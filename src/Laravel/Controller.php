<?php
namespace Magicaxe\Laravel;

abstract class Controller extends \Illuminate\Routing\Controller
{
    protected $code = 1;
    protected $data = array();
    protected $msg = array();

    protected function view($template = '')
    {
        if(!empty(request()->get('_a')))
        {
            return json_encode(['code' => $this->code,'data' => $this->data,'msg' => $this->msg]);
        }
        else
        {
            return view($template,[
                'code' => $this->code,
                'data' => $this->data,
                'msg' => $this->msg,
            ]);
        }
    }
}