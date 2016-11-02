<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/10/26
 * Time: 21:59
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
$this->title = 'Login';

?>



<?php $form = ActiveForm::begin(); ?>


<div class = 'firekylin-login'>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to login:</p>
    <?=$form->field($model,'username')->textInput(['autofocus'=>true])?>
    <?=$form->field($model,'password')->passwordInput()?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
