<?php
 ini_set("display_errors", "0");
include_once('URLHandler.php');
$ObjURLHandler = new URLHandler();
$links  = $ObjURLHandler->setLinks('http://www.greenpepper.in');
$result = $ObjURLHandler->setResultArray();

$return = 'URL'.'   '.'Count of IMG tags'.'   '.'Time Taken'."\n";
foreach ($result as $item){
    $return.= $item[0].$item[1].$item[2]."\n";
}
echo $return;

/* Enable the below code to show the result in browser in table format
$table = "<table><tr><th>URL</th><th>Count of IMG tags</th><th>Time Taken</th><tr>";
foreach ($result as $item){
    $table.= "<tr><td>$item[0]</td><td>$item[1]</td><td>$item[2]</td></tr>";
}
$table.='</table>';
echo $table;
*/

?>
