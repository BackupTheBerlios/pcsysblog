<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=ISO-8859-1"
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
echo $header_open_table1;
echo $site_name;
echo $site_description;
echo $header_close_table1;
echo $header_open_table2;
echo date("M d, Y h:i a", mktime());
echo $header_close_table2;
echo $navlinks_open_table;
echo $nav_links;
echo $navlinks_close_table;
?>
