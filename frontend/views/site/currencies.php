<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Currencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($currencies as $currency): ?>
        <p>
            <a href="<?= \yii\helpers\Url::to(['site/currency', 'id' => $currency->id]) ?>">
                <?= $currency->name; ?></a> - <?= $currency->rate; ?> </p>
    <?php endforeach; ?>
<div class="col-md-12 text-center">
    <?= \yii\widgets\LinkPager::widget([
       'pagination' => $pages,

    ]);
    ?>
</div>

</div>
