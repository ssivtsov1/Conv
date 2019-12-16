<?php
$data8='Павлоградські РЕМ';
$rrem = mb_substr($data8,mb_strlen($data8,'UTF-8')-4,3,'UTF-8');
echo $rrem;