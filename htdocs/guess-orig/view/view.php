<h1>Guess my number</h1>

<?php if ($g->tries() > 0 && $guess != $g->number()) : ?>
<form method="post" action="process/process_guess.php">
    <input type="text" name="guess">
    <input type="submit" name="doInit" value="Restart">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doCheat" value="Cheat">
</form>
<?php elseif ($g->tries() <= 0) : ?>
    <h2> No more tries! </h2>
    <form method="post" action="process/process_guess.php">
        <input type="submit" name="doInit" value="Restart">
    </form>
<?php else : ?>
    <h2> YOU WON! </h2>
    <form method="post" action="process/process_guess.php">
        <input type="submit" name="doInit" value="Restart">
    </form>
<?php endif; ?>

<?php if ($doGuess) : ?>
<h2> Guess is: <?= $guess ?> and it is <?= $res ?></h2>
<?php endif; ?>

<?php if ($doCheat) : ?>
<h2> Number is: <?= $g->number() ?></h2>
<?php endif; ?>

<h2> Tries remaining: <?= $g->tries() ?></h2>
