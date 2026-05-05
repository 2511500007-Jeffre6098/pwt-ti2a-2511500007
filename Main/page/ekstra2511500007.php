<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakulikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($conn, "DELETE FROM ekstra_2511500007 WHERE id_ekstra007='$kd'");
        if ($query) {
            echo '
            <div classs="alert alert-warning alert-dismissible">
            Berhasil Dihapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500007"/>';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ekstra2511500007" class="btn btn-primary btn-sm">
                    Tambah Ekstrakulikuler</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Id Eskul</th>
                            <th>Nama Eskul</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Action</th>
                        </tr>
                        <tread>
                            <?php
                            $no = 0;
                            $query = mysqli_query($conn, "SELECT * FROM ekstra_2511500007");
                            while ($result = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $result['id_ekstra007'] ?></td>
                                        <td><?= $result['nm_ekstra007'] ?></td>
                                        <td><?= $result['ket007'] ?></td>
                                        <td><?= $result['semester007'] ?></td>
                                        <td><?= $result['thn_ajaran007'] ?></td>
                                        <td>
                                            <a href="index.php?page=ekstra2511500007&action=hapus&kd=<?= $result['id_ekstra007'] ?>"
                                                <title="">
                                                <span class="badge badge-danger">Hapus</span> </a>
                                            <a href="index.php?page=edit_ekstra2511500007&kd=<?= $result['id_ekstra007'] ?>" <title="">
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