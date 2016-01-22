<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-27
 * Time: 下午2:09
 */

class StatisticController extends Controller
{
    /*
     * 安装量统计
     */
    public function actionIndex()
    {
        $param = array();
        $data = array();
        $total = 0;
        $cache = Yii::app()->cache;
        $province_list = $cache->get("all_province_list");
        if (empty($province_list)) {
            $province_list = Area::model()->findAllByAttributes(array('deleted' => 0, 'parentid' => 0, 'type' => 3));;
            $cache->set("all_province_list", $province_list);
        }

        $param['start'] = Yii::app()->request->getParam("start", ''); //开始时间
        if(empty($param['start'])){
            $param['start']=date("Y-m-d",strtotime(" -7 day"));
        }
        $param['end'] = Yii::app()->request->getParam("end", ''); //结束时间
        if(empty($param['end'])){
            $param['end']=date("Y-m-d");
        }
        $param['province'] = Yii::app()->request->getParam("province", ''); //省份
        $param['city'] = Yii::app()->request->getParam("city", ''); //城市
        $param['area'] = Yii::app()->request->getParam("area", ''); //区域
        $param['sid'] = Yii::app()->request->getParam("sid", ''); //学校
        $param['identity'] = Yii::app()->request->getParam("identity", ''); //身份类型
        $param['step'] = Yii::app()->request->getParam("step", '1'); //步长 日周月
        $param['deviceType'] = Yii::app()->request->getParam("deviceType", ''); //设备类型 android ios


        if ($param['province']) {
            $cityData=Area::getCity(array('cid'=>$param['province']));
        } else {
            $cityData = array();
        }
        if ($param['area']) {
            $areaData=Area::getCity(array('cid'=>$param['city']));
            $schoolArr = School::getSchoolArrByArea(array('area' => $param['area']));
        } else {
            $areaData = array();
            $schoolArr = array();
        }


        $list = UserOnline::statistic($param);
        foreach ($list as $val) {
            $data[] = array($val['dd'], (int)$val['num']);
            $total += $val['num'];
        }



//        }else{
//            $param['start'] =''; //开始时间
//            $param['end'] = ''; //结束时间
//            $param['city'] = ''; //城市
//            $param['area'] = ''; //区域
//            $param['sid'] = ''; //学校
//            $param['identity'] = ''; //身份类型
//            $param['step'] = 1; //步长 日周月
//            $param['deciveType'] =  ''; //设备类型 android ios
//        }
//        if (!empty($param['city'])) {
//            $areaArr = Area::getAreaArr(array('cid' => $param['city']));
//        } else {
//            $areaArr = array();
//        }
//




        $allProvinces = Area::getAllprovince(); //所有省份
        $data_str = json_encode($data);
        $cityArr = Area::getCityArr();
        $userid = Yii::app()->user->id;
        //$schoolArr = UserAccess::getUserSchools($userid);
        $this->render('index', array('allProvinces'=>$allProvinces,'total' => $total, 'data_str' => $data_str, 'areas' => $areaData, 'data' => $data, 'citys' => $cityData, 'schools' => $schoolArr, 'query' => $param));

    }
} 