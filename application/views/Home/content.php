<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">

    <title>哎哟喂的博客 - opqnext.com</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- <meta name="keywords" content="哎哟喂, PHP, 技术博客, PHP框架, 哎哟喂的博客, 摇滚青年" /> -->

    <meta name="description" content="哎哟喂的博客 | 我们都是一段时间的技术小能手。" />


    <link rel="icon" href="/static/images/logo.png">


    <link rel="stylesheet" href="/static/css/home_style.css">

    <link rel="stylesheet" href="/static/css/download.css">

</head>

<body>

<header>
    <a id="logo" href="/" title="哎哟喂的博客">
        <img src="/static/images/logo.png" alt="哎哟喂的博客"></a>


    <!--搜索栏-->
<!--     		<i class="js-toggle-search iconfont icon-search"></i>


    <form class="js-search search-form search-form--modal" method="get" action="https://baidu.com" role="search">
        <div class="search-form__inner">
            <div>
                <i class="iconfont icon-search"></i>
                <input class="text-input" placeholder="Enter Key..." type="search">
            </div>
        </div>
    </form> -->



    <!--侧边导航栏-->
    <a id="nav-toggle" href="#"><span></span></a>

    <nav>
        <div class="menu-top-container">
            <ul id="menu-top" class="menu">


                <li class="current-menu-item">
                    <a href="http://weibo.com/u/3751275103" target="_blank">Weibo</a>
                </li>

            </ul>
        </div>
    </nav>


</header>
<div class="m-header ">
    <section id="hero1" class="hero">
        <div class="inner">
        </div>
    </section>

    <figure class="top-image" data-enable=true></figure>

</div>

<!--文章列表-->
<div class="wrapper">
	<article class="post-14 post type-post status-publish format-image hentry category-uncategorized post_format-post-format-image">
	<h1 class="post-title" itemprop="name">{{$title}}</h1>
	<br>
	<div ng-bind-html-unsafe="article.content" id="content">
	<!-- {{$content}} -->
	</div>
	</article>
</div>





<div class="fat-footer">
    <div class="wrapper">
        <div class="layout layout--center">
            <div class="layout__item palm-mb">
                <div class="media">
                    <img class="headimg" src='/static/images/portrait.jpg' alt='哎哟喂'>
                    <div class="media__body">
                        <h4>哎哟喂</h4>
                        <p class='site-description'>如此生活三十年，直到大厦崩塌</p>
                    </div>
                </div>
                <div class="author-contact">
                    <ul>


                        <li>
                            <a href="http://weibo.com/u/3751275103" target="_blank">

                                <i class="iconfont icon-weibo"></i>

                            </a>
                        </li>


                        <li>
                            <a href="https://github.com/auto0010" target="_blank">

                                <i class="iconfont icon-github"></i>

                            </a>
                        </li>


                        <li>
                            <a href="https://www.zhihu.com/people/hua-run-97-92" target="_blank">

                                <i class="iconfont icon-zhihu"></i>

                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="hidecontent" value="{{$content}}">
<footer class="footer" role="contentinfo">
    <div class="wrapper wrapper--wide split split--responsive">
        <span>Theme by <a href="http://github.com/yumemor">Yumemor</a>. Powered by <a href="http://hexo.io">Hexo</a> | &copy 2017 哎哟喂</span>
    </div>
</footer>

<!--这里导入了 lib.js 里面涵盖了 jQuery 等框架 所以注释掉-->
<!--<script src="js/jquery.min.js"></script>-->
<script src="/static/js/lib.js"></script>
<script src="/static/js/prettify.js"></script>
<script src="/static/js/module.js"></script>
{{--<script src="./js/script.js"></script>--}}
{{--<script type='text/javascript'>
    //代码高亮
    $(document).ready(function(){
         $('pre').addClass('prettyprint linenums').attr('style', 'overflow:auto;');
           prettyPrint();
    });
</script>--}}
<!--baidu-->

{{-- <script>
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?5c399a6571456ab7f05e2c4dc81303fe";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
</script> --}}

<script type="text/javascript" color="205,205,255" opacity="0.7" zindex="-2" count="300" src="/static/js/canvas-nest.js"></script><canvas id="c_n3" width="1920" height="949" style="position: fixed; top: 0px; left: 0px; z-index: -2; opacity: 0.7;"></canvas>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','/static/js/analytics.js','ga');

    ga('create', 'UA-46156385-1', 'cssscript.com');
    ga('send', 'pageview');

</script>
<script>
    $(function(){

        var navToggle = $('#nav-toggle'),
            nav = $('nav'),
            navLinks = nav.find('a');

        navToggle.on('click', function () {
            navToggle.toggleClass('active');
            nav.toggleClass('open');
            return false;
        });
        navLinks.on('click', function () {
            navToggle.toggleClass('active');
            nav.toggleClass('open');
        });

        $(document).on('click', function () {
            if (nav.hasClass('open')) {
                navToggle.toggleClass('active');
                nav.toggleClass('open');
            }
        });

        $('.btn-slide').click(function () {
            $('#panel').slideToggle("slow");
            $(this).toggleClass("active");
            return false;
        });

        $(window).scroll(function () {
            var header = $('header');

            if ($(this).scrollTop() > 1) {
                header.addClass("scrolled");
            } else {
                header.removeClass("scrolled");
            }
        });

        $("#social-share").click(function () {
            $("#social").toggleClass("visible").slideToggle(200);
        });

        if ($('.welcome')[0]) {
            $('.author-info').hide();
            $('span.info-edit').click(function () {
                $('.author-info').toggle();
            });
        }

        var bannerNode = $('.top-image');
        if(bannerNode.data('enable')){
            var banner = [3,4,6,9,10,10,13,14,15];
            var index = parseInt((Math.random() * banner.length));
//            console.log(banner.length,index);
            bannerNode.attr('style','background-image:url(http://web.yaf.com/static/banner/'+banner[index]+'.jpg)');
            //bannerNode.attr('style','background-image:url(/banner/'+index+'.jpg)');
            // console.log('http://web.blog.com/banner/'+banner[index]+'.jpg');
        }
    })
    $(function(){
    	var data = '{{$content}}';
    	var content = $('#hidecontent').html(data).text() 
    	$('#content').html(content);
    })
</script>



</body>
</html>