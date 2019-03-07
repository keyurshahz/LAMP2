<?php
/**
 * Copyright (c) 2019.
 */

$doc_root = dirname(__FILE__);
include_once $doc_root . '/../upload/upload_class.php';
include_once $doc_root . '/../upload/path_upload.php';
require_once $doc_root . '/../config/database.php';

$json['img'] = '';
$json['error'] = '';

if (empty($_FILES['fileToUpload']['name'])) {
	$json['error'] = 'Please select a file.';
} else {
	$path_upload = new Path_upload();
	$path_upload->upload_dir = $doc_root.'/../files/path/';
	//$path_upload->path_folder = $doc_root.'/../files/path/';
	$path_upload->extensions = array('.csv');
	$path_upload->language = 'en';
	$path_upload->the_temp_file = $_FILES['fileToUpload']['tmp_name'];
	$path_upload->the_file = $_FILES['fileToUpload']['name'];
	$path_upload->http_error = $_FILES['fileToUpload']['error'];
	$path_upload->do_filename_check = 'y';
	$path_upload->validate_mime = false;
	$path_upload->rename_file = true;


	if ($path_upload->upload()) {
		$pk = $path_upload->save_file_name($db,$path_upload->file_copy);

		if($pk == 0){
			$success = 1;
			$db->rollback();
			unlink($path_upload->upload_dir.$path_upload->file_copy);
			$json['error'] = 'Not abe to upload file';

		}

		$uploaded_csv = $path_upload->upload_dir.$path_upload->file_copy;

		$path_upload->saveFileDataToDatabase($uploaded_csv, $pk, $db, false);

		$json['csv'] = $path_upload->file_copy;
	}

	$json['error'] = strip_tags($path_upload->show_error_string('##'));
}
echo json_encode($json);
