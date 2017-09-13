function build() {
  npm install
  composer install

  vendor/bin/phpcs --config-set installed_paths ../../wp-coding-standards/wpcs 

  wp core download
}

build