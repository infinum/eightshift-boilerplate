#!/usr/bin/env sh

function deploy() {
  npm install
  composer install --no-dev --no-scripts
  npm run build
}

deploy
