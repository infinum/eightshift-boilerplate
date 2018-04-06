#!/usr/bin/env sh

function build() {
  npm install
  composer install

  wp core download
  wp theme activate init_theme_name
}

build
