<?php 
include "isiberita/isiberita-header.php";
include "layout/navbar.php";
?>

<?php 
if(isset($_POST['komentarpost']))
{
    if(!isset($_SESSION['guest']))
    {
        $ppgambar = $_SESSION['gambar'];
    }
    if(komentar($_POST, $berita['id'],$ppgambar) > 0)      
    {
        echo "
        <script>
            alert('Komentar anda telah direkam!');
            // window.location.reload();
        </script>
        ";
    }
    else
    {
        echo "
            <script>
                alert('Komentar anda gagal direkam!');
                window.location.reload();
            </script>
        ";
    }
}

$komentarberita = query("SELECT * FROM komentar WHERE status ='1' AND berita='$id'");
?>
<div class="container-sm">
    <div class="table">
        <div class="row">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="isiberita">
                            <h3 class="text-center"><?= $berita['judul']; ?></h3>
                            <center>
                                <div class="gambarberita mb-5">
                                    <img class="" style="objectfit:cover; height:60vh;"src="img/<?= $berita["gambarberita"]?>" alt="<?= $berita['judul'] ?>">
                                </div>
                            </center>
                            <p>Posted by <?= ucfirst($berita['poster']) ?> at <?= $berita['tanggalpost'] ?> on <?= $berita['timeposting'] ?> | Kunjungan <?= $berita['kunjungan'] ?></p>
                            <?= $berita['konten'] ?>
                        </div>
                    </div>
                </div>
                <div class="clear">
                    <div class="bg-dark">
                        <h4 class="text-white">Komentar</h4>
                    </div>
                    <?php foreach($komentarberita as $komen) : ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <?php if($komen['ppgambar'] == "") :?>
                                    <img width="60" src="img/nopict.png" alt="Profil <?= $komen['namakomen']; ?>">
                                <?php endif;?>
                                <?php if($komen['ppgambar'] != "") :?>
                                    <img width="60" style="border-radius:50%;" src="img/<?= $komen['ppgambar']; ?>" alt="Profil <?= $komen['namakomen']; ?>">
                                <?php endif;?>
                                <h6><?= $komen['namakomen'] ?></h6>
                                <p><?= $komen['tanggalkomen'] ?></p>
                                <p><?= $komen['isikomentar'] ?></p>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <?php if(!isset($_SESSION['guest'])) :?>
                        <div class="komentaruser mb-5">
                            <form action="" method="post">
                                <h5>Tambahkan komentar</h5>
                                <textarea name="isikomentar"></textarea>
                                <button type="submit" class="btn mt-2" name="komentarpost">Submit</button>
                            </form>
                        </div>
                    <?php endif;?>
                </div>
                
            </div>
            <div class="col-sm-3 mt-5">
                <p>asdfdas</p>
            </div>
        </div>
    </div>
</div>
<?php 
include "isiberita/isiberita-footer.php";
?>