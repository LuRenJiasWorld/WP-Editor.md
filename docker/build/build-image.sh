#!/bin/bash
begin_time=$(date +%s)
version=$(date +%Y-%m-%d-%H-%M-%S)

sudo docker build \
    --build-arg HTTP_PROXY=$HTTP_PROXY   --build-arg http_proxy=$http_proxy   \
    --build-arg HTTPS_PROXY=$HTTPS_PROXY --build-arg https_proxy=$https_proxy \
    --build-arg NO_PROXY=$NO_PROXY       --build-arg no_proxy=$no_proxy       \
    . -t="wp-editormd/build:$version" \
&& sudo docker tag "wp-editormd/build:$version" "wp-editormd/build:latest"

end_time=$(date +%s)

echo "任务完成，总耗时$(($end_time-$begin_time))秒！"
