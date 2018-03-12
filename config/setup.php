<?php

require_once 'app/connection.php';
// require_once 'config/database.php';

class SQLiteCreateTable {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createTables() {
        $commands = ['CREATE TABLE IF NOT EXISTS users (
                        user_id      INTEGER PRIMARY KEY,
                        pseudo       TEXT NOT NULL
                      )'];
        foreach ($commands as $command) {
            $this->pdo->exec($command);
        }
    }


}


$pdo = (new SQLiteConnection())->connect();
if ($pdo != null)
  echo "yes !";
else
  echo "raté";
$sqlite = new SQLiteCreateTable($pdo);
$sqlite->createTables();
