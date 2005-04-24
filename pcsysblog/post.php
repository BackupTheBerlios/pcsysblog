<?php
session_start();
if (! session_is_registered ( "userid" ) )
{
session_unset ();
session_destroy ();
$url = "Location: login.php";
header ( $url );
}
else
{
include_once './includes/header.inc';
?>
<table style="width: 100%; text-align: left;" border="0"
cellpadding="2" cellspacing="2">
<tr>
<td style="width: 75%; text-align: left; vertical-align: bottom;">
<span style="font-family: Helvetica,Arial,sans-serif;">
<br />
<strong><span style="font-size: larger;">Post new blog entry</span></strong>
<object>
<form action="post_entry.php" method="post">
<p><strong>Blog entry title</strong></p>
<p><input type="text" name="post_title" size="50" maxlength="50" id="post_title" />
</p>
<p><strong>Blog entry</strong></p>
<p><textarea name="post_text" rows="20" cols="80" id="info"></textarea>
</p>
<p><input type="submit" name="Submit" value="Post to blog" />
<input type="reset" name="Cancel" value="Cancel" />
</p>
</form>
</object>
</span>
<br />
</td>
</tr>
</table>
<?php
}
include_once './includes/footer.inc';
?>
