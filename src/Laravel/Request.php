<?php
namespace Magicaxe\Laravel;

class Request extends \Illuminate\Http\Request
{
    /**
     * @var object 对象实例
     */
    protected static $instance;

    /**
     * 初始化
     * @access public
     * @return \Magicaxe\Laravel\Request
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
	/**
	 *
	 * @return string|null
	 */
	public function getReferrer()
	{
        $referer = $this->input('referer');
		return !empty($referer) ? $referer : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null);
	}
}