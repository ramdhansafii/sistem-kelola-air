<?php
session_start();
include '../assets/func.php';

$air = new klas_air;
$koneksi = $air->koneksi();
$dt_user = $air->dt_user($_SESSION['user']);
$level = $dt_user[2];
$tipe = $dt_user[3];
$username = $_SESSION['user'];

if (isset($_POST['p'])) {
    $p = $_POST['p'];
    

    if ($p == "summary" && ($level == "admin" || $level == "petugas")) {
        $bln = $_POST['t'];
        $q1 = mysqli_query($koneksi, "SELECT COUNT(username) as jml_warga FROM user WHERE level='warga'");
        $d1 = mysqli_fetch_assoc($q1);
        $data[] = array('jml_warga' => $d1['jml_warga']);

        $q2 = mysqli_query($koneksi, "SELECT SUM(pemakaian) as pemakaian FROM pemakaian WHERE tanggal LIKE '$bln%'");
        $d2 = mysqli_fetch_assoc($q2);
        $data[] = array('pemakaian' => $d2['pemakaian']);

        $q3 = mysqli_query($koneksi, "SELECT COUNT(username) as sdh_dicatat FROM pemakaian WHERE tanggal LIKE '$bln%'");
        $d3 = mysqli_fetch_assoc($q3);
        $data[] = array('tercatat' => $d3['sdh_dicatat']);

        echo json_encode($data);

    } elseif ($p == "summary_bendahara" && $level == "bendahara") {
        $bln = $_POST['t'];
        $q1 = mysqli_query($koneksi, "SELECT COUNT(username) as jml_warga FROM user WHERE level='warga'");
        $d1 = mysqli_fetch_assoc($q1);
    
        $q2 = mysqli_query($koneksi, "SELECT SUM(tagihan) as total_tagihan FROM pemakaian WHERE tanggal LIKE '$bln%'");
        $d2 = mysqli_fetch_assoc($q2);
    
        $q3 = mysqli_query($koneksi, "SELECT COUNT(DISTINCT username) as lunas_count FROM pemakaian WHERE tanggal LIKE '$bln%' AND status = 'lunas'");
        $d3 = mysqli_fetch_assoc($q3);
    
        $q4 = mysqli_query($koneksi, "SELECT COUNT(DISTINCT username) as belum_count FROM pemakaian WHERE tanggal LIKE '$bln%' AND status = 'blm lunas'");
        $d4 = mysqli_fetch_assoc($q4);
    
        $data = array(
            'total_payers' => intval($d1['jml_warga']),
            'total_income' => intval($d2['total_tagihan']),
            'fully_paid'   => intval($d3['lunas_count']),
            'unpaid'       => intval($d4['belum_count'])
        );
    
        echo json_encode($data);

    } elseif ($p == "summary_warga" && $level == "warga") {
        $bln = $_POST['t'];
        $q1 = mysqli_query($koneksi, "SELECT DATE_FORMAT(MAX(tanggal), '%d') as waktu_pencatatan FROM pemakaian WHERE tanggal LIKE '$bln%' AND username = '$username'");
        $d1 = mysqli_fetch_assoc($q1);

        $q2 = mysqli_query($koneksi, "SELECT SUM(pemakaian) as pemakaian_air FROM pemakaian WHERE tanggal LIKE '$bln%' AND username = '$username'");
        $d2 = mysqli_fetch_assoc($q2);

        $q3 = mysqli_query($koneksi, "SELECT SUM(tagihan) as total_tagihan FROM pemakaian WHERE tanggal LIKE '$bln%' AND username = '$username'");
        $d3 = mysqli_fetch_assoc($q3);

        $q4 = mysqli_query($koneksi, "SELECT COUNT(*) as lunas_count FROM pemakaian WHERE tanggal LIKE '$bln%' AND status = 'lunas' AND username = '$username'");
        $d4 = mysqli_fetch_assoc($q4);

        $data = array(
            'waktu_pencatatan' => $d1['waktu_pencatatan'] ?? '',
            'pemakaian_air'    => intval($d2['pemakaian_air']),
            'total_tagihan'    => intval($d3['total_tagihan']),
            'status_tagihan'   => $d4['lunas_count'] > 0 ? 'LUNAS' : 'BLM LUNAS'
        );

        echo json_encode($data);
    } elseif($p=="chart_bar"){
        $user=$_POST['y'];
        $q=mysqli_query($koneksi,"SELECT MONTH(tanggal) as bln,pemakaian FROM pemakaian WHERE username='$user'");
        while($d=mysqli_fetch_assoc($q)){
            $response[]= $air->bln($d['bln']);
            $response[]= $d['pemakaian'];
        }
        echo json_encode($response);
    } elseif($p=="chart_line"){
        $user=$_POST['y'];
        $q=mysqli_query($koneksi,"SELECT MONTH(tanggal) as bln,tagihan FROM pemakaian WHERE username='$user'");
        while($d=mysqli_fetch_assoc($q)){
            $response[]= $air->bln($d['bln']);
            $response[]= $d['tagihan'];
        }
        echo json_encode($response);
    }
}
?>
