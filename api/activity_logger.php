<?php
$activityLogsReady = false;

if (!function_exists('logActivity')) {
    function ensureActivityLogsTable($pdo)
    {
        global $activityLogsReady;
        if ($activityLogsReady) {
            return;
        }

        try {
            $activityLogsReady = true;
        } catch (Exception $e) {
            error_log('Activity log table setup skipped: ' . $e->getMessage());
            $activityLogsReady = true;
        }
    }

    function logActivity($pdo, $userId, $entity, $action, $details = null)
    {
        if (!$userId) {
            return;
        }

        try {
            ensureActivityLogsTable($pdo);
            if (is_array($details)) {
                $details = json_encode($details);
            }

            $stmt = $pdo->prepare("
                INSERT INTO activity_logs (user_id, entity, action, description)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$userId, $entity, $action, $details]);
        } catch (Exception $e) {
            error_log('Activity log write failed: ' . $e->getMessage());
        }
    }
}

