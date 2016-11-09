<?php

//return [
//    'class' => 'yii\db\Connection',
//    'dsn' => 'mysql:host=168.63.217.199;dbname=firekylin',
//    'username' => 'firekylin',
//    'password' => 'Qa[W@*1923{sWfMk/]z',
//    'charset' => 'utf8',
//];

return [
    'class' => 'yii\db\Connection',

    // 配置主服务器
//    'dsn' => 'mysql:host=168.63.217.199;dbname=firekylin',
//    'username' => 'firekylin',
//    'password' => 'Qa[W@*1923{sWfMk/]z',
    'charset' => 'utf8',
    'tablePrefix' => '',//默认为空


     //配置主服务器
    'masterConfig' => [
        'username' => 'firekylin',
        'password' => 'Qa[W@*1923{sWfMk/]z',
        'attributes' => [
            // use a smaller connection timeout
            PDO::ATTR_TIMEOUT => 10,
        ],
    ],

    //配置主服务器组
    'masters' => [
        ['dsn' => 'mysql:host=168.63.217.199;dbname=firekylin'],
    ],

    // 配置从服务器
    'slaveConfig' => [
        'username' => 'firekylin',
        'password' => 'Qa[W@*1923{sWfMk/]z',
        'charset' => 'utf8',
        'tablePrefix' => '',
        'attributes' => [
    // use a smaller connection timeout
        PDO::ATTR_TIMEOUT => 10,
        ],

    ],

    // 配置从服务器组
    'slaves' => [
    ['dsn' => 'mysql:host=207.46.133.186;dbname=firekylin'],
        ['dsn' => 'mysql:host=13.75.113.54;dbname=firekylin'],
],

    // 配置主服务器
//    'masterConfig' => [
//        'username' => 'firekylin',
//        'password' => 'Qa[W@*1923{sWfMk/]z',
//        'attributes' => [
//            // use a smaller connection timeout
//            PDO::ATTR_TIMEOUT => 10,
//        ],
//    ],

     //配置主服务器组
//    'masters' => [
//        ['dsn' => 'mysql:host=168.63.217.199;dbname=firekylin'],
        //['dsn' => 'dsn for master server 2'],
    //],
];