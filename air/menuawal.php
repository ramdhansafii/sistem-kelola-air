<?php 
//koneksi ke database MariaDb
include './assets/func.php';
$air = new klas_air;
$koneksi = $air->koneksi();

//masukan data ke tabel
    // $pass=password_hash("warga", PASSWORD_DEFAULT);
    // mysqli_query($koneksi,"INSERT INTO User(username,password,nama,alamat,kota,telephone,level,tipe,status) VALUES ('warga','$pass','warga air','Polines','Semarang','024111','warga','-','aktif')");
    // if(mysqli_affected_rows($koneksi)>0) echo "data berhasil masuk...";
    // else echo "Data GAGAL MASUK...";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                    <div class="card-body">
                                        <?php
                                        if(isset($_POST['tombol'])) {
                                            $username=$_POST['user'];
                                            $password=$_POST['password'];
                                            // echo "user: $username & pass: $password";

                                            //cek user tersebut ada atau tidak di tabel user
                                            $qc=mysqli_query($koneksi,"SELECT username,password FROM user WHERE username='$username'");
                                            $dc=mysqli_fetch_row($qc);

                                            if(!empty($dc[0])) $user_cek = $dc[0];
                                            
                                            if(!empty($user_cek)){
                                                //cek password
                                                $pass_cek=$dc[1];

                                                //verivikasi password
                                                if(password_verify($password,$pass_cek)){
                                                    //daftarkan session
                                                    session_start();
                                                    $_SESSION['user']=$username;
                                                    $_SESSION['pass']=$password;

                                                    //redirect ke dashboard page
                                                    echo "<script>window.location.replace('./login/index.php')</script>";
                                                }else{
                                                    echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                                            <button type= button class=btn-close data-bs-dismiss=alert></button>
                                                            <strong>Error!</strong> Login Salah.
                                                        </div>";
                                                }
                                            }
                                            else {
                                                echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                                            <button type= button class=btn-close data-bs-dismiss=alert></button>
                                                            <strong>Error!</strong> Username tidak ketemu.
                                                        </div>";
                                            }
                                        }
                                        ?>
                                        <form method="post" class="needs-validation">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUser" type="text" placeholder="Username" name="user" required/>
                                                <label for="inputUser">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" required/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <input type="submit" name="tombol" value="Login" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website <?php echo date("Y")?></div>
                            <div>
                                <a href="./profile/profile2.html">PROFILE</a>
                                &middot;
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
