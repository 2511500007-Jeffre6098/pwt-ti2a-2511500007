<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Kode otomatis
$carikode = mysqli_query($conn, "SELECT MAX(id_jadwal) FROM jadwal") or die(mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && !empty($datakode[0])) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "J-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "J-001";
}

$_SESSION["KODE"] = $hasilkode;

// Proses simpan
if (isset($_POST['tambah'])) {
    $id_jadwal   = $_POST['id_jadwal'];
    $kelas       = $_POST['kelas'];
    $thn_ajaran  = $_POST['thn_ajaran'];
    $semester    = $_POST['semester'];
    $mapel       = $_POST['mapel'];
    $guru        = $_POST['guru'];
    $hari        = $_POST['hari'];
    $jam_mulai   = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $insert_jadwal = mysqli_query($conn, "INSERT INTO jadwal (id_jadwal, id_kelas, thn_ajaran, semester)
        VALUES ('$id_jadwal', '$kelas', '$thn_ajaran', '$semester')");

    if (!$insert_jadwal) {
        echo "Gagal insert ke tabel jadwal: " . mysqli_error($conn);
        die;
    }

    $allSuccess = true;
    for ($i = 0; $i < count($mapel); $i++) {
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
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Gagal menyimpan sebagian atau seluruh data detail</h4>
        </div>';
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
                        <input type="text" name="id_jadwal" value="<?= $hasilkode; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas" required>
                            <option disabled selected value="">-- Pilih Kelas --</option>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM kelas");
                            while ($k = mysqli_fetch_array($query)) {
                                echo "<option value='$k[id_kelas]'>$k[nm_kelas]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="thn_ajaran">Tahun Ajaran</label>
                        <select class="form-control" name="thn_ajaran" id="thn_ajaran" required>
                            <option disabled selected value="">-- Pilih Tahun Ajaran --</option>
                            <option value="2025/2026">2025/2026</option>
                            <option value="2024/2025">2024/2025</option>
                            <option value="2023/2024">2023/2024</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" name="semester" id="semester" required>
                            <option disabled selected value="">-- Pilih Semester --</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>

                    <h5>Detail Jadwal</h5>
                    <div id="detail-jadwal">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <select name="mapel[]" class="form-control">
                                    <option disabled selected value="">-- Pilih Mata Pelajaran --</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM tabelmapel");
                                    while ($m = mysqli_fetch_array($query)) {
                                        echo "<option value='$m[Kd_mapel]'>$m[Nm_mapel]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select class="form-control" name="guru[]">
                                    <option disabled selected value="">-- Pilih Guru --</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM tabel_guru");
                                    while ($g = mysqli_fetch_array($query)) {
                                        echo "<option value='$g[kd_guru]'>$g[nm_guru]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="hari[]" class="form-control">
                                    <option disabled selected value="">-- Pilih Hari --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="jam_mulai[]" class="form-control">
                                    <option disabled selected value="">-- Jam Mulai --</option>
                                    <option value="07.00">07.00</option>
                                    <option value="07.40">07.40</option>
                                    <option value="08.20">08.20</option>
                                    <option value="09.40">09.40</option>
                                    <option value="10.20">10.20</option>
                                    <option value="11.00">11.00</option>
                                    <option value="11.40">11.40</option>
                                    <option value="13.00">13.00</option>
                                    <option value="13.40">13.40</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="jam_selesai[]" class="form-control">
                                    <option disabled selected value="">-- Jam Selesai --</option>
                                    <option value="07.40">07.40</option>
                                    <option value="08.20">08.20</option>
                                    <option value="09.00">09.00</option>
                                    <option value="10.20">10.20</option>
                                    <option value="11.00">11.00</option>
                                    <option value="11.40">11.40</option>
                                    <option value="12.20">12.20</option>
                                    <option value="13.40">13.40</option>
                                    <option value="14.20">14.20</option>
                                </select>
                            </div>

                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-info" onclick="tambahBaris()">+ Tambah Mapel</button>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                </form>

                <script>
                    function tambahBaris() {
                        let container = document.getElementById('detail-jadwal');
                        let row = container.firstElementChild.cloneNode(true);

                        // Reset semua select di baris baru
                        row.querySelectorAll('select').forEach(select => select.value = '');

                        // Isi kolom kosong (col-md-1) dengan tombol Hapus
                        let kolomHapus = row.querySelector('.col-md-1');
                        kolomHapus.innerHTML = '<button type="button" class="btn btn-danger" onclick="hapusBaris(this)">X</button>';

                        container.appendChild(row);
                    }

                    function hapusBaris(btn) {
                        btn.closest('.row').remove();
                    }
                </script>

            </div>
        </div>
    </div>
</section>
