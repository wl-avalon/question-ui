<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/24
 * Time: 上午11:09
 */

namespace app\modules;
use sp_framework\SpModule;

class Module extends \yii\base\Module {
    public function init() {
        SpModule::setModuleName("question-ui");
    }
}
