#!/bin/bash

# /bin/bash new_mysql_database.sh

MYSQL=`which mysql`
$MYSQL -uroot -p "ep" < "init-db.sql"
