<?php
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

function f_ConfWrite ($Settings, $File) {
	$f = fopen($File, "w");
	$keys = array_keys($Settings);
	
	if($File = "settings.conf.php"){fwrite($f, "<?php\n");}
	for($i = 0; $i < count($Settings); $i++){
		if($File = "settings.conf.php"){fwrite($f, "\$CONF['".$keys[$i]."'] = \"".$Settings[$keys[$i]]."\";\n");}
		else{fwrite($keys[$i]." ". $Settings[$keys[$i]]."\n");}
	}
	if($File = "settings.conf.php"){fwrite($f, "?>");}
	fclose($f);
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
	echo "<form action='./' method='post' >\n";
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
	if($CamID === 'NONE'){
		$keys = array_keys($MoCONF);
		echo "<table id='center'>\n";
		echo "<form action='./?settings' method='post' >\n";
			
		for ($i = 0; $i < count($MoCONF); $i++){
			
			echo "\t<tr><td>".$keys[$i]."</td>";

			// Only processing fields which have some form of range
			if(is_array($MoCONF[$keys[$i]])){
				// Numericals only here
				if((isset($MoCONF[$keys[$i]]['max'])) && (is_numeric($MoCONF[$keys[$i]]['max']) && is_numeric($MoCONF[$keys[$i]]['min']))){
					// More than 50 options get special options
					if(($MoCONF[$keys[$i]]['max'] - $MoCONF[$keys[$i]]['min']) >= 50)
					{
						// Very large numbers get a text box
						if(($MoCONF[$keys[$i]]['max'] - $MoCONF[$keys[$i]]['min']) > 9999){
							echo "<td><input type=\"number\" value=\"".$MoCONF[$keys[$i]]['current']."\" name='settings[".$keys[$i]."]' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>";
						}
						// Smaller numbers get a slider
						else {
							echo "<td><input type=\"range\" min=\"".$MoCONF[$keys[$i]]['min']."\" max=\"".$MoCONF[$keys[$i]]['max']."\" value=\"".$MoCONF[$keys[$i]]['current']."\" id=\"".$keys[$i]."InputID\" name='settings[".$keys[$i]."]' oninput=\"".$keys[$i]."OutputID.value = ".$keys[$i]."InputID.value\">";
							echo "<output name=\"".$keys[$i]."OutputName\" id=\"".$keys[$i]."OutputID\">".$MoCONF[$keys[$i]]['current']."</output></td>";
						}
					}
					// Dropdowns
					else {
						echo "<td><select name='settings[".$keys[$i]."]'>\n";
						for ($x = $MoCONF[$keys[$i]]['min']; $x <= $MoCONF[$keys[$i]]['max']; $x++){
							echo "<option value=\"".$MoCONF[$keys[$i]]['current']."\"";
							if($x == $MoCONF[$keys[$i]]['current']){echo " selected>";}
							else {echo ">";}
							echo $x."</option>\n";
						}
						echo "</td>\n";
					}
				}
				// Other arrays
				else{
					$tkeys = array_keys($MoCONF[$keys[$i]]);
					//print_r($tkeys); # Debugging
					echo "<td><select name='settings[".$keys[$i]."]'>\n";

					for ($x = 0; $x < count($tkeys); $x++){
						if(is_array($MoCONF[$keys[$i]][$tkeys[$x]])){
							for($y = 0; $y < count($MoCONF[$keys[$i]][$tkeys[$x]]); $y++){
								if($tkeys[$x] != "current"){
									echo "<option value=\"".$MoCONF[$keys[$i]]['values'][$y]."\"";
									if(($MoCONF[$keys[$i]]['values'][$y] == $MoCONF[$keys[$i]]['current']) && isset($MoCONF[$keys[$i]]['current'])){echo " selected>";}
									else {echo ">";}
									echo $MoCONF[$keys[$i]]['values'][$y]."</option>\n";
								}
							}
						}
						else{
							if($tkeys[$x] != "current"){
								echo "<option value=\"".$MoCONF[$keys[$i]][$tkeys[$x]]."\"";
								if((isset($MoCONF[$keys[$i]]['current'])) && ($MoCONF[$keys[$i]][$tkeys[$x]] == $MoCONF[$keys[$i]]['current'])){echo " selected>";}
								else {echo ">";}
								echo $MoCONF[$keys[$i]][$tkeys[$x]]."</option>\n";
							}
						}
					}

					echo "</select></td>\n";
				}
			}
			// Everything not in an array (string, INT etc)
			else{
				echo "\t<td><input type='text' name='settings[".$keys[$i]."]' value='".$MoCONF[$keys[$i]]."'/></td></tr>\n";
			}
			echo "</tr>\n";
		}
		echo "\t<tr colspan='2' align='center'><td><input type='submit' value='Submit' /></td></tr>\n";
		echo "</form></table>\n";
	}
	else{
		echo "<form action='./?settings&CameraID=".$CamID."' method='post' >\n";
	}
}
?>