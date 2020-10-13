<?php

$app = [];

$app['config'] = require "config.php";

require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';

$app['pdo'] = database\Connection::make( $app['config']['database'] );

$app['database'] = new database\QueryBuilder( $app['pdo'] );