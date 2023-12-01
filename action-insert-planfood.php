<?php
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        function insertPlanFood($user_id, $date, $budget, $sarapan_id, $makan_siang_id, $makan_malam_id) {
            global $con;
            if (!$makan_malam_id)
            $sql = "INSERT INTO 
                    planfood1(`user_id`, `date`, `budget`, `sarapan_id`, `makan_siang_id`, `makan_malam_id`) 
                    VALUES(
                        $user_id, 
                        '$date', 
                        $budget, 
                        ". ($sarapan_id? $sarapan_id: 'NULL') .", 
                        ". ($makan_siang_id? $makan_siang_id: 'NULL').", 
                        ". ($makan_malam_id? $makan_malam_id: 'NULL')."
                    )";
            
            $res = $con->exec($sql);
            return $res;
        }
        
        
        $data = file_get_contents('php://input');
        $dataJson = json_decode($data, true);
        
        
        insertPlanFood(
            $dataJson['user_id'],
            $dataJson['tanggal'],
            $dataJson['budget'],
            $dataJson['sarapan'],
            $dataJson['makan_siang'],
            $dataJson['makan_malam']
        );

        header('Content-Type: application/json');
        echo json_encode(["Status" => "OK"]);
        return;
    }
?>