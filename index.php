<?php

if (is_file("./settings.conf.php")){@require "./settings.conf.php";}
elseif(is_file("./settings.sample.conf.php"))
{
		echo "No settings found, using defaults<br />";
		copy ("./settings.sample.conf.php", "./settings.conf.php");}
else{exit ('ERROR:  Failed to access configuration files, please check installation');}

$Requirements = array(
	"includes/lang.".$CONF['Lang'].".php",
	"includes/motion_options.php",
	"includes/functions.php"
);

for ($i = 0; $i < count($Requirements); $i++){ 
	if (!include($Requirements[$i])){exit ('ERROR:  Failed to access '.$Requirements[$i].', please check installation.');}
}

?>

<head>
<title>pMotion v<?php echo $LANG['version'];?></title>