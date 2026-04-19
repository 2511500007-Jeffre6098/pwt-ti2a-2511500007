<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id = $_GET['id'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$id'"));


if(isset($_POST['tambah'])){
    $id_kelas = $_POST['id_kelas'];
    $nm_kelas = $_POST['nm_kelas'];

    $insert = mysqli_query($conn, "UPDATE kelas SET nm_kelas='$nm_kelas' WHERE id_kelas='$id_kelas'");
if($insert){
    echo '<div class="alert alert-info-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">&times;</button>
    <h5> <i class="icon fas fa-info"></i> Info </h5>
    <h4>Berhasil Diubah</h4></div>';
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
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
                        <label for="">Id Kelas</label>
                        <input type="text" name="id_kelas" value="<?= $edit['id_kelas']; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nm_kelas">Nama Kelas</label>
                        <input type="text" name="nm_kelas" value="<?= $edit['nm_kelas']; ?>" placeholder="Nama Mapel" class="form-control">
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