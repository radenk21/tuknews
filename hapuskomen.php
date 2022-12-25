<?php 
session_start();
if(!isset($_SESSION["login"]))
{
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

if(hapuskomen($id) > 0)
{
    echo "
        <script>
            alert('Komentar berhasil dihapus!');
            document.location.href='komentar.php';
        </script>
    ";
}
else {
    echo "
        <script>
            alert('Komentar gagal dihapus!');
            document.location.href='komentar.php';
        </script>
    ";
}
?>