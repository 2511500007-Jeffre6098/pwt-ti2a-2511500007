<div class="content-header">
    <div class="container-flukd">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Ekstrakulikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$query = mysqli_query($conn, "SELECT * FROM ekstra_2511500007 WHERE id_ekstra007='$kd'");
$edit = mysqli_fetch_array($query);



if (isset($_POST['tambah'])) {
    $id_ekstra007 = $_POST['id_ekstra007'];
    $nm_ekstra007 = $_POST['nm_ekstra007'];
    $ket007 = $_POST['ket007'];
    $semester007 = $_POST['semester007'];
    $thn_ajaran007 = $_POST['thn_ajaran007'];


    $insert = mysqli_query($conn, "UPDATE ekstra_2511500007 SET id_ekstra007='$id_ekstra007', nm_ekstra007='$nm_ekstra007', semester007='$semester007', ket007='$ket007',  thn_ajaran007='$thn_ajaran007' WHERE id_ekstra007='$id_ekstra007'");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hkdden="true">&times;</button>
    <h5> <i class="icon fas fa-info"></i> Info </h5>
    <h4>Berhasil Diubah</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500007">';
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
                            <label>Id Eskul</label>
                            <input type="text" name="id_ekstra007" value="<?= $edit['id_ekstra007']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Eskul</label>
                            <input type="text" name="nm_ekstra007" value="<?= $edit['nm_ekstra007']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="semester007" id="semester007">
                                <option value="1" <?= $edit['semester007'] == '1' ? 'selected' : '' ?>>Semester 1</option>
                                <option value="2" <?= $edit['semester007'] == '2' ? 'selected' : '' ?>>Semester 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="ket007" id="ket007" value="<?= $edit['ket007']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                             <select class="form-control" name="thn_ajaran007" id="thn_ajaran007">
                                <option value="2025/2026" <?= $edit['thn_ajaran007'] == '2025/2026' ? 'selected' : '' ?>>2025/2026</option>
                                <option value="2026/2027" <?= $edit['thn_ajaran007'] == '2026/2027' ? 'selected' : '' ?>>2026/2027</option>
                                <option value="2027/2028" <?= $edit['thn_ajaran007'] == '2027/2028' ? 'selected' : '' ?>>2027/2028</option>
                                <option value="2028/2029" <?= $edit['thn_ajaran007'] == '2028/2029' ? 'selected' : '' ?>>2028/2029</option>
                                <option value="2029/2030" <?= $edit['thn_ajaran007'] == '2029/2030' ? 'selected' : '' ?>>2029/2030</option>
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