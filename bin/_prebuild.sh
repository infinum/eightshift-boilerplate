#!/usr/bin/env sh

function lintPHP() {
  composer require --dev jakub-onderka/php-parallel-lint
  composer require --dev jakub-onderka/php-console-highlighter
  vendor/bin/parallel-lint --exclude wp-admin --exclude wp-includes --exclude  ./vendor/jakub-onderka .
}

function lintCSSJS() {
  npm install
  npm run precommit
}

lintPHP
lintCSSJS
