<?php 
session_start();
if(!isset($_SESSION["login"]))
{
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

if(hapusakun($id) > 0)
{
    echo "
        <script>
            alert('Akun berhasil dihapus!');
            document.location.href='akun.php';
        </script>
    ";
}
else {
    echo "
        <script>
            alert('Akun gagal dihapus!');
            document.location.href='akun.php';
        </script>
    ";
}
?>