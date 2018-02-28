<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/1
 * Time: 上午11:27
 */

namespace app\modules\models\question;
use yii\db\Query;

class CommonModel
{
    private static $db_question_chinese                = null;
    private static $db_question_math                   = null;
    private static $db_question_english                = null;
    private static $db_question_physical               = null;
    private static $db_question_chemistry              = null;
    private static $db_question_biological             = null;
    private static $db_question_political              = null;
    private static $db_question_history                = null;
    private static $db_question_geography              = null;
    private static $db_question_common_technology      = null;
    private static $db_question_internet_technology    = null;

    const DEL_STATUS_NORMAL = 0;
    const DEL_STATUS_DELETE = 1;

    public static function getQuestionDb($dbName){
        switch($dbName){
            case '语文':{
                if(is_null(self::$db_question_chinese)){
                    self::$db_question_chinese = \Yii::$app->db_question_chinese;
                }
                return self::$db_question_chinese;
            }
            case '数学':{
                if(is_null(self::$db_question_math)){
                    self::$db_question_math = \Yii::$app->db_question_math;
                }
                return self::$db_question_math;
            }
            case '英语':{
                if(is_null(self::$db_question_english)){
                    self::$db_question_english = \Yii::$app->db_question_english;
                }
                return self::$db_question_english;
            }
            case '物理':{
                if(is_null(self::$db_question_physical)){
                    self::$db_question_physical = \Yii::$app->db_question_physical;
                }
                return self::$db_question_physical;
            }
            case '化学':{
                if(is_null(self::$db_question_chemistry)){
                    self::$db_question_chemistry = \Yii::$app->db_question_chemistry;
                }
                return self::$db_question_chemistry;
            }
            case '生物':{
                if(is_null(self::$db_question_biological)){
                    self::$db_question_biological = \Yii::$app->db_question_biological;
                }
                return self::$db_question_biological;
            }
            case '政治':{
                if(is_null(self::$db_question_political)){
                    self::$db_question_political = \Yii::$app->db_question_political;
                }
                return self::$db_question_political;
            }
            case '历史':{
                if(is_null(self::$db_question_history)){
                    self::$db_question_history = \Yii::$app->db_question_history;
                }
                return self::$db_question_history;
            }
            case '地理':{
                if(is_null(self::$db_question_geography)){
                    self::$db_question_geography = \Yii::$app->db_question_geography;
                }
                return self::$db_question_geography;
            }
            case '通用技术':{
                if(is_null(self::$db_question_common_technology)){
                    self::$db_question_common_technology = \Yii::$app->db_question_common_technology;
                }
                return self::$db_question_common_technology;
            }
            case '信息技术':{
                if(is_null(self::$db_question_internet_technology)){
                    self::$db_question_internet_technology = \Yii::$app->db_question_internet_technology;
                }
                return self::$db_question_internet_technology;
            }
            default:{
                throw new \Exception('dbName is not exist,name is' . $dbName, 1);
            }
        }
    }

    public static function getQuestionDbByID($subjectID){
        switch($subjectID){
            case '241':
            case '101':
            case '9':{
                if(is_null(self::$db_question_chinese)){
                    self::$db_question_chinese = \Yii::$app->db_question_chinese;
                }
                return self::$db_question_chinese;
            }
            case '245':
            case '103':
            case '11':{
                if(is_null(self::$db_question_math)){
                    self::$db_question_math = \Yii::$app->db_question_math;
                }
                return self::$db_question_math;
            }
            case '105':
            case '13':{
                if(is_null(self::$db_question_english)){
                    self::$db_question_english = \Yii::$app->db_question_english;
                }
                return self::$db_question_english;
            }
            case '107':
            case '15':{
                if(is_null(self::$db_question_physical)){
                    self::$db_question_physical = \Yii::$app->db_question_physical;
                }
                return self::$db_question_physical;
            }
            case '109':
            case '17':{
                if(is_null(self::$db_question_chemistry)){
                    self::$db_question_chemistry = \Yii::$app->db_question_chemistry;
                }
                return self::$db_question_chemistry;
            }
            case '111':
            case '19':{
                if(is_null(self::$db_question_biological)){
                    self::$db_question_biological = \Yii::$app->db_question_biological;
                }
                return self::$db_question_biological;
            }
            case '113':
            case '21':{
                if(is_null(self::$db_question_political)){
                    self::$db_question_political = \Yii::$app->db_question_political;
                }
                return self::$db_question_political;
            }
            case '115':
            case '23':{
                if(is_null(self::$db_question_history)){
                    self::$db_question_history = \Yii::$app->db_question_history;
                }
                return self::$db_question_history;
            }
            case '117':
            case '25':{
                if(is_null(self::$db_question_geography)){
                    self::$db_question_geography = \Yii::$app->db_question_geography;
                }
                return self::$db_question_geography;
            }
            case '231':{
                if(is_null(self::$db_question_common_technology)){
                    self::$db_question_common_technology = \Yii::$app->db_question_common_technology;
                }
                return self::$db_question_common_technology;
            }
            case '235':{
                if(is_null(self::$db_question_internet_technology)){
                    self::$db_question_internet_technology = \Yii::$app->db_question_internet_technology;
                }
                return self::$db_question_internet_technology;
            }
            default:{
                throw new \Exception('dbName is not exist,name is' . $subjectID, 1);
            }
        }
    }

    public static function createSelectCommand($db, $where, $tableName, $fields = [], $limit = 0){
        $whereCondition = [
            'AND',
            ['=', 'del_status', self::DEL_STATUS_NORMAL],
            $where,
        ];

        $command = (new Query())->select($fields)->where($whereCondition)->from($tableName);
        if(!empty($limit)){
            $command->limit($limit);
        }
        return $command->createCommand($db);
    }
}