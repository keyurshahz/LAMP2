<?php  
//fetch.php
//Pedro Froes  
$doc_root = dirname(__FILE__);
require_once $doc_root . '/../config/database.php';

$type = $_REQUEST['type'];
$point1 = $_REQUEST['point1'];
$point2 = $_REQUEST['point2'];
$point3 = $_REQUEST['point3'];
$length = $_REQUEST['length'];
$descrip = $_REQUEST['descrip'];
$note = $_REQUEST['note'];
$distance = $_REQUEST['distance'];
$groundHeight = $_REQUEST['groundHeight'];
$terrainType = $_REQUEST['terrainType'];
$obstructionHeight = $_REQUEST['obstructionHeight'];
$obstructionType = $_REQUEST['obstructionType'];
$json = array(); 

if(!empty($_POST))
{  
    $path_length = mysqli_real_escape_string($db, $_POST["length"]);  
    $descrip = mysqli_real_escape_string($db, $_POST["descrip"]);  
    $note = mysqli_real_escape_string($db, $_POST["note"]);  
    $point1 = $_POST["point1"];  
    $point2 = $_POST["point2"];  
    $point3 = $_POST["point3"];  
    $distance = $_POST["distance"];  
    $ground_height = $_POST["groundHeight"];  
    $terrain_type = mysqli_real_escape_string($db, $_POST["terrainType"]);  
    $obstruction_height = $_POST["obstructionHeight"];  
    $obstruction_type = mysqli_real_escape_string($db, $_POST["obstructionType"]);  

    if($type == 'details')  
    {
        $query = "UPDATE path_info SET path_length='$path_length', descrip='$descrip', note='$note' WHERE pathID=".$_POST["pathID"]."";  	   
    }
    
    if($type == 'general')  
    {  
        $query = "UPDATE main_data_info SET distance=$distance, ground_height=$ground_height, terrain_type='$terrain_type',obstruction_height=$obstruction_height,obstruction_type='$obstruction_type' WHERE dataID=".$_POST["dataID"]."";  
    } 

    if($type == 'endpoint')
    {
        $query = "UPDATE end_point_info SET point1=$point1, point2=$point2, point3=$point3 WHERE pointID=".$_POST["pointID"]."";  
    }
    if($type == 'midpoint')
    {
        $query = "UPDATE begin_point_info SET point1=$point1, point2=$point2, point3=$point3 WHERE pointID=".$_POST["pointID"]."";  
    }
        
    if(mysqli_query($db, $query))  
    {  
        $json['success'] = true;
        $json['error'] = '';
        $json['data'] = '';             
    }else{
        $json['success'] = false;
        $json['error'] = 'Cannot update path information.';
        $json['data'] = '';
    }  

        
}else{
    $json['success'] = false;
    $json['error'] = 'Cannot update path information.';
    $json['data'] = '';
}

echo json_encode($json);exit;
?>
