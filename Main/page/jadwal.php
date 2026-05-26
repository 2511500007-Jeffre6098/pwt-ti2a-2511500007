<?php
if (isset($_GET['hapus'])) {
    $id_jadwal = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM detailjadwal WHERE id_jadwal = '$id_jadwal'");
    $hapus = mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'");

    if ($hapus) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Berhasil!</strong> Data jadwal telah dihapus.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Gagal!</strong> Tidak dapat menghapus data.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-2">Tambah Jadwal</a>
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
                        $query = mysqli_query($conn, "SELECT j.*, g.nm_guru FROM jadwal j LEFT JOIN tabel_guru g ON j.kd_guru = g.kd_guru");
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                                    <td>{$row['id_jadwal']}</td>
                                    <td>{$row['nm_guru']}</td>
                                    <td>{$row['semester']}</td>
                                    <td>{$row['thn_ajaran']}</td>
                                    <td><ul>";

                            $det = mysqli_query($conn, "SELECT d.*, m.Nm_mapel 
                                                        FROM detailjadwal d 
                                                        JOIN tabelmapel m ON d.Kd_mapel = m.Kd_mapel
                                                        WHERE d.id_jadwal = '{$row['id_jadwal']}'");
                            while ($d = mysqli_fetch_assoc($det)) {
                                echo "<li>{$d['Nm_mapel']} - {$d['hari']} - {$d['jam']} - {$d['kelas']}</li>";
                            }

                            echo      "</ul></td>
                                    <td>
                                        <a href='index.php?page=jadwal&hapus={$row['id_jadwal']}' 
                                           class='btn btn-danger btn-sm'
                                           onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>