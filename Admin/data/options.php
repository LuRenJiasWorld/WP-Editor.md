<?php

/**
 * 定义选项
 * @Author: JaxsonWang
 */

$options = array();

$options['basic_0'] = array(
	'title'       => __( 'Basic text field' ),
	'subtitle'    => __( 'id: <code>basic_0</code>' ),
	'page'        => 'page_a',
	'description' => '~',
);

$options['my_checkboxes1'] = array(
	'page'      => 'page_a',
	'type'      => 'checkbox',
	'options'   => array(
		'bird' => __( 'Bird' )
	),
	'default'   => 'bird'
);

$options['basic_1'] = array(
	'page'        => 'page_a',
	'placeholder' => __( 'Try &quot;123&quot;' ),
);

$options['basic_2'] = array(
	'page' => 'page_a',
	'tab'  => 'tab_2',
);

$options['basic_4'] = array(
	'description' => '<p class="description">An option with  default value <code>DEF</code></p>',
	'page'        => 'page_a',
	'default'     => 'DEF',
);

$options['my_dropdown_single'] = array(
	'page'        => 'page_a',
	'type'        => 'select',
	'options'     => array(
		''     => __( 'Choose an animal' ),
		'bird' => __( 'Bird' ),
		'cat'  => __( 'Cat' ),
		'fish' => __( 'Fish' ),
	),
	'description' => '<p class="description">' . __( 'Try <strong>Bird</strong> or <strong>Cat</strong> here and <strong>123</strong> above to show a conditional field.' ) . '</p>',
);

$options['depenency_1'] = array(
	'page'       => 'page_a',
	'conditions' => array(
		array( 'basic_1', 'eq', '123' ),
	),
);

$options['depenency_2'] = array(
	'page'        => 'page_a',
	'conditions'  => array(
		array( 'basic_1', 'eq', '123' ),
		array( 'my_dropdown_single', 'in', 'cat,bird' ),
	),
	'description' => '~',
);

$options['my_colorpicker'] = array(
	'page'        => 'page_a',
	'colorpicker' => true,
);

$options['my_media'] = array(
	'page'        => 'page_a',
	'type'        => 'media',
	'description' => '~',
	'placeholder' => __( 'Insert file URL' ),
	'button_text' => __( 'Select Media' ),
);

$options['my_dropdown_multiple'] = array(
	'page'     => 'page_a',
	'type'     => 'select',
	'options'  => array(
		'bird' => __( 'Bird' ),
		'cat'  => __( 'Cat' ),
	),
	'multiple' => true,
	'default'  => 'cat,bird',
);

$options['my_radios'] = array(
	'page'    => 'page_a',
	'type'    => 'radio',
	'options' => array(
		'bird' => __( 'Bird' ),
		'cat'  => __( 'Cat' ),
	),
);

$options['my_checkboxes_images'] = array(
	'page'    => 'page_a',
	'type'    => 'checkbox',
	'options' => array(
		'pressapps'  => 'http://placehold.it/120x40/35d/fff&text=pressapps',
		'wordpress'  => 'http://placehold.it/120x40/3d5/fff&text=wordpress',
		'codecanyon' => 'http://placehold.it/120x40/d35/fff&text=codecanyon',
	),
);

$options['my_checkboxes_images_2'] = array(
	'page'      => 'page_a',
	'type'      => 'checkbox',
	'options'   => array(
		'pressapps'  => 'http://placehold.it/120x40/35d/fff&text=pressapps',
		'wordpress'  => 'http://placehold.it/120x40/3d5/fff&text=wordpress',
		'codecanyon' => 'http://placehold.it/120x40/d35/fff&text=codecanyon',
	),
	'separator' => ' ',
);

$options['my_checkboxes'] = array(
	'page'      => 'page_a',
	'type'      => 'checkbox',
	'options'   => array(
		'bird' => __( 'Bird' ),
		'cat'  => __( 'Cat' ),
	),
	'separator' => '&nbsp;&nbsp;|&nbsp;&nbsp;',
	'default'   => 'cat'
);

$options['my_posts_checkboxes'] = array(
	'page'    => 'page_a',
	'type'    => 'checkbox',
	'options' => 'posts',
);

$options['my_posts_multi'] = array(
	'page'     => 'page_a',
	'type'     => 'select',
	'options'  => 'posts',
	'multiple' => true,
);

$options['my_terms_dropdown'] = array(
	'page'       => 'page_a',
	'type'       => 'radio',
	'options'    => 'terms',
	'taxonomies' => array( 'post_tag' ),
	'args'       => 'hide_empty=0',
);

$options['my_textarea'] = array(
	'type' => 'textarea',
	'page' => 'page_a',
);

$options['advanced'] = array(
	'title'         => __( 'Advanced' ),
	'subtitle'      => __( 'Belongs to page_a/tab_1' ),
	'type'          => 'textarea',
	'page'          => 'page_a',
	'tab'           => 'tab_1',
	'section'       => 'advanced',
	'section_title' => __( 'Advanced Stuff' ),
	'description'   => '~',
	'editor'        => true,
	'editor_height' => 100,
	// 'textarea_rows' => 10,
	'teeny'         => true,
	'default'       => 'This is the default, it appears after reset',
	'value'         => 'This is value on page load (click reset)',
);

// Register options
paf_options( $options );
