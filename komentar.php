<?php 
include "layout/admin-header.php";
include "layout/admin-navbar.php";
?>
<?php 
$list = query("SELECT * FROM komentar");
?>
<div class="mx5">
    <h2 class="mt-5 text-center">Daftar Komentar</h2>
    <table class="table my-5">
        <tr>
            <th class="table-dark">No.</th>
            <th class="table-dark">Pembuat</th>
            <th class="table-dark">Id berita</th>
            <th class="table-dark">Lokasi Komentar</th>
            <th class="table-dark">Isi Komentar</th>
            <th class="table-dark">Tanggal Komentar</th>
            <th class="table-dark">Tanggal Approved</th>
            <th class="table-dark">Status</th>
        </tr>
        <?php $i = 1;?>
        <?php foreach($list as $komen) :?>
        <tr>
                <td><?= $i; ?></td>
                <td><?= $komen['namakomen'] ?></td>
                <td><?= $komen['berita'] ?></td>
                <td><?= $komen['judulberita'] ?></td>
                <td><?= $komen['isikomentar'] ?></td>
                <td><?= $komen['tanggalkomen'] ?></td>
                <td><?= $komen['tanggalacc'] ?></td>
                <td>
                <?php if($komen['status'] == 0) : ?>
                    <a class="btn btn-primary" onclick="return confirm('Apakah anda ingin meng-approve komentar ini?')" href="ubahstatuskomen.php?id=<?= $komen['id'] ?>&status=<?= $komen['status'] ?>">Approve</a>
                <?php endif;?>
                <?php if($komen['status'] == 1) : ?>
                    <a class="btn btn-danger" onclick="return confirm('Apakah anda tidak ingin meng-approve komentar ini?')" href="ubahstatuskomen.php?id=<?= $komen['id'] ?>&status=<?= $komen['status'] ?>">Approved</a>
                <?php endif;?>
                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus komentar ini?')" href="hapuskomen.php?id=<?= $komen['id'] ?>"><ion-icon name="trash"></ion-icon></a>
                </td>

            </tr>
        <?php $i++;?>
        <?php endforeach;?>
    </table>
</div>

<?php 
include "layout/admin-footer.php";
?>