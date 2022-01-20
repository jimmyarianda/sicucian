<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } elseif ($_SESSION['level'] === 'Kasir') {
      header("Location: ./home.php");
    } else {
      if (!isset($_GET['id_user'])) {
        header('Location: user.php');
      }

      $id_user = $_GET['id_user'];

      $sql = "SELECT * FROM tb_user WHERE id_user=$id_user";
      $query = mysqli_query($db, $sql);
      $user= mysqli_fetch_assoc($query);

      if (mysqli_num_rows($query) < 1){
        header("Location: user.php");
      }
?>

<!DOCTYPE html>
<html lang="en">

<?php include('_partials/head.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <?php include('_partials/navbar.php'); ?>

    <?php include('_partials/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              User
              <small>
              </small>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content">

        <?php if (isset($_SESSION['error'])) : ?>
          <p>
        <?php
            $error = $_SESSION['error'];
            if ($error) {
            ?>
            <div id="errorMessage" class="alert alert-danger" role="alert">
              <i class="fa fa-exclamation-circle"></i>&nbsp;<?=$error;?>
            </div>
            <?php
            }
        ?>
        </p>
        <?php
        unset($_SESSION['error']);
        endif;
        ?>
        
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Data User
                  &nbsp;&nbsp;<a class="btn btn-primary" href="user.php"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a></h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="user_edit_process.php" role="form">
                <input type="hidden" name="id_user" value="<?=$user['id_user'];?>" />
                <div class="box-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username User" name="username" value="<?=$user['username'];?>" autofocus="autofocus" required="required">
                        <p class="help-block">Username minimal 6 karakter, tidak boleh mengandung spasi dan garis bawah di depan atau di belakang.</p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Nama user" name="nama_user" value="<?=$user['nama_user'];?>" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password User" name="password" required="required">
                        <p class="help-block">Password minimal 8 karakter, mengandung setidaknya satu huruf kapital, satu nomor dan satu karakter khusus (!@#$%^&*-).</p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control" placeholder="Konfirmasi Password User" name="k_password" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <label>Level</label>
                        <select class="form-control" name="level" required="">
                          <option value="<?=$user['level'];?>"><?=$user['level'];?></option>
                            <option value="Administrator">Administrator</option>
                            <option value="Kasir">Kasir</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <label>Status</label>
                        <select class="form-control" name="status" required="">
                          <option value="<?=$user['status'];?>"><?=$user['status'];?></option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <input type="submit" value="Simpan Data" class="btn btn-success" name="simpan" />&nbsp;
                  <a class="btn btn-default" href="user.php">Batal</a>
                </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include('_partials/footer.php'); ?>
    
  </div>
  <!-- ./wrapper -->

  <?php include('_partials/modal.php'); ?>

  <?php include('_partials/js.php'); ?>

  <?php include('_partials/ajax.php'); ?>

</body>

</html>

<?php
}
?>