<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the game start.";
    $game = new SuSh\Guess\Guess();
    $game->reset();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game. - show results.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $guess = $_POST['guess'] ?? null;
    $doInit = $_POST['doInit'] ?? null;
    $doGuess = $_POST['doGuess'] ?? null;
    $doCheat = $_POST['doCheat'] ?? null;

    $number = (int)$_SESSION['number'] ?? null;
    $tries = (int)$_SESSION['tries'] ?? null;

    $res = null;

    $game = new SuSh\Guess\Guess($number, $tries);

    //Update session variables
    $_SESSION['number'] = $game->number();
    $_SESSION['tries'] = $game->tries();
    $number = $_SESSION['number'];
    $tries = $_SESSION['tries'];

    $data = [
        "guess" => $guess,
        "res" => $res,
        "number" => $number,
        "tries" => $tries,
        "doGuess" => $doGuess,
        "doCheat" => $doCheat,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game. - make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";

    $guess = $_POST['guess'] ?? null;
    $doInit = $_POST['doInit'] ?? null;
    $doGuess = $_POST['doGuess'] ?? null;
    $doCheat = $_POST['doCheat'] ?? null;

    $number = (int)$_SESSION['number'] ?? null;
    $tries = (int)$_SESSION['tries'] ?? null;

    $res = null;

    $game = new SuSh\Guess\Guess($number, $tries);
    if ($doGuess && $game->tries() > 0) {
        try {
            $res = $game->makeGuess($guess);
        } catch (SuSh\Guess\GuessException $e) {
            echo "Got exception: " . get_class($e) . "<hr>";
            echo "<h1>GAME RESET!</h1>";
            $game->reset();
        }
    }

    if ($doInit) {
        $game->reset();
        $res = null;
    }

    //Update session variables
    $_SESSION['number'] = $game->number();
    $_SESSION['tries'] = $game->tries();
    $number = $_SESSION['number'];
    $tries = $_SESSION['tries'];

    $data = [
        "guess" => $guess,
        "res" => $res,
        "number" => $number,
        "tries" => $tries,
        "doGuess" => $doGuess,
        "doCheat" => $doCheat,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
