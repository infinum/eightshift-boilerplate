#!/usr/bin/env sh

# Prettyfiers
BLUE='\033[0;36m'
RED='\033[0;31m'
BBLUE="\033[1;36m"
NC='\033[0m' # No Color

# Check if dump exists
if [ ! -f "latest_dump.tar.gz" ]; then
  echo "${RED}Fail! File latest_dump.tar.gz doesn't exist!${NC}"
  exit 1
fi

# Remove temp folder
rm -rf latest_dump

# Create temp folder
if [ ! -d "latest_dump" ]; then
  echo "${BLUE}Creating temp latest_dump folder!${NC}"
  mkdir latest_dump
fi

tar zxf latest_dump.tar.gz -C latest_dump
echo "${BLUE}Exporting folders success!${NC}"

# Clear the database of all tables
wp db reset

# Import database
echo "${BLUE}Database import and search replace in progress...${NC}"
wp db import latest_dump/db_dump/latest.sql

# Search and replace for URL
wp search-replace www.boilerplate.com staging.boilerplate.com --url=www.boilerplate.com --all-tables

# Search and replace for https to http
wp search-replace https://staging.boilerplate.com http://staging.boilerplate.com --all-tables

echo "${BLUE}Flushing cache, removing transients and resetting premalinks!${NC}"
wp cache flush
wp transient delete --all
wp rewrite flush

echo "${BBLUE}Finished! Success!${NC}"
