<?php
use core\modules\shop\models\Category;
use panix\engine\Html;

?>
    <div class="form-group row2">
        <div class="alert alert-info"><?= Yii::t('discounts/default', "CATEGORY_INFO"); ?></div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <?= Html::textInput('search', null, [
                'id' => 'search-discount-category',
                'class' => 'form-control',
                'placeholder' => Yii::t('default', 'SEARCH'),
                'onClick' => '$("#CategoryTree").jstree("search", $(this).val());'
            ]); ?>
        </div>
    </div>


<?php

echo \panix\ext\jstree\JsTree::widget([
    'id' => 'CategoryTree',
    'allOpen' => true,
    'data' => Category::find()->dataTree(1, null, ['switch' => 1]),
    'core' => [
        'strings' => [
            'Loading ...' => Yii::t('app/default', 'LOADING')
        ],
        'check_callback' => true,
        "themes" => [
            "stripes" => true,
            'responsive' => true,
            "variant" => "large",
            // 'name' => 'default-dark',
            // "dots" => true,
            // "icons" => true
        ],
    ],
    'plugins' => ['search', 'checkbox'],
    'checkbox' => [
        'three_state' => false,
        "keep_selected_style" => false,
        'tie_selection' => false,
    ],
]);

foreach ($model->getCategories() as $id) {

    $this->registerJs("$('#jsTree_CategoryTree').checkNode({$id});", yii\web\View::POS_END, "checkNode{$id}");
}

