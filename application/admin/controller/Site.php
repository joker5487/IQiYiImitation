<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/3
 * Time: 19:33
 */

namespace app\admin\controller;


class Site extends BaseAdmin
{
    // 网站设置
    public function index()
    {
        $site = $this->db->table('sites')->where(['names' => 'site'])->item();
        $site && $site['values'] = json_decode($site['values'], true);
        $this->assign('site', $site);
        return $this->fetch();
    }

    // 保存设置
    public function save()
    {
        $title = trim(input('post.title'));
        $site = $this->db->table('sites')->where(['names' => 'site'])->item();
        $json_title = json_encode($title);
        if (!$site) {
            $this->db->table('sites')->insert(['names' => 'site', 'values' => $json_title]);
        } else {
            $this->db->table('sites')->where(['names' => 'site'])->update(['values' => $json_title]);
        }

        $this->output(0, '保存成功');
    }
}