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



<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vokasilaper";

function getDataFromDatabase($conn) {
    $sql = "SELECT * FROM data_usaha";
    $result = mysqli_query($conn, $sql);

    $data = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    return $data;
}

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$data_usaha = getDataFromDatabase($conn);

mysqli_close($conn);
?>

<br>
<br>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><b>Data Usaha</b></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Usaha</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Usaha
                </div>
                <div class="card-body">
                <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>Nama Usaha</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Deskripsi Usaha</th>
                                <th>Action</th> <!-- Kolom baru untuk tombol delete -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_usaha as $data) : ?>
                                <tr>
                                    <td><?= $data['nama_usaha']; ?></td>
                                    <td><?= $data['email']; ?></td>
                                    <td><?= $data['nomor_telepon']; ?></td>
                                    <td><?= $data['deskripsi_usaha']; ?></td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="delete_id" value="<?= $data['id']; ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_button">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
// Bagian untuk menghapus data jika tombol delete ditekan
if (isset($_POST['delete_button'])) {
    $delete_id = $_POST['delete_id'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM data_usaha WHERE id = $delete_id";

    if (mysqli_query($conn, $sql)) {
        // Data berhasil dihapus
        echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "Data berhasil dihapus",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(function() {
                    window.location.href = "data_usaha.php";
                });
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
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
    </body>
</html>