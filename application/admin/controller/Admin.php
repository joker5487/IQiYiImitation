<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/2
 * Time: 16:20
 */

namespace app\admin\controller;


class Admin extends BaseAdmin
{
    public function index()
    {
        // 加载列表
        $data['lists'] = $this->db->table('admin')->lists();
        // 加载角色
        $data['groups'] = $this->db->table('admin_groups')->cates('gid');
        $this->assign('data', $data);
        return $this->fetch();
    }

    // 添加管理员
    public function add()
    {
        $id = (int)input('get.id');
        // 加载管理员
        $data['item'] = $this->db->table('admin')->where(['id' => $id])->item();
        // 加载角色
        $data['groups'] = $this->db->table('admin_groups')->cates('gid');
        $this->assign('data', $data);
        return $this->fetch();
    }

    // 保存管理员
    public function save()
    {
        $id = (int)input('post.id');
        $data['username'] = trim(input('post.username'));
        $data['gid'] = (int)input('post.gid');
        $password = trim(input('post.pwd'));
        $data['truename'] = trim(input('post.truename'));
        $data['status'] = (int)input('post.status');

        if ($data['username'] == '') {
            $this->output(1, '用户名不能为空');
        }
        if ($data['gid'] == '') {
            $this->output(1, '角色不能为空');
        }
        if ($id == 0 && $password == '') {
            $this->output(1, '密码不能为空');
        }
        if ($data['truename'] == '') {
            $this->output(1, '姓名不能为空');
        }
        if ($password) {
            $data['password'] = md5($data['username'].$password);
        }

        $res = true;
        if ($id == 0) { // 新增管理员
            // 判断该用户是否存在
            $item = $this->db->table('admin')->where(['username' => $data['username']])->item();
            if ($item) {
                $this->output(1, '该用户已经存在');
            }

            // 新增
            $data['add_time'] = time();
            $res = $this->db->table('admin')->insert($data);
        } else { // 更新管理员信息
            $this->db->table('admin')->where(['id' => $id])->update($data);
        }

        if (!$res) {
            $this->output(1, '保存失败');
        }

        $this->output(0, '保存成功');
    }

    // 删除管理员
    public function delete()
    {
        $id = (int)input('post.id');
        $res = $this->db->table('admin')->where(['id' => $id])->delete();
        if (!$res) {
            $this->output(1, '删除失败');
        }
        $this->output(0, '删除成功');
    }
}