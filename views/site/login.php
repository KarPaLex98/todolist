<h1>Log in</h1>

<?php
use \yii\widgets\ActiveForm;
?>

<?php
$form = Activeform::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($login_model, 'login')->textInput(['autofocus'=>true]) ?>

<?= $form->field($login_model, 'password')->passwordInput() ?>

<div>
    <button class="btn-success" type=submit">Login</button>
</div>

<?php
Activeform::end();
?>

