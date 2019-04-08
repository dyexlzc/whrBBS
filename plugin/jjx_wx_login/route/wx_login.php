<?php
!defined('DEBUG') AND exit('Access Denied.');

include _include(APP_PATH.'plugin/jjx_wx_login/model/wx_login.func.php');
$action = param(1);
$uid = intval(_SESSION('uid'));
$return_url = http_url_path().url('wx_login-return');
//默认未初始化
$not_initialize = true;
if(empty($action)) {
	$link = wx_login_link($return_url);
	http_location($link);
} elseif($action == 'return') {
	$wx_login = kv_get('wx_login');
	$appid = $wx_login['appid'];
	$appkey = $wx_login['appkey'];
	$code = param('code');
	// token 保存起来，提高速度
	$token = wx_login_get_token($appid, $appkey, $code, $return_url);
	!$token AND message($errno, $errstr);
	// 获取 openid
	$openid = wx_login_get_openid_by_token($token,$appid);
	// 如果有 openid，则直接自动登陆
	$user = wx_login_read_user_by_openid($openid);
	if(!$user) {
		$wxuser = wx_login_get_user_by_openid($openid, $token);
		$user = wx_login_create_user($wxuser['nickname'], $wxuser['headimgurl'], $openid);
	}else{
		$not_initialize = wx_is_initialized($user['uid']);//初始化
	}
	$uid = $user['uid'];
	$_SESSION['uid'] = $uid;
	user_token_set($uid);
	if($not_initialize){
		message(0, jump('登陆成功,请绑定论坛账号', url('wx_initialize'), 2));
	}else{
		message(0, jump('登陆成功', url('index'), 2));
	}
}
?>
