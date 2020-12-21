
<?php include("../../inc/conn.php");?>
<?php include("../../inc/header.php");?>
<div id ="section">
<div class="navv">
<a href="index.php?addcourse">Add course</a>
<a href="index.php?addlec">Assign lecturer</a>
<a href="index.php?viewlect">View lecturer</a>
<a href="index.php?student">View student</a>
</div>
<div class="content">
<?php

if (isset($_GET['addcourse']) )
{
echo'<div class="addlec">
<form method="post" action="index.php"><h2>Add course</h3>

<input type="text" name ="code" Placeholder="Course code"/><br/>
<input type="text" name ="title" Placeholder="course title"/><br/>
<input type="submit" name ="sub" value="Add"/>
</form>
</div>';
}
else if (isset($_GET['viewlect']) )
{
$query = mysql_query("SELECT * FROM lecturer");
$rows = mysql_num_rows($query);
if ($rows == 0 ){echo 'No lecturer';}
else{ echo '<table style="width:300px;"><tr><th>Lecturer name</th><th>Course taken</th></tr>';
while ($row = mysql_fetch_array($query)){
$sql = mysql_query("SELECT * FROM course WHERE lecturer_id = '{$row['0']}'");
$roww = mysql_fetch_array($sql);
echo '<tr><td>'.$row['1'].'</td><td>'.$roww['2'].'</td></tr>';}
echo '</table>';
}
}
 else if (isset($_GET['student']) )

{
$query = mysql_query("SELECT * FROM student");
$rows = mysql_num_rows($query);
if ($rows == 0 ){echo 'No Student';}
else{ echo '<table ><tr><th>Student name</th> <th>Phone Number</th><th>Country</th> <th>Email</th><th>Course register</th><th>Join Date</th></tr>';
while ($row = mysql_fetch_array($query)){

echo '<tr><td>'.$row['1'].'</td><td>'.$row['5'].'</td> <td>'.$row['3'].'</td> <td>'.$row['4'].'</td> <td><a href="index.php?coursereg='.$row['0'].'">View</a></td> <td>'.$row['7'].'</td></tr>';}
echo '</table>';
}

}
 else if (isset($_GET['coursereg'])){
 $query = mysql_query("SELECT * FROM course_register where student_id = '{$_GET['coursereg']}'"); 
$rowss = mysql_num_rows($query);
if ($rowss == 0){echo 'This student have not registered any course';} else{
echo '<table><tr><th>Course Title(code)</th> <th>Quiz / 30</th> <th>Exam / 70</th></tr>';
 while($row = mysql_fetch_array( $query)){
  $quer = mysql_query("SELECT * FROM course where course_code = '{$row['1']}'"); $ro = mysql_fetch_array( $quer);
  $que = mysql_query("SELECT * FROM assessment where lecturer_id = '{$ro['1']}'"); $ros = mysql_fetch_array( $que);

 echo'<tr><td>'.$ro['2'].'('.$ro['1'].')</td> <td>'.$ros['10'].'</td> <td>'.$ros['11'].'</td> </tr>';
 }
echo '</table>';
 }
 }
 else if (isset($_GET['addlec'])){
 $query = mysql_query("SELECT * FROM course where lecturer_id = ''");
 $rowss = mysql_num_rows( $query);
 if ($rowss == 0){echo 'There are lecturer for each courses';}
 else{
echo'<div class="addlec">
<form method="post" action="index.php"><h2>Add lecturer</h3>

<input type="text" name ="id" Placeholder="Lecturer id number"/><br/>
<input type="text" name ="name" Placeholder="Lecturer name"/><br/><select name="course">';
while ($row = mysql_fetch_array($query)){echo '<option>'.$row['2'].'</option>';}
echo '</select><br/><input type="text" name ="country" Placeholder="Country"/><br/>
<input type="text" name ="email" Placeholder="Email"/><br/>
<input type="password" name ="password" Placeholder="Password"/><br/>
<input type="submit" name ="submit" value="Add"/>
</form>
</div>';}
}
else if (isset($_POST['sub']))
{
$title = $_POST['title'];
 $code = $_POST['code'];
 $sql = mysql_query("INSERT INTO course VALUES ('{$code}', '', '{$title}')");
 if ($sql){echo 'You have sucessfully add the course';}
}
else if (isset($_POST['submit']))
{
$lecturer_id = $_POST['id'];
$email = $_POST['email'];
 $pass = sha1($_POST['password']);
 $name = $_POST['name'];
 $country = $_POST['country'];
 $course = $_POST['course'];
 $sql = mysql_query("INSERT INTO lecturer VALUES ('{$lecturer_id}', '{$name}', '{$country}', '{$email}','{$pass}')");
 $update = mysql_query("UPDATE course SET lecturer_id  = '{$lecturer_id}' WHERE Course_title ='{$course}'");
 if ($sql and $update ){echo 'You have sucessfully assign the lecturer';}
}
else
{
echo 'Welcome admin';
}
?>
</div>

<?php include("../../inc/footer.php");?>