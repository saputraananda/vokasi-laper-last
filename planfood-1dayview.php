<?php
	
	//Start session
    session_start();

    //Set page title
    $pageTitle = 'PlanFood';

    //PHP INCLUDES
    include 'connect.php';
    include 'Includes/functions/function.php'; 


    //TEST IF THE SESSION HAS BEEN CREATED BEFORE

    if(!isset($_SESSION['username_restaurant_qRewacvAqzA']) && !isset($_SESSION['password_restaurant_qRewacvAqzA']))
    {
        header("Location: index.php");
    	exit();
    }
    include 'Includes/templates/header.php';
    include 'Includes/templates/navbar-success-login.php';
?>
    
    <style>
            header {
                position: relative;
                        height: 350px;
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

            .div {
            border-radius: 10px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            background-color: #fb0;
            display: flex;
            flex-direction: column;
            padding: 0 20px;
        }
        .div-2 {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 20px;
            margin: 16px 0 12px;
        }
        @media (max-width: 991px) {
            .div-2 {
            margin: 0 -3px 0 1px;
            }
        }
        .div-3 {
            color: #fff;
            font: 600 20px Poppins, sans-serif;
        }
        .div-4 {
            color: #fff;
            text-align: right;
            white-space: nowrap;
            font: 600 20px Poppins, sans-serif;
        }
        @media (max-width: 991px) {
            .div-4 {
            white-space: initial;
            }
        }

        .main-title {
        font-size: 24px;
        color :#FFBB00;
        margin-bottom: 5px;
    }

    .btn-warning a {
        color: black; /* Set the text color to yellow */
        text-decoration: none; /* Remove the underline */
    }

    .btn-warning a:hover {
        text-decoration: none; /* Add underline on hover if needed */
    }
    .btn-warning {
        margin-bottom: 50px; /* Adjust the margin bottom as needed */
        margin-left: 650px;
    }
    </style>
    <!-- PlanFood View -->

    <header>
            <img src="image/Banner Planfood.png" class="img-fluid" alt="Responsive image" >
            </header>
    
    <div class="card-body">
        <form id="form-planfood" method="POST">
            <div class="panel-X">
                <div class="panel-header-X">
                    <div class="main-title">
                        PlanFood 1 Day
                    </div>
                </div>
                <div class="save-header-X">
                    <div style="display:flex">
                        <div class="icon">
                            <i class="fa fa-sliders-h"></i>
                        </div>
                        <div class="title-container">Rencana Makanmu Hari ini</div>
                    </div>
                </div>
                <div class="panel-body-X">

                <?php
                
                    // $stmt = $con->prepare("SELECT planfood1.date, planfood1.budget, menus.menu_name FROM planfood1  
                    // INNER JOIN menus 
                    // ON planfood1.sarapan_id = menus.menu_id OR 
                    //     planfood1.makan_siang_id = menus.menu_id OR 
                    //     planfood1.makan_malam_id = menus.menu_id
                    // WHERE user_id =" . $_SESSION['userid_restaurant_qRewacvAqzA']);
                    // $stmt->execute();
                    // $planfood = $stmt->fetchAll();

                    // var_dump($planfood) ;
                    // return;

                    // $stmt_menu = $con->prepare("SELECT menu_name FROM menus");
                    // $stmt_menu->execute();
                    // $menus = $stmt_menu->fetchAll();

                ?>

                <!-- DATE INPUT -->
                <?php
                    $stmt = $con->prepare("SELECT * FROM planfood1 WHERE user_id =". $_SESSION['userid_restaurant_qRewacvAqzA']);
                    $stmt->execute();
                    $planfood = $stmt->fetchAll();

                    echo "<div class='form-group'>
                    <label for='tanggal'>Tanggal PlanFood</label>
                    <div class='div'>
                    <div class='div-2'>
                        <div class='div-3'>
                        ".$planfood[0]['date']."
                        </div>
                    </div>
                    </div>
                    </div> "
                ?>
                
                                        
                <!-- BUDGET INPUT -->
                <?php
                    $stmt = $con->prepare("SELECT * FROM planfood1 WHERE user_id =". $_SESSION['userid_restaurant_qRewacvAqzA']);
                    $stmt->execute();
                    $planfood = $stmt->fetchAll();
                    echo " <div class='form-group'>
                    <label for='budget'>Budget Makan</label>
                    <div class='div'>
                    <div class='div-2'>
                        <div class='div-3'>
                        ".$planfood[0]['budget']."
                        </div>
                    </div>
                    </div>
                    </div> "
                ?>

                <!-- SARAPAN INPUT -->
                <div class="form-group">
                    <?php
                    $stmt = $con->prepare("SELECT * FROM menus");
                    $stmt->execute();
                    $menus = $stmt->fetchAll();
                    ?>
                    <label for="sarapan">Sarapan</label>
                    <div class="div">
                    <div class="div-2">
                        <div class="div-3">
                        <?php
                        // var_dump($planfood);
                        // return;
                        foreach($menus as $menu) {
                            if($menu['menu_id'] == $planfood[0]['sarapan_id']){
                            echo "<option value = '".$menu['menu_id']."' selected>";
                                echo ucfirst($menu['menu_name']);
                            echo "</option>";
                            break;
                            } 
                            // else {
                            // echo "<option value = '".$menu['menu_id']."'>";
                            //     echo ucfirst($menu['menu_name']);
                            // echo "</option>";
                            // }
                        }
                        ?>
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <?php
                    $stmt = $con->prepare("SELECT * FROM menus");
                    $stmt->execute();
                    $menus = $stmt->fetchAll();
                    ?>
                    <label for="makan-siang">Makan Siang</label>
                    <div class="div">
                    <div class="div-2">
                        <div class="div-3">
                        <?php
                        // var_dump($planfood);
                        // return;
                        foreach($menus as $menu) {
                            if($menu['menu_id'] == $planfood[0]['makan_siang_id']){
                            echo "<option value = '".$menu['menu_id']."' selected>";
                                echo ucfirst($menu['menu_name']);
                            echo "</option>";
                            break;
                            } 
                            // else {
                            // echo "<option value = '".$menu['menu_id']."'>";
                            //     echo ucfirst($menu['menu_name']);
                            // echo "</option>";
                            // }
                        }
                        ?>
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <?php
                    $stmt = $con->prepare("SELECT * FROM menus");
                    $stmt->execute();
                    $menus = $stmt->fetchAll();
                    ?>
                    <label for="makan-malam">Makan Malam</label>
                    <div class="div">
                    <div class="div-2">
                        <div class="div-3">
                        <?php
                        // var_dump($planfood);
                        // return;
                        foreach($menus as $menu) {
                            if($menu['menu_id'] == $planfood[0]['makan_malam_id']){
                                echo "<option value = '".$menu['menu_id']."' selected>";
                                    echo ucfirst($menu['menu_name']);
                                echo "</option>";
                                break;
                            } 
                            // else {
                            // echo "<option value = '".$menu['menu_id']."'>";
                            //     echo ucfirst($menu['menu_name']);
                            // echo "</option>";
                            // }
                        }
                        ?>
                        </div>
                    </div>
                    </div>
                    </div>

                <br>
                <button type="button" class="btn btn-warning">
                    <a href="planfood-1dayedit.php">Edit Plan Food</a>
                </button>
                </div>
                
            </div>
        </form>
    </div>

<?php
    include 'Includes/templates/footer.php';
?>

<!-- JS SCRIPTS -->