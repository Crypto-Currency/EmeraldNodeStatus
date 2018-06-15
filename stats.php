<?php
/**
 * Emerald Status Page - Stats
 *
 * @category File
 * @package  EmeraldStatus
 * @author   Craig Watson <craig@cwatson.org>
 * @license  https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @link     https://github.com/craigwatson/emeraldd-status
 */

require_once './php/config.php';

// Die if we're not in the whitelist
if (!in_array($_SERVER['REMOTE_ADDR'], $config['stats_whitelist'])) {
    die($_SERVER['REMOTE_ADDR'] . " is not in the whitelist");
}

// Clear data if variable present
if (isset($_GET['clear']) & is_file($config['stats_file'])) {
    unlink($config['stats_file']);
}

// Check for existing data
if (is_file($config['stats_file'])) {
    $data = json_decode(file_get_contents($config['stats_file']), true);
} else {
    $data = array();
}

// If viewing is enabled, just output and die
if (isset($_GET['view'])) {
    print_r($data);
    die();
}

// Include EasyEmerald library and set up connection
require_once './php/easyemerald.php';
$emerald = new Emerald($config['rpc_user'], $config['rpc_pass'], $config['rpc_host'], $config['rpc_port']);

// Setup SSL if configured
if ($config['rpc_ssl'] === true) {
    $emerald->setSSL($config['rpc_ssl_ca']);
}

// Get info and handle errors
$new_raw_data = $emerald->getinfo();
if (!$new_raw_data) {
    die("RPC Error");
}

// Append to array
$data[] = array('time' => time(), 'connections' => $new_raw_data['connections']);

// Purge old data
for ($i = 0; $i < count($data); $i++) {
    if ($data[$i]['time'] < (time() - $config['stats_max_age'])) {
        array_splice($data, $i, 1);
    }
}

// Save array
if (file_put_contents($config['stats_file'], json_encode($data), LOCK_EX) === false) {
    die("Failure storing data");
}
