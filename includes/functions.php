<?php
#################################################
#################################################
####  Master 'functions' file.               ####
####  If we believe a function *might* be    ####
####  reused anywhere other than a single    ####
####  page then it belongs in here.          ####
#################################################
#################################################




// Parses the master motion.conf file
// At this point we just put it into an array of it's own
// We don't bother associating with the "proper" array from motion_options.php yet
function f_MotionConf ($fPath, $fFile) {
	if(is_file($fPath."/".$fFile)){
		$f = file($fPath."/".$fFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$ConfOpts = array();
		
		for ($i = 0; $i < count($f); $i++){
				$l = explode(" ", $f[$i]);
				if (!strstr($l[0], "#") && !strstr($l[0], ";") && ($l['0'] != "" && $l['1'] != "")){
					if(strtolower($l['0']) == 'camera'){$ConfOpts["$l[0]"][] = $l['1'];}
					else{$ConfOpts["$l[0]"] = $l['1'];}
				}
		}
	}
	ksort($ConfOpts);
	return($ConfOpts);
}

// We're now merging the real configuration file in with our 'defaults' from motion_options.conf
function f_ConfMerge($Motion, $MotionConf){
	//print_r($MotionConf); // #Debugging
	//print_r($Motion); // #Debugging
	
	$cKeys = array_keys($Motion); // Getting category key names ('SysProc', 'Database', etc)
	//print_r($cKeys); // #Debugging
	$nKeys = array_keys($MotionConf); // Keys from motion.conf
	//print_r($nKeys); // Debugging
	
	for($z = 0; $z < count($nKeys); $z++){
		// Walking through the categories
		for($i = 0; $i < count($Motion); $i++){
			$oKeys = array_keys($Motion[$cKeys[$i]]); // Configuration option keys ('daemon', 'netcam_url', 'camera', etc)
			//print_r($oKeys); // # Debugging
			
			// Walking the options
			for ($x = 0; $x < count($oKeys); $x++){
				// Checks we're in the right category and option
				if((isset($Motion[$cKeys[$i]][$oKeys[$x]]) || array_key_exists($oKeys[$x], $Motion[$cKeys[$i]])) && (strcasecmp($oKeys[$x], $nKeys[$z]) == 0)){
					// Only the 'current' value, nothing else
						if(isset($Motion[$cKeys[$i]][$oKeys[$x]]['current']) || @array_key_exists('current', $Motion[$cKeys[$i]][$oKeys[$x]])){
							//echo "Category: ".$cKeys[$i]." Key: ".$oKeys[$x]." OLD: ".$Motion[$cKeys[$i]][$oKeys[$x]]['current']." NEW: ".$MotionConf[$nKeys[$z]]." FROM: ".$nKeys[$z]."<br />\n"; # Debugging
							$Motion[$cKeys[$i]][$oKeys[$x]]['current'] = $MotionConf[$nKeys[$z]];
						}
						// Options that don't have Min/Max style limits;
						else{
							//echo "Category: ".$cKeys[$i]." Key: ".$oKeys[$x]." OLD: ".$Motion[$cKeys[$i]][$oKeys[$x]]." NEW: ".$MotionConf[$nKeys[$z]]." FROM: ".$nKeys[$z]."<br />\n"; # Debugging
							$Motion[$cKeys[$i]][$oKeys[$x]] = $MotionConf[$nKeys[$z]];
						}
					}
			}
		}
	}
	return $Motion;			
}

#################################################
#################################################
####              NOTICE                     ####
####  This will outright remove existing     ####
####  data inside the file and REQUIRES      ####
####  that $Motion[SysProc][camera] ONLY     ####
####  contains the filenames, not their      ####
####  associated settings.                   ####
#################################################
#################################################

// Writes the configuration file(s)
function f_ConfWrite ($Settings, $File) {
	global $CONF;
	$f = fopen($File, "w");
	
	// Only for pMotion settings
	if($File = "settings.conf.php"){
		$keys = array_keys($Settings);
		fwrite($f, "<?php\n");
	
		for($i = 0; $i < count($Settings); $i++){fwrite($f, "\$CONF['".$keys[$i]."'] = \"".$Settings[$keys[$i]]."\";\n");}
		fwrite($f, "?>");
	}
	else{
		$cKeys = array_keys($Settings); 
		for($i = 0; $i < count($cKeys); $i++){
			$oKeys = array_keys($Settings[$cKeys[$i]]);
			for($x = 0; $x < count($oKeys); $x++){
				fwrite($f, $oKeys[$x]." ".$Settings[$cKeys[$i]][$oKeys[$x]]."\n");
			}
		}
	}
	fclose($f);
	//echo "<meta http-equiv=\"refresh\" content=\"0\">";
	//echo "<script>location.reload();</script>";
}

// Used for scanning a directory and returning specific items
function f_scanDir($Dir, $Search){
	
	// Gather all the languages
	$t = array_values(array_diff(scandir($Dir), array('..', '.')));
	$tArray = array();
	for ($i = 0; $i < count($t); $i++){
		if(strpos($t[$i], $Search) !== false){
			$tArray[] = $t[$i];
		}
	}
	return $tArray;	
}

// pMotion specific configuration ('settings.conf.php' only);
function f_pMConfPage ($DefCONF){
	global $CONF;
	$keys = array_keys($DefCONF);
	
	$Themes = f_scanDir('./styles', 'css');
	$Lang = f_scanDir('./lang', 'lang');
	
	echo "<table id='center'>\n";
	echo "<form action='".$_SERVER['REQUEST_URI']."' method='post'>\n";
		for ($i = 0; $i < count($DefCONF); $i++){
		if($keys[$i] == 'Theme' || $keys[$i] == 'Lang'){
			if($keys[$i] == 'Theme'){$Which = $Themes; $Set = $CONF['Theme'];}
			else{$Which = $Lang; $Set = $CONF['Lang'];}
			echo "\t<tr><td>".$keys[$i]."</td><td>\n";
			echo "<select name='settings[".$keys[$i]."]'>\n";
			for($x = 0; $x < count($Which); $x++){
				echo "<option value=\"".$Which[$x]."\"";
				if($Which[$x] == $Set){echo " selected>";}
				else{echo ">";}
				echo $Which[$x]."</option>\n";
			}
			echo "</select></td></tr>\n";
		}
		else{echo "\t<tr><td>".$keys[$i]."</td><td><input type='text' name='settings[".$keys[$i]."]' value='".$DefCONF[$keys[$i]]."'/></td></tr>\n";}
	}
	echo "\t<tr colspan='2' align='center'><td><input type='submit' value='Submit' /></td></tr>\n";
	echo "</form></table>\n";
}

// Motion's configuration options + the few we add because they don't make sense in settings.conf.php
/* NEEDS TO BE RE-WRITTEN TO MATCH motion_options.php FORMAT */

function f_mConfPage ($MoCONF, $CamID){
	global $CONF;
	if($CamID != "NONE"){
	}
	else{
		$EnabledCameras = array();
		// Need to pull in our camera configurations
		global $CameraConf;
		//print_r($CameraConf['enabled_feeds']); # Debugging
		$tCameras = $MoCONF['SysProc']['camera']; // "Old" list of enabled cameras
		//print_r($tCameras); # Debugging
		
		// Select only enabled cameras
		for ($i = 0; $i < count($tCameras); $i++){ if($CameraConf['enabled_feeds'][$tCameras[$i]] == 'on'){$EnabledCameras[] = $tCameras[$i];}}
		//print_r($EnabledCameras); # Debugging
		
		//Over-ride previous camera list with the new one
		$MoCONF['SysProc']['camera'] = $EnabledCameras;
		//print_r($MoCONF['SysProc']['camera']);
	}
	
}
?>