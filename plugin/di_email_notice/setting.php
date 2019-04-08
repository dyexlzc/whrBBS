<?php

/*
	插件配置文件 (无配置则不需要此文件)
*/

!defined('DEBUG') AND exit('Access Denied.');

if ($method == 'GET') {
	$kv = kv_get('email_notice');
	//var_dump($kv);
	$input = array();
	$input['email'] = form_text('email', $kv['email']);
	$input['password'] = form_text('password', $kv['password']);
	$input['smtp'] = form_text('smtp', $kv['smtp']);
	$input['port'] = form_text('port', $kv['port']);
	$input['fromname'] = form_text('fromname', $kv['fromname']);
	$input['email_title'] = form_text('email_title', $kv['email_title']);
	$input['email_message'] = form_textarea('email_message', $kv['email_message']);
	
	
	
	include _include(APP_PATH.'plugin/di_email_notice/setting.htm');
	
} else {

	$kv = array();
	$kv['email'] = param('email');
	$kv['password'] = param('password');
	$kv['smtp'] = param('smtp');
	$kv['port'] = param('port');
	$kv['fromname'] = param('fromname');
	$kv['email_title'] = param('email_title');
	$kv['email_message'] = param('email_message');


	
	kv_set('email_notice', $kv);
	
	message(0, '修改成功');
}

	
?>