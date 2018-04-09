#!/usr/bin/env sh

# Prettyfiers
BLUE='\033[0;36m'
RED='\033[0;31m'
BBLUE="\033[1;36m"
NC='\033[0m' # No Color

# Convert string to lowercase
function strtolower() {
  [ $# -eq 1 ] || return 1;
  local _str _cu _cl _x;
  _cu=(A B C D E F G H I J K L M N O P Q R S T U V W X Y Z);
  _cl=(a b c d e f g h i j k l m n o p q r s t u v w x y z);
  _str=$1;
  for ((_x=0;_x<${#_cl[*]};_x++)); do
    _str=${_str//${_cu[$_x]}/${_cl[$_x]}};
  done;
  echo $_str;
  return 0;
}

function cap_case() {
  [ $# -eq 1 ] || return 1;
  _str=$1;
  _replaced=${_str//[-_]/_}
  echo $_replaced | awk -F"_" '{for(i=1;i<=NF;i++){$i=toupper(substr($i,1,1)) substr($i,2)}} 1' OFS="_"
  return 0;
}

# Find and replace strings in files
function findReplace() {
  local var=$1
  local val=$2

  find . -type f -not -name '_rename.sh' -not -path '*/.git/*' | xargs -n1 sed -i.sedbak "s/$var/$val/g"
  find . -type f -name '*.sedbak' | xargs -n1 rm
}

echo "This script will rename your theme and its contents. It will setup you project. \n"

echo "${BBLUE}Please enter your theme name:${NC}"
echo "(This is the name that will be showed in the WordPress admin as the theme name.)"
read theme_name_real_name

if [[ -z "$theme_name_real_name" ]]; then
  echo "${RED}Theme name field is required ${NC}"
  exit 1
fi

echo "\n${BBLUE}Please enter your package name:${NC}"
echo "(This is the name that will be used for translations in all @package fields and the name of your theme folder.)"
echo "(Must be lowercase with no special characters and no spaces. You can use '_' or '-' for spaces)"
read theme_package_name

if [[ -z "$theme_package_name" ]]; then
  echo "${RED}Package name field is required ${NC}"
  exit 1
fi

echo "\n${BBLUE}Please enter theme prefix:${NC}"
echo "Theme prefix (a short prefix that will be used when defining constants. For example: INF, ABRR)"
read theme_prefix

echo "\n${BBLUE}Please enter theme development url:${NC}"
echo "Theme development url is used for local development with browsersync"
read theme_proxy_url

theme_package_name="${theme_package_name// /-}"
theme_package_name=$(strtolower $theme_package_name)
theme_namespace=$(cap_case $theme_package_name)

prefix=$(awk '{ print toupper($0) }' <<< $theme_prefix)

theme_version=$prefix"_THEME_VERSION"
theme_name=$prefix"_THEME_NAME"
theme_image_url=$prefix"_IMAGE_URL"
theme_env=$prefix"_ENV"

echo "\n${BBLUE}Please enter your theme description:${NC}"
read theme_description

echo "\n${BBLUE}Please enter author name:${NC}"
read theme_author_name

echo "\n${BBLUE}Please enter author email:${NC}"
read theme_author_email

echo "\n----------------------------------------------------\n"

echo "${BBLUE}Your details will be:${NC}\n"
echo "Theme Name: ${BBLUE}$theme_name_real_name${NC}"
echo "Description: ${BBLUE}$theme_description${NC}"
echo "Author: ${BBLUE}$theme_author_name${NC} <${BBLUE}$theme_author_email${NC}>"
echo "Text Domain: ${BBLUE}$theme_package_name${NC}"
echo "Package: ${BBLUE}$theme_package_name${NC}"
echo "Namespace: ${BBLUE}$theme_namespace${NC}"
echo "Prefix: ${BBLUE}$prefix${NC}"
echo "Theme development url: ${BBLUE}$theme_proxy_url${NC}"

echo "\n${RED}Confirm? (y/n)${NC}"
read confirmation

if [ "$confirmation" == "y" ]; then

  # Replace strings
  findReplace "init_theme_real_name" "$theme_name_real_name"
  findReplace "init_description" "$theme_description"
  findReplace "init_author_name" "$theme_author_name <$theme_author_email>"
  findReplace "init_theme_name" "$theme_package_name"
  findReplace "Inf_Theme" "$theme_namespace"
  findReplace "INF_THEME_VERSION" "$theme_version"
  findReplace "INF_THEME_NAME" "$theme_name"
  findReplace "INF_IMAGE_URL" "$theme_image_url"
  findReplace "INF_ENV" "$theme_env"
  findReplace "dev.boilerplate.com" "$theme_proxy_url"

  # Change folder name
  if [ "$theme_package_name" != "init_theme_name" ]; then
    mv "./wp-content/themes/init_theme_name" "./wp-content/themes/$theme_package_name"
  fi

  echo "${BBLUE}Finished! Success! Now start _setup.sh script to begin installations.${NC}"

else
  echo "\n${RED}Cancelled.${NC}"
fi
