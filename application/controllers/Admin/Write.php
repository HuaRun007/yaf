<?php
/**
 * Created by PhpStorm.
 * User: 124
 * Date: 2017/6/27
 * Time: 13:46
 */
class  Admin_WriteController extends Yaf_Controller_Abstract
{
    public function writeAction()
    {
        $S = new Admin_SystemModel(Yaf_Registry::get("db"), Yaf_Registry::get('mc') );
        $params['articletype'] = $S->getTypeinfo();
        return $this->getView()->make('Admin.write.writearticle',$params);
    }

    /**
     * 保存文章
     */
    public function saveArticleAction()
    {
        $request = $this->getRequest();
        
        $content = htmlspecialchars($request->getPost('content',''));

        $articleres = $this->svaeContentfile($content);

        if($articleres['code']!=200){
            COMMON::result(300,$articleres['message']);
        }

        $params = array(
            'title'            => $request->getPost('title', ''),
            'articlestatus'    => $request->getPost('articlestatus', ''),
            'content'          => APP_PATH.'/public/static/content/'.$articleres['message'],
            'article_type'     => $request->getPost('article_type', ''),
            'article_typename' => $request->getPost('article_typename', ''),
            'create_time'      => $request->getPost('create_time', '=NOW()'),
            'updated_time'     => $request->getPost('updated_time', '=NOW()'),
            );
        $S = new  Admin_SystemModel(Yaf_Registry::get("db"), Yaf_Registry::get('mc') );
        $res = $S->saveArticle($params);
        if(!$res)
        {
            $S->deleteArticle($articleres['message']);
            COMMON::result(300,'添加文章失败');
        }else{
            COMMON::result(200,'添加文章成功');
        }
    }

    /**
     * 文本编辑器中的图片上传
     */
    public function uploadFileAction()
    {
        $UploadInstance = new FileUpload();
//        //使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 , 如果成功返回true, 失败返回false;
        $res = $UploadInstance -> upload("myFileName");
        $arr = array(
            'errno' =>0,
            'data'  => [
                '/static/images/upload/'.$UploadInstance->getFileName(),
                ],
            'message' => $UploadInstance->getErrorMsg(),
            'res'   => $res,

        );

        echo  json_encode($arr);

    }

    /**
     * 把文章的内容写入一个文件中
     * @param $content [博客主体内容的html]
     * @return array() [<description>]
     */
    private function svaeContentfile($content)
    {
        if(empty($content))
        {
            return ['code'=>300,'message'=>'参数错误，不能为空!'];
        }
        $filename = date('YmdHis')."_".rand(100,999).'.txt';
        $res = file_put_contents(APP_PATH.'/public/static/content/'.$filename,$content);
        if(!$res)
        {
            return ['code'=>300,'message'=>'写入文件失败!'];
        }else{
            return ['code'=>200,'message'=>$filename];
        }
    }

}