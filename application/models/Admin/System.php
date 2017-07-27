<?php
/**
 * Created by PhpStorm.
 * User: 124
 * Date: 2017/6/27
 * Time: 13:06
 */
class Admin_SystemModel
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
     * 获取后台首页的URL标签
     */
    public function getSystemlist()
    {

    }

    /**
     * 获取分类列表
     * @return [type] [description]
     */
    public function getTypeinfo()
    {
        $sql = "SELECT * FROM `blog_articletype` WHERE status=1 AND isdel=0";

        return $this->dbh->select($sql);
    }

    public function saveArticle($params)
    {
        return $this->dbh->insert('blog_article',$params);
    }

    /**
     * 删除文章文件
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function deleteArticle($url)
    {
        return unlink(APP_PATH.'/public/static/content/'.$url);
    }

    /**
     * 获取文章list数据
     * @return [type] [description]
     */
    public function getarticleList()
    {
        $sql = "SELECT * FROM `blog_article` WHERE isdel=0 ";
        $result['list'] = $this->dbh->select($sql);
        return $result;
    }
}