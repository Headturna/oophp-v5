<?php
require(__DIR__ . "/session/session_start.php");
require(__DIR__ . "/config.php");
require(__DIR__ . "/autoload.php");

$res = null;
$guess = $_SESSION['guess'] ?? null;
$doInit = $_SESSION['doInit'] ?? null;
$doGuess = $_SESSION['doGuess'] ?? null;
$doCheat = $_SESSION['doCheat'] ?? null;
$number = (int)$_SESSION['number'] ?? null;
$tries = (int)$_SESSION['tries'] ?? null;

$g = new Guess($number, $tries);

if ($doInit || $number === null) {
    $g->reset();
} else if ($doGuess && $g->tries() > 0) {
    try {
        $res = $g->makeGuess($guess);
    } catch (GuessException $e) {
        echo "Got exception: " . get_class($e) . "<hr>";
        echo "<h1>GAME RESET!</h1>";
        $g->reset();
    }
}

//Update session variables
$_SESSION['number'] = $g->number();
$_SESSION['tries'] = $g->tries();

//Render page
require(__DIR__ . "/view/view.php");
