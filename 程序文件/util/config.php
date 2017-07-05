<?php
//数据库配置信息
define('DB_HOST', '****'); //数据库服务器主机地址
define('DB_USER', '****'); //数据库帐号
define('DB_PW', '****'); //数据库密码
define('DB_NAME', '****'); //数据库名
define('DB_CHARSET', 'UTF8'); //数据库字符集
define('DB_PCONNECT', 0); //0 或1，是否使用持久连接
define('DB_DATABASE', 'mysql'); //数据库类型

define('PHPCMS_PATH', '/');


//Cookie配置
define('CHARSET', 'UTF-8'); //数据库字符集
define('COOKIE_DOMAIN', '.qiaker.cn'); //Cookie 作用域
define('COOKIE_PATH', '/'); //Cookie 作用路径
define('COOKIE_PRE','qy_'); //Cookie 前缀，同一域名下安装多套Phpcms时，请修改Cookie前缀
define('COOKIE_TTL', 864000); //Cookie 生命周期，0 表示随浏览器进程

define('CACHE_COUNT_TTL', 600);//count统计

define('TIMEZONE', 'Etc/GMT-8'); //网站时区（只对php 5.1以上版本有效），Etc/GMT-8 实际表示的是 GMT+8
define('DEBUG', 1); //是否显示调试信息
define('ADMIN_LOG', 1); //是否记录后台操作日志
define('ERRORLOG', 0); //是否保存错误日志
define('FILTER_ENABLE', 0); //非法信息屏蔽作用范围（0 禁用，1 前台，2 全站）
define('GZIP', 1); //是否Gzip压缩后输出
define('AUTH_KEY', 'EQbGdUbAglNkVnhcikrc'); //Cookie密钥
define('PASSWORD_KEY', ''); //会员密码密钥，为了加强密码强度防止暴力破解，不可更改
define('ALLOWED_HTMLTAGS', '<p><br><hr><h1><h2><h3><h4><h5><h6><font><u><i><b><strong><div><span><ol><ul><li><img><table><tr><td><map><a><iframe>'); //前台发布信息允许的HTML标