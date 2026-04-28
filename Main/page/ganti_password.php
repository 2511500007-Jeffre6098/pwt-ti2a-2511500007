<div class="content-header">
  <div class="container-fluid">
  </div>
</div>
<?php

if (isset($_POST['tambah'])) {
  $pl = $_POST['pl'];
  $pb = $_POST['pb'];
  $username = $_POST["Username"];
  $check = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE Username = '$username' "));

if ($check) {
    $update = mysqli_query($conn, "UPDATE users SET password = '$pb' WHERE password = '$pl' AND Username = '$username' ");

if ($update) {
      echo '<div class="alert alert-info-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hkdden="true">&times;</button>
    <h5> <i class="icon fas fa-info"></i> Info </h5>
    <h4>Berhasil Diubah</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"
        aria-hkdden="true">&times;</button>
    <h5> <i class="icon fas fa-warning"></i> Info </h5>
    <h4>Gagal Diubah</h4></div>';
    }
    

  }
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="Username" value="<?php echo $_SESSION['Username'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pl">Password Lama</label>
                        <input type="text" name="pl" placeholder="Masukkan Password Lama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pb">Password Baru</label>
                        <input type="text" name="pb" id="pb" placeholder="Masukkan Password Baru" class="form-control">
                    </div>
                        <div class="form-group">
                            <input type="submit" name="tambah" value="Simpan" class="btn btn-primary">
                        </div>