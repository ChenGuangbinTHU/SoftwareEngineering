<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/27
 * Time: 10:11
 */

namespace app\components;
use yii\base\Widget;
class SideBar extends Widget {
    public function run() {
        return $this->render("sidebar");
    }
}
?>