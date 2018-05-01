<?php

require_once 'app/models/connection.php';

class Base {

    // getter
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    // SQL
    public static function sql_request($string) {
        $db = new SQLiteConnection();
        $pdo = $db->connect();
        $pdo->exec($string);
        $db->close();
    }

    // ORM
    // create : hash with no id
    public static function create($hash) {
        $request_str = self::get_request_str($hash);
        self::sql_request($request_str);
    }

    // private methods
    private static function get_request_str($hash) {
        $columns_str = self::get_columns($hash);
        $values_str = self::get_values($hash);
        $class_name = self::get_class_name();
        return 'INSERT INTO ' . $class_name . ' (' . $columns_str . ') VALUES (' . $values_str . ');';
    }

    private static function get_columns($hash) {
        return implode(', ', array_keys($hash));
    }

    private static function get_values($hash) {
        return '"' . implode('", "', $hash) . '"';
    }

    private static function get_class_name() {
        $name = strtolower(get_called_class());
        return ($name . 's');
    }

}
