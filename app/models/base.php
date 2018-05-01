<?php

require_once 'app/models/connection.php';

class Base {

    // getter
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    // ====== SQL ======
    private static function sql_request($string) {
        $db = new SQLiteConnection();
        $pdo = $db->connect();
        $pdo->exec($string);
        $db->close();
    }

    // ====== ORM ======
    // create : hash with no id
    public static function create($hash) {
        $request_str = self::get_create_request_str($hash);
        self::sql_request($request_str);
    }

    // update : hash with the fields to update
    public static function update($id, $hash) {
        $request_str = self::get_update_request_str($id, $hash);
        self::sql_request($request_str);
    }

    // destroy
    public static function destroy($id) {
        $request_str = self::get_destroy_request_str($id);
        self::sql_request($request_str);
    }

    // ====== PRIVATE METHODS FOR ORM ======
    private static function get_create_request_str($hash) {
        $columns_str = self::get_columns($hash);
        $values_str = self::get_values($hash);
        $class_name = self::get_class_name();
        return 'INSERT INTO ' . $class_name . ' (' . $columns_str . ') VALUES (' . $values_str . ');';
    }

    private static function get_update_request_str($id, $hash) {
        $class_name = self::get_class_name();
        $fields = self::fields_to_update($hash);
        return 'UPDATE ' . $class_name . ' SET ' . $fields . ' WHERE id = ' . $id . ';';
    }

    private static function get_destroy_request_str($id) {
        $class_name = self::get_class_name();
        return 'DELETE FROM ' . $class_name . ' WHERE id = ' . $id . ';';
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

    private static function fields_to_update($hash) {
        $array = self::array_map_assoc(function($k,$v){return "$k = '$v'";}, $hash);
        return implode(', ', $array);
    }

    private static function array_map_assoc($callback , $array) {
        $r = array();
        foreach ($array as $key=>$value)
            $r[$key] = $callback($key,$value);
        return $r;
    }

}
