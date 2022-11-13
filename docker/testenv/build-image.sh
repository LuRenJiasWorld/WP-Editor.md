#!/usr/bin/env bash
begin_time=$(date +%s)
version=$(date +%Y-%m-%d-%H-%M-%S)

sudo docker build \
    --network host \
    --build-arg HTTP_PROXY=$HTTP_PROXY   --build-arg http_proxy=$http_proxy   \
    --build-arg HTTPS_PROXY=$HTTPS_PROXY --build-arg https_proxy=$https_proxy \
    --build-arg NO_PROXY=$NO_PROXY       --build-arg no_proxy=$no_proxy       \
    . -t="wp-editormd/testenv:$version" \
&& sudo docker tag "wp-editormd/testenv:$version" "wp-editormd/testenv:latest"

end_time=$(date +%s)

echo "任务完成，总耗时$(($end_time-$begin_time))秒！"
