<?php 
function users()
{
	require 'connect.php';
	$sql = "SELECT * FROM hospital.users ORDER BY type";
	$query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($query)) {
		echo "<tr height=20px'>";
		echo "<td>".$row['username']."</td>";
		echo "<td>".$row['type']."</td>";
		echo "<td><center><a href='edituser.php?name=".$row['username']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deleteuser.php?name=".$row['username']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";
	
		echo "</tr>";
	}
}


function rooms()
{
	require 'connect.php';
	$sql = "SELECT * FROM hospital.rooms ORDER BY room_no" ;
	$query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>".$row['room_no']."</td>";
		echo "<td>".$row['room_name']."</td>";
		echo "<td>".$row['patientsinroom']."</td>";
		echo "<td><center><a href='editroom.php?id=".$row['room_no']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deleteroom.php?id=".$row['room_no']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";
	
		echo "</tr>";
	}
}


function adduser()
{
	$username = trim(htmlspecialchars($_POST['username']));
	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$type = trim(htmlspecialchars($_POST['type']));
	$pass = trim(htmlspecialchars($_POST['password']));
	require 'connect.php';
	$sql1 = "SELECT * FROM hospital.users WHERE `username`='$username'";
	$query1 = mysqli_query($con, $sql1);
	if (mysqli_num_rows($query1)==0) {
		$sql = "INSERT INTO hospital.users VALUES ('$username','$pass','$fname','$sname','$type')";
		$query = mysqli_query($con, $sql);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>User successfully added!</b>";
		}
	}
	else{
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Choose a unique name!</b>";
	}

	
}


function addroom()
{
	$number = trim(htmlspecialchars($_POST['number']));
	$name = trim(htmlspecialchars($_POST['name']));
	require 'connect.php';
	$sql1 = "SELECT * FROM hospital.rooms WHERE `room_name`='$name'";
	$query1 = mysqli_query($con,$sql1);
	if (mysqli_num_rows($query1)==0) {
		$sql = "INSERT INTO hospital.rooms VALUES ('$number','$name','0')";
		$query = mysqli_query($con,$sql);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Room successfully added!</b>";
		}
		else{
			echo "<br>".mysqli_error();
		}
	}
	else{
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Choose unique name!</b>";
	}

	
}


function updateuser()
{
	require 'connect.php';
	//$username = trim(htmlspecialchars($_POST['username']));
	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$type = trim(htmlspecialchars($_POST['type']));
	$pass = trim(htmlspecialchars($_POST['password']));


	$name = $_GET['name'];
	
		$sql = "UPDATE hospital.users SET `fname`='$fname',`sname`='$sname',`type`='$type',`password`='$pass' WHERE `username`='$name'";
		$query = mysqli_query($con,$sql);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>User successfully updated!</b>";

		}	
}


function updateroom()
{
	$name = trim(htmlspecialchars($_POST['name']));
	require 'connect.php';

	$id = $_GET['id'];
	
		$sql = "UPDATE hospital.rooms SET `room_name`='$name' WHERE `room_no`='$id'";
		$query = mysqli_query($con,$sql);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Room successfully ipdated!</b>";

		}	
}

function settings()
{
	require 'connect.php';
	//$username = trim(htmlspecialchars($_POST['username']));
	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$password2 = trim(htmlspecialchars($_POST['password2']));
	$password = trim(htmlspecialchars($_POST['password']));
	if ($password != $password2) {
		echo "<br><b style='color:red;font-size:14px;font-family:Arial;'>Password doesn't match!</b>";
	}
	else{
		$name = $_SESSION['admin'];
		$type = $_SESSION['type'];
			
				$sql = "UPDATE hospital.users SET `fname`='$fname',`sname`='$sname',`password`='$password' WHERE `username`='$name' AND `type`='$type'";
				$query = mysqli_query($con,$sql);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Successfully Updated!</b>";

				}	
		}
	}
	
?>