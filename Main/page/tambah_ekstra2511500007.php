<?php
require_once "config/koneksi.php";
?>
<div class="content header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakulikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
$carikode = mysqli_query($conn, "SELECT MAX(id_ekstra007) FROM ekstra_2511500007") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 3);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "ES-" . str_pad($kode, 2, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "ES-";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_ekstra007 = $_POST['id_ekstra007'];
    $nm_ekstra007 = $_POST['nm_ekstra007'];
    $ket007 = $_POST['ket007'];
    $semester007 = $_POST['semester007'];
    $thn_ajaran007 = $_POST['thn_ajaran007'];
    

    $insert = mysqli_query($conn, "INSERT INTO ekstra_2511500007 values ('$id_ekstra007','$nm_ekstra007','$ket007','$semester007','$thn_ajaran007')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissable">
        <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Data Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="2;url=index.php?page=ekstra2511500007"/>';
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
                            <label for="id_ekstra007">Id Eskul</label>
                            <input type="text" name="id_ekstra007" value="<?= 
                            $hasilkode; ?>" placeholder="Id Eskul" class="
                            form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_ekstra007">Nama Eskul</label>
                            <input type="text" name="nm_ekstra007" id="nm_ekstra007" 
                            placeholder="Nama Eskul" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="semester007">Semester</label>
                            <br>
                             <select class="form-control" name="semester007" id="semester007">
                                <option disabled selected>-- Pilih Semester --</option>
                                <option value=1>Semester 1</option>
                                <option value=2>Semester 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ket007">Keterangan</label>
                            <input type="text" name="ket007" id="ket007" 
                            placeholder="Keterangan" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="thn_ajaran007">Tahun Ajaran</label>
                            <br>
                             <select class="form-control" name="thn_ajaran007" id="thn_ajaran007">
                                <option disabled selected>-- Tahun Ajaran --</option>
                                <option value='2025/2026'>2025/2026</option>
                                <option value='2026/2027'>2026/2027</option>
                                <option value='2027/2028'>2027/2028</option>
                                <option value='2028/2029'>2028/2029</option>
                                <option value='2029/2030'>2029/2030</option>
                            </select>
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