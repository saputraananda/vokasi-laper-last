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
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    

    <!--Link To Css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="tambahan.css" /> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    
    <!--Style dari MAP-->
    <style>
        #map {
            width: 100%;
            height: 650px; 
        }        


/*SEARCH AND RESET BUTTON*/

.search-box input {
  padding: 2px;
  color: black;
  font-weight: bold;
  font-family: 'Poppins', sans-serif; 
}

.search-box button {
  background-color: none; /* Warna latar belakang */
  border: none; /* Garis tepi */
  margin-left: 5px; /* Jarak dari tombol pencarian */
  cursor: pointer;
  padding: 5px 10px;
  border-radius: 3px; /* Sudut bulatan */
}

.search-box button:hover {
  background-color: #ffbb00; /* Warna latar belakang saat dihover */
  color:black; /* Warna teks saat dihover */
}

.search-box button i {
  color: #black; /* Warna ikon */
}

.search-box button:hover i {
  color: black; /* Warna ikon saat dihover */
}


.location-button {
    background-color: #ffbb00; 
    color: black; 
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    margin-left: 5px;
}


.location-button i {
    font-size: 18px; 
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
                    <path stroke="white" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10"d="M4 7h22M4 15h22M4 23h22" />
                </svg>
            </button>

            <div class="collapse navbar-collapse order-lg-1" id="navMenu">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item px-2 py-2 home">
                        <a class="nav-link active" href="index.php" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link" href="tracking.php" style="color: #ffbb00;">Tracking</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                    <?php
                          // Logika Jika sudah/ belum login
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

    <!--Menampilkan Banner Tracking-->
<img src="image/Banner Tracking.png" class="img-fluid" alt="Responsive image" >
  
<!--Search box yang didalamnya berisi inputan, search button, reset-button, dan findMyLocation-->
<div class="search-box">
    <input type="text" id="searchInput" placeholder="Telusuri Warung/Restaurant" style="color: black; font-weight: bold;" onkeydown="handleKeyPress(event)">
    <button onclick="search()"><i class="fas fa-search"></i></button>
    <button onclick="resetMarkers()" class="reset-button"><i class="fas fa-undo-alt"></i></button>
    <button onclick="findMyLocation()" class="location-button"><i class="fas fa-location-arrow"></i></button>
</div>

<!--Menampilkan MAP yang ada di library leaflet-->
<div id='map'></div>

<!--Longkap dikit gak ngaruh-->
<br>
<br>

    <!--Footer-->
    <footer class="bg-dark py-5">
        <div class="container mx-6">
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

      <!--Script untuk menampilkan Map,redMarker(lokasi terkini), dan radius 100 meter-->
      <script>
      // Deklarasi Variabel map,redMarker, dan circleradius
      var map;
      var redMarker;
      var circleRadius;

      // Fungsi mencari lokasi user terkini (jangan lupa aktifkan GPS di perangkat!)
      function findMyLocation() {
          if (navigator.geolocation) { // navigator geolocation adalah JavaScript API untuk mencari lokasi terkini di browser
              var options = {
                  timeout: 5000, //batas waktu 5 detik
                  maximumAge: 0 // tidak boleh ambil dari cache (harus update request)
              };
              
              // Jika proses diatas berhasil, maka lanjut ke proses dibawah ini, mulai mencari lokasi
              navigator.geolocation.getCurrentPosition(
                  function (position) { //buat fungsi position
                      //Membuat objek currentLocation menggunakan koordinat lintang dan bujur yang diperoleh dari position.coords. Objek ini kemudian digunakan untuk menetapkan lokasi saat ini pada peta.
                      var currentLocation = L.latLng(position.coords.latitude, position.coords.longitude); 
                      //Mengatur tampilan Map supaya perbesaran hanya 18x
                      map.setView(currentLocation, 18);
                      //Memunculkan teks berisi "Lokasimu sekarang"
                      var locationName = "Lokasimu Sekarang";
                      //Menambahkan marker yang berisi titik lokasi terkini, dan teks "lokasi sekarang"
                      updateMarker(currentLocation, locationName);
                      //Menambahkan lingkaran dari currentlocation sebesar 100 meter pada peta
                      addCircle(currentLocation, 500);
                  },

                  //Kemungkinan fungsi error
                  function (error) {
                      console.error('Error getting location:', error.message);
                      alert('Error getting location. Please make sure location access is allowed.');
                  },
                  options
              );
            //Jika browser tidak mendukung Javascript API untuk mencari lokasi
          } else {
              alert('Geolocation is not supported by your browser.');
          }
      }

      // Fungsi memperbarui marker lokasi terkini (redmarker)
      function updateMarker(location, name) {
          //Jika redmarker sudah ada sebelumnya,hapus dulu
          if (redMarker) {
              map.removeLayer(redMarker);
          }
          //Jika sudah dihapus, marker ditambahkan ke Map
          redMarker = L.marker(location, { icon: redIcon }).addTo(map);
          redMarker.bindPopup(name).openPopup();
          
          //event listener, jika marker di click, maka menampilkan pop-up
          redMarker.on('click', function (e) {
              
          });
      }

      // Fungsi menambahkan radius 100 meter
      function addCircle(location, radius) {
          if (circleRadius) {
              map.removeLayer(circleRadius);
          }

          circleRadius = L.circle(location, { radius: radius, color: '#FFBB00', fillOpacity: 0.1 }).addTo(map);
      }

      // Definisikan redicon
      var redIcon = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41],
      });
</script>

      <script>
      function search() {
  var searchTerm = document.getElementById('searchInput').value.toLowerCase();

  // Mengambil data dari server PHP
  fetch('get_lokasi.php')
      .then(response => response.json())
      .then(data => {
          // Menghapus semua marker kecuali marker lokasi saat ini
          map.eachLayer(function (layer) {
              if (layer instanceof L.Marker && layer !== redMarker) {
                  map.removeLayer(layer);
              }
          });

          // Menambahkan kembali marker yang sesuai dengan hasil pencarian
          data.forEach(location => {
              if (location.nama.toLowerCase().includes(searchTerm)) {
                  var popupContent = '<strong>' + location.nama + '</strong><br><img src="' + location.url_gambar + '" width="200">';
                  L.marker([location.latitude, location.longitude])
                      .bindPopup(popupContent)
                      .addTo(map);
              }
          });

          // Set view kembali ke set view awal
          map.setView([-6.591619, 106.8064164], 16); // Sesuaikan dengan koordinat dan zoom level yang diinginkan
      })
      .catch(error => {
          console.error('Error:', error);
      });
}


  //Fungsi reset marker seperti semula
  function resetMarkers() {
    // Menghapus semua marker yang ada pada peta
    map.eachLayer(function (layer) {
      if (layer instanceof L.Marker) {
        map.removeLayer(layer);
      }
    });

    // Mengambil kembali data dari server PHP dan menambahkan kembali semua marker
    fetch('get_lokasi.php')
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
  }

  // Fungsi untuk mendeteksi ketika tombol "Enter" ditekan pada input pencarian
  function handleKeyPress(event) {
        if (event.key === 'Enter') {
          search();
        }
      }
      </script>

    <script>
        //Inisiasi Peta leaflet dengan tampilan pertama kali dibuka yaitu latitude : -6.591619,longitude:8064164,17.71, serta perbesaran 18x
        var map = L.map('map').setView([-6.591619,106.8064164,17.71], 18);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';

        //Menambahkan layer peta dari OpenStreetMap ke dalam peta Leaflet.
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { //URL untuk tile layer OpenStreetMap
                attribution: '&copy; ' + mapLink + ' Contributors', //Attribution (atribusi) ditambahkan ke peta untuk memberikan kredit kepada kontributor OpenStreetMap.
                maxZoom: 18,
            }).addTo(map);


        // Mengambil data dari server PHP
        fetch('get_lokasi.php')
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
</body>

</html>
