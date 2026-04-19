<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Mapel</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd =$_GET['kd'];
        $query = mysqli_query($conn, "DELETE FROM tabelmapel WHERE Kd_mapel='$kd'");
        if ($query) {
            echo '
            <div classs="alert alert-warning alert-dismissible">
            Berhasil Dihapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel"/>';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_mapel" class="btn btn-primary btn-sm">
                Tambah Mapel</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Kode Mapel</th>
                            <th>Nama Mapel</th>
                            <th>KKM</th>
                            <th>Action</th>
                        </tr>
                        <tread>
                            <?php
                            $no = 0;
                            $query = mysqli_query($conn, "SELECT * FROM tabelmapel");
                            while ($result = mysqli_fetch_array($query) ) {
                                $no++;
                                ?>
                        <tbody>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $result['Kd_mapel'] ?></td>
                                <td><?= $result['Nm_mapel'] ?></td>
                                <td><?= $result['KKM'] ?></td>
                                <td>
                                    <a href="index.php?page=mapel&action=hapus&kd=<?= $result['Kd_mapel'] ?>" 
                                    <title="">
                                        <span class="badge badge-danger">Hapus</span> </a>  
                                    <a href="index.php?page=edit_mapel&kd=<?= $result['Kd_mapel'] ?>"<title="">
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
       