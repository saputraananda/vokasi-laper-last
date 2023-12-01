<?php
	
	//Start session
    session_start();

    //Set page title
    $pageTitle = 'PlanFood';

    //PHP INCLUDES
    include 'connect.php';
    include 'Includes/functions/function.php'; 


    //TEST IF THE SESSION HAS BEEN CREATED BEFORE
    $loggedInUser = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : null;
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

    include 'Includes/templates/header.php';
    include 'Includes/templates/navbar-success-login.php';

    ?>
            <style>
                    header {
                        position: relative;
                        height: 473px;
                        background-color: #f8f9fa;
                    }

                    header img {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .card {
                        background-color: #FFBB00;
                        width: 300px;
                        height: 200px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        padding: 20px;
                        box-shadow: 2px 2px 6px 0px rgba(0,0,0,0.3);
                    }

                    .card button {
                        display: block;
                        width: 100%;
                        height: 40px;
                        background-color: #4CAF50;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        margin-top: 20px;
                    }

                    .container1 {
                    display: flex;
                    margin-left: 250px;
                    align-items: center;
                    height: 70vh;
                    }
            </style>
            <!-- PlanFood View -->

            <header>
            <img src="image/Banner Planfood.png" class="img-fluid" alt="Responsive image" >
            </header>

            <div>
                <br>
                <br>
            </div>

            <div class="row">
            <div class="col">
                <div class="card" style="margin-left: 65px;">
                    <h2>Makan Apa Sekarang</h2>
                    <p>Anda Bingung mau makan apa sekarang? Nih Vokasi Laper kasih saran</p>
                    <button class="nav-link login-btn-2"><a href="saran-planfood.php">Minta Saran Makanan</a></button>
                </div>
            </div>
            <div class="col">
                <div class="card" style="margin-left: 65px;">
                    <h2>Makan Apa Hari ini</h2>
                    <p>Rencanakan Mau makan apa saja hari ini? Nih Vokasi Laper bantu buat plan makan-nya</p>
                    <button class="nav-link login-btn-2"><a href="planfood-1day.php">Buat PlanFood</a></button>
                </div>
            </div>
            <div class="col" >
                <div class="card" style="margin-left: 65px;">
                    <h2>PlanFood Kamu ini</h2>
                    <p>Rencanakan Mau makan apa saja Hari ini? Nih Vokasi Laper bantu buat plan makan-nya</p>
                    <button class="nav-link login-btn-2"><a href="planfood-1dayview.php">Lihat PlanFood</a></button>
                </div>
            </div>
            </div>
            <div>
                <br>
                <br>
                <br>
                <br>
            </div>
        <?php

    	include 'Includes/templates/footer.php';
?>

<!-- JS SCRIPTS -->