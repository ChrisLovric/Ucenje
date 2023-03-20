<?php

$dev=$_SERVER['SERVER_ADDR']==='192.168.0.131' ? true : false;

if($dev){
    return [
        'dev'=>$dev,
        'formatBroja'=>'###,##0.00',
        'url'=>'http://app.hr/',
        'nazivApp'=>'Edunova APP',
        'brps'=>10,
        'baza'=>[
            'dsn'=>'mysql:host=localhost;dbname=edunovapp26;charset=utf8mb4',
            'user'=>'root',
            'password'=>''
        ]
    ];
}else{

return [
    'dev'=>$dev,
    'formatBroja'=>'###,##0.00',
    'url'=>'http://app.hr/',
    'nazivApp'=>'Edunova APP',
    'brps'=>10,
    'baza'=>[
        'dsn'=>'mysql:host=localhost;dbname=edunovapp26;charset=utf8mb4',
        'user'=>'root',
        'password'=>''
    ]
];
}