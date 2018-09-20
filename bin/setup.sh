#!/usr/bin/env sh

# Prettyfiers
BLUE='\033[0;36m'
RED='\033[0;31m'
BBLUE="\033[1;36m"
NC='\033[0m' # No Color

echo "${BBLUE}Please enter dbname:${NC}"
read dbname

echo "${BBLUE}Please enter dbuser:${NC}"
read dbuser

echo "${BBLUE}Please enter dbpass:${NC}"
read dbpass

echo "${BBLUE}Please enter dbhost:${NC}"
read dbhost

echo "${BBLUE}Please enter dbprefix:${NC}"
read dbprefix

echo "\n----------------------------------------------------\n"

echo "${BBLUE}Your wp-config.php details will be:${NC}\n"
echo "dbname: ${BBLUE}$dbname${NC}"
echo "dbuser: ${BBLUE}$dbuser${NC}"
echo "dbpass: ${BBLUE}$dbpass${NC}"
echo "dbhost: ${BBLUE}$dbhost${NC}"
echo "dbprefix: ${BBLUE}$dbprefix${NC}"

echo "\n${RED}Confirm? (y/n)${NC}"
read confirmation

if [ "$confirmation" == "y" ]; then
  npm install
  composer install
  wp core download --skip-content

  wp config create --dbname=$dbname --dbuser=$dbuser --dbpass=$dbpass --dbhost=$dbhost --dbprefix=$dbprefix
  echo "${BBLUE}Finished! Success! Now finish the README and happy coding.${NC}"
else
  echo "\n${RED}Cancelled.${NC}"
fi
