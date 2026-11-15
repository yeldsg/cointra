<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

// Handle OPTIONS preflight
if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($method !== 'GET') {
    sendError('Method not allowed', 405);
}

try {
    $pdo = getDBConnection();
    $userId = getCurrentUserId();
    
    if (!$userId) {
        sendError('Authentication required', 401);
    }
    
    $format = strtoupper($_GET['format'] ?? 'CSV');
    $month = $_GET['month'] ?? '';
    $year = (int)($_GET['year'] ?? date('Y'));
    $filename = $_GET['filename'] ?? 'transactions';
    
    if (!in_array($format, ['CSV', 'PDF'])) {
        sendError('Invalid format. Use CSV or PDF', 400);
    }
    
    // Map month name to number
    $monthMap = [
        'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
        'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
        'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
    ];
    
    $monthNum = isset($monthMap[$month]) ? $monthMap[$month] : (int)date('m');
    
    // Get user details
    $stmt = $pdo->prepare("
        SELECT username, email, birthday 
        FROM users 
        WHERE id = ? 
        LIMIT 1
    ");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    
    if (!$user) {
        sendError('User not found', 404);
    }
    
    // Get transactions for the specified month/year
    $stmt = $pdo->prepare("
        SELECT transaction_date, type, category, name, amount
        FROM transactions
        WHERE user_id = ? 
        AND YEAR(transaction_date) = ?
        AND MONTH(transaction_date) = ?
        ORDER BY transaction_date DESC, id DESC
    ");
    $stmt->execute([$userId, $year, $monthNum]);
    $transactions = $stmt->fetchAll();
    
    if ($format === 'CSV') {
        // Export as CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
        
        $output = fopen('php://output', 'w');
        
        // Format birthday for display
        $birthdayValue = '';
        if (!empty($user['birthday'])) {
            $birthdayValue = date('Y-m-d', strtotime($user['birthday']));
        } else {
            $birthdayValue = 'Not set';
        }
        
        // User Information Section
        fputcsv($output, ['Username', $user['username'] ?? '']);
        fputcsv($output, ['Email', $user['email'] ?? '']);
        fputcsv($output, ['Birthday', $birthdayValue]);
        fputcsv($output, []); // Empty row for spacing
        
        // Transaction Header
        fputcsv($output, ['Date', 'Type', 'Category', 'Name', 'Amount']);
        
        // Transaction Data
        foreach ($transactions as $tx) {
            fputcsv($output, [
                $tx['transaction_date'],
                $tx['type'],
                $tx['category'] ?? '',
                $tx['name'],
                number_format($tx['amount'], 2)
            ]);
        }
        
        fclose($output);
        exit;
        
    } else if ($format === 'PDF') {
        // Export as PDF (HTML format that can be printed as PDF)
        // Note: This generates HTML that can be saved/printed as PDF by the browser
        header('Content-Type: text/html; charset=UTF-8');
        header('Content-Disposition: inline; filename="' . $filename . '.html"');
        
        // Format birthday for display
        $birthdayDisplay = 'Not set';
        if (!empty($user['birthday']) && $user['birthday'] !== '0000-00-00') {
            try {
                $birthdayDisplay = date('F d, Y', strtotime($user['birthday']));
            } catch (Exception $e) {
                $birthdayDisplay = $user['birthday'];
            }
        }
        
        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transactions Export</title>
    <style>
        @media print {
            @page { margin: 1cm; }
        }
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            color: #333;
        }
        h1 { 
            color: #4CAF50; 
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .user-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .user-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .user-info td {
            padding: 5px 10px;
        }
        .user-info td:first-child {
            font-weight: bold;
            width: 120px;
        }
        .period-info {
            margin: 15px 0;
            font-size: 14px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            page-break-inside: auto;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: left; 
        }
        th { 
            background-color: #4CAF50; 
            color: white; 
            font-weight: bold;
        }
        tr:nth-child(even) { 
            background-color: #f9f9f9; 
        }
        tr { 
            page-break-inside: avoid; 
            page-break-after: auto;
        }
        .income { 
            color: #2e7d32; 
            font-weight: bold;
        }
        .expense { 
            color: #c62828; 
            font-weight: bold;
        }
        tfoot td {
            font-weight: bold;
            background-color: #f5f5f5;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Transaction Records Export</h1>
    
    <div class="user-info">
        <table>
            <tr>
                <td>Username:</td>
                <td>' . htmlspecialchars($user['username'] ?? 'N/A') . '</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>' . htmlspecialchars($user['email'] ?? 'N/A') . '</td>
            </tr>
            <tr>
                <td>Birthday:</td>
                <td>' . htmlspecialchars($birthdayDisplay) . '</td>
            </tr>
        </table>
    </div>
    
    <div class="period-info">
        <p><strong>Period:</strong> ' . htmlspecialchars($month) . ' ' . $year . '</p>
        <p><strong>Total Transactions:</strong> ' . count($transactions) . '</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Category</th>
                <th>Name</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>';
        
        $totalIncome = 0;
        $totalExpense = 0;
        
        foreach ($transactions as $tx) {
            $typeClass = $tx['type'] === 'Income' ? 'income' : 'expense';
            if ($tx['type'] === 'Income') {
                $totalIncome += (float)$tx['amount'];
            } else {
                $totalExpense += (float)$tx['amount'];
            }
            
            $html .= '<tr>
                <td>' . htmlspecialchars($tx['transaction_date']) . '</td>
                <td class="' . $typeClass . '">' . htmlspecialchars($tx['type']) . '</td>
                <td>' . htmlspecialchars($tx['category'] ?? '') . '</td>
                <td>' . htmlspecialchars($tx['name']) . '</td>
                <td>₱' . number_format((float)$tx['amount'], 2) . '</td>
            </tr>';
        }
        
        $html .= '</tbody>
        <tfoot>
            <tr>
                <td colspan="4"><strong>Total Income:</strong></td>
                <td class="income"><strong>₱' . number_format($totalIncome, 2) . '</strong></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Total Expense:</strong></td>
                <td class="expense"><strong>₱' . number_format($totalExpense, 2) . '</strong></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Net Balance:</strong></td>
                <td><strong>₱' . number_format($totalIncome - $totalExpense, 2) . '</strong></td>
            </tr>
        </tfoot>
    </table>
    
    <div class="summary">
        <p><strong>Export Date:</strong> ' . date('F d, Y') . '</p>
    </div>
    <script>
        // Auto-trigger print dialog when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 250);
        };
    </script>
</body>
</html>';
        
        echo $html;
        exit;
    }
    
} catch (PDOException $e) {
    error_log("Database Error in export.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in export.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}

