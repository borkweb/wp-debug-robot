# WP Debug Robot
An unobtrusive debugging tool for WordPress

## Description
Have you ever wanted to get debug output sent to you from WordPress without interrupting the flow of the page?  
Do you ever wish you could get debug output from _other users'_ sessions so you don't have to:

- Log in as them
- Asking them to look at debug output themselves (bleh)
- Or try in vain to re-create their issue

This plugin allows you to send debug messages via UDP to a [Jabber Bot](https://github.com/borkweb/jabberbot) that can then route
the debug information to your IM client.

_Note: This plugin sends the messages via UDP.  The receiving end doesn't necessarily need to be a Jabber bot...it could be anything you want
(e.g. email bot, logger, whatever).  My implementation is a Jabber Bot on my local dev environment :)_

## Installation
1. Upload the `wp-debug-robot` folder to your plugins directory (e.g. `wp-content/plugins`)
1. Got to Settings > Debug Robot and configure your settings.  

### HipChat
1. Set the `Api Key` and `Room` for your HipChat server

### Jabber
1. Set the `host` and `port` of the server you wish to send debug messages to.
1. Set the default `target` email address that debug messages will be routed to by a Jabber bot.
1. Configure a [Jabber Bot](https://github.com/borkweb/jabberbot) 

_Note: you will also need a dummy jabber email address to act as your jabber bot.  I created one with Google Apps called robot@mydomain.com then friended that account with my primary Google account._

## Usage
To send debug messages, simply call:

`do_action( 'debug_robot', $message [, $color ]);`

- **$message**: Message to send to your jabber bot.
- **$color**: _(optional)_ HipChat color you wish to send your message as (yellow, red, green, gray, purple, random)

To receive debug messages, you will need to have:

- Your [Jabber Bot](https://github.com/borkweb/jabberbot) installed and configured.
- The Jabber Bot must be running.
- You must have friended your robot's jabber account with another jabber account (e.g. your Google account).
- You must be signed into Google Talk in some way shape or form so that your jabber bot can IM you.

_Note: If your Jabber Bot isn't running, no worries.  UDP doesn't wait for a response so it won't impact your WordPress instance...you just won't get the messages that
are sent until your bot is running :)_

## Credits
This code was largely written by [@abackstrom](https://github.com/abackstrom) with some additions by me while we worked at [@PlymouthState](https://github.com/PlymouthState). I then ported it into a WordPress plugin.
