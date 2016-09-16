<?

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bizerte');


define('ABSPATH', 'http://localhost/bizerte/');


$link= mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
mysql_set_charset('utf8',$link);
mysql_select_db(DB_NAME);
?>