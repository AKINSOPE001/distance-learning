<?php include "../inc/header.php"; ?>
<div class="content" style="height:300px">
<div class="section">

<div align="center" style=" padding: 0 0 20px; margin: 5px 0 5px 0;  height: 200px;" >
<form action="confirmed.php" method="get">
	<ul style="list-style:none">
	<li>Enter your email address of registration</li> <li><input type="text" name="email"></li>
    <li><input type="submit" value="Reset" name="Submit"></li>
      <?php 
if (empty($_GET['email']) === true) {
	echo '<i style="color: red">Email field cannot be empty</i>';
	}
	else {
		header ('Location:confirmed.php');
		}
?>
	</ul>
</form>

</div> 
</div>
</div>

</div>


<?php include "../inc/footer.php"; ?>


