#!/usr/bin/env sh

# Prettyfiers
# Prettyfiers
BLUE='\033[0;36m'
RED='\033[0;31m'
BBLUE="\033[1;36m"
NC='\033[0m' # No Color

if [ -n "${BASH_VERSINFO[0]}" ] && [ ${BASH_VERSINFO[0]} -gt 3 ]; then
  # Updated: 20-Aug-2009 - for bash version 4
  strtolower() {
    [ $# -eq 1 ] || return 1;
    echo ${1,,};
    return 0;
  }
else
  strtolower() {
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
fi

if [ -n "${BASH_VERSINFO[0]}" ] && [ ${BASH_VERSINFO[0]} -gt 3 ]; then
  # Updated: 20-Aug-2009 - for bash version 4
  strtoupper() {
    [ $# -eq 1 ] || return 1;
    echo ${1^^};
    return 0;
  }
else
  strtoupper() {
    [ $# -eq 1 ] || return 1;
    local _str _cu _cl _x;
    _cu=(A B C D E F G H I J K L M N O P Q R S T U V W X Y Z);
    _cl=(a b c d e f g h i j k l m n o p q r s t u v w x y z);
    _str=$1;
    for ((_x=0;_x<${#_cl[*]};_x++)); do
      _str=${_str//${_cl[$_x]}/${_cu[$_x]}};
    done;
    echo $_str;
    return 0;
  }
fi

ucwords() {
  [ $# -eq 1 ] || return 1;
  ! type -t strtoupper &>/dev/null && return 1;
  local _x _c _p _ret="" _str="$1";
  _p=0;
  for ((_x=0;_x<${#_str};_x++)); do
    _c=${_str:$_x:1};
    if [ "$_c" != " " ] && [ "$_p" = "0" ]; then
      _ret+="$(strtoupper "$_c")";
      _p=1;continue;
    fi;
    [ "$_c" = " " ] && _p=0;
    _ret+="$_c";
  done;
  if [ -n "${_ret:-}" ]; then
    echo "${_ret}";
    return 0;
  fi;
  return 1;
}

echo "This script will rename your theme and its contents. It whill setup you project. \n"

echo "${BBLUE}Please enter your theme name:${NC}"
echo "(This is the name that will be showned in the WP admin as theme name.)"
read theme_name_real_name

if [[ -z "$theme_name_real_name" ]]; then
  echo "${RED}Theme name field is required ${NC}"
  exit 1
fi

echo "\n${BBLUE}Please enter your package name:${NC}"
echo "(This is the name thet will be used for translations in all @package fields and the name of your theme folder.)"
echo "(Must be lowercase with no special characters and no spaces. You can use '_' or '-' for spaces)"
read theme_package_name

if [[ -z "$theme_package_name" ]]; then
  echo "${RED}Package name field is required ${NC}"
  exit 1
fi

theme_package_name="${theme_package_name// /-}"
theme_package_name=$(strtolower $theme_package_name)


echo "\n${BBLUE}Please enter your theme description:${NC}"
read theme_description

echo "\n${BBLUE}Please enter author name:${NC}"
read theme_author_name

echo "\n${BBLUE}Please enter author email:${NC}"
read theme_author_email

echo "\n${BBLUE}Please enter author url:${NC}"
read theme_author_url

echo "\n----------------------------------------------------\n"

echo "${BBLUE}Your details will be:${NC}\n"
echo "Theme Name: ${BBLUE}$theme_name_real_name${NC}"
echo "Description: ${BBLUE}$theme_description${NC}"
echo "Author: ${BBLUE}$theme_author_name${NC} <${BBLUE}$theme_author_email${NC}>"
echo "Author Url: ${BBLUE}$theme_author_url${NC}"
echo "Text Domain: ${BBLUE}$theme_package_name${NC}"
echo "Package: ${BBLUE}$theme_package_name${NC}"

echo "\n${RED}Confirm? (y/n)${NC}"
read confirmation

if [ "$confirmation" == "y" ]; then

#   # Replace "plugin-name"
#   replacestring="s/plugin-name/$plugin_css/g"
#   find ./plugin-name -type f -exec sed -i '' -e "$replacestring" '{}' \;

#   # Replace "plugin_name"
#   replacestring="s/plugin_name/$plugin_functions/g"
#   find ./plugin-name -type f -exec sed -i '' -e "$replacestring" '{}' \;

#   # Replace "Plugin_Name"
#   replacestring="s/Plugin_Name/$plugin_classes/g"
#   find ./plugin-name -type f -exec sed -i '' -e "$replacestring" '{}' \;

  # Replace author
  find . -type f -not -name '_rename.sh' -not -path '*/.git*' -exec sed -i -e "s/init_author_name/$theme_author_name <$theme_author_email>/g" '{}' \;

#   replacestring="s/Your Name <email@example.com>/$plugin_author <$plugin_email>/g"
#   find ./plugin-name -type f -exec sed -i '' -e "$replacestring" '{}' \;

#   # Cleanup core file
#   replacestring="s/WordPress Plugin Boilerplate/$plugin_name/g"
#   sed -i '' -e "$replacestring" ./plugin-name/plugin-name.php

#   replacestring="s/This is a short description of what the plugin does. It's displayed in the WordPress admin area./$plugin_description/g"
#   sed -i '' -e "$replacestring" ./plugin-name/plugin-name.php



  # for file in `find . -name "*theme_name*"`; do
  #   DIR=$(dirname "${VAR}")
  #   mkdir -p $DIR
  #   mv "$file" "${file/plugin-name/$theme_package_name}"
  # done


  # DONE --------------------------
  # Rename top level directory
  # find . -depth -type d -name 'theme_name*' -exec mv {} "wp-content/themes/$theme_package_name" \;

else
  echo "Cancelled."
  echo "\n${RED}Cancelled?${NC}"
fi