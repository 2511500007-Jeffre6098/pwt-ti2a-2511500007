<?php
if (isset($_GET['hapus'])) {
    $id_jadwalk = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM detailjadwalkelas WHERE id_jadwalk = '$id_jadwalk'");
    $hapus = mysqli_query($conn, "DELETE FROM jadwalkelas WHERE id_jadwalk = '$id_jadwalk'");
?>
    <?php if ($hapus): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Data jadwal telah dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php else: ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Tidak dapat menghapus data.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
<?php } ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Jadwal Kelas</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwalkelas" class="btn btn-primary btn-sm mb-2">Tambah Jadwal</a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode Jadwal</th>
                            <th>Guru</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Detail Jadwal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT j.*, n.nm_kelas FROM jadwalkelas j  LEFT JOIN kelas n ON TRIM(j.id_kelas) = TRIM(n.id_kelas) COLLATE utf8mb4_0900_ai_ci");
                        while ($row = mysqli_fetch_assoc($query)):
                        ?>
                            <tr>
                                <td><?= $row['id_jadwalk'] ?></td>
                                <td><?= $row['nm_kelas'] ?></td>
                                <td><?= $row['semester'] ?></td>
                                <td><?= $row['thn_ajaran'] ?></td>
                                <td>
                                    <ul>
                                        <?php
                                        $det = mysqli_query($conn, "SELECT k.*, m.Nm_mapel FROM detailjadwalkelas k  JOIN tabelmapel m ON k.Kd_mapel = m.Kd_mapel WHERE k.id_jadwalk = '{$row['id_jadwalk']}'");
                                        while ($k = mysqli_fetch_assoc($det)):
                                        ?>
                                            <li><?= $k['Nm_mapel'] ?> - <?= $k['hari'] ?> - <?= $k['jam'] ?> - <?= $k['nm_guru'] ?></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </td>
                                <td>
                                    <a href="index.php?page=jadwal_kelas&hapus=<?= $row['id_jadwalk'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>

                                    <a href="index.php?page=edit_jadwalkelas&id=<?= $row['id_jadwalk'] ?>"
                                       class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

