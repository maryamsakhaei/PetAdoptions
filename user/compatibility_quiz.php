<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Quiz";

$crud = new CRUD_PET();
$layout = "";

$personality = isset($_POST["personality"]) ? $_POST["personality"] : '';
$exp = isset($_POST["experience"]) ? $_POST["experience"] : '';
$space = isset($_POST["space"]) ? $_POST["space"] : 0;
$smallCh = isset($_POST["children"]) ? $_POST["children"] : '';

$p0 = ($personality === '') ? 'selected' : '';
$p1 = ($personality === 'extrovert') ? 'selected' : '';
$p2 = ($personality === 'introvert') ? 'selected' : '';
$p3 = ($personality === 'both') ? 'selected' : '';

$exp0 = ($exp === '') ? 'selected' : '';
$exp1 = ($exp === 'yes') ? 'selected' : '';
$exp2 = ($exp === 'no') ? 'selected' : '';

if (isset($_POST["finish"])) {

    if ($personality === 'extrovert') {
        $condition1 = "species IN ('Dog', 'Bird')";
    } else if ($personality === 'introvert') {
        $condition1 = "species IN ('Cat', 'Fish')";
    } else {
        $condition1 = "1";
    }

    if ($exp === 'yes') {
        $condition2 = "1";
    } else {
        $condition2 = "experienceNeeded = 0";
    }

    $condition3 = "available = 1";

    $condition4 = "minSpace <= $space";

   

    $result = $crud->selectPets("$condition1 AND $condition2 AND $condition3 AND $condition4");

    $layout = viewPets($result);
}

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Quiz');
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
        <div class="card ">
            <div class="card-header">
                Compatibility Quiz
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="personality" class="form-label">Are you rather extroverted or introverted?</label>
                        <select class="form-select" name="personality" required>
                            <option value="" <?= $p0 ?>>Select one</option>
                            <option value="extrovert" <?= $p1 ?>>Extrovert</option>
                            <option value="introvert" <?= $p2 ?>>Introvert</option>
                            <option value="both" <?= $p3 ?>>A little bit of both</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="experience" class="form-label">Do you have experience with pets?</label>
                        <select class="form-select" name="experience" required>
                            <option value="" <?= $exp0 ?>>Select one</option>
                            <option value="yes" <?= $exp1 ?>>Yes</option>
                            <option value="no" <?= $exp2 ?>>No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="space" class="form-label">What is your appartment size (in m&sup2)?</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="space" name="space" placeholder="Space" min="0" value="<?= $space ?>">
                            <span class="input-group-text">m&sup2</span>
                        </div>
                    </div>
                    <button type="submit" name='finish' class="btn btn-primary">Finish Quiz</button>
                </form>
            </div>
        </div>

        <div id="layout" class="row m-2">
            <div id="layout" class="row m-2">
                <?= $layout ?>
            </div>
        </div>


    </div>
</body>

</html>