<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 2019/6/4
 * Time: 0:16
 */

namespace app\admin\controller;


class Video extends BaseAdmin
{
    // 影片列表
    public function index()
    {
        $data['wd'] = trim(input('get.wd'));

        $data['pageSize'] = 15;
        $data['page'] = max(1, (int)input('get.page'));
        $where = [];
        if ($data['wd']) {
            // 此处在实际应用中不使用 like ，可使用搜索引擎
            $where = 'title like "%' . $data['wd'] . '%"';
        }
        $data['data'] = $this->db->table('video')->where($where)->order('id DESC')->pages($data['pageSize']);

        // 标签
        $label_ids = [];
        foreach ($data['data']['lists'] as $item) {
            !in_array($item['channel_id'], $label_ids) && $label_ids[] = $item['channel_id'];
            !in_array($item['charge_id'], $label_ids) && $label_ids[] = $item['charge_id'];
            !in_array($item['area_id'], $label_ids) && $label_ids[] = $item['area_id'];
        }
        $label_ids && $data['labels'] = $this->db->table('video_label')->where("id in(" . implode(',', $label_ids) . ")")->cates('id');

        $this->assign('data', $data);
        return $this->fetch();
    }

    // 影片添加
    public function add()
    {
        $id = (int)input('get.id');

        $data['channel'] = $this->db->table('video_label')->where(['flag' => 'channel'])->lists();
        $data['charge'] = $this->db->table('video_label')->where(['flag' => 'charge'])->lists();
        $data['areas'] = $this->db->table('video_label')->where(['flag' => 'area'])->lists();

        $data['item'] = $this->db->table('video')->where(['id' => $id])->item();

        $this->assign('data', $data);
        return $this->fetch();
    }

    // 图片上传
    public function upload_img()
    {
        $file = request()->file('file');
        if ($file == null) {
            $this->output(1, '没有文件上传');
        }

        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        $ext = $info->getExtension();
        if (!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) {
            $this->output(1, '文件格式不支持');
        }

        $img = '/uploads/' . $info->getSaveName();
        $this->output(0, '文件上传成功', $img);
    }

    // 保存影片
    public function save()
    {
        $id = (int)input('post.id');
        $data['title'] = trim(input('post.title'));
        $data['channel_id'] = (int)input('post.channel_id');
        $data['charge_id'] = (int)input('post.charge_id');
        $data['area_id'] = (int)input('post.area_id');
        $data['img'] = trim(input('post.img'));
        $data['url'] = trim(input('post.url'));
        $data['keywords'] = trim(input('post.keywords'));
        $data['desc'] = trim(input('post.desc'));
        $data['status'] = trim(input('post.status'));

        if ($data['title'] == '') {
            $this->output(1, '影片名称不能为空');
        }
        if ($data['url'] == '') {
            $this->output(1, '影片地址不能为空');
        }

        if ($id) { // 更新
            $this->db->table('video')->where(['id' => $id])->update($data);
        } else { // 新增
            $data['add_time'] = time();
            $this->db->table('video')->insert($data);
        }

        $this->output(0, '影片保存成功');
    }

    // 影片删除
    public function delete()
    {
        $id = (int)input('post.id');
        $this->db->table('video')->where(['id' => $id])->delete();
        $this->output(0, '影片删除成功');
    }
}