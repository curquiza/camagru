<?php

require_once 'app/connection.php';
// require_once 'config/database.php';

$pdo = (new SQLiteConnection())->connect();
if ($pdo != null)
  echo "yes !";
else
  echo "raté";
