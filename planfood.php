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

                // var vertical_menu = document.getElementById("vertical-menu");


                // var current = vertical_menu.getElementsByClassName("active_link");

                // if(current.length > 0)
                // {
                //     current[0].classList.remove("active_link");   
                // }
                
                // vertical_menu.getElementsByClassName('dashboard_link')[0].className += " active_link";

            </script>
            <style>
                    header {
                        position: relative;
                        height: 300px;
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

                    .row {
    display: flex;
    justify-content: space-around;
    margin: 20px;
}

.col {
    flex: 1;
}

.card {
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
}

h2 {
    color: black;
    font-family: 'Poppins', sans-serif;
    font-weight: bold; /* Use the correct weight value for bold */
    font-size: 20px; /* Use the correct font size value */
}


p {
    color: white;
    font-family: 'Poppins', sans-serif; /* Assuming you want to use Poppins font for paragraphs as well */
    font-size: 15px; /* Adjust the font size as needed */
    line-height: 1.5; /* Adjust the line height as needed for better readability */
}

.login-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
}

.login-btn a {
    color: white;
    text-decoration: none;
}

.login-btn:hover {
    background-color: #45a049;
}
.col {
    flex: 5;
    margin: 30px; /* Adjust the margin value as needed for the desired spacing */
    margin-right: 60px;
}

.col:first-child {
    margin-left: 120px; /* Adjust the margin value as needed */
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
        <div class="card">
            <h2>Makan Apa Sekarang?</h2>
            <p>Anda Bingung mau makan apa sekarang? Nih Vokasi Laper kasih saran</p>
            <button class="login-btn"><a href="saran-planfood.php">Minta Saran Makanan</a></button>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h2>Makan Apa Hari ini?</h2>
            <p>Rencanakan Mau makan apa saja hari ini? Nih Vokasi Laper bantu buat plan makan-nya</p>
            <button class="login-btn"><a href="planfood-1day.php">Buat PlanFood</a></button>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h2>PlanFood Kamu ini?  </h2>
            <p>Rencanakan Mau makan apa saja Hari ini? Nih Vokasi Laper bantu buat plan makan-nya</p>
            <button class="login-btn"><a href="planfood-1dayview.php">Lihat PlanFood</a></button>
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

    }
    else
    {
    	header("Location: index.php");
    	exit();
    }

?>

<!-- JS SCRIPTS -->