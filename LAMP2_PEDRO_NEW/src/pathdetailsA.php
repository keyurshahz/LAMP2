<?php
/**
 * Copyright (c) 2019.
 */

$doc_root = dirname(__FILE__);
require_once $doc_root . '/../config/database.php';

$type = $_REQUEST['type'];
$pathName = $_REQUEST['path_name'];

if($pathName != ""){
	$pathQuery = "select fileID,path_length, descrip, note from path_info where path_name ='".$pathName."';";

	$path = $db->query($pathQuery)->fetch_row();
	$fileId = $path[0];	

	if($type == 'details'){
		$pathsCollection = $path;
	}	
	if($type == 'general'){
		$pathQuery = "select distance, ground_height, terrain_type, obstruction_height, obstruction_type  from main_data_info where fileID=$fileId;";
		$pathsCollection = $db->query($pathQuery)->fetch_all();
	}
	if($type == 'midpoint'){
		$pathQuery = "select point1, point2, point3  from begin_point_info where fileID=$fileId;";
		$pathsCollection = $db->query($pathQuery)->fetch_all();
	}
	if($type == 'endpoint'){
		$pathQuery = "select point1, point2, point3  from end_point_info where fileID=$fileId;";
		$pathsCollection = $db->query($pathQuery)->fetch_all();
	}


	$json_data = array(
		"draw"            => intval( isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1 ),
		"recordsTotal"    => intval( sizeof($pathsCollection) ),
		"recordsFiltered" => intval( sizeof($pathsCollection) ),
		"data"            => $pathsCollection
	);
}else{
	$json_data = array(
		"recordsTotal"    => 0,
		"recordsFiltered" => 0,
		"data"            => array()
	);
}

echo json_encode($json_data);exit;
//print_r($pathsCollection->fetch_array());exit;

