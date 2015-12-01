    <?php
$con=mysql_connect("localhost","root","solar") or die("Failed to connect with database!!!!");
mysql_select_db("solar_tree", $con); 
// The Chart table contains two fields: weekly_task and percentage
// This example will display a pie chart. If you need other charts such as a Bar chart, you will need to modify the code a little to make it work with bar chart and other charts
$sth = mysql_query("SELECT * FROM stats");

$nr=mysql_num_rows($sth);
$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Position', 'type' => 'number'),       
    array('label' => 'Heatsink Temperature', 'type' => 'number'),

    

);

$rows = array();
$pos = 1;

if($nr <= 50) {
       while($r = mysql_fetch_assoc($sth)) {
       		$temp = array();
       		// the following line will be used to slice the Pie chart
    		$temp[] = array('v' =>  $pos);
    		$temp[] = array('v' => (float) $r['HeatsinkTemp']); 
		$rows[] = array('c' => $temp);
    		$pos = $pos + 1;
		}
}
else {
     $a=$nr - 50;
     while($r = mysql_fetch_assoc($sth)) {
     	      if($pos > $a) {    

	      	      $temp = array();
    		      // the following line will be used to slice the Pie chart
    		      $temp[] = array('v' =>  $pos);
    		      $temp[] = array('v' => (float) $r['HeatsinkTemp']);    
		      $rows[] = array('c' => $temp);
		      }
    		  $pos = $pos + 1;
		  }
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;
?>












