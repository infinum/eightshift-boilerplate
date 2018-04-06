function build() {
  npm install
  composer install

  vendor/bin/phpcs --config-set installed_paths ../../wp-coding-standards/wpcs 

  wp core download
  wp theme activate init_theme_name
}

build
