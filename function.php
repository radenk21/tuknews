<?php

function ubah_profile($data) {
	global $conn;

	// ambil data dari tiap elemen form dan dimasukkan ke dalam variabel 
	$id = $data["id"];
	$name = $data['fullname'];
	$username = $data['username'];
	
	$gambarLama = htmlspecialchars($data["gambarlama"]);

	// cek apakah user upload gambar / tidak
	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$update = "UPDATE user SET
				username = '$username',
				fullname = '$name',
				gambar = '$gambar'
				WHERE id = '$id';
				";
	
	var_dump($update);
	
	mysqli_query($conn, $update);

	// unset($_SESSION["gambar"]);

	// $_SESSION["gambar"] = $gambar;

	return mysqli_affected_rows($conn);
}

function ubah_pass($data) {

	global $conn;

	$pass1 = $data['pass1'];
	$id_user = $data['id_user'];

	$pass1 = password_hash($pass1, PASSWORD_DEFAULT);

	$query = "UPDATE users SET password = '$pass1' WHERE id_user = '$id_user'; ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



if(isset($_GET["aksi"])) :

	// validasi old pass
	if($_GET["aksi"] == 'validasi-oldpass'){
		$pass = $_POST["pass"];
		$id_user = $_POST["id_user"];
		$query = "SELECT * FROM users WHERE id_user = '$id_user';";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		if(mysqli_num_rows($result) > 0) {
			if(password_verify($pass, $row['password'])) {
				echo "match";
				exit();
			} else {
				echo "wrong";
				exit();
			}
		} else {
			echo "not exist";
			exit();
		}
	}



	// validasi usename server side
	if ($_GET["aksi"] == 'validasi-uname') {

	    $uname = trim(mysqli_real_escape_string($conn, $_POST["uname"]));
	    $id_user = $_POST["id_user"];

	    $sql = "SELECT * FROM users WHERE username = '$uname' AND id_user != '$id_user';";
	    $process = mysqli_query($conn, $sql);
	    $num = mysqli_num_rows($process);

	    if(strlen($uname) < 5  ){
	        echo "less";
	        exit();
	    }

	    if(strlen($uname) >= 20){
	        echo "too much";
	        exit();
	    }

	    if($num == 0){
	        echo "ok";
	        exit();
	    }else{
	        echo "used";
	        exit();
	    }
	}
endif;










?>