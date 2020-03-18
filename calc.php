<?php
require_once 'index.php';
/**
 * Данные присылаются POST запросом.
 * summn = summn-1 + (summn-1 + summadd) * daysn * (percent / daysy) - сумма на счете на конец месяца n (руб)
 */

$percent = 0.1; // процентная ставка
$summn = $_REQUEST['sum']; // СУММА ВКЛАДА
$deposit_term = $_REQUEST['term']; //срок вклада (лет) от 1 до 5 лет

$replenishment = $_REQUEST['replenishment']; // есть ли пополнение 'no' or 'yes'
$summadd = $_REQUEST['summ']; //сумма Ежемесяцного пополнения
if (!$summadd) {
    $summadd = 0;
}

$date = explode('-', $_REQUEST['date']); // дата заключения договора [ГОД, МЕСЯЦ, ДЕНЬ]
$date_timestamp = mktime(0, 0, 0, $date[1], $date[2], $date[0]); /*дата заключения договора
 в формате timestamp */
echo 'Дата заключения договора: ' . $_REQUEST['date'], '<br><br>';

$deposit_day = date('j', $date_timestamp); // ДЕНЬ заключения договора
$deposit_month = date('n', $date_timestamp); // МЕСЯЦ заключения договора
$current_year = date('Y', $date_timestamp);// ГОД заключения договора

$rest_days_month = date('t', $date_timestamp) - $deposit_day;   /*колличество дней до
   конца месяца от даты заключения договора*/

for ($j = 1; $j <= $deposit_term; $j++, $current_year++) {// расчет процентов в зависимости от срока вклада
    $year_L = date('L', mktime(0, 0, 0, $date[1], $date[2], $current_year)); /*високосный
 ли год*/

    if ($year_L == 1) { //  колличество дней в году
        $daysy = 366; // Високосный год
    } else {
        $daysy = 365;
    }

    $percent_day = $percent / $daysy; // процентная ставка в день в зависимости от типа года $current_year
    //echo $percent_day . '<br>';
    $summn_1 = $summn;

    //echo $current_year . '<br>';

    if ($j == 1) {
        $summn = $summn + $summn * $rest_days_month * $percent_day; // начисления за первый неполный месяц
    } elseif ($j > 1 and $j < $deposit_term) { // условие расчета каждого первого месяца на которые приходился вклад, если вклад больше 1 года
        $daysn = date('t', mktime(0, 0, 0, $date[1], $date[2], $current_year)); /* количество
 дней в месяце вклада, в зависимости от года $current_year.*/
        $summn += $summadd + ($summn_1 + $summadd) * $daysn * $percent_day;
    }

    for ($i = $deposit_month + 1; $i <= 12; $i++) { // цикл от следующего месяца после даты заключения и до декабря
        $daysn = date('t', mktime(0, 0, 0, $i, $date[2], $current_year)); /* количество
 дней в указанном $iом месяце в зависимости от года $current_year.*/
        $summn += $summadd + ($summn_1 + $summadd) * $daysn * $percent_day;
    }

    for ($i = 1; $i <= $deposit_month - 1; $i++) { //цикл от нового года до месяца заключения договора(не включительно)
        $daysn = date('t', mktime(0, 0, 0, $i, $date[2], $current_year));/*количество
 дней в указанном $iом месяце в зависимости от года $current_year.*/
        $summn += $summadd + ($summn_1 + $summadd) * $daysn * $percent_day;
    }
    if ($j == $deposit_term) {
        $deposit_day = date('j', mktime(0, 0, 0, $date[1], $date[2], $current_year +1));
        $summn += $summadd + ($summn_1 + $summadd) * $deposit_day * $percent_day; // начисления за последний неполный месяц
    }
}
echo $summn;




