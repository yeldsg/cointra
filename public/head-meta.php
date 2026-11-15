<?php
if (!defined('COINTRA_FAVICON_INCLUDED')) {
    define('COINTRA_FAVICON_INCLUDED', true);
    // Use only largest sizes to force browser to use bigger icon
    echo '<link rel="shortcut icon" type="image/png" href="../assets/cointra-logo.png">' . PHP_EOL;
    echo '<link rel="icon" type="image/png" sizes="512x512" href="../assets/cointra-logo.png">' . PHP_EOL;
    echo '<link rel="icon" type="image/png" sizes="256x256" href="../assets/cointra-logo.png">' . PHP_EOL;
    echo '<link rel="icon" type="image/png" sizes="192x192" href="../assets/cointra-logo.png">' . PHP_EOL;
    echo '<link rel="apple-touch-icon" sizes="512x512" href="../assets/cointra-logo.png">' . PHP_EOL;
    echo '<link rel="apple-touch-icon" sizes="256x256" href="../assets/cointra-logo.png">' . PHP_EOL;
    echo '<link rel="apple-touch-icon" sizes="192x192" href="../assets/cointra-logo.png">' . PHP_EOL;
    // Use a relative path within /public so we don't accidentally look outside the web root
    echo '<link rel="manifest" href="./manifest.json">' . PHP_EOL;
}

