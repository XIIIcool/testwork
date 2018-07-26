<?php

require_once 'db.php';

$Ajax = new Ajax();
$Users = new Users();

if(isset($_GET)){
    switch($_GET['method']){
        case "getCity":
        
            print_r(json_encode($Ajax->getListCity(ucfirst(trim($_GET['city'])))));
        break;

           case "getCategories":
            print_r(json_encode($Ajax->getListCategories(trim($_GET['name']))));
               

        break;
    }
}
if (isset($_POST)){
    if(isset($_POST['doer-email']) || isset($_POST['customer-email'])){
        $groupuser = "";
        $email = "";
        $phone = "";
        $city = "";
        $categories = array();
        if(isset($_POST['doer-email']) && !empty($_POST['doer-email'])){
            $groupuser = 1;
            $email = $_POST['doer-email'];
            $phone = $_POST['doer-tel'];
            $city = $_POST['doer-town'];
            $categories = $_POST['doer-heading'];
        } 
        if(isset($_POST['customer-email']) && !empty($_POST['customer-email'])){
            $groupuser = 2; 
            $email = $_POST['customer-email'];
            $phone = $_POST['customer-tel'];
            $city = $_POST['customer-town'];
            $categories = $_POST['customer-heading'];
        }
        
       
        
        if($groupuser != "" && $city != "" && count($categories)>0){
            $query = $Users->createUser($email,$phone,$city,$groupuser);
            if($query){
                foreach($categories as $id=>$item){
                    $categories[$id] = [$query,$item];
                }
                if($Users->insertUserCategories($categories)){
                  $result['status'] = 'OK';  
                  header('Content-Type: application/json');
                  echo json_encode($result);
                }
            } else {
                $result['status'] = 'ERROR';
                header('Content-Type: application/json');
		echo json_encode($result);
            }
        } 
    }
}