<?php
require_once "config/koneksi.php";
?>
<div class="content header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php


if (isset($_POST['tambah'])) {
    $nis = $_POST['nis'];
    $nm_siswa = $_POST['nm_siswa'];
    $kelamin = $_POST['kelamin'];
    $hp = $_POST['hp'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $id_kelas = $_POST['id_kelas'];



    $insert = mysqli_query($conn, "INSERT INTO siswa 
    VALUES ('$nis','$nm_siswa','$kelamin','$hp','$tgl_lahir','$id_kelas')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissable">
        <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Data Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="2;url=index.php?page=siswa"/>';
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
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" id="nis"
                                placeholder="NIS" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nm_siswa">Nama Siswa</label>
                            <input type="text" name="nm_siswa" id="nm_siswa"
                                placeholder="Nama Siswa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="kelamin">Jenis Kelamin</label>
                            <br>
                            <select class="form-control" name="kelamin" id="kelamin">
                                <option disabled selected>-- Pilih Jenis kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hp">No HP</label>
                            <input type="number" name="hp" id="hp"
                                placeholder="No HP" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir"
                                placeholder="Tanggal lahir" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">Id Kelas</label>
                            <br>
                            <select name="id_kelas" id="id_kelas" class="form-control">
                                <option disabled selected>-- Pilih Kelas --</option>
                                <?php
                                $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                while ($k = mysqli_fetch_array($kelas)) {
                                    echo "<option value='$k[id_kelas]'>$k[nm_kelas]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="tambah" value="Simpan" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>