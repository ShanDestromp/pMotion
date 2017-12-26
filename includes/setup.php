<?php
#################################################
#################################################
####  pMotion setup.php                      ####
####  Essentially a 'first run' wizard, used ####
####  to generate a settings.conf.php file   ####
####  from (sane) defaults.                  ####
#################################################
#################################################

if(is_file("./settings.sample.conf.php")){
	@include_once("./settings.sample.conf.php");
	@include_once("./includes/functions.php");
	if(isset($_POST['settings'])){f_ConfWrite($_POST['settings'], "./settings.conf.php");}
	else{f_pMConfPage($CONF);}	
}
else{exit ('ERROR:  Default settings missing, unable to continue.');}