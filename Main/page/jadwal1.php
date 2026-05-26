<?php
if (isset($_GET['hapus'])) {
    $id_jadwal = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM detailjadwal WHERE id_jadwal = '$id_jadwal'");

    $hapus = mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'");

    if ($hapus) {
        echo "<div class='alert alert-success alert dismissable fade show' role='alert'>
        <strong> Berhasil! </strong> Data Jadwal berhasil dihapus.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    } else {
        echo "<div class='alert alert-danger alert dismissable fade show' role='alert'>
        <strong> Gagal! </strong> Data Jadwal gagal dihapus.
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
                <h1 class="m-0">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm">Tambah Jadwal</a>
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
                        $query = mysqli_query($conn, "SELECT * FROM jadwal JOIN tabel_guru ON jadwal.kd_guru = tabel_guru.kd_guru");
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                                <td>{$row['id_jadwal']}</td>
                                <td>{$row['nm_guru']}</td>
                                <td>{$row['semester']}</td>
                                <td>{$row['thn_ajaran']}</td>
                                <td>
                                <ul>";

                            $det = mysqli_query($conn, "SELECT d.*, m.Nm_mapel FROM detailjadwal d JOIN tabelmapel m ON d.Kd_mapel = m.Kd_mapel WHERE d.id_jadwal = '{$row['id_jadwal']}'");
                            while ($d = mysqli_fetch_assoc($det)) {
                                echo "<li> {$d['Nm_mapel']} - {$d['hari']} - {$d['jam']} - {$d['kelas']} </li>";
                            }
                            echo "</ul>                                       
                                        <td>
                                        <a href='index.php?page=jadwal&action=hapus&id_jadwal=<?= {$row['id_jadwal']}; ?>'
                                        onclick='return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')'
                                        class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                            </tr>";
                        }
                        ?>
                        </ul>
                        </td>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>