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
              return $this->getView()->make('Admin.index',[]);
          }

}