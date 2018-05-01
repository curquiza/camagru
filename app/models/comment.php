<?php

require_once 'base.php';

class Comment extends Base {

    protected $id;
    protected $content;
    protected $created_at;
    protected $user_id;
    protected $photo_id;

    public function __construct($hash) {
    }

    // private static function insert_string($hash) {
    //
    // }

    // public static function find($id)
    // {
    // }
}

$hash = array();
$hash['message'] = 'yo';
$hash['user_id'] = 1;

// print_r($hash);
Comment::create($hash);
