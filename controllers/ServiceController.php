<?php

namespace app\controllers;

use app\models\Product;
use app\models\Service;
use app\models\ServiceProduct;
use app\models\ServiceSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Service models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Service();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionManageComponents($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('manage-components', [
            'model' => $model,
        ]);
    }

    public function actionAddProductComponent($id)
    {
        $postData = $this->request->post();
        $errors = [];
        $serviceProduct = new ServiceProduct();

        if (empty($id)) {
            $errors[] = Yii::t('app', 'Service not found');
        }

        $product = Product::findOne(intval($postData['product_id'] ?? 0));
        if (empty($product)) {
            $errors[] = Yii::t('app', 'Product not found');
        }

        $amount = $postData['amount'] ?? 0;
        if (empty($amount)) {
            $errors[] = Yii::t('app', 'The amount must be a number (greater than zero)');
        }

        if (!empty($errors)) {
            Yii::$app->session->setFlash('error', $errors);
            return $this->redirect(['manage-components', 'id' => $id]);
        }

        $serviceProduct = ServiceProduct::findOne([
            'service_id' => $id,
            'product_id' => $product->id,
        ]);

        if (empty($serviceProduct)) {
            $serviceProduct = new ServiceProduct();
            $serviceProduct->service_id = $id;
            $serviceProduct->product_id = $product->id;
        }

        $serviceProduct->amount_used = $amount;
        if (!$serviceProduct->save()) {
            Yii::$app->session->setFlash(
                'error',
                Yii::t('app', 'Sorry! An error occurred and it was not possible to fulfill your request!')
            );
        } else {
            Yii::$app->session->setFlash(
                'success',
                Yii::t('app', 'Product added successfully!')
            );
        }

        return $this->redirect(['manage-components', 'id' => $id]);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
