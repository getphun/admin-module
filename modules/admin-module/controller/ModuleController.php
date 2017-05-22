<?php
/**
 * Module management
 * @package admin-module
 * @version 0.0.1
 * @upgrade true
 */

namespace AdminModule\Controller;

class ModuleController extends \AdminController
{
    
    private function _defaultParams(){
        return [
            'title'             => 'Modules',
            'nav_title'         => 'System',
            'active_menu'       => 'system',
            'active_submenu'    => 'modules',
            'pagination'        => []
        ];
    }
    
    public function indexAction(){
        if(!$this->user->login)
            return $this->loginFirst('adminLogin');
        if(!$this->can_i->read_module)
            return $this->show404();
        
        $params = $this->_defaultParams();
        
        // list all exists modules
        $modules = array_diff(scandir(BASEPATH . '/modules'), ['.', '..']);
        $used_modules = [];
        foreach($modules as $module){
            $mod_path = BASEPATH . '/modules/' . $module;
            if(!is_dir($mod_path))
                continue;
            $mod_conf = $mod_path . '/config.php';
            if(!is_file($mod_conf))
                continue;
            
            $mod = include $mod_conf;
            $used_modules[] = (object)$mod;
        }
        usort($used_modules, function($a,$b){ return strcmp($a->__name, $b->__name); });
        $params['modules'] = $used_modules;
        $params['total'] = count($used_modules);
        
        return $this->respond('system/module/index', $params);
    }
}