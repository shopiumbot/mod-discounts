<?php
use yii\helpers\ArrayHelper;
use core\modules\shop\models\Manufacturer;
use panix\engine\jui\DatetimePicker;

/**
 * @var \shopium\mod\discounts\models\Discount $model
 * @var \panix\engine\bootstrap\ActiveForm $form
 */

?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
<?= $form->field($model, 'sum')->textInput(['maxlength' => 10])->hint($model::t('HINT_SUM')) ?>
<?= $form->field($model, 'start_date')->widget(DatetimePicker::class, [])->textInput(['maxlength' => 19,'autocomplete'=>'off']) ?>
<?= $form->field($model, 'end_date')->widget(DatetimePicker::class, [])->textInput(['maxlength' => 19,'autocomplete'=>'off']) ?>

<?= $form->field($model, 'manufacturers')
    ->dropDownList(ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'), [
        'prompt' => html_entity_decode($model::t('SELECT_EMPTY_MANUFACTURER')),
        'multiple' => 'multiple'
    ])->hint($model::t('HINT_MANUFACTURERS'));
?>

