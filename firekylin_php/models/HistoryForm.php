<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/10/18
 * Time: 17:07
 */

namespace app\models;
use Yii;
use yii\base\Model;

class HistoryForm extends Model
{
    public $id;
    public $content;
    public $sendNum;
    public $deviceNum;
    public $reachNum;
    public $showNum;
    public $clickNum;
    public function rules() {
        return array(
          [['id','content','sendNum','deviceNum','reachNum','showNum','clickNum'],'required'],
        );
    }
}