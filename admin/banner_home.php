<!--INI UNTUK KONEKSI DAN FUNGSI MENGENALI SIAPA USER-->
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

if (isset($_SESSION['loggedInUser'])) {
$loggedInUser = $_SESSION['loggedInUser'];
} else {
$loggedInUser = null;
}
$conn->close();
?>
<!--SELESAI-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Vokasi Laper</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>

#layoutSidenav_content {
        transition: all 0.3s;
    }

    #layoutSidenav_content {
        padding-left: 250px; /* Adjust this based on your sidenav width */
    }

    @media (max-width: 768px) {
        #layoutSidenav_content {
            padding-left: 0;
        }

        #deleteCarouselForm select {
            width: 100%;
        }
    }

    /* Media query untuk layar yang lebih kecil */
@media (max-width: 768px) {
    #layoutSidenav_content {
        padding-left: 0;
    }

    #deleteCarouselFormContainer.move-left {
        margin-left: 0;
    }

    #deleteCarouselForm select {
        width: 100%;
    }
}

    .navbar-brand {
            color: #FFBB00;
        }

        #layoutSidenav .sb-sidenav a.nav-link:hover {
            color: #FFBB00; 
        }

        #btnNavbarSearch {
        background-color: #FFBB00; 
        border: none; 
        }

        #btnNavbarSearch:hover {
            background-color: grey; 
            border: none; 
        }

        .user-info {
    display: flex;
    align-items: center;
    font-size: 16px;
}

.user-greeting {
    color: #FFBB00;
    font-weight: bold;
    margin-left: 8px;
}

.user-icon {
    font-size: 20px;
    margin-left: 14px;
}

.move-left {
        margin-left: -50%; /* Adjust the value as needed */
        transition: margin-left 0.5s ease; /* Add a smooth transition effect */
    }

/* Media query untuk layar yang lebih kecil */
@media (max-width: 768px) {
    .navbar-nav {
        flex-direction: column;
        align-items: center;
    }

    .user-info {
        margin-top: 20px;
        margin-right: 20px;
    }

    .user-greeting {
        font-size: 14px;
    }

    .user-icon {
        font-size: 18px;
    }
}
</style>

    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard_admin.php">Admin Vokasi Laper</a>
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
                        <li><a class="dropdown-item" href="login.php">Logout</a></li>
                    </ul>
                </li>
                <li class="user-info">
                    <?php if(isset($loggedInUser)) : ?>
                        <span class="user-greeting">Welcome, <?php echo $loggedInUser; ?>!</span>
                    <?php else : ?>
                        <span class="user-greeting">Welcome, Guest!</span>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                 <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    
                    <!--Bagian Dashboard-->
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Halaman Utama</div>
                            <a class="nav-link" href="dashboard_admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                           <!-- Bagian Home -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsHome" aria-expanded="false" aria-controls="collapseLayoutsHome">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Home
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsHome" aria-labelledby="headingHome" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="banner_home.php">Banner Home</a>
                                    <a class="nav-link" href="menu_harian.php">Menu Hari Ini</a>
                                    <a class="nav-link" href="pedagang_terpercaya.php">Input Pedagang</a>
                                    <a class="nav-link" href="hapus_pedagang.php">Hapus Pedagang</a>
                                    <a class="nav-link" href="update_pedagang.php">Update Pedagang</a>

                                </nav>
                            </div>

                            <!-- Bagian Tracking -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsTracking" aria-expanded="false" aria-controls="collapseLayoutsTracking">
                                <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                                Tracking
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsTracking" aria-labelledby="headingTracking" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="input_lokasi.php">Input Lokasi</a>
                                    <a class="nav-link" href="delete_lokasi.php">Delete Lokasi</a>
                                    <a class="nav-link" href="update_lokasi.php">Update Lokasi</a>
                                </nav>
                            </div>

                            <!-- Bagian Planfood -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsPlanfood" aria-expanded="false" aria-controls="collapseLayoutsPlanfood">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                                Planfood
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsPlanfood" aria-labelledby="headingPlanfood" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">Kosong 1</a>
                                    <a class="nav-link" href="">Kosong 2</a>
                                    <a class="nav-link" href="">Kosong 3</a>
                                </nav>
                            </div>

                            <!-- Bagian About -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsAbout" aria-expanded="false" aria-controls="collapseLayoutsAbout">
                                <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                                About
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsAbout" aria-labelledby="headingAbout" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="data_usaha.php">Data Usaha</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                 </nav>
            </div>
        </div>
                          
<br>
<br>

    <!--FORM PENGISIAN DATA INPUT BANNER CAROUSEL-->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><b>Input Banner Home</b></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Banner Home</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="mb-3">
                                    <label for="image_path" class="form-label">Url Gambar : Defaultnya tersimpan di C:\xampp\htdocs\vokasilaper\image (6400 x 2200)</label>
                                    <input type="text" class="form-control" id="image_path" name="image_path" placeholder="Tulis Dalam Image/nama_gambar.jpg">
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Tulis Judul Yang Akan Ditampilkan">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Sub Judul (Deskripsi Singkat)</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Tulis Deskripsi Singkat Dari Judul Diatas"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="interval_time" class="form-label">Waktu Bergeser  (1000s = 1 Sekon)</label>
                                    <input type="number" class="form-control" id="interval_time" name="interval_time" placeholder="Isi Dalam Ribuan">
                                </div>

                                <button type="submit" class="btn btn-warning" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                
       <!-- Formulir untuk Hapus Carousel -->
        <div class="container-fluid px-4">
            <h1 class="mt-4"><b>Hapus Banner Home</b></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Banner Home</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body" id="deleteCarouselFormContainer">
                    <form id="deleteCarouselForm" method="post">
                        <div class="form-group">
                            <label for="carouselToDelete">Pilih Carousel yang Ingin Dihapus:</label>
                            <select class="form-control" name="carouselToDelete" required>
                                <?php
                                // Koneksi ke database (sesuaikan dengan konfigurasi database Anda)
                                $db = new mysqli("localhost", "root", "", "vokasilaper");

                                // Periksa koneksi
                                if ($db->connect_error) {
                                    die("Koneksi database gagal: " . $db->connect_error);
                                }

                                // Query database untuk mendapatkan daftar carousel yang tersimpan
                                $query = "SELECT id, title FROM carousel_content";
                                $result = $db->query($query);

                                // Loop melalui daftar carousel dan tampilkan sebagai opsi
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                    }
                                }

                                // Tutup koneksi database
                                $db->close();
                                ?>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-danger" id="deleteButton">Hapus Carousel</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>







      <!-- (CREATE) KIRIM DATA BANNER VIA PHP-->
      <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required form fields are set and not empty
    if (
        isset($_POST['image_path']) && !empty($_POST['image_path']) &&
        isset($_POST['title']) && !empty($_POST['title']) &&
        isset($_POST['description']) && !empty($_POST['description']) &&
        isset($_POST['interval_time']) && !empty($_POST['interval_time'])
    ) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vokasilaper";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Escape and retrieve form data
        $image_path = mysqli_real_escape_string($conn, $_POST['image_path']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $interval_time = mysqli_real_escape_string($conn, $_POST['interval_time']);

        // Check if any of the required fields are empty
        if (empty($image_path) || empty($title) || empty($description) || empty($interval_time)) {
            echo "Error: One or more required fields are empty.";
        } else {
            $sql = "INSERT INTO carousel_content (image_path, title, description, interval_time)
                    VALUES ('$image_path', '$title', '$description', '$interval_time')";

            if ($conn->query($sql) === TRUE) {
                // Using SweetAlert for success notification
                echo "
                <script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil ditambahkan ke carousel.',
                        icon: 'success'
                    }).then(function() {
                        // Redirect or perform additional actions if needed
                    });
                </script>";
            } else {
                // Using SweetAlert for error notification
                echo "
                <script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Error: " . $sql . "<br>" . $conn->error . "',
                        icon: 'error'
                    });
                </script>";
            }
        }

        $conn->close();
    }
}
?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <!--SCRIPT UNTUK RESPONSIVE SAAT TOGGLE DITEKAN-->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('sidebarToggle');
        const content = document.getElementById('layoutSidenav_content');
        const selectElement = document.querySelector('#deleteCarouselForm select');
        const formContainer = document.getElementById('deleteCarouselFormContainer');

        toggleButton.addEventListener('click', function () {
            const isOpen = document.body.classList.contains('sb-sidenav-toggled');

            if (isOpen) {
                content.style.paddingLeft = '250px';
                // Adjust the width of the select element when the sidebar is toggled
                selectElement.style.width = '100%'; // Set width to 100% for responsiveness
            } else {
                content.style.paddingLeft = '0';
                // Reset the width of the select element when the sidebar is not toggled
                selectElement.style.width = '100%';
            }
        });

        // Get the toggle button element    
        const deleteButton = document.getElementById('deleteButton'); // Ganti dengan ID yang sesuai

        // Add a click event listener to the toggle button
        deleteButton.addEventListener('click', function () {
            // Toggle the 'move-left' class on the form container
            formContainer.classList.toggle('move-left');
        });
    });
</script>


<!--FUNGSI HAPUS CAROUSEL-->
<script>
    <?php
    // Periksa apakah formulir telah dikirimkan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pastikan ID carousel yang akan dihapus tersedia
        if (isset($_POST["carouselToDelete"])) {
            $carouselId = $_POST["carouselToDelete"];

            // Koneksi ke database (sesuaikan dengan konfigurasi database Anda)
            $db = new mysqli("localhost", "root", "", "vokasilaper");

            // Periksa koneksi
            if ($db->connect_error) {
                die("Koneksi database gagal: " . $db->connect_error);
            }

            // Query database untuk menghapus carousel berdasarkan ID
            $query = "DELETE FROM carousel_content WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $carouselId);

            if ($stmt->execute()) {
                // Menggunakan SweetAlert untuk memberi notifikasi
                echo "Swal.fire({
                    title: 'Sukses',
                    text: 'Carousel berhasil dihapus',
                    icon: 'success'
                }).then(function() {
                    setTimeout(function() {
                        window.location = 'banner_home.php'; // Ganti dengan halaman tujuan setelah menghapus
                    }, 500); // Sesuaikan penundaan jika diperlukan
                });";
            } else {
                // Menggunakan SweetAlert untuk memberi notifikasi
                echo "Swal.fire({
                    title: 'Gagal',
                    text: 'Gagal menghapus carousel: " . $stmt->error . "',
                    icon: 'error'
                });";
            }

            // Tutup koneksi database
            $stmt->close();
            $db->close();
        } 
    }
    ?>
</script>

<br>
<br>

    </body>
</html>