<?php
/* =======================
        打包 zip
======================= */

system('bash produce.sh');  //这里是shell脚本的路径
echo "清理完成，下面执行打包构建...\n";
echo "<br/>";

$zip = new ZipArchive();
$zip->open('WP-Editor.md.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

$packageDirs = array('assets', 'languages', 'src', 'vendor');
$packageFiles = array(
	'readme.txt',
	'LICENSE',
	'wp-editormd.php',
	'uninstall.php'
);

foreach ($packageDirs as $dir) {
	$dirPath = realpath($dir);
	$files = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($dirPath),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ($files as $name => $file) {
		if (!$file->isDir()) {
			$relativePath = str_replace($dirPath, "{$dir}/", $file);
			$zip->addFile($file, $relativePath);
		}
	}
}
foreach ($packageFiles as $file) {
	$filePath = realpath($file);
	$filePath && $zip->addFile($filePath, $file);
}
$zip->close();

echo "<b>WP-Editor.md.zip</b>压缩构建完成\n";