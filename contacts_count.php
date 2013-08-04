<?php
$search="";
 if(isset($_REQUEST["search"]))
 {
       $search=$_REQUEST["search"];
 }
 $sql="select count(*) as CNT from travel_contact where UPPER(fname) like '%" .strtoupper($search) ."%' OR UPPER(lname) like '%" .strtoupper($search)."%'";
global $con,$db_selected;
connctMysql();
$result = mysql_query($sql,$con);
while ($row = mysql_fetch_assoc($result))
{
     echo "<a rel=\"external\" href=\"http://apps.fourcells.com/travel/contacts_list.php?search=".$search."\" class=\"ratebutton\"  data-role=\"button\" data-icon=\"star\" data-inline=\"true\" >Click here to see all ". $row['CNT']. " contacts</a>";
}


mysql_free_result($result);

function connctMysql()
  {
  		$ini_array = parse_ini_file("resource.ini");
  		$port =$ini_array['port'];
		$server =$ini_array['server'].":".$port;;
		$userid =$ini_array['userid'];
		$password =$ini_array['password'];
		$database =$ini_array['database'];
      global $con,$db_selected;
      $con=@mysql_connect($server, $userid, $password);
      $db_selected = mysql_select_db($database, $con);
  }

?>