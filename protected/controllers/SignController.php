<?php

//自定义前面
class SignController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            // 'postOnly + delete', // we only allow deletion via POST request
        );
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
                'actions' => array('scheck'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'insert', 'del', 'update','test'),
                'users' => array('@'),
                //'expression'=>array($this,'loginAndNotDeleted'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function  actionIndex()
    {
        $uid = Yii::app()->user->id;
        $data = Sign::getUserSign($uid); //自定义的签名

        $arr = array(); //固定的签名不可修改的
        $member = Member::model()->findByPk($uid);
        $arr[] = $member->name;
        $arr[] = $member->name . '老师';
        $xing = MainHelper::getXing($member->name);
        if (!empty($xing)) {
            $arr[] = $xing . '老师';
        }
        $this->render('index', array('signs' => $data, 'arr' => $arr));
    }

    public function  actionInsert()
    {
        if (isset($_POST['name'])) {
            $name = trim(MainHelper::safe_string(trim($_POST['name'])));
            $userid=Yii::app()->user->id;
            $signArr=Sign::getUserSignArr(Yii::app()->user->id);
            if(in_array($name,$signArr)){
                die(json_encode(array('status' => '0', 'msg' => '保存失败,已存在相同签名')));
            }
            $mysingnum=count(Sign::getUserSign($userid));

            if($mysingnum>5){
                Yii::app()->msg->postMsg("error",'只能允许最多5个自定义签名');
                die(json_encode(array('status' => '0', 'msg' => '只能允许最多5个自定义签名')));
               // $this->redirect(Yii::app()->createUrl("notice/send"));
                exit();
            }

            $sign = new Sign;
            $sign->userid = Yii::app()->user->id;
            $sign->name = $name;
            $sign->creationtime=date("Y-m-d H:i:s");
            $sign->updatetime=date("Y-m-d H:i:s");
            if ($sign->save()) {
                die(json_encode(array('status' => '1', 'id' => $sign->id)));
            } else {
                die(json_encode(array('status' => '0', 'msg' => '保存失败')));
            }

        }

    }


    public function  actionDel()
    {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            if ($id) {
                $sign = Sign::model()->findByPk($id);
                if ($sign) {
                    $sign->deleted = 1;
                    if ($sign->save()) {
                        die(json_encode(array('status' => '1')));
                    } else {
                        die(json_encode(array('status' => '0', 'msg' => '删除失败')));
                    }
                } else {
                    die(json_encode(array('status' => '0', 'msg' => '删除失败,参数错误')));
                }
            } else {
                die(json_encode(array('status' => '0', 'msg' => '参数错误')));
            }
        }

    }
}