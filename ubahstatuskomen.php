<?php 
session_start();
if(!isset($_SESSION["login"]))
{
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET['id'];
$status = $_GET['status'];

$komen = query("SELECT * FROM komentar WHERE id = $id")[0];

if(isset($status))
{
    if(ubahstatuskomen($id, $status) > 0)
    {
        echo "
            <script>
                alert('Status Komentar telah diubah');
                document.location.href='komentar.php';
            </script>
        ";    
    }
    else
    {
        echo "
            <script>
                alert('Status Komentar gagal diubah');
                document.location.href='komentar.php';
            </script>
        ";    
    }
}

?>