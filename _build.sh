#!/usr/bin/env sh

function build() {
  npm install
  composer install --no-dev --no-scripts
  npm run build
}

build
