<?php
function cover_id_string($id)
{
    if($id=="1") return "哲学";
elseif($id=="2") return "经济学";

elseif($id=="4") return "历史学";
elseif($id=="5") return "法学";
elseif($id=="6") return "马克思主义理论";
elseif($id=="7") return "社会学";
elseif($id=="8") return "政治学";
elseif($id=="9") return "公安学";
elseif($id=="10") return "教育学";
elseif($id=="11") return "体育学";
elseif($id=="12") return "职业技术教育";
elseif($id=="13") return "新闻传播学";
elseif($id=="14") return "中国语言文学";
elseif($id=="15") return "外国语言文学";
elseif($id=="16") return "艺术";
elseif($id=="17") return "数学";
elseif($id=="18") return "物理学";
elseif($id=="19") return "化学";
elseif($id=="20") return "生物科学";
elseif($id=="21") return "天文学";
elseif($id=="22") return "地理科学";
elseif($id=="23") return "地球物理学";
elseif($id=="24") return "大气科学";
elseif($id=="25") return "海洋科学";
elseif($id=="26") return "力学";
elseif($id=="27") return "农业工程";
elseif($id=="28") return "环境科学";
elseif($id=="29") return "心理学";
elseif($id=="30") return "统计学";
elseif($id=="31") return "系统科学";
elseif($id=="32") return "地矿";
elseif($id=="33") return "机械";
elseif($id=="34") return "仪器仪表";
elseif($id=="35") return "能源动力";
elseif($id=="36") return "电气信息";
elseif($id=="37") return "土建";
elseif($id=="38") return "测绘";
elseif($id=="39") return "环境与安全";
elseif($id=="40") return "化工与制药";
elseif($id=="41") return "交通运输";
elseif($id=="42") return "海洋工程";
elseif($id=="43") return "航空航天";
elseif($id=="44") return "武器";
elseif($id=="45") return "工程力学";
elseif($id=="46") return "生物工程";
elseif($id=="47") return "公安技术";
elseif($id=="48") return "材料科学";
elseif($id=="49") return "材料";
elseif($id=="50") return "水利";
elseif($id=="51") return "林业工程";
elseif($id=="52") return "轻工纺织食品";
elseif($id=="53") return "电子信息科学";
elseif($id=="54") return "植物生产";
elseif($id=="55") return "草业科学";
elseif($id=="56") return "森林资源";
elseif($id=="57") return "环境生态";
elseif($id=="58") return "动物生产";
elseif($id=="59") return "动物医学";
elseif($id=="60") return "水产";
elseif($id=="61") return "基础医学";
elseif($id=="62") return "预防医学";
elseif($id=="63") return "药学";
elseif($id=="64") return "口腔医学";
elseif($id=="65") return "中医学";
elseif($id=="66") return "法医学";
elseif($id=="67") return "护理学";
elseif($id=="68") return "临床医学与医学技术";
elseif($id=="69") return "工商管理";
elseif($id=="70") return "管理科学与工程";
elseif($id=="71") return "公共管理";
elseif($id=="72") return "农业经济管理";
elseif($id=="73") return "图书档案学";

}
!defined('DEBUG') AND exit('Access Denied.');

include _include(XIUNOPHP_PATH.'xn_send_mail.func.php');

$action = param(1);

is_numeric($action) AND $action = '';

if($action == 'digest') {

	$_uid = param(2, 1);
	$page = param(3, 1);
	$pagesize = 20;
	
	$_user = user_read($_uid);
	$digests = $_user['digests'];
	$pagination = pagination(url("user-$_uid-{page}-1"), $digests, $page, $pagesize);
	$threadlist = thread_digest_find_by_uid($_uid, $page, $pagesize);
	
	thread_list_access_filter($threadlist, $gid);
	
	$active = 'thread';
	if($ajax) {
		foreach($threadlist as &$thread) $thread = thread_safe_info($thread);
		message(0, $threadlist);
	} else {
		include _include(APP_PATH.'view/htm/user.htm');
		exit;
	}
}
if($action == 'post') {
	
	
	
	$_uid = param(2, 0);
	$_user = user_read($_uid);
	
	$page = param(3, 1);
	$pagesize = 20;
	$totalnum = $_user['posts'];
	$pagination = pagination(url("user-post-$_uid-{page}"), $totalnum, $page, $pagesize);
	$postlist = post_find_by_uid($_uid, $page, $pagesize);
	
	post_list_access_filter($postlist, $gid);
	
	if($ajax) {
	foreach($postlist as &$post) $post = post_safe_info($post);
	message(0, $postlist);
}
	
	include _include(APP_PATH.'plugin/xn_mypost/view/htm/user_post.htm');
}

if(empty($action)) {

        

        $_uid = param(1, 0);
        empty($_uid) AND $_uid = $uid;
        $_user = user_read($_uid);

       // empty($_user) AND message(-1, lang('user_not_exists'));
        $header['title'] = $_user['username'];
        $header['mobile_title'] = $_user['username'];

        if($ajax) {
	$_user = user_safe_info($_user);
        foreach($threadlist as &$thread) $thread = thread_safe_info($thread);
        message(0, array('user'=>$_user, 'threadlist'=>$threadlist));
}
        
	include _include(APP_PATH.'view/htm/user.htm');
	
} elseif($action == 'thread') {

        

        $_uid = param(2, 0);
        empty($_uid) AND $_uid = $uid;
        $_user = user_read($_uid);
        
        empty($_user) AND message(-1, lang('user_not_exists'));
        $header['title'] = $_user['username'];
        $header['mobile_title'] = $_user['username'];

        $page = param(3, 1);
        $pagesize = 20;
        $totalnum = $_user['threads'];
        $pagination = pagination(url("user-thread-$_uid-{page}"), $totalnum, $page, $pagesize);
        $threadlist = mythread_find_by_uid($_uid, $page, $pagesize);
        thread_list_access_filter($threadlist, $gid);

        
       
	include _include(APP_PATH.'view/htm/user_thread.htm');
	
} elseif($action == 'login') {

	
	
	if($method == 'GET') {

		
		
		$referer = user_http_referer();
			
		$header['title'] = lang('user_login');
		
		
		
		include _include(APP_PATH.'view/htm/user_login.htm');

	} else if($method == 'POST') {

		
		$email = param('email');			// 邮箱或者手机号 / email or mobile
		$password = param('password');
		empty($email) AND message('email', lang('email_is_empty'));
		if(is_email($email, $err)) {
			$_user = user_read_by_email($email);
			empty($_user) AND message('email', lang('email_not_exists'));
		} else {
			$_user = user_read_by_username($email);
			empty($_user) AND message('email', lang('username_not_exists'));
		}

		!is_password($password, $err) AND message('password', $err);
		md5($password.$_user['salt']) != $_user['password'] AND message('password', lang('password_incorrect'));

		// 更新登录时间和次数
		// update login times
		user_update($_user['uid'], array('login_ip'=>$longip, 'login_date' =>$time , 'logins+'=>1));

		// 全局变量 $uid 会在结束后，在函数 register_shutdown_function() 中存入 session (文件: model/session.func.php)
		// global variable $uid will save to session in register_shutdown_function() (file: model/session.func.php)
		$uid = $_user['uid'];

	
		$_SESSION['uid'] = $uid;
		
		user_token_set($_user['uid']);
		user_name_set($email); //设置用户名进入cook

		
		
		// 设置 token，下次自动登陆。
		
		message(0, lang('user_login_successfully'));

	}


} elseif($action == 'create') {

	

!empty($conf['user_create_io']) && message(0, jump('对不起, 已经关闭会员注册', http_referer(), 1));


	
	empty($conf['user_create_on']) AND message(-1, lang('user_create_not_on'));
	
	if($method == 'GET') {
		
		
		
		$referer = user_http_referer();
		$header['title'] = lang('create_user');
		
		
		
		include _include(APP_PATH.'view/htm/user_create.htm');

	} else if($method == 'POST') {
				
		
		
		$email = param('email');
		$username = param('username');
        $password = param('password');
        
        $realname=param('realname');
        $sex=param('sex');
        $province=param('province');
        $school=param('city');
        $xueli=param('xueli');
        $year=param('year');
        $major=param('major');
        $major_text=cover_id_string($major);  //将专业对应的id转为文本，好累

        $other= $major_text."-".param('other');

        $code = param('code');
        empty($realname) AND message('realname', "请输入姓名");
        empty($other) AND message('other', "请尽可能详细的描述自己哦");

		empty($email) AND message('email', lang('please_input_email'));
		empty($username) AND message('username', lang('please_input_username'));
		empty($password) AND message('password', lang('please_input_password'));
		
		if($conf['user_create_email_on']) {
			$sess_email = _SESSION('user_create_email');
			$sess_code = _SESSION('user_create_code');
			empty($sess_code) AND message('code', lang('click_to_get_verify_code'));
			empty($sess_email) AND message('code', lang('click_to_get_verify_code'));
			$email != $sess_email AND message('code', lang('verify_code_incorrect'));
			$code != $sess_code AND message('code', lang('verify_code_incorrect'));
		}
		
		!is_email($email, $err) AND message('email', $err);
		$_user = user_read_by_email($email);
		$_user AND message('email', lang('email_is_in_use'));
		
		!is_username($username, $err) AND message('username', $err);
		$_user = user_read_by_username($username);
		$_user AND message('username', lang('username_is_in_use'));
		
		!is_password($password, $err) AND message('password', $err);
		
		$salt = xn_rand(16);
		$pwd = md5($password.$salt);
		$gid = 101;
		$_user = array (
			'username' => $username,
			'email' => $email,
            'password' => $pwd,

            'realname' => $realname,
			'sex' => $sex,
            'school' => $school,
            'xueli' => $xueli,
			'year' => $year,
            'major' => $major,
            'other' => $other,
            'province' => $province,
            
			'salt' => $salt,
			'gid' => $gid,
			'create_ip' => $longip,
			'create_date' => $time,
			'logins' => 1,
			'login_date' => $time,
			'login_ip' => $longip,
		);
		$uid = user_create($_user);
		$uid === FALSE AND message('email', lang('user_create_failed'));
		$user = user_read($uid);
	
		// 更新 session
		
		unset($_SESSION['user_create_email']);
		unset($_SESSION['user_create_code']);
		$_SESSION['uid'] = $uid;
		user_token_set($uid);
		
		$extra = array('token'=>user_token_gen($uid));
		
		include APP_PATH.'plugin/jan_identicon/Identicon.php';
		
		message(0, lang('user_create_sucessfully'), $extra);
	}
	
} elseif($action == 'logout') {
	
	
	
	$uid = 0;
	$_SESSION['uid'] = $uid;
	user_token_clear();
	
	

	message(0, jump(lang('logout_successfully'), http_referer(), 1));
	//message(0, jump('退出成功', './', 1));
	
// 重设密码第 1 步 | reset password first step
} elseif($action == 'resetpw') {
	
	
	
	!$conf['user_resetpw_on'] AND message(-1, '未开启密码找回功能！');
		
	if($method == 'GET') {

		
		
		$header['title'] = lang('resetpw');
		
		
		
		include _include(APP_PATH.'view/htm/user_resetpw.htm');

	} else if($method == 'POST') {
		
		
		
		$email = param('email');
		empty($email) AND message('email', lang('please_input_email'));
		!is_email($email, $err) AND message('email', $err);
		
		$_user = user_read_by_email($email);
		!$_user AND message('email', lang('email_is_not_in_use'));

		$code = param('code');
		empty($code) AND message('code', lang('please_input_verify_code'));
		
		$sess_email = _SESSION('user_resetpw_email');
		$sess_code = _SESSION('user_resetpw_code');
		empty($sess_code) AND message('code', lang('click_to_get_verify_code'));
		empty($sess_email) AND message('code', lang('click_to_get_verify_code'));
		$email != $sess_email AND message('code', lang('verify_code_incorrect'));
		$code != $sess_code AND message('code', lang('verify_code_incorrect'));
	
		$_SESSION['resetpw_verify_ok'] = 1;
		
		
		
		message(0, lang('check_ok_to_next_step'));
	}

// 重设密码第 3 步 | reset password step 3
} elseif($action == 'resetpw_complete') {
	
	
	
	// 校验数据
	$email = _SESSION('user_resetpw_email');
	$resetpw_verify_ok = _SESSION('resetpw_verify_ok');
	(empty($email) || empty($resetpw_verify_ok)) AND message(-1, lang('data_empty_to_last_step'));
	
	$_user = user_read_by_email($email);
	empty($_user) AND message(-1, lang('email_not_exists'));
	$_uid = $_user['uid'];
	
	if($method == 'GET') {

		
		
		$header['title'] = lang('resetpw');
		
		
		
		include _include(APP_PATH.'view/htm/user_resetpw_complete.htm');

	} else if($method == 'POST') {
		
		
		
		$password = param('password');
		empty($password) AND message('password', lang('please_input_password'));
		
		$salt = $_user['salt'];
		$password = md5($password.$salt);
		user_update($_uid, array('password'=>$password));
		
		!is_password($password, $err) AND message('password', $err);
		
		unset($_SESSION['user_resetpw_email']);
		unset($_SESSION['user_resetpw_code']);
		unset($_SESSION['resetpw_verify_ok']);
		
		
		
		message(0, lang('modify_successfully'));
		
	}

// 发送验证码
} elseif($action == 'send_code') {
	
	$method != 'POST' AND message(-1, lang('method_error'));
	
	
	
	$action2 = param(2);
	
	// 创建用户
	if($action2 == 'user_create') {
		
		$email = param('email');
		
		empty($email) AND message('email', lang('please_input_email'));
		!is_email($email, $err) AND message('email', $err);
		empty($conf['user_create_email_on']) AND message(-1, lang('email_verify_not_on'));
		$_user = user_read_by_email($email);
		!empty($_user) AND message('email', lang('email_is_in_use'));
		
		$code = rand(100000, 999999);
		$_SESSION['user_create_email'] = $email;
		$_SESSION['user_create_code'] = $code;
		
	
	// 重置密码，往老地址发送
	} elseif($action2 == 'user_resetpw') {
		
		$email = param('email');
		
		empty($email) AND message('email', lang('please_input_email'));
		!is_email($email, $err) AND message('email', $err);
		$_user = user_read_by_email($email);
		empty($_user) AND message('email', lang('email_is_not_in_use'));
		
		empty($conf['user_resetpw_on']) AND message(-1, lang('resetpw_not_on'));
		
		$code = rand(100000, 999999);
		$_SESSION['user_resetpw_email'] = $email;
		$_SESSION['user_resetpw_code'] = $code;

	} else {
		message(-1, 'action2 error');
	}
	
	
	$subject = lang('send_code_template', array('rand'=>$code, 'sitename'=>$conf['sitename']));
	$message = $subject;
	
	$smtplist = include _include(APP_PATH.'conf/smtp.conf.php');
	$n = array_rand($smtplist);
	$smtp = $smtplist[$n];
	
	
	$r = xn_send_mail($smtp, $conf['sitename'], $email, $subject, $message);
	
	
	if($r === TRUE) {
		message(0, lang('send_successfully'));
	} else {
		xn_log($errstr, 'send_mail_error');
		message(-1, $errstr);
	}

// 简单的同步登陆实现：| sync login implement simply
/* 
	将用户信息通过 token 传递给其他系统 | send user information to other system by token
	两边系统将 auth_key 设置为一致，用 xn_encrypt() xn_decrypt() 加密解密。all subsystem set auth_key to correct by xn_encrypt() xn_decrypt()
*/
} elseif($action == 'synlogin') {

	// 检查过来的 token | check token
	$token = param('token');
	$return_url = param('return_url');
	
	$s = xn_decrypt($token);
	!$s AND message(-1, lang('unauthorized_access'));
	list($_time, $_useragent) = explode("\t", $s);
	$useragent != $_useragent AND message(-1, lang('authorized_get_failed'));
	
	empty($_SESSION['return_url']) AND $_SESSION['return_url'] = $return_url;
	if(!$uid) {
		http_location(url('user-login'));
	} else {
		$return_url = _SESSION('return_url');
		
		empty($return_url) AND message(-1, lang('request_synlogin_again'));
		unset($_SESSION['return_url']);
		
		$arr = array(
			'uid'=>$user['uid'],
			'gid'=>$user['gid'],
			'username'=>$user['username'],
			'avatar_url'=>$user['avatar_url'],
			'email'=>$user['email'],
			'mobile'=>$user['mobile'],
		);
		$s = xn_json_encode($arr);
		$s = xn_encrypt($s);
		
		// 将 token 附加到 URL，跳转回去 | add token into URL, jump back
		$url = xn_urldecode($return_url).'?token='.$s;
		//$url = xn_url_add_arg($return_url, 'token', $s);
		http_location($url);
	}

} else {
	
}



// 获取用户来路
function user_http_referer() {
	
	$referer = param('referer'); // 优先从参数获取 | GET is priority
	empty($referer) AND $referer = array_value($_SERVER, 'HTTP_REFERER', '');
	
	$referer = str_replace(array('\"', '"', '<', '>', ' ', '*', "\t", "\r", "\n"), '', $referer); // 干掉特殊字符 strip special chars
	
	if(
		!preg_match('#^(http|https)://[\w\-=/\.]+/[\w\-=.%\#?]*$#is', $referer) 
		|| strpos($referer, 'user-login.htm') !== FALSE 
		|| strpos($referer, 'user-logout.htm') !== FALSE 
		|| strpos($referer, 'user-create.htm') !== FALSE 
		|| strpos($referer, 'user-setpw.htm') !== FALSE 
		|| strpos($referer, 'user-resetpw_complete.htm') !== FALSE
	) {
		$referer = './';
	}
	
	return $referer;
}

function user_auth_check($token) {
	
	global $time;
	$auth = param(2);
	$s = decrypt($auth);
	empty($s) AND message(-1, lang('decrypt_failed'));
	$arr = explode('-', $s);
	count($arr) != 3 AND message(-1, lang('encrypt_failed'));
	list($_ip, $_time, $_uid) = $arr;
	$_user = user_read($_uid);
	empty($_user) AND message(-1, lang('user_not_exists'));
	$time - $_time > 3600 AND message(-1, lang('link_has_expired'));
	
	return $_user;
}

?>
