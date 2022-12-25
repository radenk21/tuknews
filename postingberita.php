<?php 
include "posting/posting-header.php";
include "layout/admin-navbar.php";
?>
<?php 
$conn;

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // cek postingan berhasil terkirim atau tidak
    if( posting($_POST) > 0)
    {   
        echo "
        <script>
        alert('Berita berhasil ditambahkan!');
        document.location.href='daftarberita.php';
        </script>
        ";
    }
    else
    {
        echo "
            <script>
                alert('Berita gagal ditambahkan!');
                document.location.href='postingberita.php';
            </script>
        ";
    }
}
?>
<div class="container mt-5 mb-5">
    <h1>Buat Berita.</h1>
    <form action="" method="post" enctype="multipart/form-data" >
        <div class="judul my-3">
            <label for="judul">Judul :</label>
            <input type="text" class="form-control mt-3" name="judul" id="judul" required>
        </div>
        <div class="upkategori my-3">
            <!-- isi kategori yang di database merupakan value yang dipilih -->
            <label for="kategori">Kategori :</label>
            <select class="form-select form-select-sm mt-2" id="kategori" name="kategori" aria-label=".form-select-sm example">
                <option selected>Pilih Kategori</option>
                <option value="1">Market</option>
                <option value="2">Technology</option>
                <option value="3">Entertainment</option>
                <option value="4">Sport</option>
                <option value="5">Lifestyle</option>
                <option value="6">Game</option>
            </select>
        </div>
        <div class="upgambar input-group my-3">
            <label for="gambar" class="input-group-text" >Gambar</label>
            <input type="file" class="form-control" name="gambar" id="gambar" required>
        </div>
        <div class="textarea my-5">
            <textarea name="isiberita" id=""></textarea>
        </div>
        <button class="btn btn-secondary" type="submit" name="submit">Posting!</button>
    </form>
</div>

<?php require "layout/footer.php";?>