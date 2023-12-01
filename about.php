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

$loggedInUser = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : null;

// Logika logout
if (isset($_GET['logout'])) {
    // Hapus semua data sesi
    session_unset();

    // Hancurkan sesi
    session_destroy();

    // Redirect ke halaman index.php setelah logout
    header("Location: index.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Lokasi Makanan Vokasi</title>

    <!--Bootstrap5 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>   
    <script src="https://kit.fontawesome.com/711efb876c.js" crossorigin="anonymous"></script>

    <!-- Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
     
    <!--Link To Css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="tambahan.css" />
    <link rel="stylesheet" href="about.css" />

    <script>
    $(document).ready(function () {
        $('form').submit(function (e) {
            e.preventDefault();

            // Ambil data dari formulir HTML
            var nama_usaha = $("input[name='nama_usaha']").val();
            var email = $("input[name='email']").val();
            var nomor_telepon = $("input[name='nomor_telepon']").val();
            var deskripsi_usaha = $("input[name='deskripsi_usaha']").val();

            // Masukkan data ke dalam database
            $.ajax({
                type: 'POST',
                url: '',
                data: {
                    nama_usaha: nama_usaha,
                    email: email,
                    nomor_telepon: nomor_telepon,
                    deskripsi_usaha: deskripsi_usaha
                },
                success: function (response) {
                    // Data berhasil disimpan ke dalam database
                    Swal.fire({
                        title: "Sukses!",
                        text: "Data Berhasil Dikirim, Ditunggu Yaa!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(function () {
                        // Redirect to a specific page after success
                        window.location.href = "";
                    });
                },
                error: function (error) {
                    // Error handling for database interaction
                    Swal.fire({
                        title: "Error!",
                        text: "Gagal menyimpan data ke database",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    });
</script>


    <style>
      /* Style the contact section container */
.contact_section {
  background-color: #f7f7f7;
  padding: 50px 0;
}

/* Style the heading container */
.heading_container {
  text-align: center;
  margin-bottom: -30px;
}

.heading_container h2 {
  font-size: 32px;
  margin-bottom: 20px;
  color: #333;
}

.heading_container h5 {
  font-size: 20px;
  padding-bottom: 30px;
  color: #333;
}

/* Style the icon image */
.heading_container img {
  width: 40px;
  height: 40px;
}

/* Style the form container */
.contact_section form {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 5px #ffbb00;
}

.contact_section input[type="text"],
.contact_section input[type="email"] {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  outline: none;
}

.contact_section .message-box {
  height: 120px;
  resize: none;
}

.contact_section button {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.contact_section button:hover {
  background-color: #0056b3;
}

/* Style the map container */
.map_container {
  margin-top: 20px;
}

.map-responsive {
  overflow: hidden;
  padding-bottom: 56.25%;
  position: relative;
  height: 0;
}

.map-responsive iframe {
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  position: absolute;
}

/* Add media queries for responsiveness */
@media (max-width: 768px) {
  .contact_section {
    padding: 30px 0;
  }

  .contact_section .col-md-6 {
    text-align: center;
  }

  .contact_section form {
    margin: 0 auto;
  }

  .map-responsive {
    margin-top: 20px;
  }
}

.daftar, .penjelasan {
  font-family: 'Poppins', sans-serif;
  font-weight: normal; /* atau font-weight: 400; */
}

 /* Style the container */
 .featurette {
    margin-top: 30px;
    padding: 20px;
    background-color: #f8f9fa;
    border: 1px solid #d6d6d6;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
  }

  /* Style the image */
  .foto-penjelasan-home {
    max-width: 100%;
    height: auto;
    margin-left: 150px;
    border-radius: 20px;
    border: 3.5px solid #ffbb00;
    transition: transform 0.2s
  }

  .foto-penjelasan-home:hover {
  background-color: #ffbb00;
  transform: scale(1.1); /* Anda dapat menyesuaikan nilai scale sesuai keinginan */
  border: 3.5px solid #ffbb00; /* Menambahkan border kuning saat dihover */
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
}


  /* Style the text content */
  .featurette-heading {
    font-size: 24px;
    font-weight: bold;
    color: black;
    margin-bottom: 10px;
  }

  .text-muted {
    color: #777;
  }

  .lead {
    font-size: 18px;
    line-height: 1.4;
  }

  .awalmula {
    margin-top: 100px;
    padding-left: 80px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
  }

  .heading_container h2 {
    margin-bottom: 10px;
  }

  .heading_container h5 {
    margin-bottom: 20px;
  }

</style>
    
</head>

<body>
    <!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light py-4 fixed-top" style="background-color: rgb(0, 0, 0);">
  <div class="container">
    <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">
      <img src="header/Kesamping Putih.png" alt="Logo"> <!-- Gantilah "path_to_your_logo.png" dengan path gambar logo Anda -->
    </a>
    
  
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" style="color: rgb(255, 221, 0);">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
        <path stroke="white" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22" />
      </svg>
    </button>
  
      <div class="collapse navbar-collapse order-lg-1" id="navMenu">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item px-2 py-2 home">
                    <a class="nav-link" href="index.php" style="color: white;">Home</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link" href="tracking.php" style="color: white;">Tracking</a>
                </li>
                <li class="nav-item px-2 py-2">
                <?php
                if ($loggedInUser) {
                    // Jika sudah login, redirect ke admin/planfood.php
                    echo '<a class="nav-link" href="planfood.php" style="color: white;">PlanFood</a>';
                } else {
                    // Jika belum login, tautan tetap menuju admin/login.php
                    echo '<a class="nav-link" href="admin/login.php" style="color: white;">PlanFood</a>';
                }
                ?>
                </li>
                <li class="nav-item px-2 py-2 ">
                    <a class="nav-link active" href="about.php" style="color: #ffbb00;">About</a>
                </li>
                <li class="nav-item px-2 py-2 ml-2">
                        <?php if ($loggedInUser) { ?>
                            <a class="nav-link login-btn-1" href="" style="color: white;">
                                <i class="fas fa-user"></i> <?php echo $loggedInUser; ?>
                            </a>
                        <?php } else { ?>
                            <a class="nav-link login-btn-1" href="admin/login.php" style="color: white;">
                                <i class="fas fa-user"></i> Login
                            </a>
                        <?php } ?>
                    </li>
                    <li class="nav-item px-2 py-2 ml-2">
                      <?php if ($loggedInUser) { ?>
                          <a class="nav-link login-btn-2" href="?logout" style="color: black;">
                              <i class="fas fa-sign-out-alt"></i> Log Out
                          </a>
                      <?php } else { ?>
                          <a class="nav-link login-btn-2" href="admin/register.php" style="color: black;">
                              <i class="fas fa-plus"></i> Sign Up
                          </a>
                      <?php } ?>
                  </li>
            </ul>
        </div>
    </div>
  </nav>
  <!-- end of navbar -->

  <img src="image/Banner About Us.png" class="img-fluid" alt="Responsive image" >

<br>
<br>
<br>

<div class="row mandi">
  <div class="col-md-7 order-md-2 awalmula">
    <h2 class="featurette-heading fw-normal lh-1"><b>Awal Mula Vokasi Laper</b></h2>
    <p class="lead">Vokasi Laper adalah sebuah website informasi kuliner yang dirancang khusus untuk memenuhi kebutuhan kuliner mahasiswa Sekolah Vokasi IPB. Website ini memiliki dua fitur utama yang dirancang dengan cermat untuk memberikan manfaat maksimal bagi mahasiswa, yaitu Kuliner Tracking dan rencana makan atau Planfood</p>
  </div>
  <div class="col-md-5 order-md-1" style="text-align: center; display: flex; align-items: center; justify-content: center;">
    <img class="foto-penjelasan-home" width="500" height="500" src="image/vokasi.jpg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
  </div>
</div>

<br>
<br>
<br>
<br>



<!-- service section -->
<section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          <b>Kenapa Bisa Kepikiran Vokasi Laper?<b>
        </h2>
        <h5>Kami Sebagai Mahasiswa Memahami dan Merasakan</h5>
      </div>

      <div class="service_container">
        <div class="box">
          <div class="img-box">
            <img src="image/lapar.png" class="img1" alt="">
          </div>
          <div class="detail-box">
            <h1>
              2033
            </h1>
            <p>
              Mahasiswa SV Kelaparan
            </p>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="image/makan.png" class="img1" alt="">
          </div>
          <div class="detail-box">
            <h1>
              50
            </h1>
            <p>
              Tempat Makan Murah
            </p>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="image/lokasi.png" class="img1" alt="">
          </div>
          <div class="detail-box">
            <h1>
              100
            </h1>
            <p>
              Jangkauan Lokasi Murah
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end service section --> 
  
  <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="4" aria-label="Slide 5"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="5" aria-label="Slide 6"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="4000">
      <img src="image/TEAM VOKASI LAPER.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="4000">
      <img src="image/Farhan.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="4000">
      <img src="image/Hapis.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="4000">
      <img src="image/Iswi.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="4000">
      <img src="image/Maryetha.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="4000">
      <img src="image/Putra.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



   <!-- contact section -->

   <?php
// Informasi koneksi database
$servername = "localhost";  // Ganti dengan nama server database Anda
$username = "root";      // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$dbname = "vokasilaper";     // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memproses data formulir jika formulir dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai dari formulir
    $nama_usaha = $_POST["nama_usaha"];
    $email = $_POST["email"];
    $nomor_telepon = $_POST["nomor_telepon"];
    $deskripsi_usaha = $_POST["deskripsi_usaha"];

    // Menggunakan parameterized query untuk mencegah SQL injection
    $sql = "INSERT INTO data_usaha (nama_usaha, email, nomor_telepon, deskripsi_usaha) VALUES (?, ?, ?, ?)";

    // Mempersiapkan dan mengeksekusi statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nama_usaha, $email, $nomor_telepon, $deskripsi_usaha);
    $stmt->execute();

    // Menutup statement
    $stmt->close();

    // Anda dapat menambahkan logika tambahan di sini, seperti pesan sukses atau pengalihan ke halaman lain
}

// Tutup koneksi saat selesai
$conn->close();
?>


 <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container">
        <h2>
          <strong>Ingin Mendaftarkan Lokasi Usahamu?<strong>
        </h2>
        <h5>Hubungi Kami yaa!</h5>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
        <form method="post" action="">
          <div>
      <input type="text" name="nama_usaha" placeholder="Nama Usaha (Contoh : Warung Nasi Vokasi)" required/>
          </div>
          <div>
            <input type="email" name="email" placeholder="Email" required/>
          </div>
          <div>
            <input type="text" name="nomor_telepon" placeholder="Nomor Telepon"required />
          </div>
          <div>
            <input type="text" name="deskripsi_usaha" class="message-box" placeholder="Deskripsi Usaha (Contoh : Cafe, Resto, Kaki Lima, dll)"required />
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
             Kirim
            </button>
          </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="map_container">
            <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.462867798817!2d106.80353987484062!3d-6.589245164412673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5d2e602b501%3A0x25a12f0f97fac4ee!2sSchool%20of%20Vocational%20Studies%20-%20IPB%20University!5e0!3m2!1sen!2sid!4v1699319817104!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->
  <br>
  <br>
  <br>
  <br>

  


  <footer class="bg-dark py-5 ">
        <div class="container mx-6 penjelasan">
          <div class="row text-white g-7">
            <div class="col-md-6 col-lg-3">
              <h5 class="text-uppercase text-decoration-none brand text-white" href="index.html"><b>Vokasi<span style="color: rgb(255, 187, 0);"> Laper</span></b></h5>
              <p class="text-white text-muted mt-3">Vokasi Laper merupakan portal informasi makanan untuk mahasiswa Sekolah Vokasi IPB</p>
            </div>
            
            
            <div class="col-md-6 col-lg-3 daftar">
              <h5 class="text-uppercase text-decoration-none brand text-white"><b>Daftar <span style="color: rgb(255, 187, 0);">Menu</span></b></h5>
              <ul class="list-unstyled">
                <li class="my-3">
                  <a href="index.html" class="text-white text-decoration-none text-muted">
                    <i class="fas fa-chevron-right me-1"></i> Home
                  </a>
                </li>
                <li class="my-3">
                  <a href="tracking.html" class="text-white text-decoration-none text-muted">
                    <i class="fas fa-chevron-right me-1"></i> Tracking
                  </a>
                </li>
                <li class="my-3">
                  <a href="planfood.html" class="text-white text-decoration-none text-muted">
                    <i class="fas fa-chevron-right me-1"></i> Planfood
                  </a>
                </li>
                <li class="my-3">
                  <a href="about.html" class="text-white text-decoration-none text-muted">
                    <i class="fas fa-chevron-right me-1"></i> About Us
                  </a>
                </li>
              </ul>
            </div>
        
      
            <div class="col-md-6 col-lg-3 kunjungi">
              <h5 class="text-uppercase text-decoration-none brand text-white"><b>Kunjungi <span style="color: rgb(255, 187, 0);">Kami</span></b></h5>
              <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                <span class="me-3">
                  <i class="fas fa-map-marked-alt"></i>
                </span>
                <span class="fw-light">
                  Sekolah Vokasi Cilibende
                </span>
              </div>
              <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                <span class="me-3">
                  <i class="fas fa-envelope"></i>
                </span>
                <span class="fw-light">
                  vokasilaper@gmail.com
                </span>
              </div>
              <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                <span class="me-3">
                  <i class="fas fa-phone-alt"></i>
                </span>
                <span class="fw-light">
                  +62 821-1177-8193
                </span>
              </div>
            </div>
      
            <div class="col-md-6 col-lg-3 media">
              <h5 class="text-uppercase text-decoration-none brand text-white"><b>Media <span style="color: rgb(255, 187, 0);">Sosial</span></b></h5>
              <div>
                <ul class="list-unstyled d-flex">
                  <li>
                    <a href="https://www.instagram.com/flab.id/" class="text-white text-decoration-none text-muted fs-4 me-4">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  </li>
                  <li>
                    <a href="mailto:alamatemailanda@example.com" class="text-white text-decoration-none text-muted fs-4 me-4">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </li>                  
                  <li>
                    <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>

</body>
</html>