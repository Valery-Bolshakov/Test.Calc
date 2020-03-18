<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="styles.css" media="all">
</head>
<body>
<h2>Калькулятор</h2>&nbsp
<form action="" method="POST">
    Дата оформления вклада <input type="date" name="date" required><br><br>

    Сумма вклада <input type="text" name="sum" placeholder="от 1 000 до 3 000 000" required
                        value="<?php if (!empty($_REQUEST['sum'])) echo $_REQUEST['sum'] ?>"><br><br>
    <div id="slider"></div><br><br>

    Срок вклада
    <select name="term">
        <option value="1" <?php if (isset($_REQUEST['term']) and $_REQUEST['term'] == 1) echo 'selected' ?> > 1 год
        </option>
        <option value="2" <?php if (isset($_REQUEST['term']) and $_REQUEST['term'] == 2) echo 'selected' ?> > 2 года
        </option>
        <option value="3" <?php if (isset($_REQUEST['term']) and $_REQUEST['term'] == 3) echo 'selected' ?> > 3 года
        </option>
        <option value="4" <?php if (isset($_REQUEST['term']) and $_REQUEST['term'] == 4) echo 'selected' ?> > 4 года
        </option>
        <option value="5" <?php if (isset($_REQUEST['term']) and $_REQUEST['term'] == 5) echo 'selected' ?> > 5 лет
        </option>
    </select><br><br>



    Пополнение вклада
    <input type="radio" name="replenishment" value="no"
        <?php if (empty($_REQUEST['replenishment'])) echo "checked";
        if ($_POST['replenishment'] == "no") {
            echo "checked";
        } ?>> Нет
    <input type="radio" name="replenishment" value="yes"
        <?php if ($_POST['replenishment'] == "yes") {
            echo "checked";
        } ?>> Да<br><br>

    Сумма пополнения вклада <input name="summ" placeholder="от 1 000 до 3 000 000"
                                   value="<?php if (!empty($_REQUEST['summ'])) echo $_REQUEST['summ']; ?>"><br><br>
    <div id="slider_1"></div><br><br>

    <input type="submit" name="submit" value="Рассчитать"><br><br>
</form>

<?php //var_dump($_REQUEST)

echo '<script src="https://code.jquery.com/jquery-1.12.4.js"></script>';
echo '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
echo '<script type="text/javascript" src="script.js"></script>';
if (isset($_REQUEST['submit'])) {
    require_once 'calc.php';
}
/*
 * isset — Определяет, была ли установлена переменная значением, отличным от NULL ( НЕ ПУСТАЯ)
 * empty — Проверяет, ПУСТАЯ ли переменная
 * &nbsp; - Cпецсимвол HTML "Неразрывный пробел"
*/
?>
</body>
</html>