<?php
if(is_file("./settings.conf.php")){include_once("./settings.conf.php");}
else{include_once("./settings.sample.conf.php");}
	
$Requirements = array(
					"includes/lang.".$CONF['Lang'].".php",
					"includes/motion_options.php",
					"includes/functions.php"
					);

for ($i = 0; $i < count($Requirements); $i++){ 
	if (!include_once($Requirements[$i])){exit ('ERROR:  Failed to access '.$Requirements[$i].', please check installation.');}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>pMotion v<?php echo $LANG['version'];?></title>
<link href="./styles/<?php echo $CONF['Theme'];?>" rel="stylesheet" />
</head>
<body>
<div class="header">
	
	<a href='./?' class='header'>pMotion v<?php echo $LANG['version'];?></a>
</div>
<a href='./?settings' id='settings'>&nbsp;</a>
<?php
if(is_file("./settings.conf.php")){
	
	if($CONF['hostname'] == ""){$CONF['hostname'] = "localhost";}

	$MotionConf = f_MotionConf($CONF['MotionFolder'], $CONF['MotionConf']);

	//Detected at least one camera configuration, load it and any others
	if($MotionConf['camera']['0'] != ""){
			$CameraConf = array();
			for($i = 0; $i < count($MotionConf['camera']); $i++){
					$CameraConf[$MotionConf['camera'][$i]] = f_MotionConf($CONF['MotionFolder'], $MotionConf['camera'][$i]);
					if($CameraConf[$MotionConf['camera'][$i]]['feed_enabled'] == "on"){$CameraConf['enabled_feeds'][$MotionConf['camera'][$i]] = 'on';}
					else{$CameraConf['enabled_feeds'][$MotionConf['camera'][$i]] = 'off';}
			}
	}
	else{exit($LANG['NoCam']);}

	$Motion = f_ConfMerge($Motion, $MotionConf); // # Over-rides defaults with those from $CONF['MotionConf']
	
	if(isset($_GET['settings'])){include_once("./includes/settings.php");}
	elseif(isset($_GET['history'])){include_once("./includes/history.php");}

	// Default page, showing all enabled streams
	else{
		print_r($Motion); # Debugging
		
		// Counting enabled feeds to make sure it's > stream_wide
		$x = 0;
		$keys = array_keys($CameraConf['enabled_feeds']);
		for($i = 0; $i < count($CameraConf['enabled_feeds']); $i++){if($CameraConf['enabled_feeds'][$keys[$i]] == "on"){$x++;}}
		if($x < $Motion['stream_wide']['current']){$Motion['stream_wide']['current'] = $x;}
		unset($x);

		#print_r($CameraConf['enabled_feeds']);
	
		$x = 0;
		$y = floor(100 / $Motion['stream_wide']['current']);
		for ($i = 0; $i < count($CameraConf['enabled_feeds']); $i++){
			if($CameraConf['enabled_feeds'][$keys[$i]] == "on"){
				$x++;
				echo "<img src=\"http://".$CONF['hostname'].":".$CameraConf[$keys[$i]]['stream_port']."\" style=\"width:".$y."%;\" />";
			
				#echo "<video width=\"".$y."%\">";
				#echo "<source src=\"http://".$CONF['hostname'].":".$CameraConf[$keys[$i]]['stream_port']."/stream.mjpg\" />";
				#echo "</video>";
				if($x == "3"){$x = 0; echo "<br />";}
			}
		}
	}
}
else{if(!require("./includes/setup.php")){exit ("ERROR:  Failed to access configuration files, please check installation");}}
?>
</body>
</html>