<?php
class klas_air{
    function koneksi(){
        $koneksi=mysqli_connect("localhost","user_air","#Us3r_A1r_2025#","air");
        return $koneksi;
    }

   function dt_user($sesi_user)
    {
        $koneksi = $this->koneksi();
        $sesi_user = mysqli_real_escape_string($koneksi, $sesi_user);
        $q = mysqli_query($koneksi, "SELECT nama, kota, level, tipe FROM user WHERE username='$sesi_user'");
        $d = mysqli_fetch_row($q);
        return $d;
    }

    function user_to_kdtarif($username)
    {
        $koneksi = $this->koneksi();
        $username = mysqli_real_escape_string($koneksi, $username);
        $q = mysqli_query($koneksi, "SELECT tipe FROM user WHERE username='$username'");
        
        if (mysqli_num_rows($q) > 0) {
            $d = mysqli_fetch_row($q);
            $tipe = $d[0];
            return $this->tipe_to_kdtarif($tipe);
        } else {
            return false; 
        }
    }

    function tipe_to_kdtarif($tipe)
    {
        $koneksi = $this->koneksi();
        $tipe = mysqli_real_escape_string($koneksi, $tipe);
        $q = mysqli_query($koneksi, "SELECT kd_tarif FROM tarif WHERE tipe='$tipe'");
        
        if (mysqli_num_rows($q) > 0) {
            $d = mysqli_fetch_row($q);
            return $d[0];
        } else {
            return 0; 
        }
    }

    function kdtarif_to_tarif($kd_tarif)
    {
        $koneksi = $this->koneksi();
        $kd_tarif = mysqli_real_escape_string($koneksi, $kd_tarif);
        $q = mysqli_query($koneksi, "SELECT tarif FROM tarif WHERE kd_tarif='$kd_tarif'");
        
        if (mysqli_num_rows($q) > 0) {
            $d = mysqli_fetch_row($q);
            return $d[0];
        } else {
            return 0; 
        }
    }

    function tgl_walik($tgl)
    {
        $e = explode("-", $tgl);
        $tgl_baru = "$e[2]-$e[1]-$e[0]";
        return $tgl_baru;
    }
    function no_to_user($no) {
        global $koneksi;
        $q = mysqli_query($koneksi, "SELECT username FROM pemakaian WHERE no='$no'");
        $d = mysqli_fetch_row($q);
        return $d ? $d[0] : null;
    }
    function bln($no){
        if ($no == 1) $bln="Januari";
        elseif ($no == 2) $bln="Februari";
        elseif ($no == 3) $bln="Maret";
        elseif ($no == 4) $bln="April";
        elseif ($no == 5) $bln="Mei";
        elseif ($no == 6) $bln="Juni";
        elseif ($no == 7) $bln="Juli";
        elseif ($no == 8) $bln="Agustus";
        elseif ($no == 9) $bln="September";
        elseif ($no == 10) $bln="Oktober";
        elseif ($no == 11) $bln="November";
        else 
         $bln="Desember";
        return $bln;

    }
}
?>