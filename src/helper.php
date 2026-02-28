<?php

    function dd(){
        foreach(func_get_args() as $arg){
            echo '<pre>';
            var_dump($arg);
            echo '</pre>';
        }
        die;
    }

    function view(string $template,?array $data=null){
        if(is_array($data)){
            extract($data);
        }
        require VIEWS.$template.'.view.php';

    }