<?php
date_default_timezone_set('America/Los_Angeles');
$local_time_zone_factor = trim(date('O', strtotime("now")), "-0");
global $now;
$now = time();
require('wp/wp-blog-header.php');
?>
