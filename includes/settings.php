<?php
#################################################
#################################################
####  pMotions settings.php file             ####
####  Here we process any changes the user   ####
####  needs to make in either motion.conf    ####
####  or camera#.conf                        ####
#################################################
#################################################

echo "<h3 class='notice'>".$LANG['ConfOverride1']."</h3>";
echo "<h3 class='notice'>".$LANG['ConfOverride2']."</h3>";

if(isset($_GET['cameraID'])){
	f_mConfPage($Motion, $_GET['CameraID']);
}

else{
	f_mConfPage($Motion, "NONE");
}
?>