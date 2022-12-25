<?php 
session_start();
if(!isset($_SESSION["login"]))
{
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET['id'];
$leveluser = $_GET['leveluser'];

$level = query("SELECT * FROM user WHERE id = $id")[0];

if(isset($leveluser))
{
    if(ubahleveluser($id, $leveluser) > 0)
    {
        echo "
            <script>
                alert('Level User telah diubah');
                document.location.href='infoprofil.php?id=$id';
            </script>
        ";    
    }
    else
    {
        echo "
            <script>
                alert('Level User gagal diubah');
                document.location.href='infoprofil.php?id=$id';
            </script>
        ";    
    }
}
?>