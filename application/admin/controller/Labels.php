<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/3
 * Time: 21:02
 */

namespace app\admin\controller;


class Labels extends BaseAdmin
{
    // 频道管理
    public function channel()
    {
        $channel = $this->db->table('video_label')->where(['flag' => 'channel'])->lists();
        $this->assign('data', $channel);
        return $this->fetch();
    }

    // 资费管理
    public function charge()
    {
        $charge = $this->db->table('video_label')->where(['flag' => 'charge'])->lists();
        $this->assign('data', $charge);
        return $this->fetch();
    }

    // 地区管理
    public function area()
    {
        $area = $this->db->table('video_label')->where(['flag' => 'area'])->lists();
        $this->assign('data', $area);
        return $this->fetch();
    }

    // 保存
    public function save()
    {
        $ords = input('post.ords/a');
        $titles = input('post.titles/a');
        $status = input('post.status/a');
        $flag = trim(input('post.flag'));

        foreach ($ords as $key => $value) {
            $data['ord'] = $value;
            $data['title'] = $titles[$key];
            $data['status'] = isset($status[$key]) ? 1 : 0;
            $data['flag'] = $flag;

            // 新增
            if ($key == 0 && $data['title']) {
                $this->db->table('video_label')->insert($data);
            }

            if ($key > 0) {
                if ($data['title'] == '') { // 删除
                    $this->db->table('video_label')->where(['id' => $key])->delete();
                } else { // 修改
                    $this->db->table('video_label')->where(['id' => $key])->update($data);
                }
            }
        }

        $this->output(0, '保存成功');
    }
}