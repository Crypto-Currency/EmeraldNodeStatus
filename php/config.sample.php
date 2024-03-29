<?php
/**
 * Emerald Status Page
 *
 * @category File
 * @package  EmeraldStatus
 * @author   Pazor <info@emeraldcrypto.de>
 * forked from Craig Watson <craig@cwatson.org> https://github.com/craigwatson/bitcoind-status
 * @license  https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @link     https://github.com/Crypto-Currency/EmeraldNodeStatus
 */

$config = array(
  // RPC
  'rpc_user'                => 'rpcuser',
  'rpc_pass'                => 'rpcpass',
  'rpc_host'                => 'localhost',
  'rpc_port'                => '12128',
  'rpc_ssl'                 => false,
  'rpc_ssl_ca'              => null,

  // Donations
  'display_donation_text'   => true,
  'donation_address'        => 'not_set',
  'donation_amount'         => '0.001',

  // Peers
  'display_peer_info'       => false,
  'display_peer_port'       => false,
  'hide_dark_peers'         => true,

  // Cache
  'use_cache'               => true,
  'cache_file'              => '/tmp/emeraldd-status.cache',
  'max_cache_time'          => 300,
  'nocache_whitelist'       => array('127.0.0.1'),

  // Geolocation
  'geolocate_peer_ip'       => false,
  'display_ip_location'     => false,

  // UI
  'display_ip'              => false,
  'display_free_disk_space' => false,
  'display_testnet'         => false,
  'display_version'         => true,
  'display_github_ribbon'   => true,
  'display_max_height'      => true,
  'use_emeraldd_ip'         => true,
  'intro_text'              => 'not_set',
  'display_bitnodes_info'   => false,
  'display_chart'           => false,
  'node_links'              => array(),

  // Stats
  'stats_whitelist'         => array('127.0.0.1'),
  'stats_file'              => '/tmp/emeraldd-status.data',
  'stats_max_age'           => '604800',
  'stats_min_data_points'   => 5,

  // Uptime
  'display_emeraldd_uptime' => false,
  'emeraldd_process_name'   => 'emeraldd',

  // System
  'date_format'             => 'H:i:s T, j F Y ',
  'stylesheet'              => 'v2-light.css',
  'debug'                   => false,
  'admin_email'             => 'admin@domain.net',
);
