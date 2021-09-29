<?php

// Отображение показателей
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;
//use TesseractOCR;
//use thiagoalessio\TesseractOCR\TesseractOCR;
//require_once './src/TesseractOCR.php';
include "thiagoalessio/tesseract_ocr/src/TesseractOCR.php";


$this->title = 'Распознавание картинки:';
$this->params['breadcrumbs'][] = $this->title;
?>

<? $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Распознавание картинки </div>
        <div id="header_content_tagline">  </div>
    </div>
</div>

<? $this->endBlock(); ?>


<div class="form-group">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php
    $tesseract = new TesseractOCR('cnt1.jpg');
    $tesseract->whitelist (range ( '0' , '9' ));
//    $tesseract->config('load_system_dawg','0');
//    $tesseract->config('load_freq_dawg','0');
//    $tesseract->config('load_number_dawg','1');
//    $tesseract->config('classify_enable_learning','0');
//    $tesseract->config('classify_enable_adaptive_matcher','0');
    $tesseract->config('classify_bln_numeric_mode','1');
//    $tesseract->lang('eng');
    for($i=1;$i<14;$i++) {
//        $tesseract->config("textord_spline_medianwin", 6 );
        $tesseract->psm($i);
//        $tesseract->oem(3);
        $text = $tesseract->run();
        echo "The recognized text is: " . $text;
        echo '<br>';
        echo strlen($text);
        echo '<br>';
    }

    ?>


</div>





