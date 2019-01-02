#!/usr/bin/env bash

# pre-commit.sh
#
# This hook is ran every time a commit is attempted. For commit to pass, the minimum requirement is that
# WPCS checks pass.

PROJECT=`php -r "echo dirname(dirname(realpath('$0')));"`
STAGED_FILES_CMD=`git diff --cached --name-only --diff-filter=ACMR HEAD | grep \\\\.php`

#Determine if a file list is passed
if [ "$#" -eq 1 ]
then
  oIFS=$IFS
  IFS='
  '
  SFILES="$1"
  IFS=$oIFS
fi
SFILES=${SFILES:-$STAGED_FILES_CMD}

echo "-----------------"
echo "Checking PHP Lint"
echo "-----------------"
for FILE in $SFILES
do
  php -l -d display_errors=0 $PROJECT/$FILE
  if [ $? != 0 ]
  then
    echo "Fix the error before commit."
    exit 1
  fi
  FILES="$FILES $PROJECT/$FILE"
done

if [ "$FILES" != "" ]
then
  echo "--------------------"
  echo "Running Code Sniffer"
  echo "--------------------"
  ./vendor/bin/phpcs --standard=Infinum --encoding=utf-8 -p --parallel=4 --colors $FILES
  if [ $? != 0 ]
  then
    echo "Possible warnings and errors found."
    exit 1
  fi
fi

exit $?
