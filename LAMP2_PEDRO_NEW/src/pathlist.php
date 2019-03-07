<?php

$doc_root = dirname(__FILE__);
require_once $doc_root . '/../config/database.php';

$pathQuery = "select path_name  from path_info;";

$pathsCollection = $db->query($pathQuery)->fetch_all();

$paths = array();
$i =0;
$json_data = array(
	"draw"            => intval( $_REQUEST['draw'] ),
	"recordsTotal"    => intval( sizeof($pathsCollection) ),
	"recordsFiltered" => intval( sizeof($pathsCollection) ),
	"data"            => $pathsCollection
);
echo json_encode($json_data);exit;
//print_r($pathsCollection->fetch_array());exit;

