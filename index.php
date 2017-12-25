<?php
if (is_file("./settings.conf.php")){@require "./settings.conf.php";}
elseif(is_file("./settings.sample.conf.php"))
{
		echo "No settings found, using defaults";
		@copy ("./settings.sample.conf.php", "./settings.conf.php");
		if(is_file("./settings.conf.php")){header('Location: '.$_SERVER['PHP_SELF']);}
		else {exit ('ERROR:  Failed to access configuration files, please check installation');}
}
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
<link href="./styles/<?php echo $CONF['Theme'];?>" rel="stylesheet" />
</head>
<div class="header"><a href='./sss' class='header'>pMotion v<?php echo $LANG['version'];?></a></div>
<body>
<?php

$MotionConf = f_MotionConf($CONF['MotionFolder'], $CONF['MotionConf']);

//Detected at least one camera configuration, load it and any others
if($MotionConf['camera']['0'] != ""){
		$CameraConf = array();
		for($i = 0; $i < count($MotionConf['camera']); $i++){
				$CameraConf[$MotionConf['camera'][$i]] = f_MotionConf($CONF['MotionFolder'], $MotionConf['camera'][$i]);
		}
}
else{echo($LANG['NoCam']);}

$Motion = f_ConfMerge($Motion, $MotionConf); // # Over-rides defaults with those from $CONF['MotionConf']

?>
</body>