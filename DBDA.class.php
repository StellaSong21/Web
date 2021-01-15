<?php

class DBDA
{
    public $host = "localhost";
    public $uid = "root";
    public $pwd = "";
    public $dbname = "art_store";

    //成员方法
    public function Query($sql, $type = 1)
    {
        $db = new MySQLi($this->host, $this->uid, $this->pwd, $this->dbname);
        $r = $db->query($sql);

        if ($type == 1) {
            return $r->fetch_all();
        } else {
            return $r;
        }
    }

    //返回字符串的方法
    public function StrQuery($sql, $type = 1)
    {
        $db = new MySQLi($this->host, $this->uid, $this->pwd, $this->dbname);
        $r = $db->query($sql);

        if ($type == 1) {
            $attr = $r->fetch_all();
            $str = "";
            foreach ($attr as $v) {
                $str .= implode("^", $v) . "|";
            }

            return substr($str, 0, strlen($str) - 1);

        } else {
            return $r;
        }
    }

    //返回JSON
    function JSONQuery($sql, $type = 1)
    {
        $db = new MySQLi($this->host, $this->uid, $this->pwd, $this->dbname);
        if ($db->connect_errno) {
            echo "Failed to connect to MySQL: " . $db->connect_error;
        }
        $db->query("set names utf8");
        $r = $db->query($sql);

        if ($type === 1) {
            return json_encode($r->fetch_all(MYSQLI_ASSOC));
        } else {
            return $r;
        }
    }
}