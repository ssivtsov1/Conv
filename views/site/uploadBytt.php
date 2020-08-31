
<div class ='test'>
    <?php
//    debug ($model);
//     echo $f;
    //Проверка файла PARTNER на пустые поля
    $pa = $model['file'];
    $name_v2 = stristr($pa, '_', true);
    if($name_v2 == 'PARTNER')
        fieldPARTNERbyt ($pa);


    //Проверка файла CONNOBJ на пустые поля
    if($name_v2 == 'CONNOBJ')
        fieldCONNOBJbyt ($pa);


    //Проверка файла PREMISE на пустые поля
    if($name_v2 == 'PREMISE')
        fieldPREMISEbyt ($pa);

    //Проверка файла ACCOUNT на пустые поля
    if($name_v2 == 'ACCOUNT')
        fieldACCOUNTbyt ($pa);

    //Проверка файла DEVLOC на пустые поля
    if($name_v2 == 'DEVLOC')
        fieldDEVLOCbyt ($pa);

    //Проверка файла DEVICE на пустые поля
    if($name_v2 == 'DEVICE')
        fieldDEVICEbyt ($pa);

    //Проверка файла SEAL на пустые поля
    if($name_v2 == 'SEAL')
        fieldSEALbyt ($pa);

    //Проверка файла INSTLN на пустые поля
    if($name_v2 == 'INSTLN')
        fieldINSTLNbyt ($pa);


    //Проверка файла INST_MGMT на пустые поля
    if($name_v2 == 'INST')
        fieldINSTMGMTbyt ($pa);


    //Проверка файла MOVE_IN на пустые поля
    if($name_v2 == 'MOVE')
        fieldMOVEINbyt ($pa);

    ?>
</div>
