<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd =$_GET['kd'];
        $query = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$kd'");
        if ($query) {
            echo '
            <div classs="alert alert-warning alert-dismissible">
            Berhasil Dihapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa"/>';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm">
                Tambah Siswa</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>No HP</th>
                            <th>Id Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Action</th>
                        </tr>
                        <tread>
                            <?php
                            $no = 0;
                            $query = mysqli_query($conn, "SELECT siswa.*, kelas.nm_kelas FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas");
                            while ($result = mysqli_fetch_array($query) ) {
                                $no++;
                                ?>
                        <tbody>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $result['nis'] ?></td>
                                <td><?= $result['nm_siswa'] ?></td>
                                <td><?= $result['kelamin'] ?></td>
                                <td><?= $result['tgl_lahir'] ?></td>
                                <td><?= $result['hp'] ?></td>
                                <td><?= $result['id_kelas'] ?></td>
                                <td><?= $result['nm_kelas'] ?></td>

                                <td>
                                    <a href="index.php?page=siswa&action=hapus&kd=<?= $result['nis'] ?>" 
                                    <title="">
                                        <span class="badge badge-danger">Hapus</span> </a>  
                                    <a href="index.php?page=edit_siswa&kd=<?= $result['nis'] ?>"<title="">
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
       