# vty
Vty is a web-based database manager script written with Php. It's for Mysql. 

Setup
------

Edit vty.php as appropriate.

$ayar['LoginType'] = 'config_or_login';

          // "config" - Connect to server with connection information in this page.
          // "config_or_login" - Connect to server connection information in this page or with login screen.
          // "login" -  Connect to server with only login screen.
           
$ayar['dbuser'] = ''; // YOUR MYSQL USER NAME

$ayar['dbpass'] = ''; // YOUR MYSQL PASSWORD

$ayar['dbhost'] = 'localhost';    // host name to connect to database server

$ayar['dbname'] = ''; // Want to you only one database. Write its name or keep empry.

$ayar['DefaultLang'] = 'en';      // default language like en,de,tr

$ayar['db_type'] = 'mysql';       // "mysql";

$ayar['PerPage'] = 25;// number of rows to show per page.

$ayar['DbSecimi'] = 1;// is there "Choose Database"? 1 for true, 0 for false; -> default : 1

$ayar['NfGoster'] = 1;// ( 1 to Show, 0 to hide ) numrows and numfields for tables; -> default : 1

$ayar['NtGoster'] = 1;// ( 1 to Show, 0 to hide ) table number for databases; -> default : 1



