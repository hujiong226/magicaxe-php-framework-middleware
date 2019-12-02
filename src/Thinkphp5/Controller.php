<?php
namespace Magicaxe\Thinkphp5;

abstract class Controller extends \think\Controller
{
    protected $code = 1;
    protected $data = array();
    protected $msg = array();
    
    protected function render($template = '')
    {
        if($template == 'json')
        {
            return json(['code' => $this->code,'data' => $this->data,'msg' => $this->msg]);
        }
        else
        {
            return view($template, [
                'code' => $this->code,
                'data' => $this->data,
                'msg' => $this->msg,
            ]);
        }
    }
}