<div class="content-header">
    <div class="container-flukd">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'"));


if (isset($_POST['tambah'])) {
    $nis = $_POST['nis'];
    $nm_siswa = $_POST['nm_siswa'];
    $kelamin = $_POST['kelamin'];
    $hp = $_POST['hp'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $id_kelas = $_POST['id_kelas'];


    $insert = mysqli_query($conn, "UPDATE siswa SET nis='$nis', nm_siswa='$nm_siswa', kelamin='$kelamin', hp='$hp',  tgl_lahir='$tgl_lahir', id_kelas='$id_kelas' WHERE nis='$nis'");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hkdden="true">&times;</button>
    <h5> <i class="icon fas fa-info"></i> Info </h5>
    <h4>Berhasil Diubah</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hkdden="true">&times;</button>
    <h5> <i class="icon fas fa-warning"></i> Info </h5>
    <h4>Gagal Diubah</h4></div>';
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
                            <label>NIS</label>
                            <input type="number" name="nis" value="<?= $edit['nis']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="nm_siswa" value="<?= $edit['nm_siswa']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="kelamin" id="kelamin">
                                <option value="Laki-Laki" <?= $edit['kelamin'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= $edit['kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" name="hp" id="hp" value="<?= $edit['hp']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tanggal_Lahir</label>
                            <input type="date" name="tgl_lahir" value="<?= $edit['tgl_lahir']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <select name="id_kelas" class="form-control">
                                <select name="id_kelas" class="form-control">
                                    <?php
                                    $kelas = mysqli_query($conn, "SELECT * FROM kelas"); #Querry untuk manggil tabel kelas
                                    while ($k = mysqli_fetch_array($kelas)) { #loop data, setor perintah dari $kelas ke $k, biar bisa jalankan perintah yang sama berkali-kali hingga data yang didatabase habis ditampilkan
                                        $selected = ($k['id_kelas'] == $edit['id_kelas']) ? 'selected' : ''; #Kalau id_kelas dari database sama dengan id_kelas milik siswa yang sedang diedit, tandai sebagai selected
                                        echo "<option value='$k[id_kelas]' $selected>$k[nm_kelas]</option>"; #dipakai supaya option dropdown dibuat otomatis dari database, bukan ngetik manual satu-satu.
                                    }
                                    ?>
                                </select>
                        </div>

                        <div class="card-footer">
                            <input type="submit" name="tambah" value="Simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>