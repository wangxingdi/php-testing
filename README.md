# php-testing-英文
## 待完成
1. 广告图片需要自己制作;
9. 汉化;
10. 加载速度;
11. 分类和命名;
12. 商品来源标签小功能;
13. 字体和样式美化-标题的字体和简介的字体分别使用两种字体;
14. 微信机器人接入多个联盟api;
15. 提取公共方法;
16. 缓存;
17. 产品详情页面图片来源和加载速度;
18. 紧急寻找一个字体和字号;

##已完成-第一阶段
1. gif不能播放问题需要解决; - Done(fetch_main.php)
2. 图片动静分离问题需要解决; - Done(listings表增加外链字段,在fetch_main.php中获取外链url并展示)
3. 图片四周的阴影效果需要去除; - Done(main.php)
4. 图片和描述中间的空隙和手机端效果冲突问题需要解决;
4. 描述文字长度重新调整; - Done(fetch_main.php)
5. 将all cat修改为more cat; Done(表setting以及全部查询分类的sql语句)
6. 删除订阅功能
7. 文字格式和标题大小重新调整;
8. 整合users和admin两张表;
9. site_hits无用字段删除;
18. 分类bug和分类表字段问题解决;
19. 营销product_hits字段删除,offer_link.php删除;
20. product_views字段删除;
21. 删除images表;
22. mp_ads表重命名;

##已完成-第二阶段
1. 静态文件采用国外cdn;


## 说明
1. 静态文件版本
https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js
https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js
https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js
https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js
https://cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js
https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js
https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.6/jquery.timeago.min.js
https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js
https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js
https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.0.4/jscolor.min.js
https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.5.1/snap.svg-min.js
https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css
https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css

(cdnjs缺少)https://cdn.jsdelivr.net/npm/jquery-shake@1.0.0/jquery.ui.shake.min.js
