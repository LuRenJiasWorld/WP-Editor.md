#!/bin/bash
set -o xtrace

begin_time=$(date +%s)

source_dir="/data/source"
work_dir="/data/work"
target_dir="/data/target"

echo "将当前的工作目录拷贝到工作目录......"
cp -R $source_dir/*             $work_dir
cp -R $source_dir/.eslintrc.js  $work_dir
cp -R $source_dir/.babelrc      $work_dir

echo "配置工作目录权限..."
cd $work_dir
chmod -R 755 $work_dir

echo "安装相关依赖......"
npm install
composer update

echo "构建语言文件......"
msgfmt ./languages/editormd-zh_CN.po -o ./languages/editormd-zh_CN.mo &
msgfmt ./languages/editormd-zh_TW.po -o ./languages/editormd-zh_TW.mo &

echo "构建JS与CSS文件......"
npm run build-dev &

# sm-ms-management处理
cd src/Pages/page/sm-ms-management
npm install
npm run build &

wait
echo "所有并行任务执行完成！"

rm -rf `ls -d $work_dir/* | grep -v "assets\|languages\|src\|vendor\|readme.txt\|LICENSE\|wp-editormd.php\|uninstall.php"`
rm -rf `ls -d $work_dir/src/Pages/page/sm-ms-management/* | grep -v "sm-ms-management.php\|html"`

echo "打包数据"
cd $target_dir
tar -cPf - $work_dir/* | pigz -6 -p 8 > $target_dir/wp_editor_md_$(date +%Y-%m-%d-%H-%M-%S).tar.gz

echo "配置输出目录权限"
cd $target_dir
chmod -R 777 ./*

cd /root

echo "数据打包完成！"

end_time=$(date +%s)
echo "任务完成，总耗时$(($end_time-$begin_time))秒！"
