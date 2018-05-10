<?php

class View
{
    private $data = array();
    private $render = FALSE;

    public function __construct($controller, $action)
    {
        $file = ROOT . "app/views/$controller/$action.php";
        if (file_exists($file))
            $this->render = $file;
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        include($this->render);
    }
}
