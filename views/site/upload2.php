<div class ='test'>
    <?php
    //Проверка файла INSTLN на пустые поля
//    debug ($model);
//    echo $f;
    $in = $model['file'];
    $name_v = stristr($in, '_', true);
    if($name_v=='INSTLN')
        fieldINSTLN ($in);

    //Проверка файла DEVLOC на пустые поля
    if($name_v=='DEVLOC')
        fieldDEVLOC ($in);

    //Проверка файла ZLINES на пустые поля
    if($name_v=='ZLINES')
        fieldZLINES ($in);


    //Проверка файла SEALS на пустые поля
    if($name_v=='SEALS')
        fieldSEALS ($in);

    //Проверка файла PARTNER на пустые поля
    if($name_v=='PARTNER')
        fieldPARTNER ($in);


    //Проверка файла INSTLNCHA на пустые поля
    if($name_v=='INSTLNCHA')
        fieldINSTLNCHA ($in);


    //Проверка файла DEVICE на пустые поля
    if($name_v=='DEVICE')
        fieldDEVICE ($in);


    //Проверка файла DEVGRP на пустые поля
    if($name_v=='DEVGRP')
        fieldDEVGRP ($in);


    //Проверка файла MOVE_IN на пустые поля
    if($name_v=='MOVE')
        fieldMOVEIN ($in);


    ?>
</div>
