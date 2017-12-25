# Install.md

# Requirements
* Webserver (NGINX, Apache, etc) with PHP v5.3 or greater
	* You can check your PHP version by running `php -v` from the command line.
	* Test that your webserver supports PHP by making a file in your webroot named `test.php` containing `<?php phpinfo(); ?>`.  Load this file in your browser (eg http://localhost/test.php).  If you get a bunch of information about your PHP installation, it's working.
	
* Motion v4.0 or greater (v4.1.1 is the latest and recommended version at this time).
	* At this time pMotion does not do anything with any SQL-type database regardless if your Motion setup uses it.  pMotion (will) however allow you to make any adjustments to those configuration options.

## Installtion Instructions

Once your requirements have been met; place a copy of pMotion inside of your webroot and access that location in your browser (eg http://localhost/pMotion).  Upon first run (or deletion of your `settings.conf.php` file) a brief wizard will run allowing you to make adjustments.

## Virtualization

Development of pMotion is done entirely virtualized so there *should* be no reason why you can't run it the same way.  It is **heavily** recommended that both Motion and pMotion be run on the same machine however.  Development is done on a ProxMox based system using the [TurnKey Linux](https://www.turnkeylinux.org) `debian8-turnkey-nginx-php-fastcgi` template and as such will be the "best supported" method.  Splitting Motion and pMotion onto separate machines (virtual or otherwise) is theoretically possible using nfs or Samba shares (for example) but opens up a wide variety of security issues and will be left to the end user to figure out.  Such configurations however will **not** be supported, officially or otherwise at this time.  The only advice I will give for users wishing to split environments is to look into if your virtualization environment (Proxmox, ESXi etc) supports binding mount points.

### Virtual images

Direct images (docker et al) are not available at this time