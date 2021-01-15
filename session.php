<?php

class Session
{

    /**
     * 设置session
     * @param String $name session name
     * @param Mixed $data session data
     * @param Int $expire 超时时间(秒)
     */
    public static function set($name, $data, $expire = 600)
    {
        $session_data = array();
        $session_data['data'] = $data;
        $session_data['expire'] = time() + $expire;
        $_SESSION[$name] = $session_data;
    }

    /**
     * 读取session
     * @param  String $name session name
     * @return Mixed
     */
    public static function get($name)
    {
        if (isset($_SESSION[$name])) {
            if ($_SESSION[$name]['expire'] > time()) {
                return $_SESSION[$name]['data'];
            } else {
                self::clear($name);
            }
        }
        return false;
    }

    /**
     * 清除session
     * @param  String $name session name
     */
    private static function clear($name)
    {
        unset($_SESSION[$name]);
    }

}

//demo . php

session_start();

$data = '123456';
session::set('test', $data, 10);
echo session::get('test'); // 未过期，输出
sleep(10);
echo session::get('test'); // 已过期