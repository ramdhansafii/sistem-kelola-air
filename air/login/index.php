<?php
$meter_awal = $meter_akhir = "";
session_start();
if(empty($_SESSION['user'])&& empty($_SESSION['pass'])){
    echo "<script>window.location.replace('../index.php')</script>";
}

//koneksi ke database MariaDb
include '../assets/func.php';
$air = new klas_air;
$koneksi = $air->koneksi();
$dt_user=$air->dt_user($_SESSION['user']);
$level=$dt_user[2];

?>
<?php
session_start();
if (empty($_SESSION['user']) && empty($_SESSION['pass'])) {
    echo "<script>window.location.replace('../index.php')</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/air.js"></script>
    </head>
    <body class="sb-nav-fixed" data-level="<?php echo $level; ?>">
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">cv.abadi jaya</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Dashboard 
                            </a>
                            <?php
                            if ($level == "admin"){
                            ?>
                                <a class="nav-link" href="index.php?p=user">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Manajemen User
                                </a>
                                <a class="nav-link" href="index.php?p=catat_meter">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Lihat Pemakaian Warga
                                </a>
                                <!-- <a class="nav-link" href="index.php?p=pembayaran_warga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Pembayaran Warga
                                </a> -->
                                <!-- <a class="nav-link" href="index.php?p=ubah_data_meter_warga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Ubah Data Meter Warga
                                </a> -->
                            <?php
                            }
                            elseif($level == "bendahara"){
                                ?> 
                                <a class="nav-link" href="index.php?p=pemakaian_warga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Lihat Pemakaian Warga
                                </a>
                                <a class="nav-link" href="index.php?p=tarif">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Manajemen Tarif
                                </a>
                                <!-- <a class="nav-link" href="index.php?p=pembayaran_warga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Kelola Pembayaran Warga
                                </a>
                                <a class="nav-link" href="index.php?p=ubah_data_meter_warga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Ubah Data Meter Warga
                                </a> -->
                                <?php                            
                            }elseif($level == "petugas"){
                                ?> 
                                <!-- <a class="nav-link" href="index.php?p=pemakaian_warga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Lihat Pemakaian Warga
                                </a> -->
                                <a class="nav-link" href="index.php?p=catat_meter">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                catat meter warga
                                </a>
                                <!-- <a class="nav-link " href="index.php?p=ubah_data_meter_bulan_warga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Ubah Data Meter per bulan
                                </a> -->
                                <?php                            
                            }elseif($level == "warga"){
                                ?> 
                                <a class="nav-link" href="index.php?p=pemakaian_sendiri">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Lihat Pemakaian sendiri
                                </a>
                                <!-- <a class="nav-link" href="index.php?p=tagihan_sendiri">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                Melihat tagihan sendiri
                                </a>
                                <a class="nav-link" href="index.php?p=bayar_tagihan">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                membayar tagihan
                                </a> -->
                                <?php                            
                            }
                            ?>
                    
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"><i class="fas fa-user fa-flip text-warning"></i> Logged in as: <?php echo $dt_user[2] ?> </div>
                        <?php echo $dt_user[0].' ('.$dt_user[1].')';?>
                    </div> 
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <?php
                        //echo $_SERVER['REQUEST_URI'];
                        $e= explode("=",$_SERVER['REQUEST_URI']);
                        // echo "<BR>[0]: $e[0] --> [1]: $e[1]";
                        if (!empty($e[1])){
                            if ($e[1]== "user" ||$e[1]== "user_edit&username"){
                                $h1="Manajemen User";
                                $li="Menu untuk CRUD User";
                            } elseif($e[1]=="pemakaian_warga"){
                                $h1="Lihat Pemakaian Warga";
                                $li="Lihat Data Pemakaian Warga";
                            } elseif($e[1]=="pembayaran_warga"){
                                $h1="Lihat Pembayaran Warga";
                                $li="Lihat Data Pembayaran Air Warga";
                            }elseif($e[1]=="ubah_data_meter_warga"){
                                $h1="Ubah Data Meter Warga";
                                $li="Ubah Data Meter Air Warga";
                            } elseif($e[1]=="catat_meter"|| $e[1] == "meter_edit&no"){
                                $h1="catatan Meter Warga";
                                $li="catatan Meter Air Warga";
                            } elseif($e[1]=="ubah_data_meter_bulan_warga"){
                                $h1="Ubah Data Meter perbulan ";
                                $li="Ubah Data Meter perbulan Warga";
                            } elseif($e[1]=="pemakaian_sendiri"){
                                $h1="melihat pemakaian sendiri";
                                $li="melihat pemakaian sendiri";
                            } elseif($e[1]=="tagihan_sendiri"){
                                $h1="Melihat tagihan sendiri";
                                $li="Melihat tagihan sendiri";
                            } elseif($e[1]=="bayar_tagihan"){
                                $h1="Membayar tagihan";
                                $li="Membayar tagihan";
                            } elseif($e[1]=="tarif" || $e[1]="tarif_edit&kd_tarif"){
                                $h1="Manajemen Tarif";
                                $li="menu untuk mengelola tarif";
                            }
                        }else{
                            $h1="Dashboard";
                            $li="Dashboard";
                        }
                        ?>
                        <h1 class="mt-4"><?php echo $h1?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"<?php echo $li ?></li>
                        </ol>
                        <?php
                            // echo "sesi user: ".$_SESSION['user'] . " sesi pass: " . $_SESSION['pass'];

                            // session_destroy();
                            // echo "<BR> setelah session destroy: sesi user: ".$_SESSION['user'] . " sesi pass: " . $_SESSION['pass'];
                        ?>
                        <div class="row mb-3" id="pilih_waktu">
                            <div class="col-xl-3 col-md-12">
                                <label for="sel1" class="form-label">Pilih Waktu:</label>
                                <select class="form-select" id="sel1" name="waktu">
                                <option valuee="">Bulan</option>
                                <?php
                                for($i=1;$i<=12;$i++){
                                    if($i<10)
                                        $i="0".$i;
                                    
                                    echo "<option value=".date("Y")."-".$i.">".$air->bln($i)." ".date("Y")."</option>";

                                }
                                ?>
                                
                                </select>
                            </div>
                        </div>
                        <div class="row" id="summary">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3"> orang</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Pelanggan</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">m<sup>3</sup></div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Pemakaian Air</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">warga</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Sudah Dicatat</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">warga</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Belum Dicatat</i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="summary_bendahara">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3"> orang</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Pelanggan</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">Rp</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Pemasukan</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">warga</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Sudah Lunas</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">warga</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Belum Dibayar</i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="summary_warga">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3"><?php echo date("H:i:s")?></div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Waktu Pencatatan</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">m<sup>3</sup></div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Pemakaian Air</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3">Rp</div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Tagihan</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body d-flex justify-content-center">
                                        <h1></h1> 
                                        <div class="ms-3"></div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <!-- <a class="small text-white stretched-link" href="#">View Details</a> -->
                                        <div class="small text-white">Status Tagihan</i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="chart">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Grafik Pemakaian Air (m<sup>3</sup>)
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Grafik Tagihan Air (Rp)
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_POST['tombol'])){
                            $t=$_POST['tombol'];
                            if($t=="user_add"){
                                $user = $_POST['yuser'];
                                $pass = password_hash($_POST['paswed'],PASSWORD_DEFAULT);
                                $pass2 = $_POST['paswed'];
                                $nama = $_POST['nama'];
                                $alamat = $_POST['alamat'];
                                $kota = $_POST['kota'];
                                $telephone = $_POST['tlp'];
                                $level =$_POST['level'];
                                $tipe = $_POST['tipe'];
                                $status = $_POST['status'];

                                //cek user sudah ada atau belum di tabel user
                                $qc=mysqli_query($koneksi,"SELECT username FROM user WHERE username='$user'");
                                $qj=mysqli_num_rows($qc);
                                // echo "hasil cek user: $qj";
                                //username tidak ada
                                if(empty($qj)) {
                                    mysqli_query($koneksi,"INSERT INTO user (username,password,nama,alamat,kota,telephone,level,tipe,status) VALUES ('$user','$pass',\"$nama\",'$alamat','$kota','$telephone','$level','$tipe','$status')");
                                    if(mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Success</strong> Data berhasil dimasukan..
                                            </div>";
                                    }else{
                                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Eror</strong> Data Gagal dimasukan..
                                            </div>";
                                    }
                                }
                                else{//username kembar
                                    echo "<div class='alert alert-danger alert-dismissible fade show'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Username $user</strong> sudah ada..
                                        </div>";         
                                }
                            } elseif($t=="user_edit"){
                                $username=$_GET['username'];
                                $user = $_POST['yuser'];
                                $pass = $_POST['paswed'];
                                $nama = $_POST['nama'];
                                $alamat =$_POST['alamat'];
                                $kota = $_POST['kota'];
                                $telephone = $_POST['tlp'];
                                $level =$_POST['level'];
                                $tipe = $_POST['tipe'];
                                $status = $_POST['status'];
                                
                                //cek password yang ada di table user
                                $qcp=mysqli_query($koneksi,"SELECT password FROM user WHERE username='$user'");
                                $dcp=mysqli_fetch_row($qcp);
                                $pass_db=$dcp[0];

                                if($pass==$pass_db){
                                    mysqli_query($koneksi,"UPDATE user SET nama=\"$nama\",alamat='$alamat',kota='$kota',telephone='$telephone',level='$level',tipe='$tipe',status='$status' WHERE username='$username'");
                                }
                                else {
                                    $pass2 = password_hash($pass, PASSWORD_DEFAULT);
                                    mysqli_query($koneksi,"UPDATE user SET password='$pass2' ,nama=\"$nama\",alamat='$alamat',kota='$kota',telephone='$telephone',level='$level',tipe='$tipe',status='$status' WHERE username='$username'");
                                }

                                if(mysqli_affected_rows($koneksi)>0) {
                                    $_SESSION['notif'] = "<div class='alert alert-success alert-dismissible fade show'>
                                        <button type=button class=btn-close data-bs-dismiss=alert></button>
                                        <strong>Success</strong> Data berhasil diupdate..
                                    </div>";
                                }else{
                                    $_SESSION['notif'] = "<div class='alert alert-primary alert-dismissible fade show'>
                                        <button type=button class=btn-close data-bs-dismiss=alert></button>
                                        <strong>Data</strong> tidak ada perubahan..
                                    </div>";
                                }
                                echo "<script>window.location='index.php?p=user';</script>";
                                exit;
                            } elseif($t=="user_hapus"){
                                $user=$_POST['user'];
                                mysqli_query($koneksi,"DELETE FROM user WHERE username='$user'");
                                if(mysqli_affected_rows($koneksi)>0) {
                                    echo "<div class='alert alert-success alert-dismissible fade show'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Success</strong> Data berhasil dihapus..
                                        </div>";
                                }else{
                                    echo "<div class='alert alert-danger alert-dismissible fade show'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Eror</strong> Data Gagal dihapus..
                                        </div>";
                                }
                            } elseif($t=="tarif_add"){
                                $kd_tarif = $_POST['kd_tarif'];
                                $tipe_tarif = $_POST['tipe_tarif'];
                                $tarif = $_POST['tarif'];
                                $status = $_POST['status'];
                             
                                    //masukan data ke tabel tarif
                                    mysqli_query($koneksi,"INSERT INTO tarif (kd_tarif,tipe,tarif,status) VALUES ('$kd_tarif',\"$tipe_tarif\",'$tarif','$status')");
                                    if(mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Success</strong> Data berhasil dimasukan..
                                            </div>";
                                    }else{
                                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Eror</strong> Data Gagal dimasukan..
                                            </div>";
                                    }
                            } elseif($t=="tarif_edit"){
                                    $kd_tarif=$_GET['kd_tarif'];
                                    $tipe_tarif = $_POST['tipe_tarif'];
                                    $tarif = $_POST['tarif'];
                                    $status = $_POST['status'];
    
                                    mysqli_query($koneksi,"UPDATE tarif SET tipe='$tipe_tarif',tarif='$tarif',status='$status' WHERE kd_tarif='$kd_tarif'");
                                    if(mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class=\"alert alert-success alert-dismissible fade show\" id=alert-tarif>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Success</strong> Data berhasil diupdate..
                                            </div>";
                                    }else{
                                        echo "<div class=\"alert alert-primary alert-dismissible fade show\" id=alert-tarif>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> tidak ada perubahan..
                                            </div>";
                                    }
                            } elseif($t=="tarif_hapus"){
                                    $kd_tarif=$_POST['kd_tarif'];
                                    mysqli_query($koneksi,"DELETE FROM tarif WHERE kd_tarif='$kd_tarif'");
                                    if(mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Success</strong> Data berhasil dihapus..
                                            </div>";
                                    }else{
                                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Eror</strong> Data tidak jadi dihapus..
                                            </div>";
                                    }
                            }  elseif($t=="meter_add"){
                                $username = $_POST['username'];
                                $meter_awal = $_POST['meter_awal'];
                                $meter_akhir = $_POST['meter_akhir'];
                                $tagihan = isset($d[7]) ? $d[7] : 0;
                                $status=$_POST['status'];
                                
                                $kd_tarif = $air->user_to_kdtarif($username);
                                $tarif = $air->kdtarif_to_tarif($kd_tarif);
                               
                                 //cek meter awal lebih dari meter akhir
                                 $pemakaian=$meter_akhir-$meter_awal;
                                  $tagihan = $tarif * $pemakaian;
                                if($pemakaian < 0) {//meter awal >meter akhir jadinya pemakain
                                        echo "<div class='alert alert-danger alert-dismissible fade show' id=alert-meter>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>meter akhir</strong> harus lebih besar dari meter awal
                                        </div>";    
                                } else{//meter akhir > meter awal
                                    mysqli_query($koneksi,"INSERT INTO pemakaian (username,meter_awal,meter_akhir,pemakaian,kd_tarif,tagihan,tanggal,waktu,status)VALUES('$username','$meter_awal','$meter_akhir','$pemakaian','$kd_tarif','$tagihan',CURRENT_DATE(),CURRENT_TIME(),'$status')");
                                    if(mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Success</strong> Data berhasil dimasukan..
                                            </div>";
                                    }else{
                                        echo "<div class='alert alert-danger alert-dismissible fade show' id=alert-meter>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Eror</strong> Data Gagal dimasukan..
                                            </div>";
                                    }
                                }
                            }  
                            elseif($t=="meter_edit"){
                                $no=$_GET['no'];
                                $meter_awal = $_POST['meter_awal'];
                                $meter_akhir = $_POST['meter_akhir'];
                                $status=$_POST['status'];
                                $username=$air->no_to_user($no);
                                $kd_tarif = $air->user_to_kdtarif($username);
                                $tarif = $air->kdtarif_to_tarif($kd_tarif);
                                
                                $pemakaian=$meter_akhir-$meter_awal;
                                $tagihan = $tarif * $pemakaian;

                                mysqli_query($koneksi,"UPDATE pemakaian SET meter_awal='$meter_awal',meter_akhir='$meter_akhir',pemakaian='$pemakaian',tagihan='$tagihan',status='$status' WHERE no='$no'");
                                
                                if(mysqli_affected_rows($koneksi)>0) {
                                    $_SESSION['notif'] = "<div class=\"alert alert-success alert-dismissible fade show\" id=alert-meter>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Success</strong> Data berhasil diupdate..
                                        </div>";
                                }else{
                                    $_SESSION['notif'] = "<div class=\"alert alert-primary alert-dismissible fade show\" id=alert-meter>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> tidak ada perubahan..
                                        </div>";
                                }
                                // Redirect ke daftar meter agar form edit tidak muncul lagi
                                echo "<script>window.location='index.php?p=catat_meter';</script>";
                                exit;
                            
                            } elseif($t=="meter_hapus"){
                                    $no=$_POST['no'];
                                    mysqli_query($koneksi,"DELETE FROM pemakaian WHERE no='$no'");
                                    if(mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Success</strong> Data berhasil dihapus..
                                            </div>";
                                    }else{
                                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Eror</strong> Data tidak jadi dihapus..
                                            </div>";
                                    }
                            }
                                
                         
                        }elseif(isset($_GET['p'])){
                            $p=$_GET['p'];
                            if($p=="user_edit"){
                                
                                $username=$_GET['username'];
                                // echo "masuk sini utk  edit user : $username";
                                $q=mysqli_query($koneksi, "SELECT password,nama,alamat,kota,telephone,level,tipe,status FROM user WHERE username='$username'");
                                $d=mysqli_fetch_row($q);
                                $pass=$d[0];
                                $pass2=password_hash($pass,PASSWORD_DEFAULT);
                                $nama=$d[1];
                                $alamat=$d[2];
                                $kota=$d[3];
                                $telephone=$d[4];
                                $level=$d[5];
                                $tipe=$d[6];
                                $status=$d[7];
                            }elseif($p=="tarif"){
                                $kd_tarif="";
                                $status="";
                            }elseif($p=="tarif_edit"){
                                $kd_tarif=$_GET['kd_tarif'];
                                $q=mysqli_query($koneksi, "SELECT tipe,tarif,status FROM tarif WHERE kd_tarif='$kd_tarif'");
                                $d=mysqli_fetch_row($q); 
                                $tipe_tarif=$d[0];
                                $tarif=$d[1];
                                $status=$d[2];         
                            }elseif($p=="meter"){
                                $kd_tarif="";
                                $tagihan="";
                                $status="";
                                
                            }elseif($p=="meter_edit"){
                                $no=$_GET['no'];
                                $q=mysqli_query($koneksi, "SELECT username,meter_awal,meter_akhir,status FROM pemakaian WHERE no='$no'");
                                $d=mysqli_fetch_row($q); 
                                $username=$d[0];
                                $meter_awal=$d[1];
                                $meter_akhir=$d[2];
                                $status=$d[3];
                                        
                            }
                        }
                        ?>
                        <div class="card mb-4" id="user_add">
                            <div class="card-header">
                                <i class="fas fa-user-plus me-2 text-success fa-fade"></i>
                                User
                            </div>
                            <div class="card-body">
                                <form method="post" class="needs-validation" id="user_form">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="yuser" value="<?php echo $username ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pass" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="paswed" placeholder="Enter password" name="paswed"  value="<?php echo $pass ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama:</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Enter nama" name="nama"  value="<?php echo $nama ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat">Alamat:</label>
                                    <textarea class="form-control" rows="5" id="alamat" name="alamat"><?php echo $alamat; ?></textarea>

                                </div>
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota:</label>
                                    <input type="text" class="form-control" id="kota" placeholder="Enter kota" name="kota" value="<?php echo $kota ?>" >
                                </div>
                                <div class="mb-3">
                                    <label for="tlp" class="form-label">Telephone:</label>
                                    <input type="text" class="form-control" id="tlp" placeholder="Enter telephone" name="tlp" value="<?php echo $telephone ?>" >
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level:</label>
                                    <select class="form-select" name="level">
                                        <option value="">Level</option>
                                        <?php
                                        $lv=array("admin","bendahara","petugas","warga");
                                        foreach($lv as $lv2){
                                            if($level==$lv2) $sel = "SELECTED";
                                            else $sel = "";
                                            echo "<option value=$lv2 $sel>".ucwords($lv2)."</option>";
                                        }
                                        ?>                                    
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Tipe:</label>
                                    <select class="form-select" name="tipe">
                                        <option value="">Tipe</option>
                                        <?php
                                        $t=array("RT","KOS");
                                        foreach($t as $t2){
                                            if($tipe==$t2) $sel = "SELECTED";
                                            else $sel = "";
                                            echo "<option value=$t2 $sel>".ucwords($t2)."</option>";
                                        }
                                        ?>                                  
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-select" name="status">
                                        <option value="">Status</option>
                                        <?php
                                        $s=array("AKTIF","TIDAK AKTIF");
                                        foreach($s as $s2){
                                            if($status==$s2) $sel = "SELECTED";
                                            else $sel = "";
                                            echo "<option value='$s2' $sel>$s2</option>";
                                        }
                                        ?>
                                                                              
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="tombol" value="user_add">Simpan</button>
                                </form>  
                            </div>
                        </div>
                        <div class="card mb-4" id="tarif_add">
                            <div class="card-header">
                                <i class="fas fa-user-plus me-2 text-success fa-fade"></i>
                                Tarif
                            </div>
                            <div class="card-body">
                                <form method="post" class="needs-validation" id="tarif_form">
                                <div class="mb-3">
                                    <label for="kd_tarif" class="form-label">Kd Tarif:</label>
                                    <input type="text" class="form-control" id="kd_tarif" placeholder="Enter Kd Tarif" name="kd_tarif" value="<?php echo $kd_tarif ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe_tarif" class="form-label">Tipe Tarif:</label>
                                    <select class="form-select" name="tipe_tarif">
                                        <option value="">Tipe Tarif</option>
                                        <?php
                                        $tt=array("RT","KOS");
                                        foreach($tt as $tt2){
                                            if($tipe_tarif==$tt2) $sel = "SELECTED";
                                            else $sel = "";
                                            echo "<option value=$tt2 $sel>".ucwords($tt2)."</option>";
                                        }
                                        ?>                                    
                                    </select>
                                </div>  
                                <div class="mb-3">
                                    <label for="tarif" class="form-label">Tarif:</label>
                                    <input type="number" class="form-control" id="tarif" placeholder="Enter tarif" name="tarif"  value="<?php echo $tarif ?>" required>
                                </div>
                                
                                <?php
                                $st=array("AKTIF","TDK AKTIF");
                                foreach($st as $st2){
                                    if($status == $st2)$sel="CHECKED";
                                    else $sel = "";
                                    echo "<div class=\"form-check form-check-inline\">
                                            <input type=radio class=form-check-input id=radio1 name=status value=\"$st2\" $sel>
                                            <label class=form-check-label for=status>$st2</label>
                                        </div> ";
                                } 
                                ?>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary" name="tombol" value="tarif_add">Simpan</button>
                                </div>
                                
                                </form>  
                            </div>
                        </div>

                        <div class="card mb-4" id="meter_add">
    <div class="card-header">
        <i class="fas fa-user-plus me-2 text-success fa-fade"></i>
        meter
    </div>
    <div class="card-body">
        <?php
            if ($e[1] == "meter_edit&no") $dis = 'disabled';
            else $dis = "";
        ?>
        <form method="post" class="needs-validation" id="meter_form">
            <div class="mb-3">
                <label for="username" class="form-label">Nama warga:</label>
                <select class="form-select" name="username" required <?php echo $dis ?>>
                    <option value="">Pilih Nama Warga</option >
                    <?php
                    $qw = mysqli_query($koneksi, "SELECT username, nama FROM user WHERE level='warga'");
                    while ($dw = mysqli_fetch_row($qw)) {
                        $sel = ($username == $dw[0]) ? "selected" : "";
                        echo "<option value='$dw[0]' $sel>$dw[1]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="meter_awal" class="form-label">Meter Awal (m<sup>3</sup>):</label>
                <input type="text" class="form-control" id="meter_awal" placeholder="Enter meter awal" name="meter_awal" value="<?php echo $meter_awal ?>" required>
            </div>
            <div class="mb-3">
                <label for="meter_akhir" class="form-label">Meter Akhir (m<sup>3</sup>):</label>
                <input type="text" class="form-control" id="meter_akhir" placeholder="Enter meter akhir" name="meter_akhir" value="<?php echo $meter_akhir ?>" required>
            </div>
            <?php
                // Inisialisasi status agar tidak undefined
                if (!isset($status)) {
                    $status = ""; // atau "BLM LUNAS"
                }

                $st = array("LUNAS", "BLM LUNAS");
                foreach ($st as $st3) {
                    $sel = ($status == $st3) ? "checked" : "";
                    echo "<div class=\"form-check form-check-inline\">
                            <input type=\"radio\" class=\"form-check-input\" id=\"radio_$st3\" name=\"status\" value=\"$st3\" $sel>
                            <label class=\"form-check-label\" for=\"radio_$st3\">$st3</label>
                        </div>";
}

            ?>
            
            <button type="submit" class="btn btn-primary" name="tombol" value="meter_add">Simpan</button>
        </form>
    </div>

    
    
                         </div>
                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form method="post">
                                        <button type="submit" name="tombol" value="user_hapus" class="btn btn-danger" data-bs-dismiss="modal">Ya</button>         
                                    </form>
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tidak</button>
                                </div>

                            </div>  
                        </div>
                        </div>
                        <?php
                        if(isset($_SESSION['notif'])){
                            echo $_SESSION['notif'];
                            unset($_SESSION['notif']);  
                        }
                        ?>
                        <div class="card mb-4" id="user_list">
                            <div class="card-header">
                                <i class="fas fa-users me-2 text-success fa-fade"></i>
                                Data User
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Telepon</th>
                                            <th>Level</th>
                                            <th>Tipe</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $q=mysqli_query($koneksi,"SELECT username,nama,alamat,kota,telephone,level,tipe,status FROM user ORDER BY level ASC");
                                        while($d=mysqli_fetch_row($q)){
                                            $username = $d[0];
                                            $nama = $d[1];
                                            $alamat = $d[2];
                                            $kota = $d[3];
                                            $telephone = $d[4];
                                            $level = $d[5];
                                            $tipe = $d[6];
                                            $status = $d[7];
                                            
                                            echo "<tr>
                                                    <td>$username </td>
                                                    <td>$nama</td>
                                                    <td>$alamat</td>
                                                    <td>$kota</td>
                                                    <td>$telephone</td>
                                                    <td>$level</td>
                                                    <td>$tipe</td>
                                                    <td>$status</td>
                                                    <td>
                                                        <a href=index.php?p=user_edit&username=$username><button type=button class='btn btn-outline-success btn-sm'>Ubah</button></a>
                                                        <button type=button class='btn btn-outline-danger btn-sm'data-bs-toggle=modal data-bs-target=#myModal data-user=$username>Hapus</button>
                                                    </td>
                                                </tr>";
                                        }
                                        ?>
                                                                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" id="tarif_list">
                            <div class="card-header">
                                <i class="fas fa-users me-2 text-success fa-fade"></i>
                                Data Tarif
                            </div>
                            <div class="card-body">
                                <table id="tarif_table">
                                    <thead>
                                        <tr>
                                            <th>KD Tarif</th>
                                            <th>Tipe Tarif</th>
                                            <th>Tarif</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $q=mysqli_query($koneksi,"SELECT kd_tarif,tipe,tarif,status FROM tarif ORDER BY kd_tarif ASC");
                                        while($d=mysqli_fetch_row($q)){
                                            $kd_tarif = $d[0];
                                            $tipe_tarif = $d[1];
                                            $tarif = $d[2];
                                            $status = $d[3];                                           
                                            echo "<tr>
                                                    <td>$kd_tarif </td>
                                                    <td>$tipe_tarif</td>
                                                    <td>$tarif</td>
                                                    <td>$status</td>
                                                    <td>
                                                        <a href=index.php?p=tarif_edit&kd_tarif=$kd_tarif><button type=button class='btn btn-outline-success btn-sm'>Ubah</button></a>
                                                        <button type=button class='btn btn-outline-danger btn-sm'data-bs-toggle=modal data-bs-target=#myModal data-kd_tarif=$kd_tarif>Hapus</button>
                                                    </td>
                                                </tr>";
                                        }
                                        ?>
                                                                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" id="meter_list">
                            <div class="card-header">
                                <i class="fas fa-list-check me-2 text-success fa-fade"></i>
                                Data meter warga
                            </div>
                            <div class="card-body">
                                <table id="meter_table">
                                    <thead>
                                        <tr>
                                            <th>Nama warga</th>
                                            <th>Tanggal & waktu</th>
                                            <th>Meter awal</th>
                                            <th>Meter akhir</th>
                                            <th>Pemakaian</th>
                                            <th>tagihan</th>
                                            <th>status</th>
                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $q=mysqli_query($koneksi,"SELECT no,username,meter_awal,meter_akhir,pemakaian,tanggal,waktu,tagihan,status FROM pemakaian ORDER BY tanggal DESC, username ASC");
                                        while($d=mysqli_fetch_row($q)){
                                            $no = $d[0];
                                            $dt_user2 = $air->dt_user($d[1]); 
                                            $nama = isset($dt_user2[0]) ? $dt_user2[0] : $d[1]; // fallback ke username jika null
                                            $meter_awal = $d[2];
                                            $meter_akhir= $d[3];   
                                            $pemakaian= $d[4]; 
                                            $tanggal= $air->tgl_walik($d[5]);   
                                            $waktu= $d[6];  
                                            $level_login=$dt_user[2];
                                            $tagihan= $d[7];
                                            $status= $d[8];

                                            $tgl_tabel=date_create($d[5]);
                                            $tgl_sekarang=date_create();
                                            $diff=date_diff($tgl_tabel,$tgl_sekarang);
                                            $selisih=$diff->days;

                                            
                                            echo "<tr>
                                                    <td>$nama</td>
                                                    <td>$tanggal $waktu | $selisih hari </td>
                                                    <td>$meter_awal</td>
                                                    <td>$meter_akhir</td>
                                                    <td>$pemakaian</td>
                                                    <td>$tagihan</td>
                                                    <td>$status</td>";
                                                
                                                    
                                                if($level_login=="admin" || $level_login=="bendahara"){
                                                     echo "<td>
                                                            <a href='index.php?p=meter_edit&no=$no'><button type='button' class='btn btn-success btn-sm'>Ubah</button></a>
                                                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-no='$no'>Hapus</button>
                                                        </td>";
                                                } else {
                                                     //berlaku untuk petugas
                                                     if($selisih<=30){
                                                     echo "<td>
                                                            <a href='index.php?p=meter_edit&no=$no'><button type='button' class='btn btn-success btn-sm'>Ubah</button></a>
                                                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-no='$no'>Hapus</button>
                                                        </td>";
                                                    } else {
                                                        echo "<td></td>";
                                                    }
                                                }
                                                                                             
                                                echo "</tr>";
                                        }
                                        ?>
                                                                              
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                        <div class="card mb-4" id="pemakaian_list">
                            <div class="card-header">
                                <i class="fas fa-list-check me-2 text-success fa-fade"></i>
                                Data  meter warga
                            </div>
                            <div class="card-body">
                                <table id="pemakaian_table">
                                    <thead>
                                        <tr>
                                            <th>Nama warga</th>
                                            <th>Tanggal & waktu</th>
                                            <th>Meter awal</th>
                                            <th>Meter akhir</th>
                                            <th>Pemakaian</th>
                                            <th>tagihan</th>
                                            <th>status</th>
                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $q=mysqli_query($koneksi,"SELECT no,username,meter_awal,meter_akhir,pemakaian,tanggal,waktu,tagihan,status FROM pemakaian ORDER BY tanggal DESC, username ASC");
                                        while($d=mysqli_fetch_row($q)){
                                            $no = $d[0];
                                            $dt_user2 = $air->dt_user($d[1]); 
                                            $nama = isset($dt_user2[0]) ? $dt_user2[0] : $d[1]; // fallback ke username jika null
                                            $meter_awal = $d[2];
                                            $meter_akhir= $d[3];   
                                            $pemakaian= $d[4]; 
                                            $tanggal= $air->tgl_walik($d[5]);   
                                            $waktu= $d[6];  
                                            $level_login=$dt_user[2];
                                            $tagihan= $d[7];
                                            $status= $d[8];

                                            $tgl_tabel=date_create($d[5]);
                                            $tgl_sekarang=date_create();
                                            $diff=date_diff($tgl_tabel,$tgl_sekarang);
                                            $selisih=$diff->days;

                                            
                                            echo "<tr>
                                                    <td>$nama</td>
                                                    <td>$tanggal $waktu | $selisih hari </td>
                                                    <td>$meter_awal</td>
                                                    <td>$meter_akhir</td>
                                                    <td>$pemakaian</td>
                                                    <td>$tagihan</td>
                                                    <td>$status</td>";
                                                
                                                    
                                                if($level_login=="admin" || $level_login=="bendahara"){
                                                     echo "<td>
                                                            <a href='index.php?p=meter_edit&no=$no'><button type='button' class='btn btn-success btn-sm'>Ubah</button></a>
                                                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-no='$no'>Hapus</button>
                                                        </td>";
                                                } else {
                                                     //berlaku untuk petugas
                                                     if($selisih<=30){
                                                     echo "<td>
                                                            <a href='index.php?p=meter_edit&no=$no'><button type='button' class='btn btn-success btn-sm'>Ubah</button></a>
                                                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-no='$no'>Hapus</button>
                                                        </td>";
                                                    } else {
                                                        echo "<td></td>";
                                                    }
                                                }
                                                                                             
                                                echo "</tr>";
                                        }
                                        ?>
                                                                              
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                        <div class="card mb-4" id="warga_list">
                            <div class="card-header">
                                <i class="fas fa-list-check me-2 text-success fa-fade"></i>
                            Data Pemakaian
                            </div>
                            <div class="card-body">
                                <table id="warga_table" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Waktu Pencatatan Meter</th>
                                            <th>Meter awal</th>
                                            <th>Meter akhir</th>
                                            <th>Pemakaian</th>
                                            <th>Tagihan (Rp)</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $q=mysqli_query($koneksi,"SELECT no,username,meter_awal,meter_akhir,pemakaian,tanggal,waktu,tagihan,status FROM pemakaian WHERE username='{$_SESSION['user']}'ORDER BY tanggal DESC");
                                        while($d=mysqli_fetch_row($q)){
                                            $no = $d[0];
                                            $dt_user2 = $air->dt_user($d[1]); 
                                            $nama = $dt_user2[0];
                                            $meter_awal = $d[2];
                                            $meter_akhir= $d[3];   
                                            $pemakaian= $d[4]; 
                                            $tanggal= $air->tgl_walik($d[5]);   
                                            $waktu= $d[6]; 
                                            $tagihan= $d[7];
                                            $status = $d[8]; 
                                            $level_login=$dt_user[2];

                                            $tgl_tabel=date_create($d[5]);
                                            $tgl_sekarang=date_create();
                                            $diff=date_diff($tgl_tabel,$tgl_sekarang);
                                            $selisih=$diff->days;

                                            
                                            echo "<tr>
                                                    <td>$tanggal $waktu |  ".date("Y-m-d")." </td>
                                                    <td>$meter_awal</td>
                                                    <td>$meter_akhir</td>
                                                    <td>$pemakaian</td>
                                                    <td>$tagihan</td>
                                                    <td>$status</td>
                                                    <td>
                                                        <a href=index.php?p=tarif_edit&kd_tarif=$kd_tarif><button type=button class='btn btn-outline-success btn-sm'>Bayar</button></a>
                                                    </td>
                                               </tr>";
                                                                                             
                                                
                                        }
                                        ?>
                                                                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="../profile/profile2.html">PROFILE</a>
                                &middot;
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="../assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="../assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script>var lvl = "<?php echo  $level_login; ?>";</script>
        <script>var user = "<?php echo  $username; ?>";</script>
        <script>
            // Ambil user dari session PHP ke variabel JS
            var yuser = "<?= $_SESSION['user'] ?? 'guest' ?>";
            console.log('user:', yuser); // Untuk debug
        </script>

    </body>
</html>