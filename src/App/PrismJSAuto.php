<?php

namespace App;

class PrismJSAuto {

	public $languages = array();

	public $languages_all = array(
		'markup'            => array(
			'title'                 => 'Markup',
			'alias'                 => array(
				'html',
				'xml',
				'svg',
				'mathml'
			),
			'aliasTitles'           => array(
				'html'   => 'HTML',
				'xml'    => 'XML',
				'svg'    => 'SVG',
				'mathml' => 'MathML'
			),
			'overrideExampleHeader' => true,
			'option'                => 'default',
			'used'                  => false
		),
		'html'              => array(
			'title'   => 'HTML',
			'option'  => 'default',
			'require' => array( 'markup' ),
			'used'    => false,
		),
		'xml'               => array(
			'title'   => 'XML',
			'option'  => 'default',
			'require' => array( 'markup' ),
			'used'    => false,
		),
		'svg'               => array(
			'title'   => 'SVG',
			'option'  => 'default',
			'require' => array( 'markup' ),
			'used'    => false,
		),
		'mathml'            => array(
			'title'   => 'MathML',
			'option'  => 'default',
			'require' => array( 'markup' ),
			'used'    => false,
		),
		'css'               => array(
			'title'  => 'CSS',
			'option' => 'default',
			'used'   => false
		),
		'clike'             => array(
			'title'                 => 'C-like',
			'option'                => 'default',
			'overrideExampleHeader' => true,
			'used'                  => false
		),
		'javascript'        => array(
			'title'   => 'JavaScript',
			'require' => array('clike'),
			'alias'   => 'js',
			'option'  => 'default',
			'used'    => false
		),
		'abap'              => array(
			'title' => 'ABAP',
			'owner' => 'dellagustin',
			'used'  => false
		),
		'actionscript'      => array(
			'title'   => 'ActionScript',
			'require' => array('javascript'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'ada'               => array(
			'title' => 'Ada',
			'owner' => 'Lucretia',
			'used'  => false
		),
		'apacheconf'        => array(
			'title' => 'Apache Configuration',
			'owner' => 'GuiTeK',
			'used'  => false
		),
		'apl'               => array(
			'title' => 'APL',
			'owner' => 'ngn',
			'used'  => false
		),
		'applescript'       => array(
			'title' => 'AppleScript',
			'owner' => 'Golmote',
			'used'  => false
		),
		'arduino'           => array(
			'title'   => 'Arduino',
			'require' => array('cpp'),
			'owner'   => 'eisbehr-',
			'used'    => false
		),
		'arff'              => array(
			'title' => 'ARFF',
			'owner' => 'Golmote',
			'used'  => false
		),
		'asciidoc'          => array(
			'title' => 'AsciiDoc',
			'owner' => 'Golmote',
			'used'  => false
		),
		'asm6502'           => array(
			'title' => '6502 Assembly',
			'owner' => 'kzurawel',
			'used'  => false
		),
		'aspnet'            => array(
			'title'   => 'ASP.NET (C#)',
			'require' => array('markup'),
			'owner'   => 'nauzilus',
			'used'    => false
		),
		'autohotkey'        => array(
			'title' => 'AutoHotkey',
			'owner' => 'aviaryan',
			'used'  => false
		),
		'autoit'            => array(
			'title' => 'AutoIt',
			'owner' => 'Golmote',
			'used'  => false
		),
		'bash'              => array(
			'title' => 'Bash',
			'owner' => 'zeitgeist87',
			'used'  => false
		),
		'basic'             => array(
			'title' => 'BASIC',
			'owner' => 'Golmote',
			'used'  => false
		),
		'batch'             => array(
			'title' => 'Batch',
			'alias' => 'shell',
			'owner' => 'Golmote',
			'used'  => false
		),
		'bison'             => array(
			'title'   => 'Bison',
			'require' => array('c'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'brainfuck'         => array(
			'title' => 'Brainfuck',
			'owner' => 'Golmote',
			'used'  => false
		),
		'bro'               => array(
			'title' => 'Bro',
			'owner' => 'wayward710',
			'used'  => false
		),
		'c'                 => array(
			'title'   => 'C',
			'require' => array('clike'),
			'owner'   => 'zeitgeist87',
			'used'    => false
		),
		'csharp'            => array(
			'title'   => 'C#',
			'require' => array('clike'),
			'alias'   => 'dotnet',
			'owner'   => 'mvalipour',
			'used'    => false
		),
		'cpp'               => array(
			'title'   => 'C++',
			'require' => array('c'),
			'owner'   => 'zeitgeist87',
			'used'    => false
		),
		'coffeescript'      => array(
			'title'   => 'CoffeeScript',
			'require' => array('javascript'),
			'owner'   => 'R-osey',
			'used'    => false
		),
		'clojure'           => array(
			'title' => 'Clojure',
			'owner' => 'troglotit',
			'used'  => false
		),
		'crystal'           => array(
			'title'   => 'Crystal',
			'require' => array('ruby'),
			'owner'   => 'MakeNowJust',
			'used'    => false
		),
		'csp'               => array(
			'title' => 'Content-Security-Policy',
			'owner' => 'ScottHelme',
			'used'  => false
		),
		'css-extras'        => array(
			'title'   => 'CSS Extras',
			'require' => array('css'),
			'owner'   => 'milesj',
			'used'    => false
		),
		'd'                 => array(
			'title'   => 'D',
			'require' => array('clike'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'dart'              => array(
			'title'   => 'Dart',
			'require' => array('clike'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'diff'              => array(
			'title' => 'Diff',
			'owner' => 'uranusjr',
			'used'  => false
		),
		'django'            => array(
			'title'   => 'Django/Jinja2',
			'require' => array('markup'),
			'alias'   => 'jinja2',
			'owner'   => 'romanvm',
			'used'    => false
		),
		'docker'            => array(
			'title' => 'Docker',
			'owner' => 'JustinBeckwith',
			'used'  => false
		),
		'eiffel'            => array(
			'title' => 'Eiffel',
			'owner' => 'Conaclos',
			'used'  => false
		),
		'elixir'            => array(
			'title' => 'Elixir',
			'owner' => 'Golmote',
			'used'  => false
		),
		'elm'               => array(
			'title' => 'Elm',
			'owner' => 'zwilias',
			'used'  => false
		),
		'erb'               => array(
			'title'   => 'ERB',
			'require' => array(
				'ruby',
				'markup-templating'
			),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'erlang'            => array(
			'title' => 'Erlang',
			'owner' => 'Golmote',
			'used'  => false
		),
		'fsharp'            => array(
			'title'   => 'F#',
			'require' => array('clike'),
			'owner'   => 'simonreynolds7',
			'used'    => false
		),
		'flow'              => array(
			'title'   => 'Flow',
			'require' => array('javascript'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'fortran'           => array(
			'title' => 'Fortran',
			'owner' => 'Golmote',
			'used'  => false
		),
		'gedcom'            => array(
			'title' => 'GEDCOM',
			'owner' => 'Golmote',
			'used'  => false
		),
		'gherkin'           => array(
			'title' => 'Gherkin',
			'owner' => 'hason',
			'used'  => false
		),
		'git'               => array(
			'title' => 'Git',
			'owner' => 'lgiraudel',
			'used'  => false
		),
		'glsl'              => array(
			'title'   => 'GLSL',
			'require' => array('clike'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'go'                => array(
			'title'   => 'Go',
			'require' => array('clike'),
			'owner'   => 'arnehormann',
			'used'    => false
		),
		'graphql'           => array(
			'title' => 'GraphQL',
			'owner' => 'Golmote',
			'used'  => false
		),
		'groovy'            => array(
			'title'   => 'Groovy',
			'require' => array('clike'),
			'owner'   => 'robfletcher',
			'used'    => false
		),
		'haml'              => array(
			'title'   => 'Haml',
			'require' => array('ruby'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'handlebars'        => array(
			'title'   => 'Handlebars',
			'require' => array('markup-templating'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'haskell'           => array(
			'title' => 'Haskell',
			'owner' => 'bholst',
			'used'  => false
		),
		'haxe'              => array(
			'title'   => 'Haxe',
			'require' => array('clike'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'http'              => array(
			'title' => 'HTTP',
			'owner' => 'danielgtaylor',
			'used'  => false
		),
		'hpkp'              => array(
			'title' => 'HTTP Public-Key-Pins',
			'owner' => 'ScottHelme',
			'used'  => false
		),
		'hsts'              => array(
			'title' => 'HTTP Strict-Transport-Security',
			'owner' => 'ScottHelme',
			'used'  => false
		),
		'ichigojam'         => array(
			'title' => 'IchigoJam',
			'owner' => 'BlueCocoa',
			'used'  => false
		),
		'icon'              => array(
			'title' => 'Icon',
			'owner' => 'Golmote',
			'used'  => false
		),
		'inform7'           => array(
			'title' => 'Inform 7',
			'owner' => 'Golmote',
			'used'  => false
		),
		'ini'               => array(
			'title' => 'Ini',
			'owner' => 'aviaryan',
			'used'  => false
		),
		'io'                => array(
			'title' => 'Io',
			'owner' => 'AlesTsurko',
			'used'  => false
		),
		'j'                 => array(
			'title' => 'J',
			'owner' => 'Golmote',
			'used'  => false
		),
		'java'              => array(
			'title'   => 'Java',
			'require' => array('clike'),
			'owner'   => 'sherblot',
			'used'    => false
		),
		'jolie'             => array(
			'title'   => 'Jolie',
			'require' => array('clike'),
			'owner'   => 'thesave',
			'used'    => false
		),
		'json'              => array(
			'title' => 'JSON',
			'owner' => 'CupOfTea696',
			'used'  => false
		),
		'julia'             => array(
			'title' => 'Julia',
			'owner' => 'cdagnino',
			'used'  => false
		),
		'keyman'            => array(
			'title' => 'Keyman',
			'owner' => 'mcdurdin',
			'used'  => false
		),
		'kotlin'            => array(
			'title'   => 'Kotlin',
			'require' => array('clike'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'latex'             => array(
			'title' => 'LaTeX',
			'owner' => 'japborst',
			'used'  => false
		),
		'less'              => array(
			'title'   => 'Less',
			'require' => array('css'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'liquid'            => array(
			'title' => 'Liquid',
			'owner' => 'cinhtau',
			'used'  => false
		),
		'lisp'              => array(
			'title' => 'Lisp',
			'owner' => 'JuanCaicedo',
			'alias' => array(
				'emacs',
				'elisp',
				'emacs-lisp'
			),
			'used'  => false
		),
		'livescript'        => array(
			'title' => 'LiveScript',
			'owner' => 'Golmote',
			'used'  => false
		),
		'lolcode'           => array(
			'title' => 'LOLCODE',
			'owner' => 'Golmote',
			'used'  => false
		),
		'lua'               => array(
			'title' => 'Lua',
			'owner' => 'Golmote',
			'used'  => false
		),
		'makefile'          => array(
			'title' => 'Makefile',
			'owner' => 'Golmote',
			'used'  => false
		),
		'markdown'          => array(
			'title'   => 'Markdown',
			'require' => array('markup'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'markup-templating' => array(
			'title'   => 'Markup templating',
			'require' => array('markup'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'matlab'            => array(
			'title' => 'MATLAB',
			'owner' => 'Golmote',
			'used'  => false
		),
		'mel'               => array(
			'title' => 'MEL',
			'owner' => 'Golmote',
			'used'  => false
		),
		'mizar'             => array(
			'title' => 'Mizar',
			'owner' => 'Golmote',
			'used'  => false
		),
		'monkey'            => array(
			'title' => 'Monkey',
			'owner' => 'Golmote',
			'used'  => false
		),
		'n4js'              => array(
			'title'   => 'N4JS',
			'require' => array('javascript'),
			'owner'   => 'bsmith-n4',
			'used'    => false
		),
		'nasm'              => array(
			'title' => 'NASM',
			'owner' => 'rbmj',
			'used'  => false
		),
		'nginx'             => array(
			'title'   => 'nginx',
			'owner'   => 'westonganger',
			'require' => array('clike'),
			'used'    => false
		),
		'nim'               => array(
			'title' => 'Nim',
			'owner' => 'Golmote',
			'used'  => false
		),
		'nix'               => array(
			'title' => 'Nix',
			'owner' => 'Golmote',
			'used'  => false
		),
		'nsis'              => array(
			'title' => 'NSIS',
			'owner' => 'idleberg',
			'used'  => false
		),
		'objectivec'        => array(
			'title'   => 'Objective-C',
			'require' => array('c'),
			'owner'   => 'uranusjr',
			'used'    => false
		),
		'ocaml'             => array(
			'title' => 'OCaml',
			'owner' => 'Golmote',
			'used'  => false
		),
		'opencl'            => array(
			'title'                 => 'OpenCL',
			'require'               => 'cpp',
			'overrideExampleHeader' => true,
			'owner'                 => 'Milania1',
			'used'                  => false
		),
		'oz'                => array(
			'title' => 'Oz',
			'owner' => 'Golmote',
			'used'  => false
		),
		'parigp'            => array(
			'title' => 'PARI/GP',
			'owner' => 'Golmote',
			'used'  => false
		),
		'parser'            => array(
			'title'   => 'Parser',
			'require' => array('markup'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'pascal'            => array(
			'title' => 'Pascal',
			'owner' => 'Golmote',
			'used'  => false
		),
		'perl'              => array(
			'title' => 'Perl',
			'owner' => 'Golmote',
			'used'  => false
		),
		'php'               => array(
			'title'   => 'PHP',
			'require' => array(
				'clike',
				'markup-templating'
			),
			'owner'   => 'milesj',
			'used'    => false
		),
		'php-extras'        => array(
			'title'   => 'PHP Extras',
			'require' => array('php'),
			'owner'   => 'milesj',
			'used'    => false
		),
		'plsql'             => array(
			'title'   => 'PL/SQL',
			'require' => array('sql'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'powershell'        => array(
			'title' => 'PowerShell',
			'owner' => 'nauzilus',
			'used'  => false
		),
		'processing'        => array(
			'title'   => 'Processing',
			'require' => array('clike'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'prolog'            => array(
			'title' => 'Prolog',
			'owner' => 'Golmote',
			'used'  => false
		),
		'properties'        => array(
			'title' => '.properties',
			'owner' => 'Golmote',
			'used'  => false
		),
		'protobuf'          => array(
			'title'   => 'Protocol Buffers',
			'require' => array('clike'),
			'owner'   => 'just-boris',
			'used'    => false
		),
		'pug'               => array(
			'title'   => 'Pug',
			'require' => array('javascript'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'puppet'            => array(
			'title' => 'Puppet',
			'owner' => 'Golmote',
			'used'  => false
		),
		'pure'              => array(
			'title' => 'Pure',
			'owner' => 'Golmote',
			'used'  => false
		),
		'python'            => array(
			'title' => 'Python',
			'owner' => 'multipetros',
			'used'  => false
		),
		'q'                 => array(
			'title' => 'Q (kdb+ database)',
			'owner' => 'Golmote',
			'used'  => false
		),
		'qore'              => array(
			'title'   => 'Qore',
			'require' => array('clike'),
			'owner'   => 'temnroegg',
			'used'    => false
		),
		'r'                 => array(
			'title' => 'R',
			'owner' => 'Golmote',
			'used'  => false
		),
		'jsx'               => array(
			'title'   => 'React JSX',
			'require' => array(
				'markup',
				'javascript'
			),
			'owner'   => 'vkbansal',
			'used'    => false
		),
		'tsx'               => array(
			'title'   => 'React TSX',
			'require' => array(
				'jsx',
				'typescript'
			),
			'used'    => false
		),
		'renpy'             => array(
			'title' => 'Ren\'py',
			'owner' => 'HyuchiaDiego',
			'used'  => false
		),
		'reason'            => array(
			'title'   => 'Reason',
			'require' => array('clike'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'rest'              => array(
			'title' => 'reST (reStructuredText)',
			'owner' => 'Golmote',
			'used'  => false
		),
		'rip'               => array(
			'title' => 'Rip',
			'owner' => 'ravinggenius',
			'used'  => false
		),
		'roboconf'          => array(
			'title' => 'Roboconf',
			'owner' => 'Golmote',
			'used'  => false
		),
		'ruby'              => array(
			'title'   => 'Ruby',
			'require' => array('clike'),
			'owner'   => 'samflores',
			'used'    => false
		),
		'rust'              => array(
			'title' => 'Rust',
			'owner' => 'Golmote',
			'used'  => false
		),
		'sas'               => array(
			'title' => 'SAS',
			'owner' => 'Golmote',
			'used'  => false
		),
		'sass'              => array(
			'title'   => 'Sass (Sass)',
			'require' => array('css'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'scss'              => array(
			'title'   => 'Sass (Scss)',
			'require' => array('css'),
			'owner'   => 'MoOx',
			'used'    => false
		),
		'scala'             => array(
			'title'   => 'Scala',
			'require' => array('java'),
			'owner'   => 'jozic',
			'used'    => false
		),
		'scheme'            => array(
			'title' => 'Scheme',
			'owner' => 'bacchus123',
			'used'  => false
		),
		'smalltalk'         => array(
			'title' => 'Smalltalk',
			'owner' => 'Golmote',
			'used'  => false
		),
		'smarty'            => array(
			'title'   => 'Smarty',
			'require' => array('markup-templating'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'sql'               => array(
			'title' => 'SQL',
			'owner' => 'multipetros',
			'used'  => false
		),
		'soy'               => array(
			'title'   => 'Soy (Closure Template)',
			'require' => array('markup-templating'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'stylus'            => array(
			'title' => 'Stylus',
			'owner' => 'vkbansal',
			'used'  => false
		),
		'swift'             => array(
			'title'   => 'Swift',
			'require' => array('clike'),
			'owner'   => 'chrischares',
			'used'    => false
		),
		'tcl'               => array(
			'title' => 'Tcl',
			'owner' => 'PeterChaplin',
			'used'  => false
		),
		'textile'           => array(
			'title'   => 'Textile',
			'require' => array('markup'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'twig'              => array(
			'title'   => 'Twig',
			'require' => array('markup'),
			'owner'   => 'brandonkelly',
			'used'    => false
		),
		'typescript'        => array(
			'title'   => 'TypeScript',
			'require' => array('javascript'),
			'alias'   => 'ts',
			'owner'   => 'vkbansal',
			'used'    => false
		),
		'vbnet'             => array(
			'title'   => 'VB.Net',
			'require' => array('basic'),
			'owner'   => 'Bigsby',
			'used'    => false
		),
		'velocity'          => array(
			'title'   => 'Velocity',
			'require' => array('markup'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'verilog'           => array(
			'title' => 'Verilog',
			'owner' => 'a-rey',
			'used'  => false
		),
		'vhdl'              => array(
			'title' => 'VHDL',
			'owner' => 'a-rey',
			'used'  => false
		),
		'vim'               => array(
			'title' => 'vim',
			'owner' => 'westonganger',
			'used'  => false
		),
		'visual-basic'      => array(
			'title' => 'Visual Basic',
			'owner' => 'Golmote',
			'alias' => 'vb',
			'used'  => false
		),
		'wasm'              => array(
			'title' => 'WebAssembly',
			'owner' => 'Golmote',
			'used'  => false
		),
		'wiki'              => array(
			'title'   => 'Wiki markup',
			'require' => array('markup'),
			'owner'   => 'Golmote',
			'used'    => false
		),
		'xeora'             => array(
			'title'   => 'Xeora',
			'require' => array('markup'),
			'owner'   => 'freakmaxi',
			'used'    => false
		),
		'xojo'              => array(
			'title' => 'Xojo (REALbasic)',
			'owner' => 'Golmote',
			'used'  => false
		),
		'yaml'              => array(
			'title' => 'YAML',
			'owner' => 'hason',
			'used'  => false
		)
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
		$prism_base_url = $this->prism_url(); //资源载入地址
		$prism_theme    = $this->get_option( 'highlight_library_style', 'syntax_highlighting' ); //语法高亮风格
		$line_numbers = $this->get_option( 'line_numbers', 'syntax_highlighting' ) == 'on' ? true : false; //行号显示
		$prism_plugins  = array(
			"line-numbers" => array(
				"css" => $line_numbers,
				"js"  => $line_numbers
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
					if ( $language != 'html' && $language != 'xml' && $language != 'svg' && $language != 'mathml' ) {
						$prism_scripts["prism-language-{$language}-js"] = $prism_base_url . "/components/prism-{$language}.min.js";
					}
				}
			}

			if ( empty( $prism_theme ) || $prism_theme == 'default' ) {
				$prism_styles['prism-theme-default'] = $prism_base_url . "/themes/prism.min.css";
			} else {
				$prism_styles['prism-theme-style'] = $prism_base_url . "/themes/prism-{$prism_theme}.min.css";
			}
			foreach ( $prism_plugins as $prism_plugin => $prism_plugin_config ) {
				if ( $prism_plugin_config['css'] === true ) {
					$prism_styles["prism-plugin-{$prism_plugin}"] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.css";
				}
				if ( $prism_plugin_config['js'] === true ) {
					$prism_scripts["prism-plugin-{$prism_plugin}"] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.js";
				}
			}
		}

		foreach ( $prism_styles as $name => $prism_style ) {
			wp_register_style( $name, $prism_style );
			wp_enqueue_style( $name );
		}

		foreach ( $prism_scripts as $name => $prism_script ) {
			wp_register_script( $name, $prism_script );
			wp_enqueue_script( $name );
		}
	}

	private function prism_url() {
		if ( $this->get_option( 'static_cdn', 'editor_basics' ) === '//cdn.jsdelivr.net' ) {
			$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/prismjs@1.14.0';
		} else {
			$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/prism/1.14.0';
		}

		return $lib_url;
	}

	/**
	 * 获取字段值
	 *
	 * @param string $option 字段名称
	 * @param string $section 字段名称分组
	 * @param string $default 没搜索到返回空
	 *
	 * @return mixed
	 */
	public function get_option( $option, $section, $default = '' ) {

		$options = get_option( $section );

		if ( isset( $options[ $option ] ) ) {
			return $options[ $option ];
		}

		return $default;
	}
}