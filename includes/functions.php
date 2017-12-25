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
				if(isset($Motion[$keys[$i]]['current']) || array_key_exists('current', $Motion[$keys[$i]])){
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

?>