Gitkeep
=======

Scan your subdirectory to find any empty dir for create a .gitkeep file

Installation
-----------

	sudo su
	cd /opt
	git clone
	chmod a+x /opt/Gitkeep/gitkeep.php
	ln -s /opt/Gitkeep/gitkeep.php /usr/bin/gitkeep

Usage
-----

	gitkeep [FOLDER]

Params
------

	In GitKeep.class.php, you can add ignored directory


Exemple of result :
-------------------

	touch "/var/www/Symfony/upload"
	touch "/var/www/Symfony/media"