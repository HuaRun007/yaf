<?php
/**
 * Created by PhpStorm.
 * User: 124
 * Date: 2017/6/26
 * Time: 16:33
 */
class Indexcontroller extends Yaf_Controller_Abstract
{

    public function indexAction()
    {
    	$I = new IndexModel(Yaf_Registry::get("db"), Yaf_Registry::get('mc') );
        $articleList = $I->getArticlelist(); 
        $this->getView()->assign('articleList', $articleList);

        $this->getView()->display("Home/index.php");

    }

    public function seeAction()
    {

    	$id = $_GET['id'];
    	$I = new IndexModel(Yaf_Registry::get("db"), Yaf_Registry::get('mc') );
    	$articleInfo = $I->getInfoById($id);
    	$params = $articleInfo;
    	$params['content'] = file_get_contents($articleInfo['content']);
        $this->getView()->assign('params', $params);
        $this->getView()->display('Home/content.php');

    }
}