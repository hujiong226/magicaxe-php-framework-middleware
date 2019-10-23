<?php

if (!function_exists('alert')) {
    function alert($_msg)
    {
        echo "<script>alert('".$_msg."');</script>";
    }
}

if (!function_exists('browser_redirect')) {
    function browser_redirect($url)
    {
        echo "<script>
                setTimeout(function(){
                    window.location.href = '" . $url . "';
                },10);
            </script>";
        exit();
    }
}

if (!function_exists('std_decode')) {
    function std_decode($obj)
    {
        if( is_string($obj) )return $obj;
        if( !$obj )return [];
        return json_decode(json_encode($obj),1);
    }
}

if (!function_exists('encodeTree')) {
    function encodeTree(&$list, $parent_id, $parent_key, $level = 0)
    {
        $tree = [];
        $level ++;
        foreach ($list as $key=>$item)
        {
            if($item[$parent_key] == $parent_id)
            {
                $tree[$item['id']] = $item;
                unset($list[$key]);
                $tree[$item['id']]['level']  = $level;
                $tree[$item['id']]['child'] = encodeTree($list, $item['id'], $parent_key, $level);
            }
        }

        return $tree;
    }
}