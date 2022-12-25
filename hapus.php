<?php 
session_start();
if(!isset($_SESSION["login"]))
{
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

if(hapus($id) > 0)
{
    echo "
        <script>
            alert('Berita berhasil dihapus!');
            document.location.href='daftarberita.php';
        </script>
    ";
}
else {
    echo "
        <script>
            alert('Berita gagal dihapus!');
            document.location.href='daftarberita.php';
        </script>
    ";
}
?>