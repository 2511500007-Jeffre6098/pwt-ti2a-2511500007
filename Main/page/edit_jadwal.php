<?php
require_once "config/koneksi.php";

$id_jadwal = isset($_GET['id']) ? $_GET['id'] : '';

// Ambil data jadwal
$qJadwal = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal = '$id_jadwal'");
$jadwal  = mysqli_fetch_assoc($qJadwal);

if (!$jadwal) {
    echo '<div class="alert alert-danger">Data jadwal tidak ditemukan.</div>';
    echo '<meta http-equiv="refresh" content="2;url=index.php?page=jadwal"/>';
    return;
}

// Proses update
if (isset($_POST['update'])) {
    $kd_guru    = trim($_POST['kd_guru']);
    $semester   = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $Kd_mapel   = $_POST['Kd_mapel'];
    $hari       = $_POST['hari'];
    $jam        = $_POST['jam'];
    $kelas      = $_POST['kelas'];

    mysqli_query($conn, "UPDATE jadwal 
                         SET kd_guru='$kd_guru', thn_ajaran='$thn_ajaran', semester='$semester' 
                         WHERE id_jadwal='$id_jadwal'") or die(mysqli_error($conn));

    mysqli_query($conn, "DELETE FROM detailjadwal WHERE id_jadwal='$id_jadwal'");

    for ($i = 0; $i < count($Kd_mapel); $i++) {
        mysqli_query($conn, "INSERT INTO detailjadwal (id_jadwal, Kd_mapel, kelas, hari, jam) 
                             VALUES ('$id_jadwal','{$Kd_mapel[$i]}','{$kelas[$i]}','{$hari[$i]}','{$jam[$i]}')")
            or die(mysqli_error($conn));
    }

    echo '<div class="alert alert-success">Data berhasil diperbarui</div>';
    echo '<meta http-equiv="refresh" content="2;url=index.php?page=jadwal"/>';
    return;
}

// Ambil detail jadwal untuk ditampilkan di form
$qDetail = mysqli_query($conn, "SELECT * FROM detailjadwal WHERE id_jadwal='$id_jadwal'");
$details = [];
while ($d = mysqli_fetch_assoc($qDetail)) $details[] = $d;
if (empty($details)) $details = [['Kd_mapel'=>'','hari'=>'','jam'=>'','kelas'=>'']];
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Kode Jadwal</label>
                        <input type="text" value="<?= $jadwal['id_jadwal'] ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Guru</label>
                        <select name="kd_guru" class="form-control" required>
                            <option value="">Pilih Guru</option>
                            <?php
                            $g = mysqli_query($conn, "SELECT * FROM tabel_guru");
                            while ($row = mysqli_fetch_array($g)) {
                                $sel = (trim($row['kd_guru']) == trim($jadwal['kd_guru'])) ? 'selected' : '';
                                echo "<option value='{$row['kd_guru']}' $sel>{$row['nm_guru']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="Ganjil" <?= $jadwal['semester']=='Ganjil'?'selected':'' ?>>Ganjil</option>
                            <option value="Genap"  <?= $jadwal['semester']=='Genap' ?'selected':'' ?>>Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="thn_ajaran" class="form-control" required>
                            <option value="2025/2026" <?= $jadwal['thn_ajaran']=='2025/2026'?'selected':'' ?>>2025/2026</option>
                            <option value="2026/2027" <?= $jadwal['thn_ajaran']=='2026/2027'?'selected':'' ?>>2026/2027</option>
                        </select>
                    </div>

                    <hr>
                    <h5>Detail Jadwal</h5>
                    <div id="detailjadwal">
                        <?php foreach ($details as $d): ?>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <select name="Kd_mapel[]" class="form-control" required>
                                        <option value="" disabled <?= $d['Kd_mapel']==''?'selected':'' ?>>---Pilih Mata Pelajaran---</option>
                                        <?php
                                        $mapel = mysqli_query($conn, "SELECT * FROM tabelmapel");
                                        while ($m = mysqli_fetch_array($mapel)) {
                                            $sel = ($m['Kd_mapel'] == $d['Kd_mapel']) ? 'selected' : '';
                                            echo "<option value='{$m['Kd_mapel']}' $sel>{$m['Nm_mapel']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="hari[]" class="form-control" required>
                                        <option value="" disabled <?= $d['hari']==''?'selected':'' ?>>---Pilih Hari---</option>
                                        <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h): ?>
                                            <option value="<?= $h ?>" <?= $h==$d['hari']?'selected':'' ?>><?= $h ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="jam[]" class="form-control" required>
                                        <option value="" disabled <?= $d['jam']==''?'selected':'' ?>>---Pilih Jam---</option>
                                        <?php foreach (['07:15-09:15','07:15-08:00','08:00-09:15','09:45-10:30','10:30-11:15','10:30-12:00','12:45-14:00','14:00-15:30'] as $j): ?>
                                            <option value="<?= $j ?>" <?= $j==$d['jam']?'selected':'' ?>><?= $j ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="kelas[]" class="form-control" required>
                                        <option value="" disabled <?= $d['kelas']==''?'selected':'' ?>>---Pilih Kelas---</option>
                                        <?php
                                        $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                        while ($k = mysqli_fetch_array($kelas)) {
                                            $sel = ($k['nm_kelas'] == $d['kelas']) ? 'selected' : '';
                                            echo "<option value='{$k['nm_kelas']}' $sel>{$k['nm_kelas']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="btn btn-info" onclick="tambahBaris()">Tambah Mapel</button>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                    <a href="index.php?page=jadwal" class="btn btn-secondary">Batal</a>
                </form>

                <script>
                    function tambahBaris() {
                        let container = document.getElementById('detailjadwal');
                        let row = container.firstElementChild.cloneNode(true);
                        row.querySelectorAll('select').forEach(sel => sel.selectedIndex = 0);
                        container.appendChild(row);
                    }
                </script>
            </div>
        </div>
    </div>
</div>

