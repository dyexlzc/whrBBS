<?php
return array (
  'db' => 
  array (
    'type' => 'pdo_mysql',
    'mysql' => 
    array (
      'master' => 
      array (
        'host' => '127.0.0.1',
        'user' => 'dyexlzc',
        'password' => '65088145',
        'name' => 'dyexlzc',
        'tablepre' => 'bbs_',
        'charset' => 'utf8',
        'engine' => 'innodb',
      ),
      'slaves' => 
      array (
      ),
    ),
    'pdo_mysql' => 
    array (
      'master' => 
      array (
        'host' => '127.0.0.1',
        'user' => 'dyexlzc',
        'password' => '65088145',
        'name' => 'dyexlzc',
        'tablepre' => 'bbs_',
        'charset' => 'utf8',
        'engine' => 'innodb',
      ),
      'slaves' => 
      array (
      ),
    ),
  ),
  'cache' => 
  array (
    'enable' => true,
    'type' => 'mysql',
    'memcached' => 
    array (
      'host' => 'localhost',
      'port' => '11211',
      'cachepre' => 'bbs_',
    ),
    'redis' => 
    array (
      'host' => 'localhost',
      'port' => '6379',
      'cachepre' => 'bbs_',
    ),
    'xcache' => 
    array (
      'cachepre' => 'bbs_',
    ),
    'yac' => 
    array (
      'cachepre' => 'bbs_',
    ),
    'apc' => 
    array (
      'cachepre' => 'bbs_',
    ),
    'mysql' => 
    array (
      'cachepre' => 'bbs_',
    ),
  ),
  'tmp_path' => './tmp/',
  'log_path' => './log/',
  'view_url' => 'view/',
  'upload_url' => 'upload/',
  'upload_path' => './upload/',
  'logo_mobile_url' => 'view/img/logo.png',
  'logo_pc_url' => 'view/img/logo.png',
  'logo_water_url' => 'view/img/water-small.png',
  'sitename' => 'WHR人才社区',
  'sitebrief' => '智慧能碰撞出最美妙的火花',
  'timezone' => 'Asia/Shanghai',
  'lang' => 'zh-cn',
  'runlevel' => 5,
  'runlevel_reason' => 'The site is under maintenance, please visit later.',
  'cookie_domain' => '',
  'cookie_path' => '',
  'auth_key' => '2FKAFMHM82MAHGTJBX4EFMPDVEQMXNDFW7B6JBV4PHWJERAVWKVQJYK2A4WVVGGK',
  'pagesize' => 20,
  'postlist_pagesize' => 100,
  'cache_thread_list_pages' => 10,
  'online_update_span' => 120,
  'online_hold_time' => 3600,
  'session_delay_update' => 0,
  'upload_image_width' => 927,
  'order_default' => 'lastpid',
  'attach_dir_save_rule' => 'Ym',
  'update_views_on' => 1,
  'user_create_email_on' => 0,
  'user_create_on' => 1,
  'user_resetpw_on' => 0,
  'nav_2_on' => 1,
  'nav_2_forum_list_pc_on' => 1,
  'nav_2_forum_list_mobile_on' => 1,
  'admin_bind_ip' => 0,
  'cdn_on' => 1,
  'url_rewrite_on' => 0,
  'disabled_plugin' => 0,
  'version' => '4.0.4',
  'static_version' => '?1.0',
  'installed' => 1,
  'nav_2_bbs_on' => 1,
  'site_keywords' => '',
  'user_create_io' => 0,
  'attach_maxsize' => 20480000,
);
?>