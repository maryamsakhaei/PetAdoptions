<?php

require_once "../utils/crudUser.php";
require_once "../utils/formUtils.php";
require_once "../utils/file_upload.php";
require_once "../utils/userForm.php";

$pageTitle = "Sign-up";

$crud = new CRUD_USER();

$firstname = (isset($_POST['firstname'])) ? cleanInputs($_POST["firstname"]) : '';
$lastname = (isset($_POST['lastname'])) ? cleanInputs($_POST["lastname"]) : '';
$email = (isset($_POST['email'])) ? cleanInputs($_POST["email"]) : '';
$address = (isset($_POST['address'])) ? cleanInputs($_POST["address"]) : '';
$phone = (isset($_POST['phone'])) ? cleanInputs($_POST["phone"]) : '';
$space = (isset($_POST['space'])) ? cleanInputs($_POST["space"]) : '';
$exp = (isset($_POST['experienced'])) ? cleanInputs($_POST["experienced"]) : '';
$birthdate = (isset($_POST['birthdate'])) ? cleanInputs($_POST["birthdate"]) : '';
$password = (isset($_POST['password'])) ? $_POST["password"] : '';

$form = renderForm($firstname, $lastname, $address, $phone, $exp, $birthdate, $space, $email, "Create account");

if (isset($_POST["sign-up"])) {

    $picture = fileUpload($_FILES["picture"], 'user');

    $password = hash("sha256", $password);

    $values = ['User', $firstname, $lastname, $email, $phone, $address, $picture[0], $birthdate, $space, $exp, $password];

    $crud->createUser($values);
}
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
            <h1 class="text-center">User registration</h1>
            <?= $form ?>
        </form>
    </div>
    <script type="text/javascript" src="../js/userform.js"></script>
</body>

</html>