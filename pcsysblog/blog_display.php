<?php
echo $blog_open_table1;
// Connect to the database
include ("./includes/dbconnect.php");
// Display the blog posts
$page = $_GET['page'];
$limit          = 5;
$query_count    = "SELECT * FROM blog_post";
$result_count   = mysql_query($query_count);
$totalrows      = mysql_num_rows($result_count);
if(empty($page)){
$page = 1;
}
$limitvalue = $page * $limit - ($limit);
$query  = "SELECT * FROM blog_post ORDER BY post_date DESC LIMIT $limitvalue, $limit";
$result = mysql_query($query) or die("Error: " . mysql_error());
if(mysql_num_rows($result) == 0){
echo("Nothing to Display!");
}
while($row = mysql_fetch_array($result)){
// Begin your formatted output
echo '<h3>';
echo($row["post_title"]);
echo '</h3>';
echo '<span style="font-size: small">';
echo($row["post_date"]);
echo '</span>';
echo '<p>';
echo($row["post_text"]);
echo '</p>';
// End your formatted output
}
if($page != 1){
$pageprev = $page-1;
echo("<span style='font-size: small'><a href=\"{$_SERVER['PHP_SELF']}?page=$pageprev\">Prev ".$limit."</a></span>&nbsp;&nbsp;");
}else{
echo("");
}
$numofpages = $totalrows / $limit;
for($i = 1; $i <= $numofpages; $i++){
if($i == $page){
echo ("<span style='font-size: x-small'>");
echo($i."&nbsp;");
echo ("</span>");
}else{
echo("<span style='font-size: x-small'><a href=\"{$_SERVER['PHP_SELF']}?page=$i\">$i</a></span>&nbsp;");
}
}
if(($totalrows % $limit) != 0){
if($i == $page){
echo ("<span style='font-size: x-small'>");
echo($i."&nbsp;");
echo ("</span>");
}else{
echo("<span style='font-size: x-small'><a href=\"{$_SERVER['PHP_SELF']}?page=$i\">$i</a></span>&nbsp;");
}
}
if(($totalrows - ($limit * $page)) > 0){
$pagenext = $page+1;
echo("&nbsp;&nbsp;<span style='font-size: small'><a href=\"{$_SERVER['PHP_SELF']}?page=$pagenext\">Next ".$limit."</a></span>");
}else{
echo("");
}
mysql_free_result($result);
echo $blog_close_table1;
?>
