<?php

/**
 * Created by PhpStorm.
 * User: Jaxson
 * Date: 2017/5/3
 * Time: 下午5:28
 */
add_action('wp_ajax_imagepaste_action', 'imagepaste_action_callback');

function imagepaste_action_callback() {
	$result=array('error'=>'');
	$upload = wp_upload_dir();
	$uploadUrl=$upload['url'];
	$uploadDir=$upload['path'];

	list($data,$image)=explode(';',$_REQUEST['dataurl']);
	list($field,$type)=explode(':',$data);
	list($encoding,$content)=explode(',',$image);
	if ($type=='image/png') $extension='png';

	$name=md5($_REQUEST['dataurl']);
	if (!$extension) {
		$result['error']="Could not determine image extension type";
	} else {
		$file=$uploadDir.'/'.$name.'.'.$extension;
		$fileUrl=$uploadUrl.'/'.$name.'.'.$extension;
		file_put_contents($file,base64_decode($content));
		if (defined('W3TC')) {
			$result['w3tc']=1;
			ob_start();
			$w3tc=new ImagepasteW3tc();
			//$result['w3tcconfig']=$w3tc->config;
			if ($w3tc->engine=='rscf') $w3tc->upload($uploadDir,$uploadUrl,$name.'.'.$extension);
			$result['log']=$w3tc->log;
			$result['output']=ob_get_clean();
		} else $result['w3tc']=0;

		$result['url']=$fileUrl;
		$result['elementid']=$_REQUEST['elementid'];
	}
	echo json_encode($result);
	die(); // this is required to return a proper result
}

class ImagepasteW3tc {
	var $log=array();

	function __construct() {
		$this->config=array();
		$file=W3TC_CACHE_CONFIG_DIR.'/master.php';
		if (file_exists($file)) $this->config=include(W3TC_CACHE_CONFIG_DIR.'/master.php');
		$this->engine=$this->config['cdn.engine'];
		$this->username=$this->config['cdn.rscf.user'];
		$this->apikey=$this->config['cdn.rscf.key'];
		$this->container=$this->config['cdn.rscf.container'];
	}

	function upload($uploadDir,$uploadUrl,$file) {
		if (!file_exists(W3TC_LIB_DIR.'/CF/cloudfiles.php')) return;

		require_once(W3TC_LIB_DIR.'/CF/cloudfiles.php');

		$prefix=str_replace(home_url().'/','',$uploadUrl);

		// Lets connect to Rackspace
		$authentication = new CF_Authentication($this->username, $this->apikey);
		$authentication->authenticate();
		$connection = null;
		try {
			$connection = new CF_Connection($authentication);
		}
		catch(AuthenticationException $e) {
			$this->log('Error 1: '.$e->getMessage());
		}

		$container = null;
		try
		{
			$container = $connection->get_container($this->container);
			$container->make_public();
			$this->log('Connected to container '.$this->container);
		}
		catch(Exception $e) {
			$this->log('Error 2: '.$e->getMessage());
		}

		try {
			$object = $container->create_object($prefix.'/'.$file);
			$object->load_from_filename($uploadDir.'/'.$file);
			$this->log('Copied '.$file.' to '.$object->public_uri(), 'info');
		} catch(Exception $e) {
			$this->log('Error 3: '.$e->getMessage());
		}
	}

	function log($s) {
		$this->log[]=is_array($s) ? print_r($s,true) : $s;
	}
}
