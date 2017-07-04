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
        $params['articleList'] = $I->getArticlelist(); 
        return $this->getView()->make('Home.index.index',$params);
    }

    public function seeAction()
    {

    	$id = $_GET['id'];
    	$I = new IndexModel(Yaf_Registry::get("db"), Yaf_Registry::get('mc') );
    	$articleInfo = $I->getInfoById($id);
    	$params = $articleInfo;
    	$params['content'] = file_get_contents($articleInfo['content']);
        return $this->getView()->make('Home.index.content',$params);
    }
}