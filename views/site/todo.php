<h1>ToDo List</h1>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin() ?>
<div class = "row">
    <div class ="col-md6">
        <?= $form->field($model_todo, 'title')-> textInput() ?>
    </div>
    <div class ="col-md6">
        <?= $form->field($model_todo, 'description')-> textInput() ?>
    </div>
    <div class ="col-md12">
        <?= Html::submitButton('Create', ['name' => 'Create',
            'value' => 'Create', 'class'=>'btn brn-success']) ?>
    </div>
</div>

<?php $form = ActiveForm::end(); ?>

<table class="table" style="margin-top: 2%">
    <thead>
    <tr>
        <td>Выполнено</td>
        <td>Название</td>
        <td>Описание</td>
        <td>Действия</td>
    </tr>
    </thead>
    <tbody>
    <script>
        function To_Done(id)
        {
            window.location.replace("done/"+id);
        }
    </script>
    <?php foreach ($model_todo2 as $item):?>
    <tr style= "background-color: <?php if ($item->is_done): ?> #f0ad4e" <?php else: ?> #5cb85c" <?php endif ?>>
        <td>
            <?= Html::checkbox('', $item->is_done, ['onclick'=>"To_Done($item->id)"]) ?>
        </td>
        <?php if ($item->is_done): ?>
            <td><del><?=$item->title?></del></td>
            <td><del><?=$item->description?></del></td>
        <?php else: ?>
            <td><?=$item->title?></td>
            <td><?=$item->description?></td>
        <?php endif ?>
        <td>
            <a href="edit/<?=$item->id?>">Edit \</a>
            <a href="delete/<?=$item->id?>">Delete</a>
        </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>



