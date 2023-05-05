<?php
include 'koneksi.php';

function register($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$cpassword = mysqli_real_escape_string($conn, $data["cpassword"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if( $password !== $cpassword ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO admin VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);

}

if(isset($_POST['register'])) {
    if(register($_POST) > 0){
        echo "<script>alert('user baru berhasil ditambahkan')</script>";
    } else {
        echo mysqli_error($conn);
    }
}



?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #f7f7f7;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-email {
            background-color: #fff;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.25);
            max-width: 500px;
            width: 100%;
        }

        .login-text {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .login-register-text {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Sign Up</p>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label> 
            <input type="text" class="form-control" placeholder="Username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label> 
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label> 
            <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required>
        </div>
        <div class="col-12">
            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
        </div>
        <p class="login-register-text">Anda sudah punya akun? <a href="index.php">Login</a></p>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
