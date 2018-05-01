<?php

require_once 'app/models/connection.php';

class SQLiteCreateTable {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createTables() {
        $commands = [
          'CREATE TABLE IF NOT EXISTS users (
            user_id      INTEGER PRIMARY KEY,
            email        TEXT NOT NULL,
            pseudo       TEXT NOT NULL,
            password     TEXT NOT NULL,
            status       TEXT NOT NULL,
            created_at   DATETIME
          );',
         'CREATE TABLE IF NOT EXISTS photos (
           photo_id     INTEGER PRIMARY KEY,
           path         TEXT NOT NULL,
           created_at   DATETIME,
           user_id      INTEGER
         );',
         'CREATE TABLE IF NOT EXISTS comments (
           comment_id   INTEGER PRIMARY KEY,
           content      TEXT NOT NULL,
           created_at   DATETIME,
           updated_at   DATETIME,
           user_id      INTEGER,
           photo_id     INTEGER
         );',
         'CREATE TABLE IF NOT EXISTS likes (
           like_id      INTEGER PRIMARY KEY,
           user_id      INTEGER,
           photo_id     INTEGER
         );',
       ];
        foreach ($commands as $command) {
            $this->pdo->exec($command);
        }
    }
}

$pdo = (new SQLiteConnection())->connect();
if ($pdo != null)
{
    echo 'Connected'.PHP_EOL;
    $sqlite = new SQLiteCreateTable($pdo);
    $sqlite->createTables();
    echo 'Tables created'.PHP_EOL;
}
else
    echo 'Error during connection'.PHP_EOL;
