<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Lokasi Makanan Vokasi</title>

    <!--Bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>   
    <script src="https://kit.fontawesome.com/711efb876c.js" crossorigin="anonymous"></script>
    <!-- Bootstrap and jQuery scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

    <!--Link To Css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="tambahan.css" />
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="about.css" />

    <style>
     .carousel-caption {
      text-align: center;
      position: absolute;
      bottom: 35%;
      
      }

      .carousel-caption h1 {
        white-space: nowrap; /* Menjaga teks dalam satu baris */
        font-size: 50px;
      }

      .card-promo .card-title {
      font-family: 'Poppins', sans-serif;
      font-weight: 900;
      
  }

.card-promo .card-content {
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
}

    .row {
      margin-bottom: 30px;
    }

    footer {
      margin-top: 20px;
    }


    /* Gaya untuk kartu dengan indeks genap */
.card-even {
  background: linear-gradient(-18deg, #FFBD09 12.5%, rgba(255, 187, 0, 0.63) 73.44%, rgba(255, 187, 0, 0.00) 100%);
}

/* Gaya untuk kartu dengan indeks ganjil */
.card-odd {
  background: linear-gradient(-18deg, #000 12.5%, rgba(0, 0, 0, 0.63) 73.44%, rgba(0, 0, 0, 0.00) 100%);
  color: white; /* Tambahkan baris ini untuk mengganti warna teks menjadi putih */
}

/* Gaya untuk teks pada judul kartu dengan indeks ganjil */
.card-odd .card-title{
  color: white;
}
          
    </style>

</head>

<body>
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

$conn->close();
?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-4 fixed-top" style="background-color: rgb(0, 0, 0);">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">
                <img src="header/Kesamping Putih.png" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                style="color: rgb(255, 221, 0);">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                    <path stroke="white" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10"
                        d="M4 7h22M4 15h22M4 23h22" />
                </svg>
            </button>

            <div class="collapse navbar-collapse order-lg-1" id="navMenu">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item px-2 py-2 home">
                        <a class="nav-link active" href="index.php" style="color: #ffbb00;">Home</a>
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
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link" href="about.php" style="color: white;">About</a>
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

<!--PROSES DAN READ CAROUSEL-->
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <?php
    // Kode PHP Anda untuk mengambil data dari database
    $servername = "localhost";  // Ganti dengan nama host server Anda
    $username = "root";         // Ganti dengan nama pengguna database Anda
    $password = "";             // Ganti dengan kata sandi database Anda
    $dbname = "vokasilaper";    // Ganti dengan nama database Anda

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM carousel_content";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">';
        echo '<div class="carousel-inner">';

        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $active = ($index === 0) ? 'active' : '';

            echo '<div class="carousel-item ' . $active . '" data-bs-interval="' . $row['interval_time'] . '">';
            echo '<img src="' . $row['image_path'] . '" class="d-block w-100" alt="Your Image">';
            echo '<div class="carousel-caption">';
            echo '<h1><b>' . $row['title'] . '</b></h1>';
            echo '<p>' . $row['description'] . '</p>';
            echo '</div>';
            echo '</div>';
            
            $index++;
        }

        echo '</div>';
        echo '</div>';
    } else {
        echo "";
    }

    $conn->close();
    ?>

  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<br>

<!--PROSES DAN READ MENU HARI INI-->
<div class="container">
        <h2 class="gyn">Menu Senin Untuk Kamu</h2>
        <ul class="cards">
        <?php
        // db_config.php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vokasilaper";

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Eksekusi query untuk mendapatkan data dari tabel t_days
        $sql = "SELECT * FROM t_days";
        $result = $conn->query($sql);

        // Menutup koneksi (tidak perlu menutup koneksi sebelum menampilkan hasil)
        // $conn->close();
           
            // Loop through the results and generate HTML for each menu item
            $index = 0;
            while ($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $description = $row["description"];
                $price_range = $row["price_range"];
                
                
                // Pemeriksaan apakah kolom 'image_path' tersedia
                $image_path = isset($row["image_path"]) ? $row["image_path"] : 'path_default_image.jpg';

                $card_color = isset($row["card_color"]) ? $row["card_color"] : 'black';  // Nilai default atau logika default yang sesuai
                $card_class = ($card_color === "black") ? 'card-promo card-promo-black' : 'card-promo card-promo-yellow';

                // Menambahkan indeks untuk selang-seling warna kartu
                $card_class .= ($index % 2 === 0) ? ' card-even' : ' card-odd';

                echo "<li class='$card_class'>";
                echo '<div>';
                echo "<h3 class='card-title'>$title</h3>";

                // Menambahkan deskripsi
                echo '<div class="card-content">';
                echo "<p>$description</p>";
                echo '</div>';

                echo '<div class="card-content">';
                echo "<p>$price_range</p>";
                echo '</div>';  
                echo '</div>';
                echo '<div class="card-img-wrapper">';
                echo "<img src='$image_path' alt='$title Image'>";
                echo '</div>';
                echo '</li>';

                $index++;
            }

            $conn->close();
            ?>
        </ul>
    </div>
<br>

<!--PROSES DAN READ PEDAGANG TERPERCAYA-->
<div class="container">
    <h2 class="gyn">Pedagang Terpercaya</h2> <br>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vokasilaper";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query SQL untuk mengambil data dari tabel t_mitra
        $sql = "SELECT * FROM t_mitra";
        $result = $conn->query($sql);

        // Cek apakah query berhasil
        if ($result->num_rows > 0) {
            // Loop through each row to display data
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col">
                    <div class="card h-100">
                        <img src="' . $row['gambar_path'] . '" class="card-img-top" alt="' . $row['nama'] . '" height="200">
                        <div class="card-body">
                            <h5 class="card-title"><b>' . $row['nama'] . '</b></h5>
                            <p class="card-text">' . $row['lokasi'] . '</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "Tidak ada data data pedagang/ mitra.";
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </div>
</div>

<!--FOOTER-->
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

