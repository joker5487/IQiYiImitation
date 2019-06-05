<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/2
 * Time: 14:40
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
use Util\data\Sysdb;

class BaseAdmin extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->db = new Sysdb();
        $this->_admin = session('admin');

        // 未登录用户不允许访问
        if (!$this->_admin) {
            header('Location: /admin.php/admin/account/login');
            exit();
        }

        $this->assign('admin', $this->_admin);
    }

    public function output($code = 0, $msg = '', $data = [])
    {
        $return = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];

        exit(json_encode($return));
    }
}