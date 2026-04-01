<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/getcategories.php');
require_once(__DIR__ . '/../../libs/gettopic.php');

if (isset($_GET['cid']) && isset($_GET['tid'])) {
    $cid = $_GET['cid'];
    $tid = $_GET['tid'];
    $topic = getTopicById($cid, $tid, $pdo);
} else {
    die('Aucun sujet spécifié.');
}
?>