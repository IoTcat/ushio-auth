<?php

include './functions.php';

$from = $_REQUEST['from'];


$cnn = db__connect();

if(isset($_COOKIE['_token']) && db__rowNum($cnn, "token", "token", $_COOKIE['_token'])){
    db__pushData($cnn, "token", array(
        "state"=>'0',
        "updated_at"=>date("Y-m-d H:i:s", time())
    ), array(
        "token"=>$_COOKIE['_token']
    ));
    $redis->hSet('session/dialog/'.$_COOKIE['_token'], 'group', 'anonymous');
}

if($from)
    echo '<script>window.location.href="'.base64_decode($from).'"</script>';
else
    echo '<script>window.location.href="https://login.yimian.xyz/"</script>';
