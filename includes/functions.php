<?php
// Parses the master motion.conf file
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
		$keys = array_keys($MotionConf); //Getting just the key names
		for($i = 0; $i < count($MotionConf); $i++){
			
			// Ensuring that we're updating the right variable.
			if(isset($Motion[$keys[$i]]) || array_key_exists($keys[$i], $Motion)){
				// We only want to update the 'current' value, not our min/max limits.
				if(isset($Motion[$keys[$i]]['current']) || @array_key_exists('current', $Motion[$keys[$i]])){
					//echo "Key: ".$keys[$i]." OLD: ".$Motion[$keys[$i]]['current']." NEW: ".$MotionConf[$keys[$i]]."<br />"; # Debugging
					$Motion[$keys[$i]]['current'] = $MotionConf[$keys[$i]];
				}
				// For options that don't have Min/Max limits (strings, INTs etc)
				else{
					//echo "Key: ".$keys[$i]." OLD: ".$Motion[$keys[$i]]." NEW: ".$MotionConf[$keys[$i]]."<br />"; # Debugging
					$Motion[$keys[$i]] = $MotionConf[$keys[$i]];
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

function f_pMConfPage ($DefCONF){
	$keys = array_keys($DefCONF);
	echo "<table id='center'>\n";
	echo "<form action='./' method='post' >\n";
		for ($i = 0; $i < count($DefCONF); $i++){
		echo "\t<tr><td>".$keys[$i]."</td><td><input type='text' name='settings[".$keys[$i]."]' value='".$DefCONF[$keys[$i]]."'/></td></tr>\n";
	}
	echo "\t<tr colspan='2' align='center'><td><input type='submit' value='Submit' /></td></tr>\n";
	echo "</form></table>\n";
}

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

					echo "</td>\n";
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