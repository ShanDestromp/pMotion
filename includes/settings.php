<?php
#################################################
#################################################
####  pMotions settings.php file             ####
####  Here we process any changes the user   ####
####  needs to make in either motion.conf    ####
####  or camera#.conf                        ####
#################################################
#################################################
$Options = array("pMotion",
				$CONF['MotionConf']);

// Adds any camera#.conf files to list of options				
for($i = 0; $i <count($Motion['SysProc']['camera']); $i++){$Options[] = $Motion['SysProc']['camera'][$i];}

echo "<table id='center'>\n";
echo "<tr><td>Subsystem: </td><td> <select onChange=\"document.location=this.value\" value=\"GO\">";
echo "<option value=''> </option>";

for ($i = 0; $i < count($Options); $i++){
	echo "<option value=\"./?settings&page=".$Options[$i]."\"";
	if(isset($_GET['page']) && $_GET['page'] == $Options[$i]){echo "selected";}
	echo ">".$Options[$i]."</option>\n";
}

echo "</select></td></tr></table>\n";
echo "<br />";

if(isset($_GET['page'])){
	if($_GET['page'] == 'pMotion'){@include_once("./includes/setup.php");} // Basic Setup
	else{
		for($i = 0; $i < count($Options); $i++){
			if($_GET['page'] == $Options[$i]){ // Validates that it's something allowed to edit
				if($_GET['page'] == $CONF['MotionConf']){$CameraID = "NONE";}
				else{$CameraID = $_GET['page'];}
				f_mConfPage($Motion, $CameraID);
				#print_r($Motion);
			}
		}
	}
}

//if(isset($_GET['pMotionSettings'])){@include_once("./includes/setup.php");} // Basic Setup
//elseif(isset($_GET['cameraID'])){f_mConfPage($Motion, $_GET['CameraID']);}
//else{f_mConfPage($Motion, "NONE");}

echo "<h2 class='notice'>".$LANG['ConfOverride1']."</h2>";
echo "<h3 class='notice'>".$LANG['ConfOverride2']."</h3>";
echo "<h3 class='notice'>".$LANG['ConfOverride3']."</h3>";
?>