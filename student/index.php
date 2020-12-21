<?php include("../inc/conn.php");?>
<?php include("../inc/header.php");?> 
<?php
if (isset($_GET['regsucess'])){echo '<center style="font-size:20px; color:green;">Dear '.$_GET['regsucess'].', You have sucessfully register for your distant learning. Please login to get started</center>';}
?>
<div id ="section">
<?php
if ($_POST)
{
if (isset($_POST['sub'])){
$name = $_POST['name'];
$add = $_POST['address'];
$country = $_POST['country'];
$email = $_POST['email'];
$query = mysql_query("SELECT * FROM student WHERE email = '{$email}'");
$rows = mysql_num_rows($query);
$fon = $_POST['phone'];
$pass = $_POST['password'];
$cpass = $_POST['cpass'];
if( $name == "" or $add == "" or $country == "" or $email == "" or $fon == "" or $pass == "" or $cpass == "" or $cpass != $pass or $rows != 0)
{header("location:index.php?regerror");}
else {
$password = sha1($pass);
$date = gmdate("l dS \of F Y ");
$sql = mysql_query("INSERT INTO student VALUES (null, '{$name}', '{$add}', '{$country}', '{$email}', '{$fon}', '{$password}', '{$date}')");
if ($sql){header("location:index.php?regsucess=".$name."");} else {die("query fail ".mysql_error());}
}
}
else if (isset($_POST['submit']))
{
$email = $_POST['email'];
$pass = sha1($_POST['password']);
$sql = mysql_query("SELECT * FROM student WHERE email = '{$email}'");
$row = mysql_fetch_array($sql);
$name = $row['1'];
$id = $row['0'];
if ($row['6'] == $pass and $row['4'] == $email and $pass != "" and $email != "")
{
$_SESSION['name'] = $name ;
$_SESSION['id'] = $id ;
 header("location:welcome");
 } else { header("location:index.php?loginerror"); }
}

}

else {
echo '<div class ="first">

<div id ="register">
<form method="post" action="index.php"><h2>Do not have account? Create</h3>';
if (isset($_GET['regerror'])){echo '<span>Ensure you fill all the fields appropriately</span>';}
echo '<input type="text" name ="name" Placeholder="Fullname"/><br/>
<input type="text" name ="address" Placeholder="Address"/><br/>
<input type="text" name ="country" Placeholder="Country"/><br/>
<input type="text" name ="email" Placeholder="Email"/><br/>
<input type="text" name ="phone" Placeholder="Phone Number"/><br/>
<input type="password" name ="password" Placeholder="Password"/><br/>
<input type="password" name ="cpass" Placeholder="Confirm Password"/><br/>
<input type="submit" name ="sub" value="Register"/>
</form><br/>
</div>

</div>
<div class ="second">

<div id ="login">
<form method="post" action="index.php"><h2>Login as a student</h2>';
if (isset($_GET['loginerror'])){echo '<span>Incorrect login details</span>';}
echo '

<input type="text" name ="email" Placeholder="Email"/><br/>
<input type="password" name ="password" Placeholder="Password"/><br/>
<input type="submit" name ="submit" value="Login"/></br>
<a href="password_reset.php"><i> Forgot Password?</i></a>
</form><br/>
</div>

</div>';
}
?>
</div>

<?php include("../inc/footer.php");?>