#!/bin/bash

MYSQL=`which mysql`
ROOT_DIR=$(pwd)

$MYSQL -uroot -p "ep" < "$ROOT_DIR/tools/baza/init-db.sql"
