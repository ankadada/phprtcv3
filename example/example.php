<?php

require join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'lib', 'Pili_v2.php'));

$ak = 'gwd_gV4gPKZZsmEOvAuNU1AcumicmuHooTfu64q5';
$sk = 'xxxx';

$mac = new Qiniu\Pili\Mac($ak, $sk);
$client = new Qiniu\Pili\AppClient($mac);
$hub = 'lfxlive';
$title = 'lfxl';
try {
    //创建app
    $resp = $client->createApp($hub, $title, $maxUsers);
    print_r($resp);
    //获取app状态
    $resp = $client->getApp('deq02uhb6');
    print_r($resp);
    //修改app状态
    $mergePublishRtmp = null;
    $mergePublishRtmp['enable'] = true;
    $resp = $client->UpdateApp('deqq25wl9', $hub, $title, null, $mergePublishRtmp);
    print_r($resp);
    //删除app
    $resp = $client->deleteApp('deq02uhb6');
    print_r($resp);
    //获取房间连麦的成员
    $resp=$client->getappUserNum("deqq25wl9", 'lfx');
    print_r($resp);
    //剔除房间的连麦成员
    $resp=$client->kickingPlayer("deqq25wl9", 'lfx', "qiniu-f6e07b78-4dc8-45fb-a701-a9e158abb8e6");
    print_r($resp);
    // 列举房间
    $resp=$client->listRooms("deqq25wl9", '', '', '');
    print_r($resp);
    //鉴权的有效时间: 1个小时.
    $resp = $client->appToken("deq02uhb6", "lfx", '1111', (time()+3600), 'user');
    print_r($resp);
} catch (\Exception $e) {
    echo "Error:", $e, "\n";
}
