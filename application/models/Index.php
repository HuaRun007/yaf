<?php
/**
 * Created by PhpStorm.
 * User: 124
 * Date: 2017/6/27
 * Time: 13:06
 */
class IndexModel
{
    /**
     * 数据库类实例
     * @var object
     */
    public $dbh = null;

    /**
     * 缓存数据库实例
     * @var Object
     */
    public $mch = null;

    /**
     * Admin_IndexModel constructor.
     * @param $dbh
     * @param null $mch
     */
    public function __construct($dbh, $mch = null)
    {
        $this->dbh = $dbh;
        $this->mch = $mch;
    }

    /**
     * 前台获取文章列表
     * @return [type] [description]
     */
    public function getArticlelist()
    {
    	$sql = "SELECT * FROM `blog_article` WHERE isdel =0 AND isopen=1  ORDER BY id DESC";
    	return $this->dbh->select($sql);
    }

    public function getInfoById($id)
    {
    	$sql = "SELECT * FROM `blog_article` WHERE id = {$id}";
    	return $this->dbh->select_row($sql);
    }
}