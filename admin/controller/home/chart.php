<?php
    if(isset($_SESSION['admin'])){
        if($_GET['chart'] == 'filter'){
            include_once('model/home/select_10_best_filters.php');
            $filters_ranking = select_10_best_filters();
            if($filters_ranking){
                echo json_encode($filters_ranking);
            }
            else{
                echo json_encode('error');
            }
        }
        elseif($_GET['chart'] == 'user'){
            include_once('model/home/select_10_best_users.php');
            $users_ranking = select_10_best_users();
            if($users_ranking){
                echo json_encode($users_ranking);
            }
            else{
                echo json_encode('error');
            }
        }
        else{
            echo json_encode('error');
        }
    }
    else{
        echo json_encode('error');
    }