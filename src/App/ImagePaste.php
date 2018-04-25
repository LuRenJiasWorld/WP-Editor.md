<?php
/**
 * 图片上传接口
 */
namespace App;

class ImagePaste {

	private $log = array();

	public function __construct() {

		add_action( 'wp_ajax_imagepaste_action', array( $this, 'imagepaste_action_callback' ) );

	}

	private function imagepaste_action_callback() {
		$result    = array( 'error' => '' );
		$upload    = wp_upload_dir();
		$uploadUrl = $upload['url'];
		$uploadDir = $upload['path'];
		$extension = '';

		list( $data, $image ) = explode( ';', $_REQUEST['dataurl'] );
		list( $field, $type ) = explode( ':', $data );
		list( $encoding, $content ) = explode( ',', $image );
		if ( $type == 'image/png' ) {
			$extension = 'png';
		}

		$name = md5( $_REQUEST['dataurl'] );
		if ( ! $extension ) {
			$result['error'] = "Could not determine image extension type";
		} else {
			$file    = $uploadDir . '/' . $name . '.' . $extension;
			$fileUrl = $uploadUrl . '/' . $name . '.' . $extension;
			file_put_contents( $file, base64_decode( $content ) );
			if ( defined( 'W3TC' ) ) {
				$result['w3tc'] = 1;
				ob_start();
				$result['log']    = $this->log;
				$result['output'] = ob_get_clean();
			} else {
				$result['w3tc'] = 0;
			}

			$result['url']       = $fileUrl;
			$result['elementid'] = $_REQUEST['elementid'];
		}
		echo json_encode( $result );
		die(); // this is required to return a proper result
	}
}