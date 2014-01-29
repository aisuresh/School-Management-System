<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the "Database Connection"
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the "default" group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = "school";
$active_record = TRUE;

$config['school']['hostname'] = "localhost";
//$db['default']['hostname'] = "localhost:3307";
$config['school']['username'] = "root";
//$db['default']['password'] = "ram250581";
$config['school']['password'] = "";
$config['school']['database'] = "school";
$config['school']['dbdriver'] = "mysql";
$config['school']['dbprefix'] = "";
$config['school']['pconnect'] = TRUE;
$config['school']['db_debug'] = TRUE;
$config['school']['cache_on'] = FALSE;
$config['school']['cachedir'] = "";
$config['school']['char_set'] = "utf8";
$config['school']['dbcollat'] = "utf8_general_ci";



/* End of file database.php */
/* Location: ./system/application/config/database.php */