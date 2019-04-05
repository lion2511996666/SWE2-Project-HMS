<?php
function patients()
{
	require 'connect.php';
	$sql = "SELECT * FROM hospital.patient ORDER BY id";
	$query = mysqli_query($con,$sql);
	while ($row = mysqli_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['fname']."</td>";
		echo "<td>".$row['sname']."</td>";
		echo "<td>".$row['phone']."</td>";
		echo "<td>".$row['sex']."</td>";
		echo "<td><center><a href='viewpatient.php?id=".$row['id']."'>View</a></center></td>";
		echo "<td><center><a href='editpatient.php?id=".$row['id']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deletepatient.php?id=".$row['id']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";
		echo "</tr>";
	}
}

function viewpatient()
{
	$id = $_GET['id'];
	require 'connect.php';
	$sql = "SELECT * FROM hospital.patient WHERE `id`='$id'";
	$query = mysqli_query($con,$sql);
	while ($row = mysqli_fetch_array($query)) {
		$year = date('Y') - $row['birthyear'];
		echo "
		<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>ID</b></td>
				<td>P-".$row['id']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>FIRSTNAME</b></td>
				<td>".$row['fname']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>SURNAME</b></td>
				<td>".$row['sname']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>EMAIL</b></td>
				<td>".$row['email']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>ADDRESS</b></td>
				<td>".$row['address']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>PHONE</b></td>
				<td>".$row['phone']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>GENDER</b></td>
				<td>".$row['sex']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>BLOOD GRUOP</b></td>
				<td>".$row['bloodgroup']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>YEARS</b></td>
				<td>".$year."</td>
			</tr>
		";
		
	}
}


function searchpatients()
{
	require 'connect.php';
	$sachi = $_GET['s'];
	$sql = "SELECT * FROM hospital.patient WHERE `id` LIKE '%$sachi%'";
	$query = mysqli_query($con,$sql);
	while ($row = mysqli_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['fname']."</td>";
		echo "<td>".$row['sname']."</td>";
		echo "<td>".$row['phone']."</td>";
		echo "<td>".$row['sex']."</td>";
		echo "<td><center><a href='viewpatient.php?id=".$row['id']."'>View</a></center></td>";
		echo "<td><center><a href='editpatient.php?id=".$row['id']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deletepatient.php?id=".$row['id']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";
		echo "</tr>";
	}
}


function addpatient()
{
	global $con;
	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$email = trim(htmlspecialchars($_POST['email']));
	$phone = trim(htmlspecialchars($_POST['phone']));
	$address = trim(htmlspecialchars($_POST['address']));
	$gender = trim(htmlspecialchars($_POST['gender']));
	$birthyear = trim(htmlspecialchars($_POST['birthyear']));
	$bloodgroup = trim(htmlspecialchars($_POST['bloodgroup']));

	require_once "connect.php";

	$sql = "INSERT INTO hospital.patient VALUES ('','$fname','$sname','$email','$address','$phone','$gender','$bloodgroup','$birthyear')";
	$query = mysqli_query($con,$sql);
	if (!empty($query)) {
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient successfully added!</b><br><br>";
	}
	else{
		echo mysqli_error();
	}
}

function updatepatient()
{
	global $con;
	$id = $_GET['id'];
	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$email = trim(htmlspecialchars($_POST['email']));
	$phone = trim(htmlspecialchars($_POST['phone']));
	$address = trim(htmlspecialchars($_POST['address']));
	$gender = trim(htmlspecialchars($_POST['gender']));
	$birthyear = trim(htmlspecialchars($_POST['birthyear']));
	$bloodgroup = trim(htmlspecialchars($_POST['bloodgroup']));

	require_once "connect.php";

	$sql = "UPDATE hospital.patient SET `fname`='$fname',`sname`='$sname',`email`='$email',`address`='$address',`phone`='$phone',`sex`='$gender',`bloodgroup`='$bloodgroup',`birthyear`='$birthyear' WHERE `id`='$id'";
	//$sql = "INSERT INTO hospital.` VALUES ('','$fname','$sname','$email','$address','$phone','$gender','$bloodgroup','$birthyear')";
	$query = mysqli_query($con,$sql);
	if (!empty($query)) {
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient successfully updated!</b><br><br>";
	}
	else{
		echo mysqli_error();
	}
}

function settings()
{	global $con;
	require_once "connect.php";
	//$username = trim(htmlspecialchars($_POST['username']));
	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$password2 = trim(htmlspecialchars($_POST['password2']));
	$password = trim(htmlspecialchars($_POST['password']));
	if ($password != $password) {
		echo "<br><b style='color:red;font-size:14px;font-family:Arial;'>Password Must Match!</b>";
	}
	else{
		$name = $_SESSION['reception'];
		$type = $_SESSION['type'];
			
				$sql = "UPDATE hospital.users SET `fname`='$fname',`sname`='$sname',`password`='$password' WHERE `username`='$name' AND `type`='$type'";
				$query = mysqli_query($con,$sql);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Successfully updated!</b>";

				}	
		}
	}

?>