<?php
session_start();

if (!isset($_SESSION['nums'])) {
    $_SESSION['nums'] = [10, 20, 30];
}

if (isset($_POST['reset'])) {
    $_SESSION['nums'] = [10, 20, 30];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['modify'])) {
        $pos = intval($_POST['pos']);
        $val = intval($_POST['val']);

        if ($pos >= 0 && $pos < count($_SESSION['nums'])) {
            $_SESSION['nums'][$pos] = $val;
        }
    }

    if (isset($_POST['average'])) {
        $media = array_sum($_SESSION['nums']) / count($_SESSION['nums']);
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<form method="post">
    <h2>Modify array saved in session</h2>

    Position to modify:
    <input type="number" name="pos" min="0" max="2"><br><br>

    New value:
    <input type="number" name="val"><br><br>

    <button name="modify">Modify</button>
    <button name="average">Average</button>
    <button name="reset">Reset</button>

    <br><br>
    Current array: <?= implode(', ', $_SESSION['nums']) ?>

    <?php 
    if (isset($media)) : 
    ?>
    <p>Average: <?= $media ?></p>
    <?php 
    endif; 
    ?>
    
</form>

</body>
</html>