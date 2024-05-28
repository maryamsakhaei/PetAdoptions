<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Bird training";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet training', '../petcare/care.php');
addBreadcrumb('Bird');

?>

<!doctype html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
    <h1 class="text-center">Training & Tipps</h1>
        <div class="row ">
            <div class="col">
                <ul>
                    <li>Build Trust: Spend time near your bird's cage without forcing interaction. Let them observe you and become accustomed to your presence.</li>
                    <li>Positive Reinforcement: Just like with dogs, use positive reinforcement. Reward your bird with treats, verbal praise, or head scratches when they exhibit desired behaviors.</li>
                    <li> Short Sessions: Keep training sessions short and engaging. Birds have shorter attention spans, so sessions should be around 5-15 minutes to prevent them from becoming bored.</li>
                    <li>
                    Choose a Quiet Environment: Train in a quiet, calm environment where your bird can focus without distractions.
                    </li>
                </ul>
            </div>
            <div class="col">
                <img src="../images/pets/bird.jpg">
            </div>
        </div>
        <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
            <a href="care.php" class="btn btn-warning">Back</a>
        </div>
    </div>
</body>

</html>