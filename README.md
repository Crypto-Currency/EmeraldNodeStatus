# EmeraldNodeStatus

This is a small PHP application designed to display status and information from the Emerald node daemon.

#### Table of Contents

1. [Requirements](#requirements)
1. [Getting Started](#getting-started)
1. [Contributing](#contributing)
1. [Seed nodes of Emerald Crypto Coin project](#seed-nodes)
1. [Licensing](#licensing)

## Requirements

To run the application, you will need:

  * A Emerald node with RPC enabled.
  * A web-server with PHP installed.
  * The PHP `curl` module - this is used to make RPC calls to the Emerald daemon.

### PHP Support

This application has been tested with PHP 5.4, 5.5 and 5.6, as well as HHVM and Nightly PHP builds, via TravisCI.

## Getting Started

To get started, all you need to do is copy/rename `php/config.sample.php` to `php/config.php` and configure your node's RPC credentials. The application will connect to your node via RPC and report statistics.

To use Google Analytics, simply create a file called `google_analytics.inc` inside the `php` directory and paste your GA code into it.

## Collecting Connection Statistics

The script can also periodically collect the current number of connections and store it for display via Google Charts on your status page.

To do this, just schedule the `/stats.php` script to be called at whatever interval you like, then `config.php` to enable the chart display. You can optionally tweak the settings under the "Stats" section if you want to keep more or less data.

Below is an example `crontab` entry to call the script every five minutes via `curl`. It is **highly recommended** to only allow `127.0.0.1` to call the script, as allowing other IP addresses could lead to your node becoming vulnerable to DDoS attacks.

```
*/5 *  *   *   *  curl -Ssk https://127.0.0.1/stats.php > /dev/null
```


## Contributing

[![Buy me a beer!](https://cdn.changetip.com/img/graphics/Beer_Graphic.png)](https://www.changetip.com/tipme/craigwatson1987)

Contributions and testing reports are extremely welcome. Please submit a pull request or issue on [GitHub](https://github.com/craigwatson/emeraldd-status), and make sure
that your code conforms to the PEAR PHP coding standards (Travis CI will test your pull request when it's sent).

I accept tips via [ChangeTip](https://www.changetip.com/tipme/craigwatson1987) in any currency - if you would like to buy me a beer, please do!

## Advanced Options

The `config.php` file also contains lots of options to control how the application behaves, and is separated out into loose sections:

### RPC

| Value        | Type    | Default     | Explanation                        |
|--------------|---------|-------------|------------------------------------|
| `rpc_user`   | String  | `rpcuser`   | Username for RPC calls             |
| `rpc_pass`   | String  | `rpcpass`   | Password for RPC calls             |
| `rpc_host`   | String  | `localhost` | Which RPC host to connect to       |
| `rpc_port`   | String  | `12128`      | Port to use for the RPC connection |
| `rpc_ssl`    | Boolean | `false`     | Enables SSL for the RPC connection |
| `rpc_ssl_ca` | String  | `null`      | The SSL CA chain file              |

### Donations

| Value                   | Type    | Default   | Explanation                                 |
|-------------------------|---------|-----------|---------------------------------------------|
| `display_donation_text` | Boolean | `true`    | Display text to encourage donations         |
| `donation_address`      | String  | `not_set` | Emerald address to advertise for donations  |
| `donation_amount`       | String  | `0.1`   | Donation amount - not currently implemented |

### Peers

| Value               | Type    | Default | Explanation                                |
|---------------------|---------|---------|--------------------------------------------|
| `display_peer_info` | Boolean | `false` | Display connected peers                    |
| `display_peer_port` | Boolean | `false` | Display remote peer's port                 |
| `hide_dark_peers`   | Boolean | `true`  | Hides peers connected from "Dark" networks |

### Cache

| Value               | Type    | Default                       | Explanation                                                |
|---------------------|---------|-------------------------------|------------------------------------------------------------|
| `use_cache`         | Boolean |  `true`                       | Enable cache                                               |
| `cache_file`        | String  |  `/tmp/emeraldd-status.cache` | File location to write to for cache                        |
| `max_cache_time`    | Int     |  `300`                        | Expiry time for cache                                      |
| `nocache_whitelist` | Array   |  `array('127.0.0.1')`         | The IP addresses that are allowed to bypass or clear cache |

### Geolocation

| Value                 | Type    | Default | Explanation                   |
|-----------------------|---------|---------|-------------------------------|
| `geolocate_peer_ip`   | Boolean | `false` | Geolocate peers' IP addresses |
| `display_ip_location` | Boolean | `false` | Geolocate node IP address     |

### UI

| Value   | Type    | Default | Explanation                                                                                                                         |
|---------------------------|---------|-----------|---------------------------------------------------------------------------------------------------------------- |
| `display_ip`              | Boolean | `false`   | Display the server IP address                                                                                   |
| `display_free_disk_space` | Boolean | `false`   | Displayfree disk space                                                                                          |
| `display_testnet`         | Boolean | `false`   | Display testnet status                                                                                          |
| `display_version`         | Boolean | `true`    | Display node `emeraldd` version                                                                                 |
| `display_github_ribbon`   | Boolean | `true`    | Displays the 'Fork me on GitHub' ribbon                                                                         |
| `display_max_height`      | Boolean | `false`   | Displays the node height as a percentage of network height                                                      |
| `use_emeraldd_ip`         | Boolean | `true`    | Use the Emerald daemon to get the public IP, instead of `$_SERVER`                                              | 
| `intro_text`              | String  | `not_set` | Introductory text to display above the node statistics.                                                         |
| `display_bitnodes_info`   | Boolean | `false`   | Displays various information via the bitnodes.io API                                                            |
| `display_chart`           | String  | `false`   | Displays a chart showing the stats collected by the stats.php script                                            |
| `node_links`              | Array   | `array()` | Displays links to various other profiles for your node. Takes the form of a multidimensional array, see example | 

### Stats

| Value                   | Type   | Default                     | Explanation                                            |
|-------------------------|--------|-----------------------------|--------------------------------------------------------|
| `stats_whitelist`       | Array  | `array('127.0.0.1')`        | Hosts that can run the stats script                    |
| `stats_file`            | String | `/tmp/emeraldd-status.data` | File to store stats                                    |
| `stats_max_age`         | String | `604800`                    | Maximum age for stats                                  |
| `stats_min_data_points` | Int    | `5`                         | Minimum data points to collect before displaying chart |

### Uptime

| Value                     | Type    | Default    | Explanation                                                 |
|---------------------------|---------|------------|-------------------------------------------------------------|
| `display_emeraldd_uptime` | Boolean | `true`     | Displays the uptime of the Emerald daemon                   |
| `emeraldd_process_name`   | String  | `emeraldd` | Name to use when getting the emerald daemon process' uptime |

### System

| Value         | Type    | Default            | Explanation                                                  |
|---------------|---------|--------------------|--------------------------------------------------------------|
| `date_format` | String  | `H:i:s T, j F Y`   | PHP date fuction format to use when outputting dates         |
| `stylesheet`  | String  | `v2-light.css`     | CSS Stylesheet to use                                        |
| `debug`       | Boolean | false`             | If enabled, the contents of $data is echoed in HTML comments |
| `admin_email` | String  | `admin@domain.net` | Email address to display on error                            |

#### Important Note

  *  **Do not** disable cache unless you either have an alternative mechanism or your node is protected from potential DDoS attacks.

## Seed Nodes

Seed nodes of Emerald Crypto Coin project
* https://seed1.emeraldcrypto.de/EmeraldNodeStatus/
* https://seed2.emeraldcrypto.de/EmeraldNodeStatus/

## Licensing

* Copyright (C) 2015 [Craig Watson](http://www.cwatson.org)
* Forked and modified 2018 by [Pazor](https://www.emeraldcrypto.de)
* Distributed under the terms of the [Apache License v2.0](http://www.apache.org/licenses/LICENSE-2.0) - see [LICENSE file](https://github.com/craigwatson/bitcoind-status/blob/master/LICENSE) for details.
* [EasyBitcoin-PHP library](https://github.com/aceat64/EasyBitcoin-PHP) is reproduced under the terms of the [MIT licence](http://opensource.org/licenses/MIT) and is used from commit [670414e](https://github.com/aceat64/EasyBitcoin-PHP/tree/670414e1b733e11bb7bdf4fcb17169853301716b).

