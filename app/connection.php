<?php

require_once 'config/database.php';

class SQLiteConnection {

  private $pdo;

  public function connect() {
    if ($this->pdo == null) {
        $this->pdo = new \PDO("sqlite:" . Database::PATH_TO_SQLITE_FILE);
    }
    return $this->pdo;
  }

}
