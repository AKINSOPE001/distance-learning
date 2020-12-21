
<?php include("../../inc/conn.php");?>
<?php include("../../inc/header.php");?>
<div id ="section">
<div class="navv">

<a href="index.php?upload">Upload Lecture</a>
<a href="index.php?quiz">Set Quiz</a>
<a href="index.php?exam">Set Exam</a>
<a href="index.php?scorestudent">Score Student</a>
</div>
<div class="content">
<?php
if (isset($_GET['scorestudent']) )
{
$sql = mysql_query("SELECT * FROM assessment WHERE lecturer_id = '{$_SESSION['id']}'");
 $rows = mysql_num_rows($sql);
 if ($rows = 0){echo 'No student has registered for your course';} else{ 
 echo '<table> <tr><th>Student id</th> <th>Quiz Answer</th> <th>Exam Answer</th> <th>Quiz score</th><th>Exam score</th></tr>';
 while($row = mysql_fetch_array($sql)){
  $sqll = mysql_query("SELECT * FROM course WHERE lecturer_id ='{$_SESSION['id']}'"); $roww = mysql_fetch_array($sqll);
  $sqllo = mysql_query("SELECT * FROM course_register WHERE course_id ='{$roww['0']}'"); $rowws = mysql_fetch_array($sqllo);
  $query = mysql_query("SELECT names FROM student WHERE id ='{$rowws['2']}'"); $rrowws = mysql_fetch_array($query);
  
 if ($row['10'] == 0){ $scor = '<a href ="index.php?givequizscore='.$row['0'].'">Give Score</a>';} else {$scor = $row['10']; }
 if ($row['11'] == 0){ $score = '<a href ="index.php?giveexamscore='.$row['0'].'">Give Score</a>';} else {$score = $row['11']; }
 echo '<tr><td>'.$rrowws['0'].'</td> <td>'.$row['8'].'</td> <td>'.$row['9'].'</td> <td>'.$scor.'</td> <td>'.$score.'</td> </tr>';
 }
echo '</table>';
 }
}
 else if (isset($_GET['givequizscore'])){
 echo 'Enter Quiz score<br/><form> <input type="hidden"/ name="id" value="'.$_GET['givequizscore'].'"><input type="text" name="score"/><br/>
<input type="submit" name="sco" value ="Submit"/> ';

 }
 else if (isset($_GET['scco'])){$sql = mysql_query("UPDATE assessment SET exam_score = '{$_GET['score']}' WHERE id = '{$_GET['id']}'"); 
 if ($sql){header("location:index.php?scorestudent");}
 }
 else if (isset($_GET['sco'])){$sql = mysql_query("UPDATE assessment SET quiz_score = '{$_GET['score']}' WHERE id = '{$_GET['id']}'"); 
 if ($sql){header("location:index.php?scorestudent");}
 }
 else if (isset($_GET['giveexamscore'])){
 echo 'Enter Exam score<br/><form> <input type="hidden"/ name="id" value="'.$_GET['giveexamscore'].'"><input type="text" name="score"/><br/>
<input type="submit" name="scco" value ="Submit"/> ';
 }
 else if (isset($_GET['upload']))
 {
 echo '<h2>Upload lecture</h2>';
 if ($_GET['upload'] =="error"){echo '<span style="color:red;">Specified file not selected </span><br/>';}
 echo 'Select the file you want to upload it  can either be pdf or powerpoint slides <br/>
 <form method="post" action="index.php"  enctype="multipart/form-data">
 <input type="file" name="pic" /><br/>
 <input type="submit" value="Upload" name ="upload"/>
 </form>
 ';
 }

 else if (isset($_GET['quiz'])){$sql = mysql_query("SELECT * FROM assessment WHERE lecturer_id = '{$_SESSION['id']}' ");
 $row = mysql_num_rows($sql);
 if ($row == 1){echo "You have already set the quiz";}
else{ echo '<h2>Question</h2><form action="index.php" method = "post">
 <textarea name="ques" rows="10" cols ="30"></textarea><br/>
 <input type="submit" name="sub"  value="Set"/>
 </form>';}
 }
 else if (isset($_GET['exam']))
{
$sql = mysql_query("SELECT * FROM assessment WHERE lecturer_id = '{$_SESSION['id']}' ");
 $row = mysql_fetch_array($sql);
  $rows = mysql_num_rows($sql);
  if ($rows != 1){echo "Set the quiz first";}
 else if ($rows == 1 and $row['4'] != "Not Set"){echo "You have already set the Exam";}
else{ 
echo '<form action="index.php" method = "post"><h4>Question 1</h4>
 <textarea name="ques1" rows="4" cols ="30"></textarea><br/>
 <h4>Question 2</h4>
 <textarea name="ques2" rows="4" cols ="30"></textarea><br/>
 <h4>Question 3</h4>
 <textarea name="ques3" rows="4" cols ="30"></textarea><br/>
 <input type="submit" name="submit" value="Set"/>
 </form>';}
}
else if (isset($_POST['sub'])){
$ques ="Not Set"; $no = "No"; $score = 0;
$sql = mysql_query("INSERT INTO assessment VALUES (null, '{$_SESSION['id']}', '{$_POST['ques']}', '{$ques}', '{$ques}', '{$ques}', '{$no}', '{$no}', '', '', '{$score}', '{$score}')");
if ($sql){ echo 'You have sucessfully set the quiz';}
 }
else if (isset($_POST['submit'])){
$ques1 = $_POST['ques1'];
$ques2 = $_POST['ques2'];
$ques3 = $_POST['ques3'];
$sqll = mysql_query("UPDATE assessment SET question1 = '{$ques1}', question2 = '{$ques2}', question3 = '{$ques3}' WHERE lecturer_id = '{$_SESSION['id']}'");
if ($sqll){ echo 'You have sucessfully set the Exam';}

}
 else if ($_FILES)
{
$name = $_FILES['pic']['name'];
$tmp = $_FILES['pic']['tmp_name'];
$type = $_FILES['pic']['type'];
$size = $_FILES['pic']['size'];
$uploaddir = '../../lectures/';
$uploadfile = $uploaddir . basename($name);
if ($type == "application/pdf" or $type == "application/vnd.openxmlformats-officedocument.presentationml.presentation" )
{
$query = mysql_query("INSERT INTO lecture VALUES (null, '{$name}', '{$_SESSION['id']}')");
move_uploaded_file($tmp, $uploadfile);
echo 'You have sucessfully uploaded the lecture';
}else {header("location:index.php?upload=error");}
}
else
{
$id = $_SESSION['id'];
$sql = mysql_query("SELECT Course_title From course WHERE lecturer_id= '{$id}'");
$title = mysql_fetch_array($sql);
echo ''.$title['0'].' Lecturer';
}
?>
</div>

<?php include("../../inc/footer.php");?>