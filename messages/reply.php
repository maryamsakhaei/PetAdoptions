<?php
session_start();

require_once "../utils/crudStories.php";
require_once "../utils/crudUser.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Contact";

$crud = new CRUD_STORY();
$crudUser = new CRUD_USER();

$receiver = $_GET["id"];
$msgId = $_GET["msgid"];

$getMsg = $crud->selectMessages("id = $msgId");
$getReceiver = $crudUser->selectUsers("id = $receiver");

$msg = $getMsg[0];
$msgContent = $msg['message'];
$user = $getReceiver[0];

if (isset($_SESSION["User"])) {
    $crud->changeMsgStatus($msgId, 1, "User");
    $sender = $_SESSION["User"];
    $receiverName = $user['agency'];
    $read_agency = 0;
    $read_user = 1;
} else if (isset($_SESSION["Agency"])) {
    $crud->changeMsgStatus($msgId, 1, "Agency");
    $sender = $_SESSION["Agency"];
    $receiverName = $user['firstName'] . ' ' . $user['lastName'];
    $read_agency = 1;
    $read_user = 0;
}

if (isset($_POST["submit"])) {

    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $values = [$subject, $message, $sender, $receiver, $read_agency, $read_user];

    $crud->createMessage($values);
}
addBreadcrumb('Home', '../home.php');
addBreadcrumb('Messages', '../messages/seeMessages.php');
addBreadcrumb('Reply');
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
        <div class="card-body">
            <p class="card-text"><?= $msgContent ?></p>
            <p class="text-sm-end fw-medium">- <?= $receiverName ?></p>
        </div>
    </div>
    <div class="container mt-5" id='contact-form'>
        <div style="display: flex; align-items: center;">
            <h2 style="margin-right: 40px;">Reply to:</h2>
            <p class="fw-light" style="margin: 0; font-size: 18px"><?= $receiverName ?></p>
        </div>
        <form method="post">
            <div class="form-group">
                <label for="name">Subject:</label>
                <input type="text" class="form-control" 2="subject" name="subject" required>
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