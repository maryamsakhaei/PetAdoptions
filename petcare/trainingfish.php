<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Fish training";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet training', '../petcare/care.php');
addBreadcrumb('Fish');

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
        <h1 class="text-center"></h1>
        <div class="row">
            <h1>Training & Tipps</h1>
            <div class="col">
                
                <ul>
                    <li>
                        Choose the Right Fish: Some fish species are more trainable than others. Goldfish, bettas, and some cichlids can be more receptive to training.
                    </li>
                    
                    <li>
                        Use Visual Cues: Fish rely heavily on visual cues. Use a distinct object or color as a cue for feeding or other behaviors. Over time, they may associate that cue with the desired action.
                    </li>
                    
                    <li>
                        Consistent Routine: Fish thrive on routine. Feed them at the same time each day and use consistent cues to establish patterns.
                    </li>
                    
                    <li>
                        Avoid Stress: Fish are sensitive to stress, so if they seem agitated or stressed during training, stop and try again later.
                    </li>
                    
            </div>
            <div class="col">
                <img src="../images/pets/fish.jpg">
            </div>
            <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
                <a href="care.php" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
</body>

</html>