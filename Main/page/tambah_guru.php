<?php
require_once "config/koneksi.php";
?>
<div class="content header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
$carikode = mysqli_query($conn, "SELECT MAX(kd_guru) FROM tabel_guru") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 3);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "GR-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "GR-";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $kd_guru = $_POST['kd_guru'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];

    $insert = mysqli_query($conn, "INSERT INTO tabel_guru values ('$kd_guru','$nm_guru','$jenkel','$pend_terakhir','$hp','$alamat','$tgl_lahir')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissable">
        <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Data Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="2;url=index.php?page=guru"/>';
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
                            <label for="kd_guru">Kode Gurus</label>
                            <input type="text" name="kd_guru" value="<?= 
                            $hasilkode; ?>" placeholder="Kode Gurus" class="
                            form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_guru">Nama Guru</label>
                            <input type="text" name="nm_guru" id="nm_guru" 
                            placeholder="Nama Guru" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="jenkel">Jenis Kelamin</label>
                            <br>
                             <select class="form-control" name="jenkel" id="jenkel">
                                <option disabled selected>-- Pilih Jenis kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" 
                            placeholder="Tanggal Lahir" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="pend_terakhir">Pendidikan Terakhir</label>
                            <br>
                           <select class="form-control" name="pend_terakhir" id="pend_terakhir">
                            <option value="Strata 1">Strata 1</option>
                            <option value="Strata 2">Strata 2</option>
                            <option value="Diploma 3">Diploma 3</option>
                            <option value="SMA Sederajat">SMA sederajat</option>
                           </select>
                        </div>
                         <div class="form-group">
                            <label for="hp">No HP</label>
                            <input type="tel" name="hp" id="hp" 
                            placeholder="No HP" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" 
                            placeholder="Alamat" class="form-control">
                        </div>
                         
                        <div class="form-group">
                            <input type="submit" name="tambah" value="Simpan" class="btn btn-primary">
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</section>