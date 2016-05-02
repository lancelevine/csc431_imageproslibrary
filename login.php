<!doctype html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<html>
<!--Edits start here-->
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/colour_blue.css" />
<link rel="stylesheet" type="text/css" href="style/image_viewer.css" />

<div id="logo">
<h1>Image Processing Library</h1>
<div id="links"></div>
</div>
<!--end here-->
<head><title>Login</title></head>
<body>
<div id="content">
<div id = "phpContent">
<h1>Login</h1>
<?php
    mysql_set_charset("utf8");
    ?>
<table>
<form action="confirm.php" method="POST">
<span class="sub">Account</span>&nbsp;<input type="text" name="account"><br>
<span class="sub">Password</span> <input type="password" name="code"><br>
<tr><td><input type="submit" name="submit" value="login" /></td></tr>

</form>
</table>
<br><br>
<table>
<form action="register.php" method="POST">
<span class="sub">New Account name</span> &nbsp;&nbsp;<input type="text" name="account"><br>
<span class="sub">New Password</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="code"><br>
<span class="sub">New Name </span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" placeholder="Optional"><br>

<tr><td><input type="submit" name="register" value="register" /></td></tr>

</form>
</table>
</div>
</div>

</body>
</html>