<?php


if(is_dir($dir =__DIR__.'/../storage/logs')){
    try{
        include __DIR__.'/../public/index.php';
    }catch (\Exception $e){
        echo $e->getMessage();
    }
}
