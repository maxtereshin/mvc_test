<?php

namespace App;

class View
{

    public $template_view = 'template.php';

    function generate($content_view, $data = null)
    {
        if(is_array($data)) {
            extract($data);
        }
        require_once SITE_PATH . 'Views' . DS . $this->template_view;
    }
}
