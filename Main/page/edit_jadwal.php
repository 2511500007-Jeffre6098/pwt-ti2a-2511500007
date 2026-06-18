<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id_jadwal = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_jadwal)) {
    echo '<div class="alert alert-danger">Id Jadwal tidak ditemukan</div>';
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
    die;
}

$query_jadwal = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal = '$id_jadwal'") or die(mysqli_error($conn));
$data_jadwal = mysqli_fetch_array($query_jadwal);

if (!$data_jadwal) {
    echo '<div class="alert alert-danger">Data jadwal tidak ditemukan</div>';
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
    die;
}

$query_detail = mysqli_query($conn, "SELECT * FROM detailjadwal WHERE id_jadwal = '$id_jadwal'") or die(mysqli_error($conn));
$data_detail = [];
while ($d = mysqli_fetch_array($query_detail)) {
    $data_detail[] = $d;
}

if (isset($_POST['update'])) {
    $kelas       = $_POST['kelas'];
    $thn_ajaran  = $_POST['thn_ajaran'];
    $semester    = $_POST['semester'];
    $mapel       = $_POST['mapel'];
    $guru        = $_POST['guru'];
    $hari        = $_POST['hari'];
    $jam_mulai   = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $update_jadwal = mysqli_query($conn, "UPDATE jadwal SET 
        id_kelas    = '$kelas', 
        thn_ajaran  = '$thn_ajaran', 
        semester    = '$semester' 
        WHERE id_jadwal = '$id_jadwal'");

    if (!$update_jadwal) {
        echo "Gagal update jadwal: " . mysqli_error($conn);
        die;
    }

    mysqli_query($conn, "DELETE FROM detailjadwal WHERE id_jadwal = '$id_jadwal'");

    $allSuccess = true;
    for ($i = 0; $i < count($mapel); $i++) {
        // Lewat baris kalau ada yang kosong 
        if (empty($mapel[$i])) continue;

        $insertdetail = mysqli_query($conn, "INSERT INTO detailjadwal (id_jadwal, Kd_mapel, kd_guru, hari, jam_mulai, jam_selesai) 
            VALUES ('$id_jadwal', '{$mapel[$i]}', '{$guru[$i]}', '{$hari[$i]}', '{$jam_mulai[$i]}', '{$jam_selesai[$i]}')");
        if (!$insertdetail) {
            $allSuccess = false;
            echo "Gagal insert detail ke-{$i}: " . mysqli_error($conn);
        }
    }

    if ($allSuccess) {
        echo '
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Diupdate</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Gagal mengupdate sebagian atau seluruh data detail</h4>
        </div>';
    }

    $query_jadwal = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal = '$id_jadwal'");
    $data_jadwal  = mysqli_fetch_array($query_jadwal);

    $query_detail = mysqli_query($conn, "SELECT * FROM detailjadwal WHERE id_jadwal = '$id_jadwal'");
    $data_detail  = [];
    while ($d = mysqli_fetch_array($query_detail)) {
        $data_detail[] = $d;
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="id_jadwal">ID Jadwal</label>
                        <input type="text" name="id_jadwal" value="<?= $data_jadwal['id_jadwal']; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas" required>
                            <option disabled value="">-- Pilih Kelas --</option>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM kelas");
                            while ($k = mysqli_fetch_array($query)) {
                                $selected = ($k['id_kelas'] == $data_jadwal['id_kelas']) ? 'selected' : '';
                                echo "<option value='$k[id_kelas]' $selected>$k[nm_kelas]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="thn_ajaran">Tahun Ajaran</label>
                        <select class="form-control" name="thn_ajaran" id="thn_ajaran" required>
                            <option disabled value="">-- Pilih Tahun Ajaran --</option>
                            <?php
                            $tahun_options = ['2025/2026', '2024/2025', '2023/2024'];
                            foreach ($tahun_options as $t) {
                                $selected = ($t == $data_jadwal['thn_ajaran']) ? 'selected' : '';
                                echo "<option value='$t' $selected>$t</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" name="semester" id="semester" required>
                            <option disabled value="">-- Pilih Semester --</option>
                            <option value="Ganjil" <?= ($data_jadwal['semester'] == 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
                            <option value="Genap" <?= ($data_jadwal['semester'] == 'Genap') ? 'selected' : ''; ?>>Genap</option>
                        </select>
                    </div>

                    <h5>Detail Jadwal</h5>
                    <div id="detail-jadwal">
                        <?php
                        // switch case kalau belum ada data
                        if (empty($data_detail)) {
                            $data_detail = [[
                                'Kd_mapel'    => '',
                                'kd_guru'     => '',
                                'hari'        => '',
                                'jam_mulai'   => '',
                                'jam_selesai' => ''
                            ]];
                        }

                        foreach ($data_detail as $d):
                        ?>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <select name="mapel[]" class="form-control">
                                        <option disabled value="" <?= $d['Kd_mapel'] == '' ? 'selected' : ''; ?>>-- Pilih Mata Pelajaran --</option>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM tabelmapel");
                                        while ($m = mysqli_fetch_array($query)) {
                                            $selected = ($m['Kd_mapel'] == $d['Kd_mapel']) ? 'selected' : '';
                                            echo "<option value='$m[Kd_mapel]' $selected>$m[Nm_mapel]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control" name="guru[]">
                                        <option disabled value="" <?= $d['kd_guru'] == '' ? 'selected' : ''; ?>>-- Pilih Guru --</option>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM tabel_guru");
                                        while ($g = mysqli_fetch_array($query)) {
                                            $selected = ($g['kd_guru'] == $d['kd_guru']) ? 'selected' : '';
                                            echo "<option value='$g[kd_guru]' $selected>$g[nm_guru]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select name="hari[]" class="form-control">
                                        <option disabled value="" <?= $d['hari'] == '' ? 'selected' : ''; ?>>-- Pilih Hari --</option>
                                        <?php
                                        $hari_options = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                        foreach ($hari_options as $h) {
                                            $selected = ($h == $d['hari']) ? 'selected' : '';
                                            echo "<option value='$h' $selected>$h</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select name="jam_mulai[]" class="form-control">
                                        <option disabled value="" <?= $d['jam_mulai'] == '' ? 'selected' : ''; ?>>-- Jam Mulai --</option>
                                        <?php
                                        $jam_mulai_opts = ['07.00','07.40','08.20','09.40','10.20','11.00','11.40','13.00','13.40'];
                                        foreach ($jam_mulai_opts as $jm) {
                                            $selected = ($jm == $d['jam_mulai']) ? 'selected' : '';
                                            echo "<option value='$jm' $selected>$jm</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select name="jam_selesai[]" class="form-control">
                                        <option disabled value="" <?= $d['jam_selesai'] == '' ? 'selected' : ''; ?>>-- Jam Selesai --</option>
                                        <?php
                                        $jam_selesai_opts = ['07.40','08.20','09.00','10.20','11.00','11.40','12.20','13.40','14.20'];
                                        foreach ($jam_selesai_opts as $js) {
                                            $selected = ($js == $d['jam_selesai']) ? 'selected' : '';
                                            echo "<option value='$js' $selected>$js</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger" onclick="hapusBaris(this)">X</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="btn btn-info" onclick="tambahBaris()">+ Tambah Mapel</button>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                    <a href="index.php?page=jadwal" class="btn btn-secondary">Batal</a>
                </form>

                <script>
                    function tambahBaris() {
                        let container = document.getElementById('detail-jadwal');
                        let row = container.firstElementChild.cloneNode(true);
                        row.querySelectorAll('select').forEach(select => select.value = '');
                        container.appendChild(row);
                    }

                    function hapusBaris(btn) {
                        let container = document.getElementById('detail-jadwal');
                        if (container.children.length > 1) {
                            btn.closest('.row').remove();
                        } else {
                            alert('Minimal harus ada 1 detail jadwal');
                        }
                    }
                </script>

            </div>
        </div>
    </div>
</section>
