<?php

$counter_logfile = 'visitor_counter.txt';  // will used to store count! This file should contain beside this script file. 
// 5 minit in seconds
$inactive = 300;  // how many second? Set the session max lifetime ? 1m = 60s 
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime 

session_start();

if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    // last request was more than 2 hours ago
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}

$_SESSION['testing'] = time(); // Update session
if( isset( $_SESSION['visit_count'] ) )
   {
      $_SESSION['visit_count'] += 1;
   }
   else
   {
      $_SESSION['visit_count'] = 1;
   } 

   if($_SESSION['visit_count']<2) { 

      // Open log file for reading and writing
      if ($vfile = @fopen($counter_logfile, 'r+'))
      {
      // Lock log file from other scripts
         $locked = flock($vfile, LOCK_EX);

         // Lock successful?
         if ($locked)
         {
         // Let's read current count
            $count = intval( trim( fread($vfile, filesize($counter_logfile) ) ) );

            // Update count by 1 and write the new value to the log file
            $count = $count + 1;
            rewind($vfile);
            fwrite($vfile, $count);

         }
         else
         {
         // Lock not successful. Better to ignore than to damage the log file
            $count = 1;
         }

         // Release file lock and close file handle
         flock($vfile, LOCK_UN);
         fclose($vfile);
      } 
   }

?>

<!DOCTYPE html>
<html lang="en">
<style>
	body {
		text-align: center;
		font-family: sans-serif;
	}
	.title {
		padding-top: 50px;
		padding-bottom: 50px;
	}
	.visitor-container {
		padding-bottom: 40px;
		font-size: 18px;

	}
</style>
<head>
	<meta charset="UTF-8">
	<title>Simple PHP Session Visitor hit Counter Demo Page</title>
</head>
<body>
	<h3 class="title"> Simple PHP Session Visitor hit Counter Demo Page </h3>
	<p class="visitor-container"> Page has been Visited <?php include('visitor_counter.txt'); ?> Times </p> 

	<p>If you visit this page after 5 minuet (adjustable) or from different web browser,<br> you will be counted  as new visitor</p>
	
	<p>Download this simple php visitor hit counter from gitHun <br>@ 
	<a href="https://github.com/shariarbd/Simple-PHP-Session-Visitor-hit-Counter">Simple PHP Session Visitor hit Counter</a></p>
</body>
</html>
