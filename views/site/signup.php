<h1>Sign up</h1>

<?php
    use \yii\widgets\ActiveForm;
?>

<?php
   $form = Activeform::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($model, 'login')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div>
    <button type="submit" class="btn-success">Submit</button>
</div>

<?php
    Activeform::end();
?>

