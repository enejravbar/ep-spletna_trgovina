#!/bin/bash
  
EXPECTED_ARGS=0
E_BADARGS=65
MYSQL=`which mysql`
CLEAN="DROP DATABASE ep;"
Q1="CREATE DATABASE IF NOT EXISTS ep DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;"
Q2="GRANT USAGE ON *.* TO ep@localhost IDENTIFIED BY 'ep_težko_geslo';"
Q3="GRANT ALL PRIVILEGES ON ep.* TO ep@localhost;"
Q4="FLUSH PRIVILEGES;"
SQL="${Q1}${Q2}${Q3}${Q4}"

$MYSQL -uroot -p -e "$CLEAN"
$MYSQL -uroot -p -e "$SQL"
$MYSQL -uroot -p "ep" < "new_tables.sql"
$MYSQL -uroot -p "ep" < "insert_data.sql"