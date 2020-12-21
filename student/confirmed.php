<?php include "../inc/header.php"; ?>

<div id ="section">
<div class="navv">

<?php
if (empty($_GET['email'])===true){
	echo 'please enter email';
	header ('location: password_reset.php');
	die();
	
}
else{
	
 echo 'Password reset link has been sent to your email: ' . $_GET['email'];	
}
?>
</div>
</div>

<?php include "../inc/footer.php"; ?>