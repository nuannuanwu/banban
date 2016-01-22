<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-24
 * Time: 下午1:49
 * 班班动态
 */

class DynamicController extends Controller{
    /**
     * @return array action filters
     */
    const PAGE_SIZE=2;
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            // 'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function init()
    {

    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('banbandynamic', 'banbanactivity','banbannews','dynamicdetail'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(),
                'users' => array('@'),
                //'expression'=>array($this,'loginAndNotDeleted'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    /*
     * 产品动态　
     */
    public function actionBanbandynamic(){
        $adtype=Yii::app()->request->getParam("type",1);
        $data= BanbanDynamic::model()->pageData(array('adtype'=>1,'size'=>self::PAGE_SIZE));
        $this->renderPartial("banbandynamic", array("list" => $data));
    }

    /*
     * 活动推广
     */
    public function actionBanbanactivity(){
        $data= BanbanDynamic::model()->pageData(array('adtype'=>2,'size'=>self::PAGE_SIZE));
        $this->renderPartial("banbanactivity", array("list" => $data));
    }
    /*
     * 行业资讯
     */
    public function actionBanbannews(){
        $data= BanbanDynamic::model()->pageData(array('adtype'=>3,'size'=>self::PAGE_SIZE));
        $this->renderPartial("banbannews", array("list" => $data));
    }
    /*
    * 详情全文
    */
    public function actionDynamicdetail($id){
        $model= BanbanDynamic::model()->findByPk($id);
        $this->renderPartial("dynamicdetail", array("model" => $model));
    }

} 