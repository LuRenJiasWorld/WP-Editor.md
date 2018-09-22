<?php

namespace EditormdUtils;

class Internationalization {

	/**
	 * @access   private
	 * @var      string    $domain    The domain identifier for this plugin.
	 */
	private $domain;

	public function __construct() {
		$this->domain = 'editormd';
		add_action( 'plugins_loaded', array($this,'load_plugin_textdomain') );
	}

	/**
	 * 指定文件夹
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->domain,
			false,
			dirname(dirname( dirname( plugin_basename( __FILE__ ) ) )) . '/languages/'
		);

	}

}
