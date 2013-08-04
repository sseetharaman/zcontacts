<?php
$search="";
 if(isset($_REQUEST["search"]))
 {
       $search=$_REQUEST["search"];
 }
 $sql="select fname,lname,city,state,phone,email from travel_contact where UPPER(fname) like '%" .strtoupper($search) ."%' OR UPPER(lname) like '%" .strtoupper($search)."%'";
global $con,$db_selected;
connctMysql();
$result = mysql_query($sql,$con);
$tmp="<table data-role=\"table\" id=\"contact-table\" data-mode=\"reflow\" class=\"ui-responsive table-stroke\">";
$tmp=$tmp."<head><tr><th data-priority='1'>First name</th><th data-priority='2'>Last name</th><th data-priority='3'>City</th><th data-priority='4'>State</th><th data-priority='5'>Phone</th></tr></thead><tbody>";

while ($row = mysql_fetch_assoc($result))
{
//     echo "<a rel=\"external\" href=\"http://apps.fourcells.com/travel/contacts_list.php?search".$search."\" class=\"ratebutton\"  data-role=\"button\" data-icon=\"star\" data-inline=\"true\" >Click here to see all ". $row['CNT']. " contacts</a>";
 $em="<a href='mailto:".$row['email']."'>".$row['fname']."</a>";
 $pm="<a href='tel:".$row['phone']."'>".$row['phone']."</a>";
  $tmp=$tmp."<tr><td>".$em."</td>". "<td>".$row['lname']."</td>"."<td>".$row['city']."</td>"."<td>".$row['state']."</td>"."<td>".$pm."</td></tr>";
//  echo $tmp."<br>";

}
$tmp=$tmp."</tbody></table>";

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
<!DOCTYPE html>
<html>
    <head>
    <title>Contact List</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a2/jquery.mobile-1.0a2.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a2/jquery.mobile-1.0a2.min.js"></script>
</head>

<body>

 
    <div data-role="page" id="indexPage">
        <div data-role="header">
            <h1>Zone Travels Contacts List</h1>
        </div>
        <div data-role="content">
<div data-role="content" class="jqm-content">
				


		<div data-demo-html="true">		
  <?php echo $tmp; ?>

	</div><!--/demo-html -->
        </div>
 
        <div data-role="footer">
            <h1>www.fourcells.com</h1>
        </div>
    </div>
 
</body>
</html>