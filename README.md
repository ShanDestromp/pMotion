# pMotion
pMotion is a PHP based frontend to [Motion-Project](https://github.com/Motion-Project/motion).

The goal is to have full control over Motion; while also having a reasonable interface with live feeds and playback of recordings in a lightweight package.

pMotion only requires a PHP capable webserver with read/write access to wherever you store your footage; and Motion installed.  No bulky SQL databases (unless you're using one with motion) or inconvenient dependencies.

# Assumptions

* Motion is installed and running locally to the pMotion instance (same machine).
	* While handling remote installs is a (future) goal it is in the far distance and shouldn't be expected soon.
* A working webserver with PHP separate from the one included with Motion
	* NGINX is a simple to setup example and is the (primary) one used for development.
	* A reasonably modern version of PHP is required, with v5.6.30 being the version used for development.  All attempts to maintain portability will be made but straying too far from Linux + php >=5.x will probably result in issues.

# Current Status

Basic functionality is the priority at the moment - reading existing camera configurations, historical playback, and management of recordings.

Please note that any security notifications inherent to Motion are applicable here as well.  Please read and understand the security notice available at the end of the [Stream and Webcontrol](https://motion-project.github.io/motion_config.html#Options_Stream_Webcontrol) section of the official Motion-Project documents.

# Todo

A lot.  Public source (eg from github) is more or less non-functional at this time.  Consider pMotion to be non-working unless otherwise indicated.
