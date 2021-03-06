<?php

!defined('DEBUG') AND exit('Access Denied.');


$fid = param(1, 0);
$page = param(2, 1);
$orderby = param('orderby');
$extra = array(); // 给插件预留

$active = 'default';
!in_array($orderby, array('tid', 'lastpid')) AND $orderby = 'lastpid';
$extra['orderby'] = $orderby;

$forum = forum_read($fid);
empty($forum) AND message(3, lang('forum_not_exists'));
forum_access_user($fid, $gid, 'allowread') OR message(-1, lang('insufficient_visit_forum_privilege'));
$pagesize = $conf['pagesize'];



$toplist = $page == 1 ? thread_top_find($fid) : array();

// 从默认的地方读取主题列表
$thread_list_from_default = 1;


$digest = param('digest', 0);
$extra['digest'] = $digest;
if($digest == 1) {
	$thread_list_from_default = 0;
	$active = 'digest';
	$digests = thread_digest_count($fid);
	$pagination = pagination(url("forum-$fid-{page}", array('digest'=>1)), $digests, $page, $pagesize);
	$threadlist = thread_digest_find_by_fid($fid, $page, $pagesize);
}

if($thread_list_from_default) {
	$pagination = pagination(url("forum-$fid-{page}", $extra), $forum['threads'], $page, $pagesize);
	$threadlist = thread_find_by_fid($fid, $page, $pagesize, $orderby);
}

$header['title'] = $forum['seo_title'] ? $forum['seo_title'] : $forum['name'].'-'.$conf['sitename'];
$header['mobile_title'] = $forum['name'];
$header['mobile_link'] = url("forum-$fid");
$header['keywords'] = '';
$header['description'] = $forum['brief'];

$_SESSION['fid'] = $fid;

if($ajax) {
	$forum = forum_safe_info($forum);
	foreach($threadlist as &$thread) $thread = thread_safe_info($thread);
	message(0, array('forum'=>$forum, 'threadlist'=>$threadlist));
}

include _include(APP_PATH.'view/htm/forum.htm');

?>