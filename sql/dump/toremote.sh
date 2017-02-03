#!/bin/bash
scp dump.sql food:~/project/sql/dump/
#ssh food << EOF
#cd ~/bare/foodsql/
#./restore.sh
#EOF
#bash
