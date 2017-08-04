<?php
/**
 * Created by PhpStorm.
 * User: 124
 * Date: 2017/6/27
 * Time: 11:18
 */
class Admin_IndexController extends Yaf_Controller_Abstract
{
      public function indexAction()
      {

        if(!Yaf_Registry::has('user'))
        {
            $this->getView()->display("Admin/login.php");
            return false;
        }
        $this->getView()->display("Admin/index.php");
        return false;
      }

      public function LoginAction()
      {
        $request = $this->getRequest();
        $username = $request->getPost('username', '');
        $password = substr(md5($request->getPost('password', '')),2 , 20);

        

        $I = new IndexModel(Yaf_Registry:: get("db"), Yaf_Registry:: get('mc'));
        
        $result = $I->getUserInfo($username);
        $errMsg = '';
        if(!$result)
        {
        
            $errMsg = '用户名不存在!';
            $this->getView()->assign('errMsg', $errMsg);
            $this->getView()->display("Admin/login.php");
            return false;            
        }
        $result = $I->getUserInfo($username, $password);
        if(!$result){
            $errMsg = '用户名或密码错误!';
            $this->getView()->assign('errMsg', $errMsg);
            $this->getView()->display("Admin/login.php");
            return false;            
        } 

        Yaf_Registry::set('user', $result);

        $this->getView()->assign('user', $result);
        $this->getView()->display("Admin/index.php");
        return false;
 
        
      }

}