<?php

require_once 'base.php';

class Comment extends Base {

    protected $id;
    protected $content;
    protected $created_at;
    protected $user_id;
    protected $photo_id;

    public function __construct($id) {
    }
}
