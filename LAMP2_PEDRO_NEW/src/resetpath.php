<?php
/**
 * Copyright (c) 2019.
 */

$doc_root = dirname(__FILE__);
include_once $doc_root . '/../upload/path_upload.php';
require_once $doc_root . '/../config/database.php';

$pathName = $_REQUEST['path_name'];

if($pathName != ""){
	$pathQuery = "select fileID from path_info where path_name ='".$pathName."';";

	$path = $db->query($pathQuery)->fetch_row();
	$fileId = $path[0];
	$success = false;
	if(isset($fileId) && $fileId > 0){
		$fileQuery = "select * from file_info where fileId=$fileId";
		$fileInfo = $db->query($fileQuery)->fetch_row();
		$fileName = $fileInfo[1];

		if(isset($fileName) && $fileName != ""){
			$upload_dir = $doc_root.'/../files/path/';
			$filePath = $upload_dir.$fileName;
			$path_upload = new Path_upload();
			$path_upload->truncateTables($fileId, $db);
			$path_upload->saveFileDataToDatabase($filePath, $fileId, $db, true);
		}else{
			$json_data = array(
				"error" => 'Not able to find respective file',
				"success" => $success
			);
		}

	}else{
		$json_data = array(
			"error" => 'Not able to find respective file',
			"success" => $success
		);
	}



	$json_data = array(
		"data" => $fileId,
		"success" => true
	);

}else{
	$json_data = array(
		"data"            => array(),
		"success" => false
	);
}

echo json_encode($json_data);exit;
//print_r($pathsCollection->fetch_array());exit;

