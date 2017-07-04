<div class="bjui-pageContent">
    <div style="padding:50px 0;width: 90%;margin: 0 auto;">
        <form id="writearticle_from"  action="/Admin_Write/saveArticle" method="POST" class="datagrid-edit-form"  data-data-type="json"  >
            <input type="hidden" name="articlestatus" value="" id="articlestatus">
            <input type="hidden" name="content" value="" id="content">
            <input type="hidden" name="article_typename" value="" id="article_typename">
            <fieldset>
                <legend>文章属性</legend>
                <br>
            <div class="bjui-row col-3">
                <label class="row-label">文章分类</label>
                <div class="row-input required">
                    <select name="article_type" id="article_type" data-toggle="selectpicker" data-rule="required" data-width="100%"
                            data-live-search="true" data-size="10">
                        <option value="">请选择</option>
                        @foreach($articletype as $item)
                        <option value="{{$item['id']}}">{{$item['typename']}}</option>
                        @endforeach
                    </select>
                </div>

                <label class="row-label">是否公开</label>
                <div class="row-input required">
                    <input type="radio" name="isopen"  data-toggle="icheck" value="1" data-label="是" checked>
                    <input type="radio" name="isopen"  data-toggle="icheck" value="0" data-label="否" >
                </div>

                <label class="row-label">文章状态</label>
                <div class="row-input">
                    <select name="" data-toggle="selectpicker" data-rule="required" data-width="100%"
                            data-live-search="true" data-size="10" disabled>
                        <option value="1" @if($articlestatus==1) checked @endif>新建</option>
                        <option value="2" @if($articlestatus==2) checked @endif>暂存</option>
                        <option value="3" @if($articlestatus==3) checked @endif>发布</option>
                    </select>
                </div>

                <label class="row-label">文章标签</label>
                <div class="row-input">
                    <input type="text" value="" placeholder="添加标签">
                </div>
            </div>
            </fieldset>

            <br>
            {{--<fieldset>--}}
                <legend>撰写文章</legend>
            <br>
                <div class="col-1" style="margin: 0px 10px 0px 10px;">
                    <div class="row-input">
                        <input type="text" name="title" value="" placeholder="请填写标题" data-rule="required">
                    </div>
                    <br>
        {{--文本编辑器--}}
            <div id="editor" data-rule="requide">
                <p id="text">请输入内容</p>
            </div>
        {{--文本编辑器--}}
                    <br>
                </div>
            {{--</fieldset>--}}
        </form>
    </div>

    <div class="text-center btns-user">
            <button id="article_save" type="button" class="btn btn-green btn-lg" onclick="article_submit(2)">保存草稿</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button id="article_submit" type="button" class="btn btn-blue btn-lg" onclick="article_submit(3)">发布文章</button>
    </div>
    <!-- 注意， 只需要引用 JS，无需引用任何 CSS ！！！-->
    <script type="text/javascript" src="/static/js/wangEditor.js"></script>
    <script type="text/javascript">
        var E = window.wangEditor;
        var editor = new E('#editor');
        editor.customConfig.uploadImgServer = '/Admin_Write/uploadFile';  // 上传图片到服务器
        editor.customConfig.uploadFileName = 'myFileName'; //自定义 fileName
        editor.create()
    //     editor.txt.html()       获取html
        document.getElementById('editor').addEventListener('click', function () {
            $('#text').remove();
        })

        /*==============分割线================*/
        function article_submit(step)
        {
            var content = editor.txt.html();
           // console.log(content);return;
            if(content=='<p><br></p>' || content=='<p id="text">请输入内容</p><p><br></p>')
            {
                BJUI.alertmsg('warn', '请填写文章内容!',{displayPosition:'middlecenter',displayMode:'fade'});
                return;
            }
            $('#articlestatus').val(step);   //提交的状态
            $('#content').val(content); //文章的主题内容
            $('#article_typename').val($('#article_type option:selected').text());

            BJUI.ajax('ajaxform', {
                url: "/Admin_Write/saveArticle",
                form: $.CurrentNavtab.find('#writearticle_from'),
                validate:true,
                loadingmask: true,
                okCallback: function(json, options) {
                    console.log('返回内容1：\n'+ JSON.stringify(json))
                }
            });
        }
    </script>
</div>
