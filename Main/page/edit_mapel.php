<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Mata Pelajaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tabelmapel WHERE Kd_mapel='$kd'"));


if(isset($_POST['tambah'])){
    $Kd_mapel = $_POST['Kd_mapel'];
    $Nm_mapel = $_POST['Nm_mapel'];
    $KKM = $_POST['KKM'];

    $insert = mysqli_query($conn, "UPDATE tabelmapel SET Nm_mapel='$Nm_mapel', KKM='$KKM' WHERE Kd_mapel='$Kd_mapel'");
if($insert){
    echo '<div class="alert alert-info-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">&times;</button>
    <h5> <i class="icon fas fa-info"></i> Info </h5>
    <h4>Berhasil Diubah</h4></div>';
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
}else{
    echo '<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">&times;</button>
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
                        <label for="">Kode Mapel</label>
                        <input type="text" name="Kd_mapel" value="<?= $edit['Kd_mapel']; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Nm_mapel">Nama Mapel</label>
                        <input type="text" name="Nm_mapel" value="<?= $edit['Nm_mapel']; ?>" placeholder="Nama Mapel" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="KKM">KKM</label>
                        <input type="text" name="KKM" value="<?= $edit['KKM']; ?>" id="KKM" placeholder="KKM" class="form-control">
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>