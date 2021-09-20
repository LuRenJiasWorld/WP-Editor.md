#!/bin/bash

version=$(date +%Y-%m-%d-%H-%M-%S)

sudo docker build . -t="wp-editormd/build:$version"
sudo docker tag "wp-editormd/build:$version" "wp-editormd/build:latest"
