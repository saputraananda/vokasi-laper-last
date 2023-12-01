<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        .card-header {
            background-color: #FFBB00; /* Ubah warna latar belakang card-header menjadi kuning */
            color: white; /* Ubah warna teks di card-header menjadi putih */
            }

            body {
                background-image: url('../image/gambarlogin.png'); /* Replace with the actual path to your image */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
    </style>
</head>
<body class="bg-white">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vokasilaper";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['inputFirstName'];
    $lastName = $_POST['inputLastName'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Berhasil
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat Anda Sudah Terdaftar',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'login.php';
        });
        </script>";
    } else {
        // Error
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'TWaduh Eror, Coba Lagi Yaa',
            html: '$error_message'
        });
        </script>";
    }
}

$conn->close();
?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7" style="margin-top: 8vh;">
                        <div class="card shadow-lg border-5 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4" style="color: black;"><b>DAFTAR SEKARANG</b></h3>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input name="inputFirstName" class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" required/>
                                                <label for="inputFirstName">First name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input name="inputLastName" class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" required />
                                                <label for="inputLastName">Last name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="inputEmail" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" required />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input name="inputPassword" class="form-control" id="inputPassword" type="password" placeholder="Create a password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input name="inputPasswordConfirm" class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" required/>
                                            <label for="inputPasswordConfirm">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>  
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-warning btn-block"><b>Buat Akun</b></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="login.php">Sudah Punya Akun? Login disini</a></div>
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
    // Mengambil elemen input password dan confirm password
    const password = document.getElementById('inputPassword');
    const confirmPassword = document.getElementById('inputPasswordConfirm');

    // Menambahkan event listener untuk periksa kesamaan saat input diubah
    confirmPassword.addEventListener('input', function() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Hmm..Gak Sama Nihh');
        } else {
            confirmPassword.setCustomValidity('');
        }
    });
</script>

</body>
</html>
