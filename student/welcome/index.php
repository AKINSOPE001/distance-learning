
<?php include("../../inc/conn.php");?>
<?php include("../../inc/header.php");?>
<div id ="section">
<div class="navv">
<a href="index.php?vcourses">Register Course</a>
<a href="index.php?regcourse">Registered Courses</a>
<a href="index.php?asses">Assessment</a>

</div>
<div class="content">
<?php
if (isset($_GET['vcourses']) )
{
$query = mysql_query("SELECT * FROM course");
while($row = mysql_fetch_array($query)){echo $row['2'].'('.$row['0'].') <a href="index.php?reg='.$row['0'].'">Register</a><br/>';}

}
 else if (isset($_GET['regcourse'])){
 $query = mysql_query("SELECT DISTINCT course_id FROM course_register WHERE student_id = '{$_SESSION['id']}'");
 echo '<table style="margin-top:-20px;"><tr><td>Course Title</td> <td>Course Code</td> <td>Lecturer Name</td><td>Lecture document</td> <td>Quiz</td> <td>Exam</td></tr>';
while($row = mysql_fetch_array($query)){
$id = $row['0'];
$sl = mysql_query("SELECT * FROM course WHERE course_code = '{$id}' "); $res = mysql_fetch_array($sl);
$sll = mysql_query("SELECT * FROM lecturer WHERE lecturer_id = '{$res['1']}' "); $resu = mysql_fetch_array($sll);
$slll = mysql_query("SELECT * FROM lecture WHERE lecturer_id = '{$res['1']}' "); 
$resul = mysql_fetch_array($slll); if($resul['1'] == "") {$results ="No Lecture";} else {$results ="<a href='../../lectures/".$resul['1']."'>download</a>";}
$sllll = mysql_query("SELECT * FROM assessment WHERE lecturer_id = '{$res['1']}' "); $result = mysql_num_rows($sllll); $asses = mysql_fetch_array($sllll); if($result == 0) {$resultss ="Quiz not set";} else if ($asses['6'] == 'Yes'){$resultss ="Quiz taken";} else{ $resultss = "<a href='index.php?takeurquiz=".$asses['0']."'>Take Your quiz now</a>";}
$slllll = mysql_query("SELECT * FROM assessment WHERE lecturer_id = '{$res['1']}' "); $sult = mysql_num_rows($slllll); $assess = mysql_fetch_array($slllll); if($sult == 0) {$resultsss ="Exam Not Set";} else if ($assess['4'] == 'Not Set'){$resultsss ="Exam Not Set";} else if ($assess['7'] == 'Yes'){$resultsss ="Exam taken";}  else{ $resultsss = "<a href='index.php?takeurexam=".$assess['0']."'>Take Your Exam now</a>";}
echo '<tr><td>'.$res['2'].'</td> <td>'.$row['0'].'</td><td>'.$resu['1'].'</td><td>'.$results.'</td>
<td>'.$resultss.'</td><td>'.$resultsss.'</td></tr> <br/>';}
 echo '</table>';
}
 else if (isset($_GET['takeurquiz'])){
 $sql = mysql_query("SELECT quiz FROM assessment WHERE id = '{$_GET['takeurquiz']}'  ");
 $result = mysql_fetch_array($sql);
 echo "Question<br/>".$result['0']."<br/>Answer <br/><form><input type='hidden' value = '".$_GET['takeurquiz']."' name='id'/>
 <textarea rows='5' cols='30' name='ans'></textarea><br/><input type='submit' name='answ' value='Submit'/></form>";
 
 }
 else if (isset($_GET['answ'])){ if( isset($_GET['ans']) and $_GET['ans'] != ''){
 $sql = mysql_query("UPDATE assessment SET quiz_answer = '{$_GET['ans']}', quiz_taken = 'Yes' WHERE id = '{$_GET['id']}' ");
 if ($sql){echo 'You have have atempted the quiz sucessfully ';}
 }
 }
 else if (isset($_GET['takeurexam'])){
 $sql = mysql_query("SELECT * FROM assessment WHERE id = '{$_GET['takeurexam']}'  ");
 $result = mysql_fetch_array($sql);
 echo "Question 1<br/>".$result['3']."<br/>Question 2<br/>".$result['4']."<br/>Question 3<br/>".$result['4']."<br/>Answer <br/>
 <form><input type='hidden' value = '".$_GET['takeurexam']."' name='id'/>
 <textarea rows='5' cols='30' name='ans'></textarea><br/><input type='submit' name='exa' value='Submit'/></form>";
 
 }
 else if (isset($_GET['exa'])){
 if( isset($_GET['ans']) and $_GET['ans'] != ''){
 $sql = mysql_query("UPDATE assessment SET exam_answer = '{$_GET['ans']}', exam_taken = 'Yes' WHERE id = '{$_GET['id']}' ");
 if ($sql){echo 'You have have atempted the Exam sucessfully ';} else { die ("error". mysql_error());}
 }
 }
 else if (isset($_GET['asses'])){
 $query = mysql_query("SELECT DISTINCT course_id FROM course_register WHERE student_id = '{$_SESSION['id']}'");
 echo '<table><tr><td>Course Title(Code)</td> <td>Quiz over 30</td><td>Exam over 70</td> <td>Total over 100</td> </tr>';
while($row = mysql_fetch_array($query)){
$id = $row['0'];
$sl = mysql_query("SELECT * FROM course WHERE course_code = '{$id}' "); $res = mysql_fetch_array($sl);
$sll = mysql_query("SELECT * FROM assessment WHERE lecturer_id = '{$res['1']}' "); $ress = mysql_fetch_array($sll);
if($ress['10'] == ""){$quiz = "Not Taken";} else{ $quiz = $ress['10'];}
if($ress['11'] == ""){$exam = "Not Taken";} else{ $exam = $ress['11'];}
$total = $ress['11']+$ress['10'];
echo '<tr> <td>'.$res['2'].'('.$row['0'].')</td>  <td>'.$quiz.'</td> <td>'.$exam.'</td><td>'.$total.'</td>  </tr>';
}
echo'</table>';
 }
 else if (isset($_GET['reg'])){
 $sql = mysql_query("INSERT INTO course_register VALUES (null, '{$_GET['reg']}', '{$_SESSION['id']}')");
 if ($sql){echo 'You have registered the couse ';}
}

else
{
$sql = mysql_query("SELECT * FROM student WHERE id ='{$_SESSION['id']}'"); 
$row = mysql_fetch_array($sql);
echo
'<table id="userta">
<tr><td>Name</td><td>'.$row['1'].'</td></tr>
<tr><td>Email</td><td>'.$row['4'].'</td></tr>
<tr><td>Address</td><td>'.$row['2'].'</td></tr>
<tr><td>Country</td><td>'.$row['3'].'</td></tr>
<tr><td>Phone Number</td><td>'.$row['5'].'</td></tr>
<tr><td>Join Date</td><td>'.$row['7'].'</td></tr>
</table>';

}
?>
</div>

<?php include("../../inc/footer.php");?>