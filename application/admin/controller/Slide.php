<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/4
 * Time: 13:42
 */

namespace app\admin\controller;


class Slide extends BaseAdmin
{
    // 首页首屏
    public function index()
    {
        $data = $this->db->table('slide')->where(['type' => 0])->lists();
        $this->assign('data', $data);
        return $this->fetch();
    }

    // 添加首屏幻灯片
    public function add_first()
    {
        $id = (int)input('get.id');
        $slide = $this->db->table('slide')->where(['id' => $id])->item();
        $this->assign('data', $slide);
        return $this->fetch();
    }

    // 保存幻灯片
    public function save()
    {
        $id = (int)input('post.id');
        $data['type'] = (int)input('post.type');
        $data['title'] = trim(input('post.title'));
        $data['ord'] = trim(input('post.ord'));
        $data['url'] = trim(input('post.url'));
        $data['img'] = trim(input('post.img'));

        if ($data['title'] == '') {
            $this->output(1, '标题不能为空');
        }
        if ($data['url'] == '') {
            $this->output(1, '链接地址不能为空');
        }
        if ($data['img'] == '') {
            $this->output(1, '图片不能为空');
        }

        if ($id) {
            $this->db->table('slide')->where(['id' => $id])->update($data);
        } else {
            $this->db->table('slide')->insert($data);
        }

        $this->output(0, '幻灯片保存成功');
    }

    // 删除幻灯片
    public function delete()
    {
        $id = (int)input('post.id');
        $this->db->table('slide')->where(['id' => $id])->delete();
        $this->output(0, '幻灯片删除成功');
    }
}