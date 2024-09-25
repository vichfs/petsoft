<?php

//var_dump($model);

use app\models\Product;
use kartik\number\NumberControl;

$serviceProducts = $model->getServiceProducts()
    ->joinWith('product')
    ->orderBy(['products.description' => SORT_ASC])
    ->all();
$totalCost = 0.0;

$css = <<<CSS
    .form-service-products form {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 1.2rem;
        margin: 1.5rem 0;
    }
CSS;

$this->registerCss($css);

?>

<h1><?= Yii::t('app', 'Service Components') ?>: <?= $model->description ?></h1>

<div class="form-service-products">
    <form method="post" action="/index.php?r=service/add-product-component&id=<?= $model->id ?>">
        <fieldset>
            <legend><?= Yii::t('app', 'Add product to service') ?></legend>
            <input name="id" type="hidden" value="<?= $model->id ?>">
            <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">

            <div class="row">
                <div class="col-sm">
                    <label for="product"><?= Yii::t('app', 'Product') ?></label>
                    <select class="form-select" aria-label="<?= Yii::t('app', 'Select the product') ?>" name="product_id" id="product">
                        <option value=""></option>
                        <?php foreach (Product::find()->orderBy(['description' => SORT_ASC])->all() as $product) : ?>
                            <option value="<?= $product->id ?>"><?= $product->description ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm">
                    <label for="amount-widget"><?= Yii::t('app', 'Amount') ?></label>
                    <?php
                    echo NumberControl::widget([
                        'name' => 'amount',
                        'maskedInputOptions' => [
                            'groupSeparator' => Yii::$app->params['numericMask']['groupSeparator'],
                            'radixPoint' => Yii::$app->params['numericMask']['radixPoint'],
                            'digits' => 4,
                        ],
                        'options' => [
                            'id' => 'amount',
                            'type' => 'text',
                        ],
                        'displayOptions' => [
                            'id' => 'amount-widget',
                            'class' => 'form-control',
                        ]
                    ]);
                    ?>
                </div>
            </div>

            <div class="row" style="margin-top: 5px;">
                <div class="col">
                    <input class="btn btn-primary" type="submit" value="<?= Yii::t('app', 'Add') ?>">
                </div>
            </div>
        </fieldset>
    </form>
</div>

<div class="grid-view table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><?= Yii::t('app', 'Produto') ?></th>
                <th class="text-center" scope="col"><?= Yii::t('app', 'Unidade') ?></th>
                <th class="text-end" scope="col"><?= Yii::t('app', 'Quantidade') ?></th>
                <th id="product-cost" class="text-end" scope="col"><?= Yii::t('app', 'Custo') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($serviceProducts as $serviceProduct) : ?>
                <?php
                $product = $serviceProduct->getProduct()->one();
                $productCost = $serviceProduct->amount_used * $product->cost;
                ?>
                <tr>
                    <td><?= Yii::t('app', $product->description) ?></td>
                    <td class="text-center"><?= Yii::t('app', $product->unit) ?></td>
                    <td class="text-end"><?=
                                            Yii::$app->formatter->asDecimal(
                                                $serviceProduct->amount_used,
                                                4
                                            )
                                            ?></td>
                    <td class="text-end">
                        <?= Yii::$app->formatter->asCurrency($productCost) ?>
                    </td>
                </tr>
                <?php $totalCost += $productCost; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td class="text-end" headers="product-cost">
                    <?= Yii::$app->formatter->asCurrency($totalCost) ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>