<?php
session_start();

require_once "../utils/formUtils.php";
require_once "../utils/crudUser.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Users";

preventUser();
preventAgency();
redirectToLogin();

$crud = new CRUD_USER();

$results = $crud->selectUsers("role != 'Adm' and role != 'Agency'");

$getAdmin = $crud->selectUsers("id = {$_SESSION["Adm"]}");

$admin = $getAdmin[0];

$layout = "";

if (!empty($results)) {

    foreach ($results as $user) {

        if (is_array(($user))) {

            $imageSrc = "../images/users/{$user["image"]}";

            $firstName = $user["firstName"];
            $lastName = $user["lastName"];
            $email = $user["email"];
            $userid = $user["id"];

            $layout .= <<<HTML
                
                    <div class='card'>
                        <img src='{$imageSrc}' class='img-fluid'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$firstName} {$lastName}</h5>
                            <p class='card-text'>{$email}</p>
                            <a href='../user/update.php?id={$userid}' class='btn btn-warning'>Update</a>
                            <a href='../user/delete.php?id={$userid}' class='btn btn-danger'>Delete</a>
                           

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
addBreadcrumb('Users');
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
        <div id="layout" class="grid">
            <?= $layout ?>
        </div> 
    </div>

</body>

</html>