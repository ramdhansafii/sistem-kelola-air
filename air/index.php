<?php 
//koneksi ke database MariaDb
include './assets/func.php';
$air = new klas_air;
$koneksi = $air->koneksi();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Selamat Datang - Sistem Air</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #2a3a55, #1c2536);
      color: white;
      margin: 0;
      overflow-x: hidden;
    }

    header {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 2rem;
    }

    header h1 {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    header p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
    }

    .btn-custom {
      margin: 0.5rem;
      padding: 0.75rem 2rem;
      font-size: 1rem;
      border-radius: 30px;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .login-section {
      background: #ffffff;
      color: #333;
      padding: 4rem 1rem;
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .login-container {
      max-width: 450px;
      width: 100%;
      margin: 0 auto;
    }

    .card {
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      border: none;
    }

    .card-header {
      background: transparent;
      border-bottom: 1px solid rgba(0,0,0,0.1);
      padding: 1.5rem 2rem;
    }

    .card-body {
      padding: 2rem;
    }

    .profile-btn {
      background: transparent;
      color: white;
      border: 2px solid white;
    }

    .profile-btn:hover {
      background: white;
      color: #2a3a55;
    }

    .scroll-down {
      margin-top: 2rem;
      font-size: 2rem;
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(10px);
      }
    }
    
    .form-floating {
      margin-bottom: 1.5rem;
    }
    
    .form-control {
      height: 50px;
      border-radius: 8px;
      padding: 0 15px;
    }
    
    .btn-primary {
      padding: 10px 25px;
      border-radius: 8px;
      font-weight: 500;
    }
  </style>
</head>

<body>
  <header>
    <h1>Selamat Datang di Sistem Pengelolaan Air</h1>
    <p>Sistem untuk mencatat, mengelola, dan memonitor pemakaian air Anda.</p>
    <div>
      <a href="#loginForm" class="btn btn-light btn-custom">Login</a>
      <a href="./profile/profile2.html" class="btn profile-btn btn-custom">Profile</a>
    </div>
    <div class="scroll-down">
      <i class="fas fa-angle-down"></i>
    </div>
  </header>

  <section id="loginForm" class="login-section">
    <div class="login-container">
      <div class="card">
        <div class="card-header text-center">
          <h3 class="my-3">Login</h3>
        </div>
        <div class="card-body">
          <?php
          if (isset($_POST['tombol'])) {
            $username = $_POST['user'];
            $password = $_POST['password'];
            $qc = mysqli_query($koneksi, "SELECT username,password FROM user WHERE username='$username'");
            $dc = mysqli_fetch_row($qc);

            if (!empty($dc[0])) $user_cek = $dc[0];

            if (!empty($user_cek)) {
              $pass_cek = $dc[1];

              if (password_verify($password, $pass_cek)) {
                session_start();
                $_SESSION['user'] = $username;
                $_SESSION['pass'] = $password;
                echo "<script>window.location.replace('./login/index.php')</script>";
              } else {
                echo "<div class=\"alert alert-danger\">Login salah.</div>";
              }
            } else {
              echo "<div class=\"alert alert-danger\">Username tidak ditemukan.</div>";
            }
          }
          ?>
          <form method="post">
            <div class="form-floating">
              <input class="form-control" id="inputUser" type="text" placeholder="Username" name="user" required />
              <label for="inputUser">Username</label>
            </div>
            <div class="form-floating">
              <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" required />
              <label for="inputPassword">Password</label>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-4">
              <a class="small text-muted" href="#">Lupa password?</a>
              <input type="submit" name="tombol" value="Login" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>