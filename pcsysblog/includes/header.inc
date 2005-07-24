<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8"
http-equiv="content-type" />
<meta content="blog system" name="description" />
<title>PCSysBlog Site</title>
<link rel="stylesheet" type="text/css" href="./includes/pcsysblog.css" />
<?php
include './includes/common.inc';
?>
</head>
<body>
<?php
// For security reasons, lets make sure the install directory has been deleted
if (file_exists(install)){
echo("<p><img src='../images/fail.png' width='12' height='12' border='0' name='success.png' alt='Success'>&nbsp;Leaving the install directory in place is a big security risk!</p><p>Please delete the install directory, then refresh this page.</p>");
// If it hasn't been deleted, exit now
exit();
// If it has been deleted, lets continue
}else{
echo $header_open_table1;
echo $image_webhome;
echo $header_close_table1;
echo $header_open_table2;
echo date("M d, Y h:i a", mktime());
echo $header_close_table2;
echo $navlinks_open_table;
if (! session_is_registered ( "userid" ) )
{
echo $visitor_nav_links;
}
else
{
echo $admin_nav_links;
}
echo $navlinks_close_table;
}
?>
