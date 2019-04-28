<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>Play the game</h1>
<h1>Guess my number</h1>

<?php if ($tries > 0 && $guess != $number) : ?>
<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doInit" value="Restart">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doCheat" value="Cheat">
</form>
<?php elseif ($tries <= 0) : ?>
    <h2> No more tries! </h2>
    <form method="post">
        <input type="submit" name="doInit" value="Restart">
    </form>
<?php else : ?>
    <h2> YOU WON! </h2>
    <form method="post">
        <input type="submit" name="doInit" value="Restart">
    </form>
<?php endif; ?>

<?php if ($doGuess) : ?>
<h2> Guess is: <?= $guess ?> and it is <?= $res ?></h2>
<?php endif; ?>

<?php if ($doCheat) : ?>
<h2> Number is: <?= $number ?></h2>
<?php endif; ?>

<h2> Tries remaining: <?= $tries ?></h2>
