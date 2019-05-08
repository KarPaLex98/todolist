<h1>Edit Mode</h1>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model_todo, 'title')->textInput() ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model_todo, 'description')->textInput() ?>
    </div>
    <div class="col-md-12">
        <?= Html::submitButton('Change', ['name' => 'Edit',
            'value' => 'Create', 'class'=>'btn brn-success']) ?>
    </div>
</div>
<?php $form = ActiveForm::end(); ?>