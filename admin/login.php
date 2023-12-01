<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Vokasi Laper</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- your other meta tags and links -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- Change the reference here to the specific Poppins font weight you want -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        <!-- your styles -->


        <style>

            

            body {
                background-image: url('../image/gambarlogin.png'); /* Replace with the actual path to your image */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

           

            .google-icon {
            color: #4285F4; /* Warna biru Google */
            }

            .facebook-icon {
            color: #3b5998; /* Warna biru Facebook */
            }


            .card-header {
            background-color: #FFBB00; /* Ubah warna latar belakang card-header menjadi kuning */
            color: white; /* Ubah warna teks di card-header menjadi putih */
            }

            .form-floating {
            position: relative;
            }

            .form-control {
            padding-right: 40px; /* Menyesuaikan padding kanan untuk ikon */
            }

            .password-toggle {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 30px; /* Menyesuaikan posisi horizontal ikon */
                cursor: pointer;
            }

            .card-header h3 {
             font-family: 'Poppins', sans-serif;
            font-weight: 550;
            }

            .card {
        border-color: #FFBB00 !important;
        border-width: 0px;
    }

        </style>

    </head>

    <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vokasilaper";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['inputEmail'];
            $password = $_POST['inputPassword'];
        
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = $conn->query($sql);
        
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
        
                // Check user's role
                if ($user['role'] == 'admin') {
                    $_SESSION['loggedInUser'] = $user['first_name']; // Simpan dalam session
                    echo "<script>
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Selamat Datang Admin!',
                                text: 'Login berhasil',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                window.location = 'dashboard_admin.php';
                            });
                        }, 100);
                    </script>";
                    exit;
                } else {
                    $_SESSION['loggedInUser'] = $user['first_name']; // Simpan dalam session
                    echo "<script>
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Selamat Datang Voks!',
                                text: 'Login berhasil',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                window.location = '../index.php';
                            });
                        }, 100);
                    </script>";
                    exit;
                }
            } else {
                $error = "Ada yang salah, coba lagi.";
            }
        }
        
        
        $conn->close();
        ?>
        


    <body class="bg-white">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 mx-auto" style="margin-top: 8vh;">    
                                <div class="card shadow-lg border-5 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color: black"><b>LOGIN</b></h3></div>
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                    <form style="width: 100%;" method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email </label>
                                        </div>
                                        <div class="form-floating mb-3" style="position: relative;">
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                            <span class="password-toggle" onclick="togglePassword()">
                                                <i class="fas fa-eye" id="togglePassword"></i>
                                            </span>
                                        </div>                                            
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Lupa Pasword?</a>
                                            <button class="btn btn-warning" type="submit"><b>Login</b></button>
                                        </div>
                                        <div class="text-center mt-3"> <!-- Ini adalah div baru untuk tombol login via Google dan Facebook -->
                                            <p>Atau login melalui:</p>
                                            <button class="btn btn-light mb-2">
                                                <i class="fab fa-google google-icon"></i>
                                            </button>
                                            <button class="btn btn-light mb-2">
                                                <i class="fab fa-facebook facebook-icon"></i>
                                            </button>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Belum Punya Akun? Daftar Disini</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            function togglePassword() {
                var passwordField = document.getElementById("inputPassword");
                var toggleIcon = document.getElementById("togglePassword");
                
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = "password";
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
        </script>

<script>
    <?php if (isset($error)) : ?>
        Swal.fire({
            title: "Waduh!",
            text: "<?php echo $error; ?>",
            icon: "error",
            button: "Oke",
        });
    <?php endif; ?>
</script>
        
    </body>
</html>
