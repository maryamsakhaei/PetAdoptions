<?php
session_start();

require_once "../utils/crudStories.php";
require_once "../utils/crudUser.php";
require_once "../messages/viewMessages.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

$crud = new CRUD_STORY();
$crudUser = new CRUD_USER();

preventAdmin();

$pageTitle = "Messages";

if (isset($_SESSION['Agency'])) {
    $agency = $_SESSION['Agency'];
    $condUnread = "fk_receiver_id = $agency AND readmsg_agency = 0";
    $condRead = "fk_receiver_id = $agency AND readmsg_agency = 1";
} else if (isset($_SESSION['User'])) {
    $user = $_SESSION['User'];
    $condUnread = "fk_receiver_id = $user AND readmsg_user = 0";
    $condRead = "fk_receiver_id = $user AND readmsg_user = 1";
}

$unreadMessages = $crud->selectMessages($condUnread);
$readMessages = $crud->selectMessages($condRead);

$unread = viewMessages($unreadMessages);
$read = viewMessages($readMessages);

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Messages');

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

    <div class="container">
        <h2 class="h2-header">Messages</h2>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Unread messages
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?= $unread ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Read messages
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?= $read ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>