#!/usr/bin/env sh

# Prettyfiers
BLUE='\033[0;36m'
RED='\033[0;31m'
BBLUE="\033[1;36m"
NC='\033[0m' # No Color

# Create temp folder
if [ ! -d "db_dump" ]; then
  echo -e "${BLUE}Creating temp db_dump folder!${NC}"
  mkdir db_dump
fi

# Export latest db
wp db export db_dump/latest.sql
echo -e "${BLUE}Exporting db to db_dump/latest.sql${NC}"

# Remove old dump
if [ -f "latest_dump.tar.gz" ]; then
  echo -e "${BLUE}Removing old compressed latest.tar.gz file!${NC}"
  rm latest_dump.tar.gz
fi

# Exit if folders are not existing
if [ ! -d "db_dump" ] || [ ! -d "wp-content/uploads/" ]; then
  echo -e "${RED}Fail! Folders are missing!${NC}"
  exit 1
fi

# Compress folders
tar czf latest_dump.tar.gz db_dump/ wp-content/uploads/
echo -e "${BLUE}Compressing folders success!${NC}"

# Remove temp folder
if [ -d "db_dump" ]; then
  rm -rf db_dump
  echo -e "${BLUE}Removing temp db_dump folder!${NC}"
fi

echo -e "${BBLUE}Export complete! File is located in root folder latest_dump.tar.gz${NC}"
