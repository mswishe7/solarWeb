    <?php
$con=mysql_connect("localhost","root","solar") or die("Failed to connect with database!!!!");
mysql_select_db("solar_tree", $con); 
$sth = mysql_query("SELECT * FROM InputCurrent");


$nr=mysql_num_rows($sth);
$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    array('label' => 'Position', 'type' => 'number'),       
    array('label' => 'Input Current', 'type' => 'number'),

    

);

$rows = array();
$pos = 1;

if($nr <= 50) {
       while($r = mysql_fetch_assoc($sth)) {
       		$temp = array();
    		$temp[] = array('v' =>  $pos);
    		$temp[] = array('v' => (float) $r['InputCurrent']);
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
    		      $temp[] = array('v' => (float) $r['InputCurrent']);
		      $rows[] = array('c' => $temp);
		      }
    		  $pos = $pos + 1;
		  }
	}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;
?>
