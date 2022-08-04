<?php

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отображение всех картинок';
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Загрузить изображения', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        echo $sort->link('upload') . ' | ' . $sort->link('filename');?>
        <div class="row">
            <?php foreach ($models as $model):?>
            <div class="col-4">
                <div class="card mb-4" style="" id="<?= $model->id;?>">
                    <div class="card-img">
                        <img src="<?= Yii::$app->params['imgPath'] . $model->filename;?>" class="card-img-top" alt="">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title"><?= $model->filename;?></h6>
                        <p class="card-text"><?= $model->upload;?></p>
                        <a href="<?= Yii::$app->params['imgPath'] . $model->filename;?>" class="btn btn-primary">Полный размер</a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>


</div>
