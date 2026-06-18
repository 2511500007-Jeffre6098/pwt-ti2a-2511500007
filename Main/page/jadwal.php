<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $id = $_GET['id'];
        mysqli_query($conn, "DELETE FROM detailjadwal WHERE id_jadwal = '$id'");
        $query = mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = '$id'");

        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus
            </div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">


                <?php if ($_SESSION['Role'] == "Admin") { ?>
                    <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm">
                        Tambah Jadwal
                    </a>
                    <br><br>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Kode Jadwal</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Detail Jadwal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($conn, "SELECT * FROM jadwal join kelas on jadwal.id_kelas = kelas.id_kelas");
                            while ($result = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $result['id_jadwal']; ?></td>
                                    <td><?= $result['nm_kelas']; ?></td>
                                    <td><?= $result['thn_ajaran']; ?></td>
                                    <td><?= $result['semester']; ?></td>
                                    <td>
                                        <?php
                                            $det = mysqli_query($conn, " SELECT * FROM detailjadwal JOIN tabel_guru ON detailjadwal.kd_guru = tabel_guru.kd_guru JOIN tabelmapel ON detailjadwal.Kd_mapel = tabelmapel.Kd_mapel WHERE detailjadwal.id_jadwal = '{$result['id_jadwal']}'");
                                            while ($d = mysqli_fetch_assoc($det)) {
                                                echo "{$d['Nm_mapel']} - {$d['nm_guru']} - {$d['hari']} - {$d['jam_mulai']}-{$d['jam_selesai']} <br>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="index.php?page=jadwal&action=hapus&id=<?= $result['id_jadwal']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            <span class="badge badge-danger">Hapus</span>
                                            <a href="index.php?page=edit_jadwal&id=<?= $result['id_jadwal'] ?>">
                                        <span class="badge badge-warning">Edit</span></a>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <a href="index.php?page=cetak_jadwal" class="btn btn-primary btn-sm">
                        Cetak Jadwal
                    </a>

                <?php } else if ($_SESSION['Role'] == "Guru") {
                    $guru = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM guru WHERE kd_guru = '{$_SESSION['username']}'"));
                    $kd_guru = $guru['kd_guru'];
                    $query = mysqli_query($conn, "SELECT DISTINCT * FROM jadwal JOIN kelas ON jadwal.id_kelas = kelas.id_kelas join detailjadwal on jadwal.id_jadwal = detailjadwal.id_jadwal WHERE detailjadwal.kd_guru = '$kd_guru'");
                    $result = mysqli_fetch_array($query);
                ?>

                    <h5><?= "Tahun Ajaran: " . $result['thn_ajaran'] ?></h5>
                    <h5><?= "Semester: " . $result['semester'] ?></h5>
                    <br>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Jam</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $no = 1; 
                                $det = mysqli_query($conn, "SELECT * FROM detailjadwal JOIN jadwal ON detailjadwal.id_jadwal = jadwal.id_jadwal JOIN kelas ON jadwal.id_kelas = kelas.id_kelas JOIN mapel ON detailjadwal.Kd_mapel = mapel.Kd_mapel  WHERE detailjadwal.id_jadwal = '{$result['id_jadwal']}' AND detailjadwal.kd_guru = '$kd_guru'");
                                while ($d = mysqli_fetch_assoc($det)) {
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['Nm_mapel'] ?></td>
                                <td><?= $d['nm_kelas'] ?></td>
                                <td><?= $d['hari'] ?></td>
                                <td><?= $d['jam_mulai'] ?> - <?= $d['jam_selesai'] ?></td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <a href="index.php?page=cetak_jadwal" class="btn btn-primary btn-sm">
                        Cetak Jadwal
                    </a>

                <?php } else if ($_SESSION['Role'] == "Siswa") {
                    $siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '{$_SESSION['username']}'"));
                    $id_kelas = $siswa['id_kelas'];
                    $query = mysqli_query($conn, "SELECT DISTINCT * FROM jadwal JOIN kelas ON jadwal.id_kelas = kelas.id_kelas JOIN detailjadwal ON jadwal.id_jadwal = detailjadwal.id_jadwal WHERE jadwal.id_kelas = '$id_kelas'");
                    $result = mysqli_fetch_array($query);
                ?>

                    <h5><?= "Tahun Ajaran: " . $result['thn_ajaran'] ?></h5>
                    <h5><?= "Semester: " . $result['semester'] ?></h5>
                    <h5><?= "Kelas: " . $result['nm_kelas'] ?></h5>
                    <br>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Hari</th>
                                <th>Jam</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $no = 1;
                                $det = mysqli_query($conn, "SELECT * FROM detailjadwal JOIN tabel_guru ON detailjadwal.kd_guru = tabel_guru.kd_guru JOIN tabelmapel ON detailjadwal.Kd_mapel = tabelmapel.Kd_mapel join jadwal on detailjadwal.id_jadwal = jadwal.id_jadwal WHERE detailjadwal.id_jadwal = '{$result['id_jadwal']}' AND jadwal.id_kelas = '$id_kelas'");
                                while ($d = mysqli_fetch_assoc($det)) {
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['nm_mapel'] ?></td>
                                <td><?= $d['nm_guru'] ?></td>
                                <td><?= $d['hari'] ?></td>
                                <td><?= $d['jam_mulai'] ?> - <?= $d['jam_selesai'] ?></td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="index.php?page=cetak_jadwal" class="btn btn-primary btn-sm">
                        Cetak Jadwal
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>