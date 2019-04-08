<?php
/*
	插件升级文件
*/
!defined('DEBUG') AND exit('Forbidden');

$kv1 = kv_get('email_notice');

$kv = array();
$kv['email'] = $kv1['email'];
$kv['password'] = $kv1['password'];
$kv['smtp'] = $kv1['smtp'];
$kv['port'] = $kv1['port'];


kv_set('email_notice', $kv);
?>