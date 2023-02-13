#!/usr/bin/env bash
docker images | grep wp-editormd | awk '{print $1":"$2}' | xargs docker rmi
