<?php 
require "../functions.php";
session_start();


// untuk membuat user tetap login ke index selama session nya belum di destroy
if(isset($_SESSION["login"]))
{
    header("Location: ../index.php");
    exit;
}

// login
if(isset($_POST["login"]))
{
    global $conn;
    $username = $_POST["usernamelogin"];
    $password = $_POST["passlogin"];
    // variabel kalau user salah username atau password
    $erroruserlog;
    $errorpasslog;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1)
    {
        // cek password
        $row = mysqli_fetch_assoc($result);
    
        if(password_verify($password, $row["password"]))
        {
            // set session
            $_SESSION['login'] = TRUE;
            $_SESSION['id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['gambar'] = $row['gambar'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $password;
            $_SESSION['leveluser'] = $row['leveluser'];

            header("Location: ../index.php");
            exit;
        }
        $errorpasslog = TRUE;
    }
    else {
        $erroruserlog = TRUE;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="attributes/register.css">
    
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post">
                <?php 
                if (isset($_POST["register"])) {
                    
                    if (registrasi($_POST) > 0) {
                        echo "<script>
                            alert('user baru berhasil ditambahkan!');
                        </script>";
                    }
                    else {
                        echo mysqli_error($conn);
                    }
                    
                }
                
                ?>
                <h1>Buat Akun</h1>
                <input id="username" type="username" name="username" required placeholder="Username" />
                <div></div>
                <input id="fullname" type="text" name="fullname" required placeholder="Name" />
                <input id="email" type="email" name="email" required placeholder="Email" />
                <input id="pass" type="password" name="password" required placeholder="Password" />
                <input id="pass2" type="password" name="password2" required placeholder="Confirm Password" />
                <button type="submit" name="register">Daftar</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>Masuk</h1>
                <span>Gunakan Akun Anda Yang Sudah Terdaftar</span>
                <input type="text" name="usernamelogin" required placeholder="Username" />
                <?php if(isset($erroruserlog)) : ?>
                    <div class="alert">Username is invalid.</div>
                <?php endif; ?>
                <input type="password" name="passlogin" required placeholder="Password" />
                <?php if(isset($errorpasslog)) : ?>
                    <div class="alert">Password is invalid.</div>
                <?php endif; ?>
                <a href="#">Lupa Password?</a>
                <button type="submit" name="login">Masuk</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Hai, Selamat datang kembali!</h1>
                    <p>Buruan Masuk Dan baca Berita-Berita Menarik Lainnya</p>
                    <button class="ghost" id="signIn">Masuk</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Selamat datang di TukNews!</h1>
                    <p>Belum Memiliki Akun?? <br> Daftar sekarang dan mulailah membaca berita menarik bersama kami</p>
                    <button class="ghost" id="signUp">Daftar</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        
    </script>

</body>
</html>