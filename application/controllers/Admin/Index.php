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

        if(empty($_SESSION['user']))
        {
           return $this->getView()->display("Admin/login.php");
  
        }
        $this->getView()->assign('user',$_SESSION['user']);
        return $this->getView()->display("Admin/index.php");

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
            return $this->getView()->display("Admin/login.php");
          
        }
        $result = $I->getUserInfo($username, $password);
        if(!$result){
            $errMsg = '用户名或密码错误!';
            $this->getView()->assign('errMsg', $errMsg);
            return $this->getView()->display("Admin/login.php");
          
        } 

        session_start();

        $_SESSION['user'] = $result;

        $this->redirect("/Admin_Index/index");

 
        
      }


      public function logoutAction()
      {

         unset($_SESSION['user']);

         return $this->redirect("/Admin_Index/index");
      }
}