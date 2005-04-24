<?php
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
echo $footer_open_table1;
echo $copyright;
echo $footer_close_table1;
echo $footer_open_table2;
echo $xhtml_compliance;
echo $vcss_compliance;
echo $footer_close_table2;
?>
</body>
</html>
