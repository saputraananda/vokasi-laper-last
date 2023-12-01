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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

        <script>
        var map;
        var marker;

        // Fungsi untuk menginisialisasi peta dan menanggapi klik pada peta
        function initMap() {
            map = L.map('map').setView([-6.598064898834868, 106.79895499342264], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Nonaktifkan zoom peta selama scroll halaman
            map.scrollWheelZoom.disable();

            // Event listener untuk menanggapi klik pada peta
            map.on('click', function (event) {
                var clickedLocation = event.latlng; // Dapatkan lokasi klik
                updateMarker(clickedLocation); // Panggil fungsi untuk menambahkan marker
            });
        }

        // Fungsi untuk menambahkan atau memperbarui marker
        function updateMarker(location) {
            // Hapus marker yang ada (jika ada)
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker baru di lokasi yang diklik
            marker = L.marker(location, { draggable: true }).addTo(map);

            // Perbarui nilai latitude dan longitude di dalam form
            document.getElementById('latitude').value = location.lat;
            document.getElementById('longitude').value = location.lng;

            // Event listener untuk menanggapi drag pada marker
            marker.on('dragend', function (event) {
                // Perbarui nilai latitude dan longitude di dalam form setelah marker di-drag
                document.getElementById('latitude').value = marker.getLatLng().lat;
                document.getElementById('longitude').value = marker.getLatLng().lng;
            });
        }
    </script>
        <style>
    #layoutSidenav_content {
        padding-left: 250px; /* Adjust this based on your sidenav width */
    }

    @media (max-width: 768px) {
        #layoutSidenav_content {
            padding-left: 0;
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



    <!--FORM PENGISIAN DATA INPUT LOKASI-->
        <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><b>Input Lokasi</b></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Input Lokasi</li>
            </ol>

            <!--#MENAMPILKAN MAP (INPUT LOKASI)-->
            <div id="map" style="height: 500px; width: 1220px; border-radius: 15px; margin-top: 30px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); border: 2px solid #ffbb00;"></div>
            <button class="btn btn-warning mx-auto" id="btnFindLocation" type="button" onclick="findMyLocation()" style="margin-top: 10px; margin-bottom: 10px;"><i class="fas fa-map-marker-alt"></i> Find My Location</button>

            <div class="card mb-4">
                <div class="card-body">
                <form id="locationForm" method="post">
                <div class="mb-3">
                    <label for="locationName" class="form-label">Nama Usaha</label>
                    <input type="text" class="form-control" id="locationName" name="locationName" placeholder="Contoh : Warung Nasi Kabita"required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude_form" placeholder="Masukan Latitude Disini"required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude_form" placeholder="Masukan Longitude Disini"required>
                </div>
                <div class="mb-3">
                    <label for="imageUrl" class="form-label">URL Gambar (Defaultnya tersimpan di C:\xampp\htdocs\vokasilaper\image)</label>
                    <input type="text" class="form-control" id="imageUrl" name="imageUrl" placeholder="Tulis Dalam image/nama_file.jpg"required>
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
                </form>                
            </div>
        </div>
    </main>
</div>

<br>
<br>
<br>

        

      <!--KIRIM DATA LOKASI VIA PHP-->
      <?php
        $servername = "localhost";  // Ganti dengan nama host server Anda
        $username = "root";         // Ganti dengan nama pengguna database Anda
        $password = "";             // Ganti dengan kata sandi database Anda
        $dbname = "vokasilaper";    // Ganti dengan nama database Anda

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi ke database gagal: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $locationName = htmlspecialchars($_POST['locationName'] ?? '');
            $latitude = htmlspecialchars($_POST['latitude_form'] ?? '');
            $longitude = htmlspecialchars($_POST['longitude_form'] ?? '');
            $imageUrl = htmlspecialchars($_POST['imageUrl'] ?? '');

            // SQL untuk menyimpan data ke dalam tabel "lokasi"
            $sql = "INSERT INTO lokasi (nama, latitude, longitude, url_gambar) VALUES ('$locationName', '$latitude', '$longitude', '$imageUrl')";

            if ($conn->query($sql) === TRUE) {
                // Penyimpanan data berhasil
                $response = array('success' => true, 'message' => 'Lokasi berhasil ditambahkan.');
            } else {
                // Terjadi kesalahan saat menyimpan data
                $response = array('success' => false, 'message' => 'Gagal menambahkan lokasi: ' . $conn->error);
            }
        }

        // Tutup koneksi
        $conn->close();

// Tampilkan SweetAlert berdasarkan response
echo '<script>';
echo 'if (' . json_encode($response['success']) . ') {';
echo '  Swal.fire("Sukses", ' . json_encode($response['message']) . ', "success");';
echo '} else {';
echo '  Swal.fire("Error", ' . json_encode($response['message']) . ', "error");';
echo '}';
echo '</script>';
?>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <!--SCRIPT UNTUK RESPONSIVE SAAT TOGGLE DITEKAN-->
        <script>
            const toggleButton = document.getElementById('sidebarToggle');
            const content = document.getElementById('layoutSidenav_content');

            toggleButton.addEventListener('click', function() {
                const isOpen = document.body.classList.contains('sb-sidenav-toggled');

                if (isOpen) {
                    content.style.paddingLeft = '250px'; // Sesuaikan dengan lebar sidenav
                } else {
                    content.style.paddingLeft = '0';
                }
            });
        </script>

<script>
// Function to find the user's current location
function findMyLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                var currentLocation = L.latLng(position.coords.latitude, position.coords.longitude);
                map.setView(currentLocation, 15); // Set the map view to the user's current location
                updateMarker(currentLocation); // Update the marker on the map
            },
            function (error) {
                // Handle errors if location access is denied or unavailable
                console.error('Error getting location:', error.message);
                alert('Error getting location. Please make sure location access is allowed.');
            }
        );
    } else {
        // Browser doesn't support geolocation
        alert('Geolocation is not supported by your browser.');
    }
}
    // Tambahkan event listener untuk mengendalikan zoom hanya saat "Ctrl + scroll"
    map.scrollWheelZoom.disable();
    map.on('focus', function () {
        map.scrollWheelZoom.enable();
    });
    map.on('blur', function () {
        map.scrollWheelZoom.disable();
    });

    // Cek apakah tombol "Ctrl" ditekan saat scroll
    var isCtrlPressed = false;
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Control') {
            isCtrlPressed = true;
        }
    });
    document.addEventListener('keyup', function (e) {
        if (e.key === 'Control') {
            isCtrlPressed = false;
        }
    });

    // Tambahkan event listener untuk zoom hanya saat "Ctrl + scroll"
    map.on('wheel', function (e) {
        if (!isCtrlPressed) {
            e.originalEvent.preventDefault(); // Menghentikan aksi scroll bawaan browser
            map.scrollWheelZoom.disable();
        }
    });
</script>


<script>
    initMap();
</script>   

    </body>
</html>