<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/27
 * Time: 下午9:43
 */

namespace app\modules\services\outer\query;
use app\modules\models\question\QuestionDetailModel;
use app\modules\models\question\QuestionRecordModel;

class GetRandomQuestionByConditionService
{
    public static function getRandomQuestionByCondition($grade = 0, $subject = 0, $version = 0, $module = 0, $nodeID = 0){
        $questionDetailBean = QuestionDetailModel::queryOneQuestionByCondition($grade, $subject, $version, $module, $nodeID);
        $questionRecordID   = $questionDetailBean->getQuestionRecordUuid();
        $questionRecordBean = QuestionRecordModel::queryOneRecordByUuid($questionRecordID, $subject);
        $questionDetailList = QuestionDetailModel::queryQuestionListByRecordUuid($questionRecordID, $subject);

        $questionList = [];
        foreach($questionDetailList as $questionDetailBean){
            $questionContent    = explode("\n", $questionDetailBean->getQuestionContent());
            $questionAnalysis   = explode("\n", $questionDetailBean->getQuestionAnalysis());
            $questionAnswer     = explode("\n", $questionDetailBean->getQuestionAnswer());
            $questionList[]     = [
                'questionContent'           => $questionContent,
                'questionAnswer'            => $questionAnswer,
                'questionAnalysis'          => $questionAnalysis,
                'questionKnowledgePoint'    => $questionDetailBean->getQuestionKnowledgePoint(),
                'questionQuestionPoint'     => $questionDetailBean->getQuestionQuestionPoint(),
            ];
        }

        $questionRemark         = explode("\n", $questionRecordBean->getQuestionRemark());
        return [
            'questionRemark'    => $questionRemark,
            'questionList'      => $questionList,
        ];
    }
}