<div class="content-header">
    <div class="container-flukd">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tabel_guru WHERE kd_guru='$kd'"));


if (isset($_POST['tambah'])) {
    $kd_guru = $_POST['kd_guru'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];


    $insert = mysqli_query($conn, "UPDATE tabel_guru SET nm_guru='$nm_guru', jenkel='$jenkel', pend_terakhir='$pend_terakhir', tgl_lahir='$tgl_lahir', hp='$hp', alamat='$alamat' WHERE kd_guru='$kd_guru'");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hkdden="true">&times;</button>
    <h5> <i class="icon fas fa-info"></i> Info </h5>
    <h4>Berhasil Diubah</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
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
                            <label>Kode Guru</label>
                            <input type="text" name="kd_guru" value="<?= $edit['kd_guru']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Guru</label>
                            <input type="text" name="nm_guru" value="<?= $edit['nm_guru']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenkel">
                                <option value="Laki-Laki" <?= $edit['jenkel'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= $edit['jenkel'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="<?= $edit['tgl_lahir']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <select class="form-control" name="pend_terakhir">
                                <option value="Strata 1">Strata 1</option>
                                <option value="Strata 2">Strata 2</option>
                                <option value="Diploma 3">Diploma 3</option>
                                <option value="SMA Sederajat">SMA sederajat</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" name="hp" value="<?= $edit['hp']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" value="<?= $edit['alamat']; ?>" class="form-control">
                        </div>

                        <div class="card-footer">
                            <input type="submit" name="tambah" value="Simpan" class="btn btn-primary">
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>