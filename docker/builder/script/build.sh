#!/usr/bin/env bash

set -o xtrace

begin_time=$(date +%s)

source_dir="/data/source"
work_dir="/data/work"
dist_dir="/data/dist"
target_dir="/data/target"
cache_dir="/data/cache"

HTTP_PROXY="${HTTP_PROXY:-}"
http_proxy="${http_proxy:-}"
HTTPS_PROXY="${HTTPS_PROXY:-}"
https_proxy="${https_proxy:-}"
NO_PROXY="${NO_PROXY:-}"
no_proxy="${no_proxy:-}"
CLEAN_BUILD="${CLEAN_BUILD:-false}"
BUILD_MODE="${BUILD_MODE:-dev}"
BUILD_SM_MS_MANAGEMENT="${BUILD_SM_MS_MANAGEMENT:-true}"


function build-js() {
    if [ "$BUILD_MODE" = "prod" ]; then
        npm run build-prod
    else
        npm run build-dev
    fi
}

if [ "$CLEAN_BUILD" = "true" ]; then
    echo "洁净构建，清除缓存......"
    cd $work_dir
    ls -lAh
    ls -A1 $work_dir/ | xargs -I{} rm -rf {}
    ls -lAh
fi

echo "将当前的工作目录拷贝到工作目录......"
rsync -az --delete \
    --exclude=".git/" \
    --exclude="docker/" \
    --exclude="node_modules/" \
    --exclude="**/node_modules/" \
    $source_dir/ $work_dir/
step1_end_time=$(date +%s)

echo "配置工作目录权限..."
cd $work_dir
chmod -R 755 $work_dir
step2_end_time=$(date +%s)

ls -lAh

echo "安装相关依赖......"
yarn install \
  && cp yarn.lock ${source_dir}/yarn.lock
composer update
step3_end_time=$(date +%s)

echo "构建语言文件......"
msgfmt ./languages/editormd-zh_CN.po -o ./languages/editormd-zh_CN.mo &
msgfmt ./languages/editormd-zh_TW.po -o ./languages/editormd-zh_TW.mo &
step4_end_time=$(date +%s)

echo "构建JS与CSS文件......"
build-js &

# sm-ms-management处理
if [ $BUILD_SM_MS_MANAGEMENT = "true" ]; then
    echo "构建sm-ms-management"
    cd src/Pages/page/sm-ms-management
    yarn install \
      && cp yarn.lock ${source_dir}/src/Pages/page/sm-ms-management/yarn.lock
    step5_end_time=$(date +%s)
    npm run build &
else
    echo "不构建sm-ms-management"
    step5_end_time=$step4_end_time
fi

wait
step6_end_time=$(date +%s)
echo "所有并行任务执行完成！"

rsync -az --delete \
      --exclude="node_modules/" \
      --exclude="**/node_modules/" \
      $work_dir/ $dist_dir/wp-editormd/

cd $dist_dir/wp-editormd
rm -rf `ls -A $dist_dir/wp-editormd | grep -v "assets\|languages\|src\|vendor\|readme.txt\|LICENSE\|wp-editormd.php\|uninstall.php"`

cd $dist_dir/wp-editormd/src/Pages/page/sm-ms-management/
rm -rf `ls -A $dist_dir/wp-editormd/src/Pages/page/sm-ms-management/ | grep -v "sm-ms-management.php\|html"`

cd $dist_dir
echo "打包数据"
zip -9 -qq -r $target_dir/wp_editor_md_$(date +%Y-%m-%d-%H-%M-%S).zip ./

step7_end_time=$(date +%s)

echo "配置输出目录权限"
cd $target_dir
chmod -R 777 ./*

cd /root
step8_end_time=$(date +%s)
echo "数据打包完成！"

end_time=$(date +%s)

echo "拷贝到工作目录耗时$(($step1_end_time-$begin_time))秒"
echo "配置权限耗时$(($step2_end_time-$step1_end_time))秒"
echo "安装依赖耗时$(($step3_end_time-$step2_end_time))秒"
echo "构建语言文件耗时$(($step4_end_time-$step3_end_time))秒"
echo "sm-ms-management安装依赖耗时$(($step5_end_time-$step4_end_time))秒"
echo "总构建耗时$(($step6_end_time-$step4_end_time))秒"
echo "打包数据耗时$(($step7_end_time-$step6_end_time))秒"
echo "配置输出目录权限耗时$(($step8_end_time-$step7_end_time))秒"
echo "------"
echo "任务完成，总耗时$(($end_time-$begin_time))秒！"
