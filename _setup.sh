#!/usr/bin/env sh

function build() {
  npm install
  composer install
  composer -o dump-autoload
  wp core download
}

build
