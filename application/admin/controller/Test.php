<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/5/24
 * Time: 13:09
 */

namespace app\admin\controller;

use think\Controller;
use Util\data\Sysdb;

class Test extends Controller
{
    public function test()
    {
        $this->db = new Sysdb();
        $data = $this->db->table('admin')->where(['username' => 'admin'])->item();
        dump($data);
    }
}