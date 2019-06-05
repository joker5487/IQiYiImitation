<?php
namespace app\index\controller;

use think\Controller;
use Util\data\Sysdb;

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db = new Sysdb();
    }

    public function index()
    {
        // 首屏幻灯片
        $slide_list = $this->db->table('slide')->where(['type' => 0])->lists();

        // 频道导航标签
        $channel_list = $this->db->table('video_label')->where(['flag' => 'channel'])->order('ord ASC')->pages(8);

        // 获取今日焦点视频数据（取最新的数据）
        $today_hot_list = $this->db->table('video')->where(['status' => 1])->order('id DESC')->pages(6);

        $this->assign('data', $slide_list);
        $this->assign('channel_list', $channel_list['lists']);
        $this->assign('today_hot_list', $today_hot_list['lists']);
        return $this->fetch();
    }

    // 影片分类列表
    public function cate()
    {
        $data['label_channel'] = (int)input('get.label_channel');
        $data['label_charge'] = (int)input('get.label_charge');
        $data['label_area'] = (int)input('get.label_area');

        // 分类列表信息
        $channel_list = $this->db->table('video_label')->where(['flag' => 'channel'])->cates('id');
        $charge_list = $this->db->table('video_label')->where(['flag' => 'charge'])->cates('id');
        $area_list = $this->db->table('video_label')->where(['flag' => 'area'])->cates('id');

        // 影片列表信息
        $data['pageSize'] = 1;
        $data['page'] = max(1, (int)input('get.page'));

        $where['status'] = 1;
        if ($data['label_channel']) {
            $where['channel_id'] = $data['label_channel'];
        }
        if ($data['label_charge']) {
            $where['charge_id'] = $data['label_charge'];
        }
        if ($data['label_area']) {
            $where['area_id'] = $data['label_area'];
        }
        $data['data'] = $this->db->table('video')->where($where)->pages($data['pageSize']);

        $this->assign('channel_list', $channel_list);
        $this->assign('charge_list', $charge_list);
        $this->assign('area_list', $area_list);

        $this->assign('data', $data);
        return $this->fetch();
    }

    // 视频播放
    public function video()
    {
        $id = (int)input('get.id');
        $video = $this->db->table('video')->where(['id' => $id])->item();
        $this->assign('data', $video);
        return $this->fetch();
    }
}
