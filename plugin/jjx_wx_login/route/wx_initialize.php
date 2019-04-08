<?php
!defined('DEBUG') AND exit('Access Denied.');

$lang += include _include(APP_PATH."lang/$conf[lang]/bbs_admin.php");
$_SERVER['lang'] = $lang;
include _include(APP_PATH.'plugin/jjx_wx_login/model/wx_login.func.php');
$action = param(1);
$_SESSION['uid'] = $uid;
$info = db_find_one('user', array('uid'=>$uid));

if('update' == $action){
	$email = param('email');
	$username = param('username');
	$password = param('password');
	$_gid = param('_gid');
	
	empty($email) AND message('email', lang('please_input_email'));
	$email AND !is_email($email, $err) AND message('email', $err);
	$username AND !is_username($username, $err) AND message('username', $err);

	$_user = user_read_by_email($email);
	$_user AND message('email', lang('email_is_in_use'));
	if($info['username'] != $username){
		$_user = user_read_by_username($username);
		$_user AND message('username', lang('user_already_exists'));
	}
	
	$salt = xn_rand(16);
	$pwd = md5($password.$salt);
	$r = array(
		'username'=>$username,
		'password'=>$pwd,
		'salt'=>$salt,
		'gid'=>101,
		'email'=>$email,
		'create_ip'=>ip2long(ip()),
		'create_date'=>$time
	);
	$r = user__update($info['uid'],$r);
	if($r){
		message(0, jump('绑定成功', url('index'), 2));
	}else{
		message(-1, lang('create_failed'));
	}
		
	// hook admin_user_create_post_end.php
	
}
include _include(APP_PATH.'plugin/jjx_wx_login/template/wx_initialize.htm');
?>
