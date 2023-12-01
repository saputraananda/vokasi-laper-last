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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Vokasi Laper</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />


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

#map {
            margin-top: 50px; /* Atur margin atas sesuai kebutuhan */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan shadow */
            border: 1px solid #FFBB00; /* Tambahkan warna border */
            border-radius: 10px; /* Atur lekukan sudut */
            overflow: hidden; /* Sembunyikan overflow jika diperlukan */
            width: 100%;
            height: 700px; /* Sesuaikan tinggi peta sesuai kebutuhan */
        }

         </style>

    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">Admin Vokasi Laper</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <button class="btn btn-warning mx-auto" id="btnFindLocation" type="button" onclick="findMyLocation()" style="margin-top: 1px; margin-bottom: 1px;"><i class="fas fa-map-marker-alt"></i>Lokasi Saya</button>

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
                                    <a class="nav-link" href="menu_categories.php">Kategori Menu</a>
                                    <a class="nav-link" href="makanan.php">Data Makanan</a>
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


        <div id="layoutSidenav_content">
            <main>
        <div id='map'></div>
            </main>
        </div>

        <script>
        var locations = [
            ["MEKDI (BOIKOT!)", -6.592201891524794, 106.8051222122348, "/absolute/path/to/image/mekdi.png"],
            ["KOSAN TIN DAN ZAITOT", -6.591975446239985, 106.80841450785722, "/absolute/path/to/image/mekdi.png"],
            ["Bakso Pa'de Jangkung Sancang Bogor", -6.590896494006148, 106.80652119208555, "/absolute/path/to/image/mekdi.png"],
            ["HAGU Coffee & Space", -6.591360113708131, 106.8080285935006, "/absolute/path/to/image/mekdi.png"],
            ["Warung Bapak Gila", -6.5918097, 106.8085942, "/absolute/path/to/image/mekdi.png"]
        ];

        var map = L.map('map').setView([-6.591619,106.8064164,17.71], 13);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink + ' Contributors',
                    maxZoom: 18,
            }).addTo(map);


        // Mengambil data dari server PHP
        fetch('../get_lokasi.php')
            .then(response => response.json())
            .then(data => {
              data.forEach(location => {
                var popupContent = '<strong>' + location.nama + '</strong><br><img src="' + location.url_gambar + '" width="200">';
                L.marker([location.latitude, location.longitude])
                    .bindPopup(popupContent)
                    .addTo(map);
            });
            })
            .catch(error => {
                console.error('Error:', error);
            });

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
            map.scrollWheelZoom.disable();
        }
    });
    </script>

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
                map.setView(currentLocation, 18); // Set the map view to the user's current location
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

// Function to update the marker on the map
function updateMarker(location) {
    // Remove existing marker if any
    if (redMarker) {
        map.removeLayer(redMarker);
    }

    // Create a red marker at the specified location
    redMarker = L.marker(location, { icon: redIcon }).addTo(map);
}

// Define a red icon for the marker
var redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41],
});

var redMarker; // Variable to store the red marker

// Rest of your existing code...

</script>

<script>
    initMap();
</script>   

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </body>
</html>