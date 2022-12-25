<?php 
include "layout/admin-header.php";
include "layout/admin-navbar.php";
?>

<?php 
$list = query("SELECT * FROM user");
?>

<div class="mx-5">
    <h2 class="text-center mt-5">Daftar Akun</h2>
    <table class="table my-5">
        <tr>
            <th class="text-center table-dark">No.</th>
            <th class="text-center table-dark">Username</th>
            <th class="text-center table-dark">Full Name</th>
            <th class="text-center table-dark">Level User</th>
            <th class="text-center table-dark">E-mail</th>
            <th class="text-center table-dark">Tanggal Tambah</th>
            <th class="text-center table-dark">Aksi</th>
        </tr>
    
    <?php $i = 1;?>
    <?php foreach($list as $row) : ?>
        <?php if($row['leveluser'] == 0) { $row['leveluser'] = 'Member'; } ?>
        <?php if($row['leveluser'] == 1) { $row['leveluser'] = 'Admin'; } ?>
        <tr>
            <td class="text-center" ><?= $i . '.' ?></td>
            <td class="text-center" ><?= $row['username']; ?></td>
            <td class="text-center" ><?= $row['fullname']; ?></td>
            <td class="text-center" ><?= $row['leveluser']; ?></td>
            <td class="text-center" ><?= $row['email']; ?></td>
            <td class="text-center" ><?= $row['tanggal ditambahkan']; ?></td>
            <td class="text-center" >
                <a class="btn btn-primary" href="infoprofil.php?id=<?= $row['id'] ?>">Info</a>
                <a class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus akun ini?')" href="hapusakun.php?id=<?= $row['id'] ?>"><ion-icon name="trash"></ion-icon></a>
            </td>
        </tr>
        <?php $i++;?>
    <?php endforeach;?>
    </table>
</div>
<?php 
include "layout/admin-footer.php";
?>