#!/bin/bash

#Db name
readonly DB_NAME="desafio"

# Construct the MySQL query
readonly Q1="GRANT ALL PRIVILEGES ON *.* TO root;"
readonly Q2="FLUSH PRIVILEGES;"
readonly Q3="CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
readonly SQL="${Q1}${Q2}${Q3}"

# Run the actual command
/usr/bin/mysql -uroot -proot -e "$SQL"
/usr/bin/mysql -uroot -proot "$DB_NAME" < /docker-entrypoint-initdb.d/database.sql
