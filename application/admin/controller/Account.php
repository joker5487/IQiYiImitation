<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/5/23
 * Time: 17:22
 */

namespace app\admin\controller;

use think\Controller;
use Util\data\Sysdb;

class Account extends Controller
{
    // 数据返回公共方法（临时）
    public function output($code = 0, $msg = '', $data = [])
    {
        $return = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];

        exit(json_encode($return));
    }

    // 管理画面登录界面
    public function login()
    {
        return $this->fetch();
    }

    // 管理员登录
    public function dologin()
    {
        $username = trim(input('post.username'));
        $pwd = trim(input('post.pwd'));
        $verifycode = trim(input('post.verifycode'));

        if ($username == '') {
            $this->output(1, '用户名不能为空');
        }
        if ($pwd == '') {
            $this->output(1, '密码不能为空');
        }
        if ($verifycode == '') {
            $this->output(1, '验证码不能为空');
        }

        // 验证验证码
        if (!captcha_check($verifycode)) {
            $this->output(1, '验证码错误');
        }
        // 验证用户
        $this->db = new Sysdb();
        $admin = $this->db->table('admin')->where(['username' => 'admin'])->item();
        if (!$admin) {
            $this->output(1, '用户不存在');
        }
        if (md5($admin['username'].$pwd) !== $admin['password']) {
            $this->output(1, '密码错误', $admin);
        }
        if ($admin['status'] == 1) {
            $this->output(1, '用户已被禁用');
        }

        // 设置用户session
        session('admin', $admin);
        $this->output(0, '登录成功');
    }

    // 退出登录
    public function logout()
    {
        session('admin', null);
        $this->output(0, '退出登录成功');
    }
}