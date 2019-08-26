<?php

$configFile = dirname(__FILE__) . '/config.php';

if (file_exists($configFile))
{
    include $configFile;
}
else
{
    die("Please rename the config-sample.php file to config.php and add your Flickr API key and secret to it\n");
}

spl_autoload_register(function($className)
{
    $className = str_replace ('\\', DIRECTORY_SEPARATOR, $className);
    include (dirname(__FILE__) . '/../src/' . $className . '.php');
});

use \DPZ\Flickr;

if(isset($_REQUEST['redrose'])){
	$redrose=$_REQUEST['redrose'];
	if($redrose=='listphoto'){
		$flickr = new Flickr($flickrApiKey, $flickrApiSecret);
		$method=$_REQUEST['method'];
		$api_key=$_REQUEST['api_key'];
		$user_id=$_REQUEST['user_id'];
		$tags=$_REQUEST['tags'];
		$format=$_REQUEST['format'];
		$per_page=$_REQUEST['per_page'];
		$nojsoncallback=$_REQUEST['nojsoncallback'];
		$parameters =  array(
			'user_id' => $user_id,
			'tags' => $tags,
			'format' => $format,
			'per_page' => $per_page,
			//'extras' => 'url_sq,path_alias',
		);
		//$response = $flickr->call('flickr.photos.search', $parameters);
		$response = $flickr->call($method, $parameters);
		$out = array_values($response);
		//echo json_encode($out, JSON_FORCE_OBJECT);
		echo json_encode($out);
	}
	if($redrose=='photoinfo'){
		$flickr = new Flickr($flickrApiKey, $flickrApiSecret);
		$method=$_REQUEST['method'];
		$api_key=$_REQUEST['api_key'];
		$photo_id=$_REQUEST['photo_id'];
		$format=$_REQUEST['format'];
		$nojsoncallback=$_REQUEST['nojsoncallback'];
		$parameters =  array(
			'photo_id' => $photo_id,
			'format' => $format,
		);
		//$response = $flickr->call('flickr.photos.search', $parameters);
		$response = $flickr->call($method, $parameters);
		$out = array_values($response);
		//echo json_encode($out, JSON_FORCE_OBJECT);
		echo json_encode($out);
	}
	if($redrose=='listtag'){
		$flickr = new Flickr($flickrApiKey, $flickrApiSecret);
		$method=$_REQUEST['method'];
		$api_key=$_REQUEST['api_key'];
		$format=$_REQUEST['format'];
		$nojsoncallback=$_REQUEST['nojsoncallback'];
		$parameters =  array(
			'api_key' => $api_key,
			'format' => $format,
		);
		//$response = $flickr->call('flickr.photos.search', $parameters);
		$response = $flickr->call($method, $parameters);
		$out = array_values($response);
		//echo json_encode($out, JSON_FORCE_OBJECT);
		echo json_encode($out);
	}
}



/* $photos = $response['photos'];

$out = array_values($photos);
echo json_encode($out, JSON_FORCE_OBJECT); */

?>