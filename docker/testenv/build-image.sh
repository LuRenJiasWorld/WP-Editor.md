#!/bin/bash

version=$(date +%Y-%m-%d-%H-%M-%S)

sudo docker build . -t="wp-editormd/testenv:$version"
sudo docker tag "wp-editormd/testenv:$version" "wp-editormd/testenv:latest"
