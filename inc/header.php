<?php
session_start();
?>
<html>
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<title></title>
<link rel ="stylesheet" type="text/css" href="css/style.css"/>
<link rel ="stylesheet" type="text/css" href="../css/style.css"/>
<link rel ="stylesheet" type="text/css" href="../../css/style.css"/>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/jssor.js"></script>
<script type="text/javascript" src="js/jssor.slider.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="../js/dex.js"></script>
</head>
<body>
<div id="header">
<a href="<?php $page = $_SERVER['PHP_SELF'];  if ($page == '/Distant learning/index.php'){echo 'index.php';} 
else if ($page == '/Distant learning/admin/welcome/index.php' or $page == '/Distant learning/student/welcome/index.php' or
$page == '/Distant learning/lecturer/welcome/index.php')

{echo "../../index.php";}else {echo "../index.php";}?>">
<div class="first">Distance learning system</div></a>
<?php

$page = $_SERVER['PHP_SELF'];  
if ($page == '/Distant learning/index.php')
{$student = 'student'; $lecturer ='lecturer'; $admin = 'admin'; $rl = 'logout';} 
else if ($page == '/Distant learning/admin/welcome/index.php' or $page == '/Distant learning/student/welcome/index.php' or
$page == '/Distant learning/lecturer/welcome/index.php')

{ $rl = '../../logout';}
else 
{$student = "../student"; $lecturer = "../lecturer"; $admin = "../admin";  $rl = '../logout';}
if(!isset($_SESSION['name'])){
echo '<div class="secon">
<ul>
<a href="'.$student.'"><li>Student</li></a>
<a href="'.$lecturer.'"><li>Lecturer</li></a>
<a href="'.$admin.'"><li>Admin</li></a>
</ul>
';}
else
{
echo '<div id="logout">Welcome '.$_SESSION['name'].' &nbsp;<a href="'.$rl.'">Logout</a></div> ';
}

?></div>
</div>
<div id="clear"> </div>
