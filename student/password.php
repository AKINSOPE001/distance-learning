 <?php 
if (empty($_GET['email']) === true) {
	echo 'Email field cannot be empty';
	}
	else {
		header ('Location:confirmed.php');
		}
?>