//Ввести свой день рождения и посчитать сколько прожито дней - вывести результат в рамке.
<div class = 'test' >
    <?php
    $dr = date ('m.d.Y', mktime (0,0,0,9,30,2020));
    echo $dr;
    ?>
    <br/>
    <?php
    $today = date("m.d.Y");
    echo $today;
    echo '<br>';
    echo '<br>';

    $rez = countDaysBetweenDates($today, $dr);
    echo "<table border='1'>";
    echo $rez;
    echo '</table>';
    ?>

</div>
