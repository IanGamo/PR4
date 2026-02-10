<?php
session_start();

if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [
        'milk' => 0,
        'soft' => 0
    ];
}

if (isset($_POST['worker'])) {
    $_SESSION['worker'] = trim($_POST['worker']);
}


if (isset($_POST['reset'])) {
    $_POST = [];
}


if (isset($_POST['add'])) {
    $prod = $_POST['product'];
    $qty = intval($_POST['qty']);

    if ($qty > 0 && array_key_exists($prod, $_SESSION['inventory'])) {
        $_SESSION['inventory'][$prod] += $qty;
    }
}


if (isset($_POST['remove'])) {
    $prod = $_POST['product'];
    $qty = intval($_POST['qty']);

    if ($qty > 0 && array_key_exists($prod, $_SESSION['inventory'])) {
        if ($_SESSION['inventory'][$prod] >= $qty) {
            $_SESSION['inventory'][$prod] -= $qty;
        } else {
            $msg = "Error: Not enough units to remove";
        }
    }
}
?>

<form method="post">
    <h2>Supermarket Management</h2>

    <a>Worker name:</a>
    <input type="text" name="worker" value="<?= htmlspecialchars($_SESSION['worker'] ?? '') ?>"><br><br>

    <a>Choose product:</a><br>
    <select name="product">
        <option value="milk">Milk</option>
        <option value="soft">Soft drink</option>
    </select><br><br>

    <a>Product quantity:</a><br>
    <input type="number" name="qty" min="1"><br><br>

    <button name="add">Add</button>
    <button name="remove">Remove</button>
    <button name="reset">Reset</button>
</form>

<h2>Inventory</h2>
<a>Worker: <?= htmlspecialchars($_SESSION['worker'] ?? '') ?></a><br>
<a>Units milk: <?= $_SESSION['inventory']['milk'] ?></a><br>
<a>Units soft drink: <?= $_SESSION['inventory']['soft'] ?></a><br>

<?php if (isset($msg)) echo $msg; ?>