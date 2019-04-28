<?php
require(__DIR__ . "/../session/session_start.php");
require(__DIR__ . "/../config.php");
require(__DIR__ . "/../autoload.php");

/**
 * Process the data from the post form.
 */

$_SESSION['guess'] = $_POST['guess'] ?? null;
$_SESSION['doInit'] = $_POST['doInit'] ?? null;
$_SESSION['doGuess'] = $_POST['doGuess'] ?? null;
$_SESSION['doCheat'] = $_POST['doCheat'] ?? null;

if ($_POST['doInit']) {
    $_SESSION['number'] = null;
}

/**
 * Redirect.
 */
header("Location: ../index.php");
