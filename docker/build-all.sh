#!/usr/bin/env bash
function build_and_return() {
    cd $1
    ./build-image.sh
    cd ..
}

build_and_return builder
build_and_return testenv
