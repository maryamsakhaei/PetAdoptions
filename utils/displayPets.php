<?php
session_start();
require_once "crudPet.php";
require_once "../pet/viewAll.php";

$status = isset($_GET["status"]) ? $_GET["status"] : null;
$species = isset($_GET["species"]) ? $_GET["species"] : null;
$size = isset($_GET["size"]) ? $_GET["size"] : null;
$vaccine = isset($_GET["vaccinated"]) ? $_GET["vaccinated"] : null;

$crud = new CRUD_PET();

$conditions = array();

if ($status != null) {
    if ($status == "all") {
    } else {
        $conditions[] = "`available` = '$status'";
    }
}

if ($species != null) {
    $values = explode(",", $species);
    $conditions_species = array();

    foreach ($values as $value) {
        $conditions_species[] = "`species` = '$value'";
    }

    $speciesCondition = "(" . implode(" OR ", $conditions_species) . ")";
    $conditions[] = $speciesCondition;
}

if ($size != null) {
    $values = explode(",", $size);
    $sizeConditions = array();

    foreach ($values as $value) {
        $sizeConditions[] = "`size` = '$value'";
    }

    $sizeCondition = "(" . implode(" OR ", $sizeConditions) . ")";
    $conditions[] = $sizeCondition;
}

if ($vaccine != null) {
    $values = explode(",", $vaccine);
    $vaccineConditions = array();

    foreach ($values as $value) {
        $vaccineConditions[] = "`vaccinated` = '$value'";
    }

    $vaccineCondition = "(" . implode(" OR ", $vaccineConditions) . ")";
    $conditions[] = $vaccineCondition;
}

$condition = implode(" AND ", $conditions);

$result = $crud->selectPets($condition);

echo viewPets($result);
