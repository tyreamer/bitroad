<?PHP
require_once("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('bitroad.org');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('webmaster@bitroad.org');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*dbusername*/'bitroadadmin',
                      /*password*/'adminPass',
                      /*database name*/'BitRoadDB1',
                      /*table name*/'Location');

//Update to get a random string from this link: http://tinyurl.com/randstr
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>