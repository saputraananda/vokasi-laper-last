<?php
	
	//Start session
    session_start();

    //Set page title
    $pageTitle = 'PlanFood';

    //PHP INCLUDES
    include 'connect.php';
    include 'Includes/functions/function.php'; 


    //TEST IF THE SESSION HAS BEEN CREATED BEFORE

    if(isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA']))
    {
        include 'Includes/templates/header.php';
        include 'Includes/templates/navbar-success-login.php';
    	?>

            <script type="text/javascript">

                var vertical_menu = document.getElementById("vertical-menu");


                var current = vertical_menu.getElementsByClassName("active_link");

                if(current.length > 0)
                {
                    current[0].classList.remove("active_link");   
                }
                
                vertical_menu.getElementsByClassName('dashboard_link')[0].className += " active_link";

            </script>
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

                    .card-center{
                    align-items: center;
                    justify-content: center;
                    height: 50vh;
                    display: flex;
                    }

                    
            </style>

<style>

  .container2 {
    width: 200px; /* ubah sesuai kebutuhan */
    height: 200px; /* ubah sesuai kebutuhan */
    border: 1px solid black;
    border-radius: 50%; /* membuat lingkaran */
    overflow: hidden; /* memastikan gambar tidak keluar dari lingkaran */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .image {
    width: 100% ; /* mengisi seluruh area lingkaran */
    height: 100%; /* mengatur tinggi gambar sesuai proporsi aslinya */
  }
  
  .div {
    border-radius: 10px;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    background-color: #FFBB00;
    display: flex;
    width: 231px;
    flex-direction: column;
  }
  .img {
    aspect-ratio: 1.11;
    object-fit: contain;
    object-position: center;
    width: 100%;
    overflow: hidden;
    align-self: stretch;
  }
  .div-2 {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        margin: 15px 0;
        padding: 0 18px;
    }
  .div-3 {
    align-self: stretch;
    display: flex;
    width: 100%;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
  }
  .div-4 {
    color: #000;
    font: 600 18px Poppins, sans-serif;
  }
  .div-5 {
    align-self: start;
    display: flex;
    align-items: flex-start;
    gap: 3px;
  }
  .img-2 {
    aspect-ratio: 0.78;
    object-fit: contain;
    object-position: center;
    width: 100%;
    overflow: hidden;
    flex: 1;
  }
  .div-6 {
    color: #000;
    align-self: center;
    white-space: nowrap;
    margin: auto 0;
    font: 600 10px Poppins, sans-serif;
  }
  @media (max-width: 991px) {
    .div-6 {
      white-space: initial;
    }
  }
  .div-7 {
    color: #000;
    align-self: stretch;
    margin-top: 6px;
    white-space: nowrap;
    font: 400 15px Poppins, sans-serif;
  }
  @media (max-width: 991px) {
    .div-7 {
      white-space: initial;
    }
  }
</style>
            <!-- PlanFood View -->

            <header>
            <img src="image/Banner Planfood.png" class="img-fluid" alt="Responsive image" >
            </header>

            <?php
                $stmt = $con->prepare("SELECT * FROM menus ORDER BY RAND() LIMIT 1");
                $stmt->execute();
                $makanan = $stmt->fetchAll();

                echo "
                <form method='get'>
                  <div class='card-center'>
                    <div class='div'>
                      <div class='container2' style='margin-left: 15px; margin-top: 15px; margin-bottom: 15px;'>
                        <img 
                            loading='lazy'
                            src='/vokasilaper/images/".$makanan[0]["menu_image"]."'
                            class='image'
                        />
                      </div>
                        <div class='div-2'>
                            <div class='div-3'>
                            <div class='div-4'>".$makanan[0]['menu_name']."</div>
                            </div>
                            <div class='div-7'>Rp. ".$makanan[0]["menu_price"]."</div>
                        </div>
                    </div>
                    </div>
                    <div>
                  </div>
                  <div>
                  <h5 style='text-align: center;color: black;'>Kurang Puas dengan saran ini?</h5> 
                  </div>
                  <button class='nav-link login-btn-1' style='margin-left: 667px; background-color: white; color: black;' type='submit'>Minta Saran Lagi</button>
                  <br/>    
                </form>"
                
                
            ?>

            
<br>
<br>



        <?php

    	include 'Includes/templates/footer.php';

    }
    else
    {
    	header("Location: index.php");
    	exit();
    }

?>

<!-- JS SCRIPTS -->