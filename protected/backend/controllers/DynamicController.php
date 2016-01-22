<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-23
 * Time: 下午5:15
 * 班班动态管理
 */

class DynamicController extends Controller{
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    //列表
    public function actionIndex(){
        $query = isset($_GET['Dynamic']) ? $_GET['Dynamic'] : array('title'=>'','adtype'=>'');
        $data = BanbanDynamic::model()->pageData($query);
        $typearr=BanbanDynamic::$typearr;
        $this->render('index',array('data'=>$data,'query'=>$query,'typearr'=>$typearr));
    }


    public function actionCreate()
    {
        $model=new BanbanDynamic;
        $typearr=BanbanDynamic::$typearr;

        if(isset($_POST['Dynamic']))
        {
            $model->attributes=$_POST['Dynamic'];
            $model->image = $_POST['Dynamic']['image'];
            $model->deleted = 0;
            $model->state=1;
            $model->addesc=htmlspecialchars($model->addesc);
            $model->creationtime=date("Y-m-d H:i:s");
            $model->uid = Yii::app()->user->id;
            $model->save();
            if($model->save()){
                Yii::app()->msg->postMsg('success', '创建成功');
                $this->redirect(array('index'));
            }
        }
        $this->render('update',array(
            'model'=>$model,'imageFlag'=>0,'typearr'=>$typearr
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=BanbanDynamic::model()->findByPk($id);
        $typearr=BanbanDynamic::$typearr;
        if(isset($_POST['Dynamic']))
        {
            $oldimage = $model->image;
            $model->attributes=$_POST['Dynamic'];
          //  $model->image = STORAGE_QINNIU_XIAOXIN_TX.$_POST['Dynamic']['image'];
            $model->image = $_POST['Dynamic']['image'];
            $model->addesc=htmlspecialchars($model->addesc);
            $model->updatetime=date("Y-m-d H:i:s");
            if($model->save()){
                Yii::app()->msg->postMsg('success', '修改成功');
                $this->redirect(array('index'));
            }
        }

        $this->render('update',array(
            'model'=>$model,'imageFlag'=>1,'typearr'=>$typearr
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model=BanbanDynamic::model()->findByPk($id);
        $isdelete=false;
        if($model){
            $model->deleted=1;
            if($model->save()){
                $isdelete=true;
            }
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            if($isdelete){
                Yii::app()->msg->postMsg('success', '删除成功');
            }else{
                Yii::app()->msg->postMsg('error', '删除失败');
            }
         $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }
} 