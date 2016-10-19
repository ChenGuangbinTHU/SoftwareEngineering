<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/17
 * Time: 10:55
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($message , 'file')-> fileInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>