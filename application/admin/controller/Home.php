<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/2
 * Time: 14:35
 */

namespace app\admin\controller;

class Home extends BaseAdmin
{
    public function index()
    {
        // 网站设置信息
        $site = $this->db->table('sites')->where(['names' => 'site'])->item();
        $site && $site['values'] = json_decode($site['values'], true);

        // 获取权限菜单
        $menus = false;
        $role = $this->db->table('admin_groups')->where(['gid' => $this->_admin['gid']])->item();
        $role['rights'] = $role && $role['rights'] ? json_decode($role['rights'], true) : [];
        if ($role['rights']) {
            $where = "mid in (" . implode(',', $role['rights']) . ") AND ishidden = 0 AND status = 0";
            $menus = $this->db->table('admin_menus')->where($where)->cates('mid');
            $menus && $menus = $this->getTreeItems($menus);
        }

        $this->assign('site', $site);
        $this->assign('role', $role);
        $this->assign('menus', $menus);
        return $this->fetch();
    }

    public function welcome()
    {
        return $this->fetch();
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
}