<?php
require_once "/var/www/html/API_PROJECT2/config/database.php";
require_once "/var/www/html/API_PROJECT2/models/UserModel.php";
require_once "/var/www/html/API_PROJECT2/controllers/UserController.php";

$model = new UserModel($conn);
$controller = new UserController($model);

$action = $_GET['action'] ?? 'create';

if ($action === 'create') {
    $controller->create();
} 
elseif ($action === 'save') {
    $controller->save();
} 
elseif ($action === 'fetchStates') {
    $country = $_GET['country'];
    echo json_encode($controller->fetchStates($country));
}
?>











































