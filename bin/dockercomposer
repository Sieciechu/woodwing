#!/bin/bash

docker container run -it --rm -v "$PWD":/app -v composercache:/tmp -w /app --env COMPOSER_HOME=/app --env COMPOSER_CACHE_DIR=/tmp -u $(id -u):$(id -g) composer $@

