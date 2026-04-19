<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $id =$_GET['id'];
        $query = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas ='$id'");
        if ($query) {
            echo '
            <div classs="alert alert-warning alert-dismissible">
            Berhasil Dihapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas"/>';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_kelas" class="btn btn-primary btn-sm">
                Tambah Kelas</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Id Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Action</th>
                        </tr>
                        <tread>
                            <?php
                            $no = 0;
                            $query = mysqli_query($conn, "SELECT * FROM kelas");
                            while ($result = mysqli_fetch_array($query) ) {
                                $no++;
                                ?>
                        <tbody>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $result['id_kelas'] ?></td>
                                <td><?= $result['nm_kelas'] ?></td>
                                <td>
                                    <a href="index.php?page=kelas&action=hapus&id=<?= $result['id_kelas'] ?>" 
                                    <title="">
                                        <span class="badge badge-danger">Hapus</span> </a>  
                                        <a href="index.php?page=edit_kelas&id=<?= $result['id_kelas'] ?>"<title="">
                                        <span class="badge badge-warning">edit</span></a>                                  
                                </td>
                            </tr>
                            </tbody>
                            <?php } ?>                            
                </table>
            </div>
        </div>
    </div>
</div>
       