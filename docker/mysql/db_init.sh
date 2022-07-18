#!/bin/bash

mysql -u root -proot application < /docker-entrypoint-initdb.d/DB_seed.sql

