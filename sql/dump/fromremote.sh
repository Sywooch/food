#!/bin/bash
scp food:~/project/sql/dump/dump.sql ./dump.sql
#ssh food << EOF
#cd ~/bare/foodsql/
#./restore.sh
#EOF
#bash
