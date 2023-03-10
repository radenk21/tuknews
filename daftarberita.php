<?php 
include "listberita/listberita-header.php";
include "layout/admin-navbar.php";
?>

<?php   
$list = query("SELECT *FROM beritapost");
?>
<div class="mx-5">
    <h2 class="text-center mt-5">Daftar Berita</h2>
    <table class="table my-5">
        <tr>
            <th class="table-dark">No.</th>
            <th class="table-dark">Pembuat</th>
            <th class="table-dark">Judul</th>
            <th class="table-dark">Kategori</th>
            <th class="table-dark">Gambar</th>
            <th class="table-dark">Konten</th>
            <th class="table-dark">Tanggal Post</th>
            <th class="table-dark">Aksi</th>
        </tr>
        <?php $i = 1;?>
        <?php foreach($list as $row) : ?>
            <tr>
                <td><?= $i.'.'; ?></td>
                <td><?= $row["poster"]; ?></td>
                <td><?= $row["judul"]; ?></td>
                <td><?= $row["kategori"]; ?></td>
                <td>
                    <img width="50px" src="img/<?= $row["gambarberita"]; ?>" alt="">
                </td>
                <td style="width:20%;">
                    <div class="isikontenberita" style="height: 20vh;overflow:scroll;">
                        <?= $row["konten"]; ?>
                    </div>
                </td>
                <td><?= $row["tanggalpost"]; ?></td>
                <td>
                    <a href="hapus.php?id=<?= $row['id'] ?>">
                        <button onclick="return confirm('Anda yakin ingin menghapus berita?')" class="btn btn-danger" type="submit"><ion-icon name="trash"></ion-icon></button>
                    </a>
                </td>
            </tr>
        <?php $i++;?>
        <?php endforeach;?>
    </table>
</div>

<?php 
include "layout/footer.php";
?>