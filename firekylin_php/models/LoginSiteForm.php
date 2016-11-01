<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/10/26
 * Time: 21:52
 */
namespace app\models;

 use Yii;
 use yii\base\Model;

 class LoginSiteForm extends Model
 {
     public $username;
     public $password;

     public function rules()
     {
         return [
             // username and password are both required
             [['username', 'password'], 'required'],
         ];
     }
 }