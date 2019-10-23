<?php
namespace Magicaxe\Thinkphp5;

class Request extends \think\Request
{
    /**
     * @var object 对象实例
     */
    protected static $instance;

    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return \think\Request
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }
        return self::$instance;
    }
    
	/**
	 *
	 * @return string|null
	 */
	public function getReferrer()
	{
        $referer = $this->param('referer');
		return !empty($referer) ? $referer : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null);
	}
}