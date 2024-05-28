<?php

function cleanInputs($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return  $data;
}
function redirectToLogin()
{
    if (!isset($_SESSION["Adm"])) {
        header("Location: ../user/login.php");
    }
}
function redirectAgencyToLogin()
{
    if (!isset($_SESSION["Agency"])) {
        header("Location: ../user/login.php");
    }
}
function preventAdmin()
{
    if (isset($_SESSION["Adm"])) {
        header("Location: ../admin/dashboard.php");
    }
}
function preventUser()
{
    if (isset($_SESSION["User"])) {
        header("Location: ../user/dashboard.php");
    }
}
function preventAgency()
{
    if (isset($_SESSION["Agency"])) {
        header("Location: ../agency/dashboard.php");
    }
}
function removeOldPetImage($oldImage)
{
    if ($oldImage != "placeholder.jpg") {
        unlink("../images/pets/$oldImage");
    }
}
function removeOldUserImage($oldImage)
{
    if ($oldImage != "placeholder.jpg") {
        unlink("../images/users/$oldImage");
    }
}
function validateName($name)
{
    return preg_match('/^[a-zA-ZäöüÄÖÜß\s]+$/', $name);
}

function validateAdress($address)
{
    return preg_match('/^[a-zA-Z,äöüÄÖÜß\s0-9]+$/', $address);
}
