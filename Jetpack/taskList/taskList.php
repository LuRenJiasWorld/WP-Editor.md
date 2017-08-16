<?php
/**
 * Task List support.
 *
 * Backward compatibility requires support for both "[ /X ] Hello World" shortcodes.
 *
 */

function taskList_markup( $content ) {
	$textarr = wp_html_split( $content );

	$regex = '/^\s*\[[x\s]\]\s*/';

	foreach ( $textarr as &$element ) {

		if ( '' == $element || '<' === $element[0] ) {

			continue;

		}

		$element = preg_replace_callback( $regex, 'taskList_src', $element );

	}

	return implode( '', $textarr );
}

function taskList_src( $matches ) {
	$taskList = $matches[0];

	$regex_1 = '/^\s*\[\s\]\s*/';

	$regex_2 = '/^\s*\[x\]\s*/';

	if ( preg_match($regex_1,$taskList) ) {

		$taskList = preg_replace('/^\s*\[\s\]\s*/', '<input style="margin-right:5px" type="checkbox" class="task-list-item-checkbox" disabled />', $taskList);

	}

	if ( preg_match($regex_2,$taskList) ) {

		$taskList = preg_replace('/^\s*\[x\]\s*/', '<input style="margin-right:5px" type="checkbox" class="task-list-item-checkbox" checked disabled />', $taskList);

	}

	return $taskList;
}


add_filter( 'the_content', 'taskList_markup', 9 ); // before wptexturize
add_filter( 'comment_text', 'taskList_markup', 9 ); // before wptexturize
