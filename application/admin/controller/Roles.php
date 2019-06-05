<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/3
 * Time: 16:19
 */

namespace app\admin\controller;


class Roles extends BaseAdmin
{
    // 角色列表
    public function index()
    {
        $data['roles'] = $this->db->table('admin_groups')->lists();
        $this->assign('data', $data);
        return $this->fetch();
    }

    // 角色添加
    public function add()
    {
        $gid = (int)input('get.gid');
        $role = $this->db->table('admin_groups')->where(['gid' => $gid])->item();
        if ($role && $role['rights']) {
            $role['rights'] = json_decode($role['rights']);
        }
        $this->assign('role', $role);

        $menu_list = $this->db->table('admin_menus')->where(['status' => 0])->cates('mid');
        $menus = $this->getTreeItems($menu_list);

        $results = [];
        foreach ($menus as $value) {
            $value['children'] = isset($value['children']) ? $this->formatMenus($value['children']) : false;
            $results[] = $value;
        }
        $this->assign('menus', $results);
        return $this->fetch();
    }

    // 角色保存
    public function save()
    {
        $gid = (int)input('post.gid');
        $data['title'] = trim(input('post.title'));
        $menus = input('post.menu/a');

        if (!$data['title']) {
            $this->output(1, '角色名称不能为空');
        }
        if ($menus) {
            $data['rights'] = json_encode(array_keys($menus));
        }

        if ($gid) {
            $this->db->table('admin_groups')->where(['gid' => $gid])->update($data);
        } else {
            $this->db->table('admin_groups')->insert($data);
        }
        $this->output(0, '保存成功');
    }

    // 角色删除（注意：删除前应该先检查是否有用户在使用当前角色）
    public function delete()
    {
        $gid = (int)input('post.gid');
        $this->db->table('admin_groups')->where(['gid' => $gid])->delete();
        $this->output(0, '删除成功');
    }

    private function getTreeItems($items)
    {
        $tree = [];
        foreach ($items as $item) {
            if (isset($items[$item['pid']])) {
                $items[$item['pid']]['children'][] = &$items[$item['mid']];
            } else {
                $tree[] = &$items[$item['mid']];
            }
        }

        return $tree;
    }

    private function formatMenus($items, &$res = [])
    {
        foreach ($items as $item) {
            if (!isset($item['children'])) {
                $res[] = $item;
            } else {
                $tem = $item['children'];
                unset($item['children']);
                $res[] = $item;
                $this->formatMenus($tem, $res);
            }
        }

        return $res;
    }
}