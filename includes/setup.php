<?php
#################################################
#################################################
####  pMotion setup.php                      ####
####  Essentially a 'first run' wizard, used ####
####  to generate a settings.conf.php file   ####
####  from (sane) defaults.                  ####
#################################################
#################################################

if(!isset($_GET['settings'])){
	if(is_file("./settings.sample.conf.php")){
		@include_once("./settings.sample.conf.php");
		@include_once("./includes/functions.php");
		if(isset($_POST['settings'])){
			f_ConfWrite($_POST['settings'], "./settings.conf.php");
			unset($_POST['settings']);
			//header("Refresh:0; url=./?settings&pMotionSettings");
		}
		f_pMConfPage($CONF);	
	}
	else{exit ('ERROR:  Default settings missing, unable to continue.');}
}
else{
	if(isset($_POST['settings'])){
		f_ConfWrite($_POST['settings'], "./settings.conf.php");
		unset($_POST['settings']);
		//header("Refresh:0; url=./?settings&pMotionSettings");	
	}
	f_pMConfPage($CONF);
}