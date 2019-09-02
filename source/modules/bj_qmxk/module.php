<?php




defined('IN_IA') or exit('Access Denied');

class bj_qmxkModule extends WeModule {

    public function fieldsFormDisplay($rid = 0) {
        global $_W;
        $setting = $_W['account']['modules'][$this->_saveing_params['mid']]['config'];
        include $this->template('rule');
    }

    public function fieldsFormSubmit($rid = 0) {
        global $_GPC, $_W;
        if (!empty($_GPC['title'])) {
            $data = array(
                'title' => $_GPC['title'],
                'description' => $_GPC['description'],
                'picurl' => $_GPC['thumb-old'],
                'url' => create_url('mobile/module/list', array('name' => 'bj_qmxk', 'weid' => $_W['weid'])),
            );
            if (!empty($_GPC['thumb'])) {
                $data['picurl'] = $_GPC['thumb'];
                file_delete($_GPC['thumb-old']);
            }
            $this->saveSettings($data);
        }
        return true;
    }
 
    public function settingsDisplay($settings) {
        global $_GPC, $_W;
        $theone = pdo_fetch('SELECT * FROM '.tablename('bj_qmxk_rules')." WHERE  weid = :weid" , array(':weid' => $_W['weid']));
        $cardtype = pdo_fetchall('SELECT * FROM '.tablename('bj_qmxk_card_type').' WHERE  weid = :weid order by cardid asc', array(':weid' => $_W['weid']));
        $id = $theone['id'];
        if (checksubmit()) {
            $settings = array(
                'default_dividend'=>$_GPC['default_dividend'], 
                'extract'=>$_GPC['extract'],
                'card'=>$_GPC['card']
                    );
            $this->saveSettings($settings);
            //更新rules表
            $rules = array(
                'default_dividend'=>$_GPC['default_dividend'], 
                'extract'=>$_GPC['extract'],
                'weid' => $_W['weid']
            );
            if(empty($id)) {
                    pdo_insert('bj_qmxk_rules', $rules);
            } else {
                    pdo_update('bj_qmxk_rules', $rules,array('id' => $id));
            }
            //更新card_type表
            $card = $_GPC['card'];
            pdo_update_card('bj_qmxk_card_type',$card,array('weid'=>$_W['weid']));
            message('保存成功', 'refresh');
        }
        if(empty($settings['footer']))
        {
            $settings['footer']=$_W['account']['name'];	
        }
        include $this->template('setting');
    }

}
