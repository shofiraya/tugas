<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    
    <style>
        body {
            width: 800px;
            margin: auto;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
            background-color: #060a1f;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            text-underline-position: under;
            text-decoration: underline black;
        }

        button{
            padding: 10px;
            font-weight: bold;
            color: white;
            background-color: #4caf50;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin-top: 20px;
            float: right;
        }

        label{
            font-weight: bold;
            display: block;
            font-size: 20px;
            margin-bottom: 10px;
        }

        input{
            border: 1px solid black;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        div{
            border: 1px solid black;
            padding: 20px;
            width: 90%;
            background-color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Form Upload File</h3>
        <form style="margin-left: 10px;" action="hasil_upload.php" method="POST" enctype="multipart/form-data">
            <label for="">Upload file :</label>
            <Input type="file" name="gambar">
            <button name="submit" type="submit">Upload</button>
        </form>
    </div>
<?php

?>
    
    <br/>
    <br/>
    <a style="margin-left: 10px;" href="upload.php">Upload lagi</a>
    <br/>
    <br/>
</body>
</html>

<?php 
require 'koneksi.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($koneksi);
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>

<h1>Halaman Registrasi</h1>

<form action="" method="post">

	<ul>
		<li>
			<label for="username">username :</label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password">password :</label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<label for="password2">konfirmasi password :</label>
			<input type="password" name="password2" id="password2">
		</li>
		<li>
			<button type="submit" name="register">Register!</button>
		</li>
	</ul>

</form>

<?php
function registrasi($data) {
	global $koneksi;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username  FROM admin WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($koneksi, "INSERT INTO admin VALUES('$username', '$password')");

	return mysqli_affected_rows($koneksi);

}

?>
</body>
</html>