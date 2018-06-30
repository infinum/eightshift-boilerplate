#!/usr/bin/env sh

function lintCSSJS() {
  npm install
  npm run precommit
}

lintCSSJS
