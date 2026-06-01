<?php
require_once "config/koneksi.php";
?>
<div class="content header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
$carikode = mysqli_query($conn, "SELECT MAX(id_jadwal) FROM jadwal") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if ($datakode && $datakode[0] !== null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "J-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "J-001";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $kd_guru = $_POST['kd_guru'];
    $semester = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $Kd_mapel = $_POST['Kd_mapel'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $kelas = $_POST['kelas'];

    $insertjadwal = mysqli_query($conn, "INSERT INTO jadwal values ('$id_jadwal','$kd_guru','$thn_ajaran','$semester')");
   
    if (!$insertjadwal) {
        echo "Gagal insert tabel jadwal: " . mysqli_error($conn);
        die;
    }

    $allSuccess = true;
    for ($i = 0; $i < count($Kd_mapel); $i++) {
        $insert = mysqli_query($conn, "INSERT INTO detailjadwal (id_jadwal, Kd_mapel, kelas, hari, jam) VALUES ('$id_jadwal', '{$Kd_mapel[$i]}', '{$kelas[$i]}', '{$hari[$i]}', '{$jam[$i]}')");
        if (!$insert) {
            $allSuccess = false;
            echo "Gagal insert detail ke-{$i}: " . mysqli_error($conn);
            die;
        }
    }

    if($allSuccess) {
        echo '<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Data Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="2;url=index.php?page=jadwal"/>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Gagal menyimpan sebagian atau seluruh data detail.</h4>
        </div>';
         }
    
    }

?>
<div class="content">
    <div class="content-fluid">
        <div class="card">
            <div class="card-body">
                <h3>Tambah Jadwal</h3>
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Kode Jadwal</label>
                            <input type="text" name="id_jadwal" value="<?=  $hasilkode ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Guru</label>
                            <select name="kd_guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM tabel_guru");
                                while ($g = mysqli_fetch_array($query)) {
                                    echo "<option value=' {$g['kd_guru']} '>{$g['nm_guru']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select name="semester" id="semester" class="form-control" required>
                                <option selected disabled>---Pilih Semester---</option>
                                <option>Ganjil</option>
                                <option>Genap</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select name="thn_ajaran" id="semester" class="form-control" required>
                                <option selected disabled>---Pilih Tahun Ajaran---</option>
                                <option>2025/2026</option>
                                <option>2026/2027</option>
                            </select>
                        </div>
                        <hr>
                        <h5>Detail Jadwal</h5>
                        <div class="detailjadwal" id="detailjadwal">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <select name="Kd_mapel[]" class="form-control" required>
                                        <option selected disabled>---Pilih Mata Pelajaran---</option>
                                        <?php
                                        $mapel = mysqli_query($conn, "SELECT * FROM tabelmapel");
                                        while ($m = mysqli_fetch_array($mapel)) {
                                            echo "<option value='{$m['Kd_mapel']}'>{$m['Nm_mapel']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="hari[]" class="form-control" required>
                                        <option selected disabled>---Pilih Hari---</option>
                                        <option>Senin</option>
                                        <option>Selasa</option>
                                        <option>Rabu</option>
                                        <option>Kamis</option>
                                        <option>Jumat</option>
                                        <option>Sabtu</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="jam[]" class="form-control" required>
                                        <option selected disabled>---Pilih Jam---</option>
                                        <option>07:15-09:15</option>
                                        <option>07:15-08:00</option>                                       
                                        <option>08:00-09:15</option>
                                        <option>08:00-09:15</option>
                                        <option>09:45-10:30</option>
                                        <option>10:30-11:15</option>
                                        <option>10:30-12:00</option>
                                        <option>12:45-14:00</option>
                                        <option>14:00-15:30</option>                                        
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="kelas[]" class="form-control" required>
                                        <option selected disabled>---Pilih Mata Pelajaran---</option>
                                        <?php
                                        $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                        while ($k = mysqli_fetch_array($kelas)) {
                                            echo "<option value='{$k['nm_kelas']}'>{$k['nm_kelas']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-info" onclick="tambahBaris()">Tambah Mapel</button>
                        <br><br>
                        <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        <script>
                            function tambahBaris() {
                                let container = document.getElementById('detailjadwal');
                                let row = container.firstElementChild.cloneNode(true);
                                row.querySelectorAll('input').forEach(input => input.value = '');
                                container.appendChild(row);
                            }
                        </script>
             </div>
        </div>
    </div>

</div>
</form>