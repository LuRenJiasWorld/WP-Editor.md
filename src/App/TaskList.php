<?php

namespace App;

class TaskList {

	public function __construct() {
		add_filter( 'the_content', array( $this, 'taskList_markup' ) ); // before wptexturize
		add_filter( 'comment_text', array( $this, 'taskList_markup' ) ); // before wptexturize
	}

	public function taskList_markup( $content ) {
		$textarr = wp_html_split( $content );

		$regex = '/^\s*\[[x\s]\]\s*/';

		foreach ( $textarr as &$element ) {

			if ( '' == $element || '<' === $element[0] ) {

				continue;

			}

			$element = preg_replace_callback( $regex, array($this,'taskList_src'), $element );

		}

		return implode( '', $textarr );
	}

	public function taskList_src( $matches ) {

		$taskList = $matches[0];

		$regex_1 = '/^\s*\[\s\]\s*/';

		$regex_2 = '/^\s*\[x\]\s*/';

		if ( preg_match( $regex_1, $taskList ) ) {
			$taskList = preg_replace( '/^\s*\[\s\]\s*/', '<input style="margin-right:5px" type="checkbox" class="task-list-item-checkbox" disabled />', $taskList );
		}

		if ( preg_match( $regex_2, $taskList ) ) {
			$taskList = preg_replace( '/^\s*\[x\]\s*/', '<input style="margin-right:5px" type="checkbox" class="task-list-item-checkbox" checked disabled />', $taskList );
		}

		return $taskList;
	}
}