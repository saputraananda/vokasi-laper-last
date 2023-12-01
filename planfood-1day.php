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

            .main-title {
        font-size: 24px;
        color :#FFBB00;
        margin-bottom: 5px;
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
                    <div class="title-container">Rencanakan Makanmu Hari ini</div>
                </div>
            </div>
            <div class="panel-body-X">

                <!-- DATE INPUT -->
                <div class="form-group">
                    <label for="tanggal">Tanggal PlanFood</label>
                    <input class="form-control" type="date" id="tanggal" name="tanggal" required>
                </div>

                <!-- BUDGET INPUT -->
                <div class="form-group">
                    <label for="budget">Budget Makan</label>
                    <input class="form-control" type="text" id="budget" name="budget" placeholder="Isi tanpa RP dan Koma (,)"required>
                </div>

                <!-- SARAPAN INPUT -->
                <div class="form-group">
                    <label for="sarapan">Sarapan</label>
                    <div class="input-group">
                        <select class="form-control" type="text" id="sarapan" name="sarapan"></select>
                        <span class="input-group-text" id="harga-sarapan"></span>
                    </div>
                </div>

                <!-- MENU PRICE INPUT -->
                <div class="form-group">
                    <label for="makan-siang">Makan Siang</label>
                    <div class="input-group">
                        <select class="form-control" type="text" id="makan-siang" name="makan-siang"></select>
                        <span class="input-group-text" id="harga-makan-siang"></span>
                    </div>
                </div>

                <!-- MENU IMAGE INPUT -->
                <div class="form-group">
                    <label for="makan-malam">Makan Malam</label>
                    <div class="input-group">
                        <select class="form-control" type="text" id="makan-malam" name="makan-malam"></select>
                        <span class="input-group-text" id="harga-makan-malam"></span>
                    </div>
                </div>

                <br>
                <span id="pesan-error"></span>
                <button type="submit" class="btn btn-warning" style="margin-left: 650px;">Simpan Plan Food</button>
            </div>
        </div>
    </form>
</div>
<br>
<br>
<br>


    <!-- <form id="form-planfood" method="POST">
        <div>
            <label for="tanggal">Masukkan Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>
        <div>
            <label for="budget">Budget Makan:</label>
            <input type="text" id="budget" name="budget" required >
        </div>
        <div style="display: flex;">
            <label for="sarapan">Sarapan:</label>
            <select class="select-menu" type="text" id="sarapan" name="sarapan"></select>
            <span id="harga-sarapan"></span>
        </div>
        <div style="display: flex;">
            <label for="makan-siang">Makan Siang:</label>
            <select select class="select-menu" type="text" id="makan-siang" name="makan-siang"></select>
            <span id="harga-makan-siang"></span>
        </div>
        <div style="display: flex;">
            <label for="makan-malam">Makan Malam:</label>
            <select select class="select-menu" type="text" id="makan-malam" name="makan-malam"></select>
            <span id="harga-makan-malam"></span>
        </div>

        <span id="pesan-error"></span>

        <button type="submit">Simpan Plan Food</button>
    </form> -->

    <script>

        // var vertical_menu = document.getElementById("vertical-menu");


        // var current = vertical_menu.getElementsByClassName("active_link");

        // if(current.length > 0)
        // {
        //     current[0].classList.remove("active_link");   
        // }

        // vertical_menu.getElementsByClassName('dashboard_link')[0].className += " active_link";

        <?php
            $stmt = $con->prepare("SELECT  menu_id ,menu_name, menu_price FROM menus ");
            $stmt->execute();
            $makanan = $stmt->fetchAll();
            
            $return_data = [];
            for ($i=0;$i<count($makanan); $i++) {
                $return_data[$makanan[$i]["menu_id"]] = [
                    "name" => $makanan[$i]["menu_name"],
                    "price" => $makanan[$i]["menu_price"]
                ];

                // $return_data[$makanan[$i]["menu_name"]] = $makanan[$i]["menu_price"];
            }

            echo "const data_menu = ". json_encode($return_data)
        ?>
        
        

        const makan_siang = document.getElementById("makan-siang")
        const harga_makan_siang = document.getElementById("harga-makan-siang")
        let select_content = "<option value=''>Pilih Menu Makan Siang</option>" 
        Object.entries(data_menu).forEach(([key,value]) => {
            select_content += `<option value="${key}">${value.name}</option> `
        })

        makan_siang.innerHTML = select_content
        makan_siang.addEventListener('change', () => {
            if (data_menu[makan_siang.value]) {
                document.getElementById("harga-makan-siang").innerHTML = "Rp. " + data_menu[makan_siang.value].price 
            } else {
                harga_makan_siang.innerHTML = ""
            }
        })

        // console.log(data_menu);
        const sarapan = document.getElementById("sarapan")
        const harga_sarapan = document.getElementById("harga-sarapan")
        let select_content2 = "<option value=''>Pilih Menu Sarapan</option>" 
        Object.entries(data_menu).forEach(([key,value]) => {
            select_content2 += `<option value="${key}">${value.name}</option> `
        })

        sarapan.innerHTML = select_content2
        sarapan.addEventListener('change', () => {
            if (data_menu[sarapan.value]) {
                document.getElementById("harga-sarapan").innerHTML = "Rp. " + data_menu[sarapan.value].price
            } else {
                harga_sarapan.innerHTML = ""
            }
        })

        // console.log(data_menu);
        const makan_malam = document.getElementById("makan-malam")
        const harga_makan_malam = document.getElementById("harga-makan-malam")
        let select_content3 = "<option value=''>Pilih Menu Makan Malam</option>" 
        Object.entries(data_menu).forEach(([key,value]) => {
            select_content3 += `<option value="${key}">${value.name}</option> `
        })

        makan_malam.innerHTML = select_content3
        makan_malam.addEventListener('change', () => {
            if (data_menu[makan_malam.value]) {
                document.getElementById("harga-makan-malam").innerHTML = "Rp. " + data_menu[makan_malam.value].price 
            } else {
                harga_makan_malam.innerHTML = ""
            }
        })

        const formPlanFood = document.getElementById('form-planfood')
        formPlanFood.addEventListener('submit', (event) => {
            event.preventDefault()
            
            const budget = document.getElementById('budget')
            const select_menu = document.querySelectorAll('.select-menu')
            let tempSum = 0
            select_menu.forEach(select => {
                if (data_menu[select.value]) {
                    tempSum += data_menu[select.value].price
                }
            })

            if (tempSum > parseInt(budget.value)) {
                // melebihi
                document.getElementById('pesan-error').innerHTML = "Jumlah harga makanan melebihi budget makan anda!!"
            } else {
                // berhasil
                const formData = {
                    user_id: <?php echo $_SESSION['userid_restaurant_qRewacvAqzA']; ?>,
                    tanggal: document.getElementById('tanggal').value,
                    budget: parseInt(document.getElementById('budget').value),
                    sarapan: document.getElementById('sarapan').value != ""? parseInt(document.getElementById('sarapan').value): null,
                    makan_siang: document.getElementById('makan-siang').value != ""? parseInt(document.getElementById('makan-siang').value): null,
                    makan_malam: document.getElementById('makan-malam').value != ""? parseInt(document.getElementById('makan-malam').value): null,
                }
                fetch('/VokasiLaper/action-insert-planfood.php', {
                    headers: {
                        'Content-Type' : 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify(formData)
                }).then(res=>res.json())
                .then(res=> {
                    if (res.status) {
                        document.getElementById('pesan-error').innerHTML = "Success Menambahkan PlanFood"
                    }
                }).catch(console.error);


            }
        })


    </script>

<?php
    include 'Includes/templates/footer.php';
?>

<!-- JS SCRIPTS -->