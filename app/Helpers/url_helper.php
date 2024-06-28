<?php

if (!function_exists('asset_url')){
    function asset_url($file){
        return base_url('assets/'.$file);
    }
}

if (!function_exists('css_url')){
    function css_url($file){
        return asset_url('css/'.$file.'.css');
    }
}

if (!function_exists('js_url')){
    function js_url($file){
        return asset_url('js/'.$file.'.js');
    }
}

if (!function_exists('img_url')){
    function img_url($file){
        return asset_url('img/'.$file);
    }
}
    