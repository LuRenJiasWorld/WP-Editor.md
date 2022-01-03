#!/bin/bash
set -o xtrace

begin_time=$(date +%s)

source_dir="/data/source"
work_dir="/data/work"
target_dir="/data/target"
cache_dir="/data/cache"

echo "将当前的工作目录拷贝到工作目录......"
cp -R $source_dir/*             $work_dir
cp -R $source_dir/.eslintrc.js  $work_dir
cp -R $source_dir/.babelrc      $work_dir
step1_end_time=$(date +%s)

echo "配置工作目录权限..."
cd $work_dir
chmod -R 755 $work_dir
step2_end_time=$(date +%s)

ls -l

echo "安装相关依赖......"
if [ $CACHE_NODE_MODULES = "true" ]; then
    tar xf ${cache_dir}/main_node_modules/node_modules.tar
    npm prune
    npm install
    tar cf ${cache_dir}/main_node_modules/node_modules.tar node_modules
else
    npm install
fi
composer update
step3_end_time=$(date +%s)

echo "构建语言文件......"
msgfmt ./languages/editormd-zh_CN.po -o ./languages/editormd-zh_CN.mo &
msgfmt ./languages/editormd-zh_TW.po -o ./languages/editormd-zh_TW.mo &
step4_end_time=$(date +%s)

echo "构建JS与CSS文件......"
npm run build-dev &

# sm-ms-management处理
if [ $BUILD_SM_MS_MANAGEMENT = "true" ]; then
    echo "构建sm-ms-management"
    cd src/Pages/page/sm-ms-management
    npm install
    step5_end_time=$(date +%s)
    npm run build &
else
    echo "不构建sm-ms-management"
    step5_end_time=$step4_end_time
fi

wait
step6_end_time=$(date +%s)
echo "所有并行任务执行完成！"

rm -rf `ls -d $work_dir/* | grep -v "assets\|languages\|src\|vendor\|readme.txt\|LICENSE\|wp-editormd.php\|uninstall.php"`
rm -rf `ls -d $work_dir/src/Pages/page/sm-ms-management/* | grep -v "sm-ms-management.php\|html"`

echo "打包数据"
cd $work_dir
zip -9 -r $target_dir/wp_editor_md_$(date +%Y-%m-%d-%H-%M-%S).zip ./

step7_end_time=$(date +%s)

echo "配置输出目录权限"
cd $target_dir
chmod -R 777 ./*

cd /root
step8_end_time=$(date +%s)
echo "数据打包完成！"

end_time=$(date +%s)

echo "任务完成，总耗时$(($end_time-$begin_time))秒！"
echo "拷贝到工作目录耗时$(($step1_end_time-$begin_time))秒"
echo "配置权限耗时$(($step2_end_time-$step1_end_time))秒"
echo "安装依赖耗时$(($step3_end_time-$step2_end_time))秒"
echo "构建语言文件耗时$(($step4_end_time-$step3_end_time))秒"
echo "sm-ms-management安装依赖耗时$(($step5_end_time-$step4_end_time))秒"
echo "总构建耗时$(($step6_end_time-$step4_end_time))秒"
echo "打包数据耗时$(($step7_end_time-$step6_end_time))秒"
echo "配置输出目录权限耗时$(($step8_end_time-$step7_end_time))秒"
