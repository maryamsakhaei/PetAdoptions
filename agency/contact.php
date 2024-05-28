<?php
session_start();

require_once "../utils/crudStories.php";
require_once "../utils/crudUser.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Contact";

if (!isset($_SESSION["User"])) {
    header("Location: ../user/login.php");
}

$crud = new CRUD_STORY();
$crudUser = new CRUD_USER();

$receiver = $_GET["id"];
$sender = $_SESSION["User"];

$getReceiver = $crudUser->selectUsers("id = $receiver");
$user = $getReceiver[0];
$receiverName = $user['agency'];

$read_agency = 0;
$read_user = 1;

if (isset($_POST["submit"])) {

    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $values = [$subject, $message, $sender, $receiver, $read_agency, $read_user];

    $crud->createMessage($values);
}

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Messages', '../messages/seeMessages.php');
addBreadcrumb('Contact agency');
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container" id='contact-form'>
        <div style="display: flex; align-items: center;">
            <h2 style="margin-right: 40px;">Contact:</h2>
            <p class="fw-light" style="margin: 0; font-size: 18px"><?= $receiverName ?></p>
        </div>
        <form method="post">
            <div class="form-group">
                <label for="name">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="buttons">
                <button type="submit" class="btn btn-primary" name="submit">Send</button>
            </div>

        </form>
    </div>

</body>

</html>