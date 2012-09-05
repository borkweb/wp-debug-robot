# Debug Robot
An unobtrusive debugging tool for WordPress

## Description

## Installation
1. Upload the `wp-debug-robot` folder to your plugins directory (e.g. `wp-content/plugins`)
1. Copy `wp-debug-robot/config.sample.php` to `wp-debug-robot/config.php`
1. Edit `config.php` to set the `host` and `port` of the server you wish to send debug messages to.
1. Edit `config.php` to set the default `target` email address that debug messages will be routed to by a Jabber bot.
1. Configure a [Jabber Bot](https://github.com/borkweb/jabberbot) 

_Note: you will also need a dummy jabber email address to act as your jabber bot.  I created one with Google Apps called robot@mydomain.com then friended that account with my primary Google account._

## Usage
To send debug messages, simply call:

`do_action( 'debug_robot', $message [, $target ]);`

**$message**: Message to send to your jabber bot.
**$target**: _(optional)_ Email address that your jabber bot will route the message to.

To receive debug messages, you will need to have:

- Your [Jabber Bot](https://github.com/borkweb/jabberbot) installed and configured.
- The Jabber Bot must be running.
- You must have friended your robot's jabber account with another jabber account (e.g. your Google account).
- You must be signed into Google Talk in some way shape or form so that your jabber bot can IM you.

## Credits
This code was largely written by [@abackstrom](https://github.com/abackstrom) with some additions by me while we worked at [@PlymouthState](https://github.com/PlymouthState). I then ported it into a WordPress plugin.
