<?php

/** @var yii\web\View $this */

$this->title = 'Genomed test';

?>

<div id="short_link_wrap" class="container text-center">
    <div class="row align-items-start">
        <div class="col">
            <div class="label">Короткая ссылка: </div>
            <a id="short_link" target="_blank"></a>
        </div>
        <div class="col">
            <div class="label">QR-код: </div>
            <div id="qrcode"></div>
        </div>
    </div>
</div>

<div id="short_link_error" class="alert alert-danger"></div>

