## address plugin for Wordpress ##
Contributors: @marchalyoan
Donate link: https://pledgie.com/campaigns/31846
Tags: address, wordpress
Requires at least: 4.5.2
Tested up to: 4.5.2
Stable tag: 4.5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

![styleCi](https://styleci.io/repos/66348625/shield) [![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9CYUE3CVEAJ2Q)


Simple save global and retrive ship address of website

== Description ==

Minimal address plugin for wordpress

== Installation ==

*This section describes how to install the plugin and get it working.*

1. Activate the plugin through the 'Plugins' menu in WordPress

For get address
`<?php $address = get_option( 'address' ); ?>`

Echo value
`<?= $address['ship-address'];?>`


== Changelog ==
= 1.0 =
Initial plugin.

== Todo ==

* Test
