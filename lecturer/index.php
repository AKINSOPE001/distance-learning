
<?php include("../inc/conn.php");?>
<?php include("../inc/header.php");?>
<?php
if (!$_POST)
{ echo'
<div id ="login">
<form method="post" action="index.php"><h2>Login as an lecturer</h3>';
if (isset($_GET['error'])){echo '<span>Incorrect login details</span>';}
echo '<input type="text" name ="email" Placeholder="Email"/><br/>
<input type="password" name ="password" Placeholder="Password"/><br/>
<input type="submit" name ="submit" value="Login"/>
<a href="../student/password_reset.php"><i> Forgot Password?</i></a>
</form><br/>
</div>';}
else
{
$email = $_POST['email'];
$pass = sha1($_POST['password']);
$sql = mysql_query("SELECT * FROM lecturer WHERE password = '{$pass}' AND email = '{$email}'");
$row = mysql_num_rows($sql);
if ($row == 1)
{
$ro = mysql_fetch_array($sql);
$_SESSION['name'] = $ro['1'];
$_SESSION['id'] = $ro['0'];
header("location:welcome");

} else { header("location:index.php?error"); }
}
?>
<?php include("../inc/footer.php");?>