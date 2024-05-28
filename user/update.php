<?php

require_once "../utils/crudUser.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";
require_once "../utils/userForm.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Update details";

session_start();

if (isset($_SESSION["User"])) {
    $id = $_SESSION["User"];
} elseif (isset($_SESSION["Adm"])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = $_SESSION["Adm"];
    }
} elseif (isset($_SESSION["Agency"])) {
    $id = $_SESSION["Agency"];
}

$crud = new CRUD_USER();

$result = $crud->selectUsers("id = $id");

if (!empty($result)) {

    $user = $result[0];

    $firstname = $user['firstName'];
    $lastname = $user['lastName'];
    $email = $user['email'];
    $address = $user['address'];
    $phone = $user['phone'];
    $space = $user['space'];
    $exp = $user['experienced'];
    $birthdate = $user['birthdate'];

    $form = renderForm($firstname, $lastname, $address, $phone, $exp, $birthdate, $space, $email, "Update account");

    if (isset($_POST["sign-up"])) {

        $firstname = cleanInputs($_POST["firstname"]);
        $lastname = cleanInputs($_POST["lastname"]);
        $address = cleanInputs($_POST["address"]);
        $phone = (isset($_POST["phone"])) ? cleanInputs($_POST["phone"]) : '';
        $space = (isset($_POST["space"])) ? cleanInputs($_POST["space"]) : '';
        $exp = cleanInputs($_POST["experienced"]);
        $birthdate = cleanInputs($_POST["birthdate"]);

        $picture = fileUpload($_FILES["picture"], 'user');

        if ($_FILES["picture"]["error"] == 0) {
            removeOldUserImage($user["image"]);
            $update = $crud->updateUser($id, $firstname, $lastname, $address, $birthdate, $phone, $email, $space, $exp, $picture[0]);
        } else {
            $picture = null;
            $update = $crud->updateUser($id, $firstname, $lastname, $address, $birthdate, $phone, $email, $space, $exp, $picture);
        }
        if ($update) {
            header("refresh: 2; url = ../user/profile.php");
        }
    }
}
addBreadcrumb('Home', '../home.php');
addBreadcrumb('Profile', '../user/profile.php');
addBreadcrumb('Edit');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <h1 class="text-center">Update user</h1>
            <?= $form ?>
        </form>
    </div>
    <script type="text/javascript" src="../js/userform.js"></script>
</body>

</html>