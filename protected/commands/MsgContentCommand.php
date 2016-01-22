<?php
class MsgContentCommand extends CConsoleCommand
{
    const DEFAULT_OFFSET = 0;

    public function run($args)
    {
        Yii::import('ext.banban.OfficialAccount_pdu', true);
        set_time_limit(0);
        //$offset = (int)Yii::app()->cache->get("offset");
        //Yii::app()->cache->set("offset", 0);exit;
        $timeStart = time();
        $dbOfficial = Yii::app()->db_official;
        $array = array();

        $dbOfficialName = preg_match("/dbname=(.*)/", $dbOfficial->connectionString, $officialMatch);

        $sql_cnt = "SELECT COUNT(*) AS count FROM ". $officialMatch[1] .".op_content";

        $count = $dbOfficial->createCommand($sql_cnt)->queryAll();

        //if (empty($cnt)) exit("NULL DATA!");

        for ($i = 0; $i < $count[0]['count']; $i += 1000) {
            $sql = "SELECT t.* FROM ". $officialMatch[1] .".op_content AS t LIMIT 1000 OFFSET {$i};";
            $cnt = $dbOfficial->createCommand($sql)->queryAll();

            foreach ($cnt as &$v1) {
                $content = json_decode($v1['content']);
                if ($content === null) {
                    continue;
                }
                foreach ($content as $v2) {
                    foreach ($v2 as $v3) {
                        if ($v3->type === "text") {
                            $array[] = array(
                                "content" => $v3->content,
                                "height" => 0,
                                "type" => ucfirst($v3->type),
                                "width" =>  0
                            );
                        } elseif ($v3->type === "image") {
                            $array[] = array(
                                "content" => $v3->content,
                                "height" => isset($v3->height) ? (int)$v3->height : 0,
                                "type" => ucfirst($v3->type),
                                "width" => isset($v3->width) ? (int)$v3->width : 0
                            );
                        }
                    }
                }
                $v1['content'] = $content;
                //var_dump($v1['msgid']); //打印ID号
                $this->transMsgContent($v1);
            }
        }
        //Yii::app()->cache->set("offset", $offset + 1000);
    }

    public function transMsgContent($arr)
    {
        $stream = '';

        $innerContent = new TOfficialAccountMsgContent();
        $innerContentObject = new TOfficialAccountContentObject();
        $innerContentItem = new TOfficialAccountContentItem();

        $innerContentItemList = new c_vector($innerContentItem);

        if (isset($arr['content']) && !empty($arr['content']->item)) {
            foreach ($arr['content']->item as $v) {
                $c = clone $innerContentItem;
                $c->content->val = isset($v->content) ? $v->content : "";
                if ($v->type === "image") {
                    $c->type->val = "Image";
                    $c->width->val = isset($v->width) ? (int)$v->width : 0;
                    $c->height->val = isset($v->height) ? (int)$v->height : 0;
                } else {
                    $c->type->val = "Text";
                    $c->width->val = 0;
                    $c->height->val = 0;
                }
                $innerContentItemList->push_back($c);

            }
        }

        $innerContentObject->vContentItem = $innerContentItemList;

        $innerContent->mId->val = $arr['msgid'];
        $innerContent->content = $innerContentObject;

        $reqMsg = new TReqUpdateOfficialAccountMsgContent();
        $reqMsg->officialAccountMsgContent = $innerContent;
        $reqMsg->writeTo($stream, 0);

        $_out = self::writeToHttpPackage(169, $stream);
        $response = self::readFromHttpPackage(APOLLO_OFFICIAL_ACCOUNT, $_out);

        return true;
    }

    public static function writeToHttpPackage($CmdType, $stream, $uid = 0)
    {
        $_out = "";
        $request = new THttpPackage;

        $request->sVer->val = APOLLO_CLIENT_TYPE;
        $request->uid->val = 0;
        $request->nClientType->val = APOLLO_CLIENT_TYPE;
        $request->nCMDID->val = $CmdType;
        $request->iSequence->val = time();
        $request->vecData->push_back($stream);

        $request->writeTo($_out, 0);
        return $_out;
    }

    public static function readFromHttpPackage($url, $stream)
    {
        $curl = new Curl();
        $curl->success(function($instance) {

        });

        $curl->error(function($instance) {
            Yii::log("\n".'error url:' . $instance->url . "\n".'error code:' . $instance->error_code . "\n".'error message:' . $instance->error_message . "\n",CLogger::LEVEL_ERROR,'Curl.Apollo');

            var_dump('error url:' . $instance->url . "\n");
            var_dump('error code:' . $instance->error_code . "\n");
            var_dump('error message:' . $instance->error_message . "\n");exit;
        });

        $curl->complete(function($instance) {

        });

        $result = $curl->post($url, $stream);

        $response = new TRespPackage;
        $response->readFrom($result, 0);
        return $response;
    }
}