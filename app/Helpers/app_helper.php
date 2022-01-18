<?php
    function render($core, $view, $data = [])
    {
        echo view($view, $data);
    }

    function breadcrumb($path = 'home'){
        static $breadcrumb = array(
            'home' => array('title' => 'Home','link' => null),
            'ok' => array('title' => 'Test','link' => 'test')
        );

        $arrPath = explode("|", $path);
        foreach ($arrPath as $key => $value) {
            if (array_key_exists($value,$breadcrumb)){
                $result[] = $breadcrumb[$value];
            }
        }

        return $result;
    }
?>