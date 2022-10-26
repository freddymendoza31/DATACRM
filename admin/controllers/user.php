<?php

$metodo = $_SERVER['REQUEST_METHOD'];
switch ($metodo) {
    case 'POST':
        include_once('../models/user.php');
        switch ($_POST['opcn']) {
            case 'consultarUsuarios':
                $info = User::mdlListar($_POST);
                foreach ($info as $key => $value) {
                    $info= $value['result'];
                }
                echo json_encode($info);
            break;
        }
    break;
}
