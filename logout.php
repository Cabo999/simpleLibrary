<?php  
$loggedIn = "loggedIn";
 $cvalue = "";
setcookie($loggedIn,$cvalue,time()-3600,"/","",true);
flush();
sleep(1);
echo '<script> window.location.assign("https://libsimple.000webhostapp.com/")</script>';

?>
