<?php
/**PrismJS语法高亮处理库
 * Created by PhpStorm.
 * User: jaxson
 * Date: 2017/6/6
 * Time: 上午9:57
 */
class editormd_prismjs {

	public $languages = array();

	public $languages_all = array(
		"markup" => "Markup",
		"css" => "CSS",
		"clike" => "C-like",
		"javascript" => "JavaScript",
		"abap" => "ABAP",
		"actionscript" => "ActionScript",
		"ada" => "Ada",
		"apacheconf" => "Apache Configuration",
		"apl" => "APL",
		"applescript" => "AppleScript",
		"asciidoc" => "AsciiDoc",
		"aspnet" => "ASP.NET (C#)",
		"autoit" => "AutoIt",
		"autohotkey" => "AutoHotkey",
		"bash" => "Bash",
		"basic" => "BASIC",
		"batch" => "Batch",
		"bison" => "Bison",
		"brainfuck" => "Brainfuck",
		"bro" => "Bro",
		"c" => "C",
		"csharp" => "C#",
		"cpp" => "C++",
		"coffeescript" => "CoffeeScript",
		"crystal" => "Crystal",
		"css-extras" => "CSS Extras",
		"d" => "D",
		"dart" => "Dart",
		"django" => "Django/Jinja2",
		"diff" => "Diff",
		"docker" => "Docker",
		"eiffel" => "Eiffel",
		"elixir" => "Elixir",
		"erlang" => "Erlang",
		"fsharp" => "F#",
		"fortran" => "Fortran",
		"gherkin" => "Gherkin",
		"git" => "Git",
		"glsl" => "GLSL",
		"go" => "Go",
		"graphql" => "GraphQL",
		"groovy" => "Groovy",
		"haml" => "Haml",
		"handlebars" => "Handlebars",
		"haskell" => "Haskell",
		"haxe" => "Haxe",
		"http" => "HTTP",
		"icon" => "Icon",
		"inform7" => "Inform 7",
		"ini" => "Ini",
		"j" => "J",
		"jade" => "Jade",
		"java" => "Java",
		"jolie" => "Jolie",
		"json" => "JSON",
		"julia" => "Julia",
		"keyman" => "Keyman",
		"kotlin" => "Kotlin",
		"latex" => "LaTeX",
		"less" => "Less",
		"livescript" => "LiveScript",
		"lolcode" => "LOLCODE",
		"lua" => "Lua",
		"makefile" => "Makefile",
		"markdown" => "Markdown",
		"matlab" => "MATLAB",
		"mel" => "MEL",
		"mizar" => "Mizar",
		"monkey" => "Monkey",
		"nasm" => "NASM",
		"nginx" => "nginx",
		"nim" => "Nim",
		"nix" => "Nix",
		"nsis" => "NSIS",
		"objectivec" => "Objective-C",
		"ocaml" => "OCaml",
		"oz" => "Oz",
		"parigp" => "PARI/GP",
		"parser" => "Parser",
		"pascal" => "Pascal",
		"perl" => "Perl",
		"php" => "PHP",
		"php-extras" => "PHP Extras",
		"powershell" => "PowerShell",
		"processing" => "Processing",
		"prolog" => "Prolog",
		"properties" => ".properties",
		"protobuf" => "Protocol Buffers",
		"puppet" => "Puppet",
		"pure" => "Pure",
		"python" => "Python",
		"q" => "Q",
		"qore" => "Qore",
		"r" => "R",
		"jsx" => "React JSX",
		"reason" => "Reason",
		"rest" => "reST (reStructuredText)",
		"rip" => "Rip",
		"roboconf" => "Roboconf",
		"ruby" => "Ruby",
		"rust" => "Rust",
		"sas" => "SAS",
		"sass" => "Sass (Sass)",
		"scss" => "Sass (Scss)",
		"scala" => "Scala",
		"scheme" => "Scheme",
		"smalltalk" => "Smalltalk",
		"smarty" => "Smarty",
		"sql" => "SQL",
		"stylus" => "Stylus",
		"swift" => "Swift",
		"tcl" => "Tcl",
		"textile" => "Textile",
		"twig" => "Twig",
		"typescript" => "TypeScript",
		"vbnet" => "VB.Net",
		"verilog" => "Verilog",
		"vhdl" => "VHDL",
		"vim" => "vim",
		"wiki" => "Wiki markup",
		"xojo" => "Xojo (REALbasic)",
		"yaml" => "YAML"
	);

	public $languages_default = array(
		"markup" => "Markup",
		"css" => "CSS",
		"clike" => "C-like",
		"javascript" => "JavaScript",
	);

	public $prism_plugins = array(
		"line-numbers" => array(
			"css" => true,
			"js" => true
		)
	);

	public function __construct() {
		add_filter('the_content', array($this, 'prism_languages'));
		add_action('wp_footer', array($this, 'prism_styles_scripts'));
	}

	public function prism_languages($content) {
		if (preg_match_all('/<code class="language-([a-z\-0-9]+)"/', $content, $language_matches) > 0 && !empty($language_matches[1])) {
			foreach ($language_matches[1] as $language_match) {
				if (isset($this->languages_all[$language_match])) {
					$this->languages[$language_match] = $this->languages_all[$language_match];
				}
			}
		}
		return $content;
	}

	public function prism_styles_scripts() {
		$options = get_option( 'editormd_options' );
		$prism_base_url = isset( $options['support_highlight_library'] ) && $options['support_highlight_library'] == '' ? '//cdn.bootcss.com/prism/1.6.0' : $options['support_highlight_library']; //资源载入地址
		$prism_theme = isset( $options['support_highlight_library_style'] ) && $options['support_highlight_library_style'] == '' ? 'default' : $options['support_highlight_library_style']; //语法高亮风格
		$prism_styles = array();
		$prism_scripts = array();

		if (!empty($this->languages)) {
			if (count($this->languages) <= count($this->languages_default)) {
				$use_default = true;
				foreach ($this->languages as $language => $display_name) {
					if (!array_key_exists($language, $this->languages_default)) {
						$use_default = false;
						break;
					}
				}
			} else {
				$use_default = false;
			}
			if ($use_default) {
				$prism_scripts[] = $prism_base_url . "/prism.min.js";
			} else {
				$prism_scripts[] = $prism_base_url . "/components/prism-core.min.js";
				foreach ($this->languages as $language => $display_name) {
					$prism_scripts[] = $prism_base_url . "/components/prism-{$language}.min.js";
				}
			}
			if (empty($prism_theme) || $prism_theme == 'default') {
				$prism_styles[] = $prism_base_url . "/themes/prism.min.css";
			} else {
				$prism_styles[] = $prism_base_url . "/themes/prism-{$prism_theme}.min.css";
			}
			foreach ($this->prism_plugins as $prism_plugin => $prism_plugin_config) {
				if ($prism_plugin_config['css'] === true) {
					$prism_styles[] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.css";
				}
				if ($prism_plugin_config['js'] === true) {
					$prism_scripts[] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.js";
				}
			}
		}

		foreach ($prism_styles as $prism_style) {
			echo '<link rel="stylesheet" type="text/css" href="' . $prism_style . '">';
		}

		foreach ($prism_scripts as $prism_script) {
			echo '<script type="text/javascript" src="' . $prism_script . '"></script>';
		}
	}
}

//实例化
$prism = new editormd_prismjs();