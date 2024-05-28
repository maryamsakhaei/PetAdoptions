<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Cat training";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet training', '../petcare/care.php');
addBreadcrumb('Cat');

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
        <div class="row">
            <div class="col">
                <ul>
                    <li>Use Positive Reinforcement: Cats respond well to positive reinforcement. Reward desired behaviors with treats, praise, or playtime to encourage repetition.</li>
                    <li>Be Patient: Cats have their own pace and preferences. Patience is key as you work with their natural instincts and behaviors.</li>
                    <li>   Use High-Value Treats: Use treats that your cat finds particularly enticing to motivate them during training sessions.</li>
                    <li>    Use Toys: Interactive toys like feather wands or laser pointers can be used to encourage your cat's natural hunting and chasing instincts.</li>
                </ul>
            </div>
            <div class="col">
                <img src="../images/pets/cat.jpg">
            </div>
        </div>
        <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
            <a href="care.php" class="btn btn-warning">Back</a>
        </div>
    </div>
</body>

</html>