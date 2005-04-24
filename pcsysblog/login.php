<?php
// session_start has to occur first
session_start();
include_once './includes/header.inc';
?>
<table style="width: 100%; text-align: left;" border="0"
cellpadding="2" cellspacing="2">
<tr>
<td style="width: 75%; text-align: left; vertical-align: bottom;">
<span style="font-family: Helvetica,Arial,sans-serif;">
<br />
<strong><span style="font-size: larger;">Login</span></strong>
<object>
<form action="verify_user.php" method="post">
<p><strong>Username</strong></p>
<p><input type="text" name="username" id="username" />
</p>
<p><strong>Password</strong></p>
<p><input name="admin_passwd" type="password" id="admin_passwd" />
</p>
<p><input type="submit" name="Submit" value="Login" />
</p>
</form>
</object>
</span>
<br />
</td>
</tr>
</table>
<?php
include_once './includes/footer.inc';
?> 
