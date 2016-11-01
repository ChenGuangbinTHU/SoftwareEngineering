<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/10/18
 * Time: 16:20
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Inquiry History';
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('inquiry', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>