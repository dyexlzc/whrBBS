<?php

!defined('DEBUG') AND exit('Access Denied.');

if ($method == 'GET') {
    $kv = kv_get('kylinde_unread');
	$input['kylinde_unread_color'] = form_text('kylinde_unread_color',$kv['kylinde_unread_color']);
    include _include(APP_PATH.'plugin/1tmo_unread/setting.htm');
} else {
    $kv = array();
    $kv['kylinde_unread_color'] = param('kylinde_unread_color');
    kv_set('kylinde_unread', $kv);
    message(0, jump('修改成功', url('plugin-setting-1tmo_unread')));
}

?>