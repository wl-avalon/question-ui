<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/27
 * Time: 下午9:43
 */

namespace app\modules\services\outer\query;
use app\modules\components\PackageParams;
use app\modules\models\beans\QuestionDetailBean;
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
            $questionContent    = self::formatQuestionContent($questionDetailBean);
            $questionAnalysis   = self::formatQuestionAnalysis($questionDetailBean);
            $questionAnswer     = self::formatQuestionAnswer($questionDetailBean);
            $questionList[]     = [
                'questionContent'           => $questionContent,
                'questionAnswer'            => $questionAnswer,
                'questionAnalysis'          => $questionAnalysis,
                'questionKnowledgePoint'    => $questionDetailBean->getQuestionKnowledgePoint(),
                'questionQuestionPoint'     => $questionDetailBean->getQuestionQuestionPoint(),
            ];
        }

        $questionRemark         = explode("\n", trim($questionRecordBean->getQuestionRemark()));
        return [
            'questionRemark'    => $questionRemark,
            'questionList'      => $questionList,
        ];
    }

    private static function formatQuestionContent(QuestionDetailBean $questionDetailBean){
        $questionContentList = explode("\n", trim($questionDetailBean->getQuestionContent()));
        $resultList = [];
        foreach($questionContentList as $contentItem){
            $count = mb_substr_count($contentItem, '{math-ml-image}');
            $explodeMathList = explode('{math-ml-image}', $contentItem);
            $i = 0;
            foreach($explodeMathList as $explodeMathItem){
                $resultList[] = [
                    'textType'  => 'text',
                    'value'     => $explodeMathItem,
                ];
                if($i < $count){
                    $resultList[] = [
                        'textType'  => 'math-ml-image',
                        'value'     => PackageParams::getContentWebPNGFileName($questionDetailBean->getUuid(), $i),
                    ];
                }
                $i++;
            }
        }
        return $resultList;
    }

    private static function formatQuestionAnalysis(QuestionDetailBean $questionDetailBean){
        $questionContentList = explode("\n", trim($questionDetailBean->getQuestionAnalysis()));
        $resultList = [];
        foreach($questionContentList as $contentItem){
            $count = mb_substr_count($contentItem, '{math-ml-image}');
            $explodeMathList = explode('{math-ml-image}', $contentItem);
            $i = 0;
            foreach($explodeMathList as $explodeMathItem){
                $resultList[] = [
                    'textType'  => 'text',
                    'value'     => $explodeMathItem,
                ];
                if($i < $count){
                    $resultList[] = [
                        'textType'  => 'math-ml-image',
                        'value'     => PackageParams::getAnalysisWebPNGFileName($questionDetailBean->getUuid(), $i),
                    ];
                }
                $i++;
            }
        }
        return $resultList;
    }

    private static function formatQuestionAnswer(QuestionDetailBean $questionDetailBean){
        $questionContentList = explode("\n", trim($questionDetailBean->getQuestionAnswer()));
        $resultList = [];
        foreach($questionContentList as $contentItem){
            $count = mb_substr_count($contentItem, '{math-ml-image}');
            $explodeMathList = explode('{math-ml-image}', $contentItem);
            $i = 0;
            foreach($explodeMathList as $explodeMathItem){
                $resultList[] = [
                    'textType'  => 'text',
                    'value'     => $explodeMathItem,
                ];
                if($i < $count){
                    $resultList[] = [
                        'textType'  => 'math-ml-image',
                        'value'     => PackageParams::getAnswerWebPNGFileName($questionDetailBean->getUuid(), $i),
                    ];
                }
                $i++;
            }
        }
        return $resultList;
    }
}