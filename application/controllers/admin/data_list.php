<?php
/**
 * 资料列表控制器
 * Created by PhpStorm.
 * User: 熠
 * Date: 2015/5/13 0013
 * Time: 13:41
 */

class Data_List extends CI_Controller
{
    private $assign_arr = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('data', 'data_cls');
        $this->assign_arr['controller_name'] = $this->router->class;
        $this->assign_arr['web_title'] = '资料管理';
        $this->assign_arr['nav_show'] = 'data';
    }

    public function index($page = 1)
    {
        $per_page = 10;//每页10条数据
        //获取课件列表
        $data_list = $this->data_cls->get_list(2, $page, $per_page);
        $this->assign_arr['data_info_list'] = $data_list;
        //分页
        $this->load->library('page_cls');
        $this->assign_arr['page_string'] = $this->page_cls->get_page_config($this, $this->data_cls->get_counts(array('type' => '2')), true, $per_page);
        //页面展示
        $this->smarty->view('admin/data_list.tpl', $this->assign_arr);
    }

    public function del($did)
    {
        $did = intval($did);
        $this->log->add_log('删除资料(资料id:' . $did . ')', $this->assign_arr['web_title']);
        $this->data_cls->del_by_did($did);
        echo 1;
    }

}

/* End of file data_list.php */
/* Location: ./application/controllers/admin/data_list.php */