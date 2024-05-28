<?php
session_start();

require_once "../utils/formUtils.php";
require_once "../utils/crudUser.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Agencies";

preventUser();
preventAgency();
redirectToLogin();

$crud = new CRUD_USER();

$results = $crud->selectUsers("role != 'Adm' and role != 'User'");

$getAdmin = $crud->selectUsers("id = {$_SESSION["Adm"]}");

$admin = $getAdmin[0];

$layout = "";

if (!empty($results)) {

    foreach ($results as $user) {

        if (is_array(($user))) {

            $imageSrc = "../images/users/{$user["image"]}";

            $agency = $user["agency"];
            $email = $user["email"];
            $userid = $user["id"];

            $layout .= <<<HTML
                <div class='col-lg-3 col-md-4 col-sm-6'>
                    <div class='card'>
                        <img src='{$imageSrc}' class='img-fluid'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$agency}</h5>
                            <p class='card-text'>{$email}</p>
                            <a href='../agency/update.php?id={$userid}' class='btn btn-warning'>Update</a>
                            <a href='../agency/delete.php?id={$userid}' class='btn btn-danger'>Delete</a>
                           

                        </div>
                    </div>
                </div>
            HTML;
        } else {
            echo "Invalid user data: " . print_r($user, true);
        }
    }
} else {
    $layout .= "No results found!";
}
addBreadcrumb('Dashboard', "../admin/dashboard.php");
addBreadcrumb('Agencies');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>


<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <div id="layout" class="row">
            <?= $layout ?>
        </div> 
    </div>

</body>

</html>