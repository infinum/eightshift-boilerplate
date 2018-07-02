#!/usr/bin/env sh

function build() {
  npm install
  composer install
  wp core download
}

build
