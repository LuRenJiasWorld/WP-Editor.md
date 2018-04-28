<?php

namespace Utils;

class Internationalization {

	/**
	 * @access   private
	 * @var      string    $domain    The domain identifier for this plugin.
	 */
	private $domain;

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

	/**
	 * @param $domain
	 */
	public function set_domain( $domain ) {
		$this->domain = $domain;
	}

}
