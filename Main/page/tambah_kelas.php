<?php
require_once "config/koneksi.php";
?>
<div class="content header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php
$carikode = mysqli_query($conn, "SELECT MAX(id_kelas) FROM kelas") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 3);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "ID-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "ID-";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_kelas = $_POST['id_kelas'];
    $nm_kelas = $_POST['nm_kelas'];

    $insert = mysqli_query($conn, "INSERT INTO kelas values ('$id_kelas','$nm_kelas')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissable">
        <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Data Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="2;url=index.php?page=kelas"/>';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Data Gagal Disimpan</h4>
        </div>';
    }
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="id_kelas">Id Kelas</label>
                            <input type="text" name="id_kelas" value="<?= 
                            $hasilkode; ?>" placeholder="Id Kelas" class="
                            form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_kelas">Nama Kelas</label>
                            <input type="text" name="nm_kelas" id="nm_kelas" 
                            placeholder="Nama Kelas" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="tambah" value="Simpan" class="btn btn-primary">
                    </form> 
                </div>
            </div>
        </div>
    </div>
</section>