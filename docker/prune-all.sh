#!/usr/bin/env bash
docker images | grep wp-editormd | awk '{print $3}' | xargs docker rmi