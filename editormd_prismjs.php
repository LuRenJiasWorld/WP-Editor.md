<?php

class editormd_prismjs {

	public $languages = array();

	public $languages_all = array(
		'markup'       =>
			array(
				'used' => false,
			),
		'html'         =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'xml'          =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'svg'          =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'mathml'       =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'css'          =>
			array(
				'used' => false,
			),
		'clike'        =>
			array(
				'used' => false,
			),
		'javascript'   =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'abap'         =>
			array(
				'used' => false,
			),
		'actionscript' =>
			array(
				'require' => array( 'javascript' ),
				'used'    => false,
			),
		'ada'          =>
			array(
				'used' => false,
			),
		'apacheconf'   =>
			array(
				'used' => false,
			),
		'apl'          =>
			array(
				'used' => false,
			),
		'applescript'  =>
			array(
				'used' => false,
			),
		'asciidoc'     =>
			array(
				'used' => false,
			),
		'aspnet'       =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'autoit'       =>
			array(
				'used' => false,
			),
		'autohotkey'   =>
			array(
				'used' => false,
			),
		'bash'         =>
			array(
				'used' => false,
			),
		'basic'        =>
			array(
				'used' => false,
			),
		'batch'        =>
			array(
				'used' => false,
			),
		'bison'        =>
			array(
				'require' => array( 'c' ),
				'used'    => false,
			),
		'brainfuck'    =>
			array(
				'used' => false,
			),
		'bro'          =>
			array(
				'used' => false,
			),
		'c'            =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'csharp'       =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'cpp'          =>
			array(
				'require' => array( 'c' ),
				'used'    => false,
			),
		'coffeescript' =>
			array(
				'require' => array( 'javascript' ),
				'used'    => false,
			),
		'crystal'      =>
			array(
				'require' => array( 'ruby' ),
				'used'    => false,
			),
		'css-extras'   =>
			array(
				'require' => array( 'css' ),
				'used'    => false,
			),
		'd'            =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'dart'         =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'django'       =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'diff'         =>
			array(
				'used' => false,
			),
		'docker'       =>
			array(
				'used' => false,
			),
		'eiffel'       =>
			array(
				'used' => false,
			),
		'elixir'       =>
			array(
				'used' => false,
			),
		'erlang'       =>
			array(
				'used' => false,
			),
		'fsharp'       =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'fortran'      =>
			array(
				'used' => false,
			),
		'gherkin'      =>
			array(
				'used' => false,
			),
		'git'          =>
			array(
				'used' => false,
			),
		'glsl'         =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'go'           =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'graphql'      =>
			array(
				'used' => false,
			),
		'groovy'       =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'haml'         =>
			array(
				'require' => array( 'ruby' ),
				'used'    => false,
			),
		'handlebars'   =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'haskell'      =>
			array(
				'used' => false,
			),
		'haxe'         =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'http'         =>
			array(
				'used' => false,
			),
		'icon'         =>
			array(
				'used' => false,
			),
		'inform7'      =>
			array(
				'used' => false,
			),
		'ini'          =>
			array(
				'used' => false,
			),
		'j'            =>
			array(
				'used' => false,
			),
		'jade'         =>
			array(
				'require' => array( 'javascript' ),
				'used'    => false,
			),
		'java'         =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'jolie'        =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'json'         =>
			array(
				'used' => false,
			),
		'julia'        =>
			array(
				'used' => false,
			),
		'keyman'       =>
			array(
				'used' => false,
			),
		'kotlin'       =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'latex'        =>
			array(
				'used' => false,
			),
		'less'         =>
			array(
				'require' => array( 'css' ),
				'used'    => false,
			),
		'livescript'   =>
			array(
				'used' => false,
			),
		'lolcode'      =>
			array(
				'used' => false,
			),
		'lua'          =>
			array(
				'used' => false,
			),
		'makefile'     =>
			array(
				'used' => false,
			),
		'markdown'     =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'matlab'       =>
			array(
				'used' => false,
			),
		'mel'          =>
			array(
				'used' => false,
			),
		'mizar'        =>
			array(
				'used' => false,
			),
		'monkey'       =>
			array(
				'used' => false,
			),
		'nasm'         =>
			array(
				'used' => false,
			),
		'nginx'        =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'nim'          =>
			array(
				'used' => false,
			),
		'nix'          =>
			array(
				'used' => false,
			),
		'nsis'         =>
			array(
				'used' => false,
			),
		'objectivec'   =>
			array(
				'require' => array( 'c' ),
				'used'    => false,
			),
		'ocaml'        =>
			array(
				'used' => false,
			),
		'oz'           =>
			array(
				'used' => false,
			),
		'parigp'       =>
			array(
				'used' => false,
			),
		'parser'       =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'pascal'       =>
			array(
				'used' => false,
			),
		'perl'         =>
			array(
				'used' => false,
			),
		'php'          =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'php-extras'   =>
			array(
				'require' => array( 'php' ),
				'used'    => false,
			),
		'powershell'   =>
			array(
				'used' => false,
			),
		'processing'   =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'prolog'       =>
			array(
				'used' => false,
			),
		'properties'   =>
			array(
				'used' => false,
			),
		'protobuf'     =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'puppet'       =>
			array(
				'used' => false,
			),
		'pure'         =>
			array(
				'used' => false,
			),
		'python'       =>
			array(
				'used' => false,
			),
		'q'            =>
			array(
				'used' => false,
			),
		'qore'         =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'r'            =>
			array(
				'used' => false,
			),
		'jsx'          =>
			array(
				'require' =>
					array(
						'markup',
						'javascript',
					),
				'used'    => false,
			),
		'reason'       =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'rest'         =>
			array(
				'used' => false,
			),
		'rip'          =>
			array(
				'used' => false,
			),
		'roboconf'     =>
			array(
				'used' => false,
			),
		'ruby'         =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'rust'         =>
			array(
				'used' => false,
			),
		'sas'          =>
			array(
				'used' => false,
			),
		'sass'         =>
			array(
				'require' => array( 'css' ),
				'used'    => false,
			),
		'scss'         =>
			array(
				'require' => array( 'css' ),
				'used'    => false,
			),
		'scala'        =>
			array(
				'require' => array( 'java' ),
				'used'    => false,
			),
		'scheme'       =>
			array(
				'used' => false,
			),
		'smalltalk'    =>
			array(
				'used' => false,
			),
		'smarty'       =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'sql'          =>
			array(
				'used' => false,
			),
		'stylus'       =>
			array(
				'used' => false,
			),
		'swift'        =>
			array(
				'require' => array( 'clike' ),
				'used'    => false,
			),
		'tcl'          =>
			array(
				'used' => false,
			),
		'textile'      =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'twig'         =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'typescript'   =>
			array(
				'require' => array( 'javascript' ),
				'used'    => false,
			),
		'vbnet'        =>
			array(
				'require' => array( 'basic' ),
				'used'    => false,
			),
		'verilog'      =>
			array(
				'used' => false,
			),
		'vhdl'         =>
			array(
				'used' => false,
			),
		'vim'          =>
			array(
				'used' => false,
			),
		'wiki'         =>
			array(
				'require' => array( 'markup' ),
				'used'    => false,
			),
		'xojo'         =>
			array(
				'used' => false,
			),
		'yaml'         =>
			array(
				'used' => false,
			),
	);

	public $languages_default = array(
		"markup"     => "Markup",
		"css"        => "CSS",
		"clike"      => "C-like",
		"javascript" => "JavaScript",
	);

	public function __construct() {
		add_filter( 'the_content', array( $this, 'prism_languages' ) );
		add_filter( 'comment_text', array( $this, 'prism_languages' ) );
		add_action( 'wp_footer', array( $this, 'prism_styles_scripts' ) );
	}

	public function prism_languages( $content ) {
		if ( preg_match_all( '/<code class="language-([a-z\-0-9]+)"/', $content, $language_matches ) > 0 && ! empty( $language_matches[1] ) ) {
			foreach ( $language_matches[1] as $language_match ) {
				if ( isset( $this->languages_all[ $language_match ] ) ) {
					$this->languages_all[ $language_match ]['used'] = true;
					$this->update_require( $this->languages_all[ $language_match ] );
				}
			}
		}
		foreach ( $this->languages_all as $language => $meta ) {
			if ( $meta['used'] === true ) {
				array_push( $this->languages, $language );
			}
		}

		return $content;
	}

	public function update_require( $language ) {
		if ( isset( $language['require'] ) ) {
			foreach ( $language['require'] as $key ) {
				$this->languages_all[ $key ]['used'] = true;
				$this->update_require( $this->languages_all[ $key ] );
			}
		}
	}

	public function prism_styles_scripts() {
		$prism_base_url = paf('highlight_library'); //资源载入地址
		$prism_theme    = paf('highlight_library_style'); //语法高亮风格
		$prism_plugins  = array(
			"line-numbers" => array(
				"css" => paf('line_numbers') == 1 ? true : false,
				"js"  => paf('line_numbers') == 1 ? true : false
			)
		);
		$prism_styles   = array();
		$prism_scripts  = array();

		if ( ! empty( $this->languages ) ) {
			if ( count( $this->languages ) <= count( $this->languages_default ) ) {
				$use_default = true;
				foreach ( $this->languages as $language ) {
					if ( ! array_key_exists( $language, $this->languages_default ) ) {
						$use_default = false;
						break;
					}
				}
			} else {
				$use_default = false;
			}
			if ( $use_default ) {
				$prism_scripts['prism-language-default-js'] = $prism_base_url . "/prism.min.js";
			} else {
				$prism_scripts['prism-core-js'] = $prism_base_url . "/components/prism-core.min.js";
				foreach ( $this->languages as $language ) {
					if( $language != 'html' && $language != 'xml' && $language != 'svg' && $language != 'mathml' ) {
						$prism_scripts["prism-language-{$language}-js"] = $prism_base_url . "/components/prism-{$language}.min.js";
					}
				}
			}

            if ( empty( $prism_theme ) || $prism_theme == 'default' ) {
				$prism_styles['prism-theme-css'] = $prism_base_url . "/themes/prism.min.css";
			} else {
				$prism_styles['prism-theme-css'] = $prism_base_url . "/themes/prism-{$prism_theme}.min.css";
			}
			foreach ( $prism_plugins as $prism_plugin => $prism_plugin_config ) {
				if ( $prism_plugin_config['css'] === true ) {
					$prism_styles["prism-plugin-{$prism_plugin}-css"] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.css";
				}
				if ( $prism_plugin_config['js'] === true ) {
					$prism_scripts["prism-plugin-{$prism_plugin}-js"] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.js";
				}
			}
		}

		foreach ( $prism_styles as $name => $prism_style ) {
			wp_register_style($name, $prism_style);
			wp_enqueue_style($name);
		}

		foreach ( $prism_scripts as $name => $prism_script ) {
			wp_register_script($name, $prism_script);
			wp_enqueue_script($name);
		}
	}
}

//实例化
$prism = new editormd_prismjs();