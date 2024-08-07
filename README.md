lushu 1.0
===============

> 运行环境要求PHP7.2+，兼容PHP8.0，nginx1.5+ ,mysql 5.5+
#### 编写日期  2024-04-29  @author：wtj   
## 主要功能 
* 用户新建，编辑，删除行程记录  
* 配置素材库  
* 下列除了说明彻底删除的 其他均为软删除
* 下列可能会出现重复功能的接口 （正常操作 时间长搞忘了那些接口有了 后面去改的话有点麻烦）



# 安装设置 
>###  新安装后需要修改下列文件中参数
> > ####  `console/static/user/open.js`   中的   `Post_url` 值
> >####  `lushu/static/user/open.js`   中的   `Post_url` 值
> >###  <img src="lushu/static/user/img_2.png">
> >####  nginx配置中的高德转接key
>###  高德地图参数配置文件 :
> >  `/lushu/layout/map_edit.php`</br>
> >  `/lushu/layout/map_edit_poi.php`</br>
> >  `/lushu/layout/map_select_poi.php`</br>
> >  `/lushu/layout/map_view.php`</br>
>###  站点基础参数配置  文件地址:`/dataconfig.php`
> > ####  模版每页列表展示数量 常量 `NUMBER_PAGES` 
> >####  登录加密方式  `PROGRAM_ENCRYPTION`  开启为`rsa`加密  关闭`md5`加密 
> >####  网站分表设置  `WHETHER_TO_DIVIDE_THE_TABLE`  
> >####  登录过期时间  `EXPIRATION_TIME`
> >####  前台登录Cookie名称  `CLOOTA_ADMIN_UUID`
> >####  后台登录Cookie名称  `CLOOTA_ADMIN_BACKGROUND_UUID`
>## 伪静态设置
> >location /</br>
>{</br>
>rewrite ^(.*)/lushu/login /lushu/index.php?cmd=login last;</br>
>rewrite ^(.*)/lushu/logout /lushu/index.php?cmd=logout last;</br>
>rewrite ^(.*)/lushu/(.*).html  /lushu/index.php?cmd=$2 last;</br>
>rewrite ^(.*)/api-json/(.*)  /api-json/index.php last;</br>
>rewrite ^(.*)/console/login /console/index.php?cmd=login last;</br>
>rewrite ^(.*)/console/logout /console/index.php?cmd=logout last;</br>
>rewrite ^(.*)/console/(.*).html  /console/index.php?cmd=$2 last;</br>
></br>
>}</br>
>location /_AMapService/</br>
>{</br>
>set $args "$args&jscode=00894a438623e38a79c6fea26452b99f";</br>
>proxy_pass https://restapi.amap.com/;
></br>}</br>
> 上方 $args&jscode=**  中**为高德地图key 后期需要更换  

## 文件结构
> ###/api-json/  前端的主要接口文件
> > /json/    ---------               对应的接口文件<br>
> /model/ --------- 对应的生成模版处理文件夹<br>
>/pdf/ --------- pdf的生成模版存放文件夹<br>
>/static/ --------- 静态资源存放地址<br>
> check.php   参数校验类文件<br>
> config.php   接口配置文件<br>
> common.php   接口主要用的方法集合类<br>
> index.php   入口文件  新增加的文件  需在当前页面 `Verify_Permissions()` 方法中添加自行需要的文件名称  `$Unrestricted` 数组为不需要登录即可查看    `$constrained`  为需要登录后才可查看的地址 <br>
> 
> ###/config/  配置文件夹  
> >acc.php 数据库配置文件<br>
> >acc.php 引入公用文件处理文件<br>
> >configuration.php 各种备注库<br>
> >fun.php 默认方法集合类  全项目引用<br>
> >ip.php （老版本遗留，当前项目暂无使用 可删除）<br>
>
> ###/console/  后台文件夹
> > /do/    ---------               后台的接口文件夹<br>
> /layout/ --------- 组件存放处<br>
>/model/ --------- 后台模版的数据处理文件<br>
>/static/ --------- 静态资源存放地址<br>
>/view/ --------- 后台模版存放地址 -- 入口模版index.php 其他都是在index.php中展示  （index.php勿删）<br>
> check.php   参数校验类文件<br>
> config.php   后台配置文件<br>
> do.php   接口的入口文件  常用url do.php?cmd=$1&list=$2   $1 引用的接口类文件名  $2  使用的方法名  <br>
> function.php   后台使用的方法集合文件<br>
> index.php   入口文件  新增加的文件  需在当前页面 `Verify_Permissions()` 方法中添加自行需要的文件名称  `$Unrestricted` 数组为不需要登录即可查看    `$constrained`  为需要登录后才可查看的地址 <br>
> lang.php   语言配置文件 （未使用）<br>
>
> ###/error/   错误提示文件夹  
>
> ###/libs/  引用的工具类
> > /jwt/    ---------               后台的rsa2加密解密类  未使用（需开启）<br>
> /PHPMailer/ --------- php 发送邮件的类  未使用  注册接口放开后可运用 <br>
>/phpmailers/ --------- php 发送邮件的类  未使用 <br>
>/qr/ --------- 二维码生成类<br>
>/tcpdf/ --------- 导出为pdf类  （不太支持html样式  未使用）<br>
>/weixin/ --------- 其他类  未使用  可删除<br>
> mysqli_class.php   数据库连接类<br>
>
>  ###/log/  日志
> > /REQUEST/    ---------               接口的日志存放地址<br>
>
>  ###/lushu/  前端页面模板存放地址    当前文件夹 标注为组件的统一为view 文件夹下调用的php 文件
> > /details/    ---------               详情页组件存放地址<br>
> > /js/    ---------               前端的每个页面存放的js文件    当前文件名跟view 文件名称一致<br>
> > /layout/    ---------               前端的辅助组件存放地址 例如各种弹窗等 <br>
> > /search/    ---------               前端的搜索辅助组件存放地址（存放各种复杂搜索的页面片段）<br>
> > /static/    ---------               静态资源存放文件地址<br>
> > /view/    ---------               前端整体文件存放地址  当前在前端访问地址案例 ： www.****.com/lushu/文件名.html 即可访问  新增需在index.php中修改配置 详见下方注释<br>
> config.php   前端配置文件  <br>
> function.php   前端使用的方法集合文件<br>
> index.php   入口文件  新增加的文件  需在当前页面 `Verify_Permissions()` 方法中添加自行需要的文件名称  `$Unrestricted` 数组为不需要登录即可查看    `$constrained`  为需要登录后才可查看的地址 <br>
> mysqli_class.php   数据库连接类<br>
>
>  ###/upfiles/  文件存放地址
> > /pdf/    ---------               前端生成的pdf存放地址  可一月一删除 未写程序 自定义<br>
>
>
>  ###/vendor/  引入的导出pdf导出类   当前类使用composer下载 需要先行引入当前文件夹中`autoload.php` 文件
> > /mpdf/    ---------               生成pdf的集成类<br>
>
>  ###/dataconfig.php  全局的配置文件
>  ###/index.php  入口文件 







## 数据库结构
> ###POI库  poi的相关数据存储组
> > t_resources    poi主体结构库<br>
> > t_resources_list    poi主体结构库复制库 未启用  后期优化可使用<br>
> > t_resources_price    poi库消费分类库<br>
> > t_resources_template    poi库模版库  具有3个相同表  下列同样规则同为分表  分表规则为当前登录用户id/3 后的取余数   或者key/3 后的取余数<br>
> > t_resources_user_price    poi库 用户编辑已有数据价格分类表 <br>
>
> ###笔记库 
> > t_resources_note    笔记存储的主要表<br>
>
> ###标签库 
> > t_label    标签表<br>
>
> ###城市名称库 
> > t_city     主要城市名称表  前端不可编辑 <br>
> t_resources_city   用户上传的主要城市名称表
>
> ###工具库 
> > t_transportation     交通工具库<br>
>
> ###活动与服务 
> > t_resources_activities     活动与服务 库<br>
>
> ###交通库 
> > t_resources_traffic     交通库未使用  （前端程序交通使用方式跟表无关系） 后期优化具有路线后可启用<br>
>
> ###酒店库 
> > t_resources_hotel    酒店主体结构库<br>
> > t_resources_hotel_price    酒店库消费分类库<br>
> > t_resources_hotel_template    酒店库模版库  具有3个相同表  下列同样规则同为分表  分表规则为当前登录用户id/3 后的取余数   或者key/3 后的取余数<br>
> > t_resources_hotel_user_price    酒店库 用户编辑已有数据价格分类表 <br>
>
> ###日志 
> > t_project_log    用户操作项目的日志表  内部的msg_log字段内容中 {user} 为操作的用户名称  {project}为项目名称<br>
>
> ###图片库 
> > t_resources_img    图片库<br>
>
> ###系统基础配置 
> > t_admin    用户表  admin  为管理员账号 或者编辑 其他is_admin为管理员账号  数据库修改  后台无修改功能<br>
> > t_grouping    分组表  学生绑定的分组存储表<br>
> > t_message    消息表  <br>
> > t_project_socre   评分表 教师给项目打分的表  <br>
> > t_receive   消息表 用户接收消息的表  可隔段时间清楚数据  <br>
> > t_score   评分细则表 教师设置的评分细则表 <br>
> > t_site_config   站点配置表  <br>
> > t_tourism   旅游局表/相关推荐表  <br>
>
> ###行程亮点库 
> > t_resources_wonderful    亮点表<br>
>
> ###用户线路导出/行程路线表
> > t_export_project    导出的行程路线表<br>
> > t_export_project_cost    项目的价格明细<br>
> > t_export_project_day_schedule    项目的对应日期绑定的poi景区<br>
> > t_export_project_demand    项目的需求明细<br>
> > t_export_project_member    项目的用户信息权限  （半启用） 未编写多用户共同编辑<br>
> > t_export_project_remarks    项目的行程总览<br>
> > t_export_project_remarks_day    项目的某个日期的行程总览<br>
> > t_export_project_remarks_notes    项目的备注的行程总览<br>
> > t_export_project_traffic    项目的交通信息<br>
> > t_export_quotation    项目的报价信息<br>
> > t_export_quotation_list    项目的报价具体信息<br>
> > t_export_quotation_subterm    项目的报价具体信息<br>>
> ###用户项目（路线）操作
> > t_project    用户项目（路线）表<br>
> > t_project_cost    项目的价格明细<br>
> > t_project_day_schedule    项目的对应日期绑定的poi景区<br>
> > t_project_demand    项目的需求明细<br>
> > t_project_member    项目的用户信息权限  （半启用） 未编写多用户共同编辑<br>
> > t_project_remarks    项目的行程总览<br>
> > t_project_remarks_day    项目的某个日期的行程总览<br>
> > t_project_remarks_notes    项目的备注的行程总览<br>
> > t_project_traffic    项目的交通信息<br>
> > t_quotation    项目的报价信息<br>
> > t_quotation_list    项目的报价具体信息<br>
> > t_quotation_subterm    项目的报价具体信息<br>




## 注意事项
###  新建接口后（前端，后台，接口）  请在/对应的文件目录/index.php文件中引用`Verify_Permissions`方法中添加自已需要的接口类型   `$Unrestricted`  不需要登录  `$constrained`  需要登录
###  <img src="lushu/static/user/img.png">
###  <img src="lushu/static/user/img_1.png">



## json 文件介绍
### 当前文件夹  访问方式为  /api-json/?cmd=#1&list=#2
###  #1 代表当前文件夹下的json文件的php文件名
###  #2 对应php 文件中类的方法
###  接口返回参数统一样式 
    "code": 200,//状态值  200 正常  201 失败或者其他原因（只会提示报错）  405 越权操作或者操作不存在的值 接口返回后前端会统一重定向到首页
    "msg": "请求成功",//请求提示语
    "data": {}//请求返回内容体


> ###api-json/json/home.php
> >*   接口：statistics  功能： 首页统计数量 接口
> >*   接口：statisticsDay  功能： 首页统计7天日期内的项目数量 接口
> ###api-json/json/login.php
> >*   接口：logins  功能： 登录用户主要接口
> ###api-json/json/project.php
> >*   接口：default_name  功能： 默认项目名称访问   返回格式案例  2023/10/30-12:00 **创建
> >*   接口：name  功能：第一步：添加项目名称  项目协作人员
> >*   接口：detail  功能：第二步： 添加项目详细信息
> >*   接口：GetDay  功能：获取项目日期的相关信息  周几 日期 城市
> >*   接口：GetItinerary  功能：获取项目基础信息 亮点 行程介绍 定制师笔记
> >*   接口：GetItinerary_notes  功能：获取项目备注基础信息  行程介绍 定制师笔记
> >*   接口：GetItinerary_day  功能：获取项目对应天数基础信息  景点 行程介绍 定制师笔记
> >*   接口：Project_data  功能：获取项目基本信息   
> >*   接口：Project_day  功能：获取项目全部天数的 景点 酒店  交通 相关城市
> >*   接口：Project_log  功能：获取项目日志信息
> >*   接口：Project_datas  功能：获取项目基本信息 - 对应接口使用（有些接口不需要返回一些值）
> >*   接口：editProject  功能：设置项目基本信息  （后期修改接口   头像等）
> >*   接口：Restore  功能：设置项目制作中  
> >*   接口：Complete  功能：设置项目已完成  
> >*   接口：Close  功能：设置项目已关闭  
> >*   接口：Delete  功能：设置项目已删除  
> >*   接口：Restore_s  功能：设置项目恢复正常项目内容  
> >*   接口：Collect  功能：设置项目为星标项目  
> >*   接口：Completely  功能：彻底删除项目数据
> ###api-json/json/register.php  （未使用） 
> >*   接口：registers  功能： 注册用户主要接口
> ###api-json/json/resource.php  
> >*   接口：add  功能： 添加新的资源信息（PIO）
> >*   接口：updata_add  功能： 编辑之前的数据  不覆盖原始数据（PIO）
> >*   接口：hotel_add  功能： 添加新的资源信息（酒店）
> >*   接口：hotel_updata_add  功能： 编辑之前的数据  不覆盖原始数据（酒店）
> >*   接口：DelResource  功能： 删除poi信息 
> >*   接口：Delhotel  功能： 删除酒店信息 
> >*   接口：DelActivities  功能： 删除活动信息 
> >*   接口：DelCity  功能： 删除城市名称 
> >*   接口：DelTrip  功能： 删除亮点信息 
> >*   接口：DelCity  功能： 删除城市名称
> ###api-json/json/source_img.php
> >*   接口：picture  功能： 上传图片库接口
> >*   接口：default  功能： 设置poi默认图片
> >*   接口：default_hotel  功能： 设置酒店默认图片
> >*   接口：DelPicture  功能： 删除图片信息
> ###api-json/json/Download.php  
>####  当前文件使用 Mpdf类库导出pdf   导出可直接使用html作为模版（样式可能会有差异）最好不要用position定位，和display属性，导出的类读取不到这些属性值 导出的在`/upfiles/pdf/`中，定期清理即可
> >*   接口：quotation_pdf  功能： 导出项目报价pdf
> >*   接口：Itinerary_pdf  功能： 导出行程单-pdf
> >*   接口：Project_pdf  功能： 导出pdf展示路线展示-pdf   导出时会请求高德地图得到路线截图所以天数越多，时长会对应增加（php 超时时间要设置最少 1分钟以上）
> ###api-json/json/export.php
>####  项目导出的记录 （行程路线库）此类 项目代表为行程路线库中的项目
> >*   接口：：add_trip  功能：     添加亮点行程总览
> >*   接口：：del_trip  功能：      去除亮点行程总览
> >*   接口：：add_note  功能：     添加笔记总览
> >*   接口：：add_note_notes  功能：     添加笔记总览
> >*   接口：：del_note  功能：     去除亮点行程总览
> >*   接口：：del_note_notes  功能：     去除亮点行程总览
> >*   接口：：add_day_city  功能：     添加项目城市信息
> >*   接口：：del_day_city  功能：     去除项目城市信息
> >*   接口：：AddTraffic  功能：     添加交通信息
> >*   接口：：add_project_content  功能：     添加项目介绍内容
> >*   接口：：GetProjectPoi  功能：     获取项目日期对应的景点信息
> >*   接口：：add_project_content_notes  功能：     添加项目备注介绍
> >*   接口：：AddProjectPoi  功能：     添加项目日程安排中的poi信息
> >*   接口：：DelProjectPoi  功能：     去除项目日程安排中的poi信息
> >*   接口：：GetProjectTraffic  功能：     获取项目日期对应的交通信息
> >*   接口：：editProjectPoisort  功能：     项目中日程安排顺序更改
> >*   接口：：editProjectTraffic  功能：     项目交通乘车顺序
> >*   接口：：projectDayTraffic  功能： 获取项目中对应天数交通信息
> >*   接口：：editprojectDayTraffic  功能： 项目中某天交通乘车顺序
> >*   接口：：GetDay  功能：获取项目日期的相关信息  周几 日期 城市
> ###api-json/json/export_information.php
>####  项目导出的记录 （行程路线库）此类 项目代表为行程路线库中的项目
> >*   接口：：demand  功能：     根据项目key查询项目需求
> >*   接口：：EditDemand  功能：      根据项目key编辑项目需求
> >*   接口：：TravelRoute  功能：      根据项目key获取项目日期内全部信息
> >*   接口：：Getbooking  功能：      根据项目key获取项目内全部日期酒店信息
> >*   接口：：Cost  功能：      根据项目key查询费用核算
> >*   接口：：GetDayClassCost  功能：      根据项目key查询费用核算
> >*   接口：：AddDayClassCost  功能：      根据项目key编辑费用核算
> ###api-json/json/export_quotation.php
>####  项目导出的记录 （行程路线库）此类 项目代表为行程路线库中的项目
> >*   接口：quotation_type  功能：     获取项目行程报价分类
> >*   接口：quotation  功能：      获取项目行程报价
> >*   接口：classification  功能：      获取项目行程报价具体信息
> >*   接口：setTime  功能：      获取项目行程报价表时间条例
> >*   接口：supplement  功能：      根据项目key查询项目报价补充说明
> >*   接口：setsupplement  功能：      添加编辑项目报价补充说明
> >*   接口：DelQuotation  功能：      去除项目报价补充说明
> >*   接口：Const  功能：      根据项目key查询项目报价费用说明
> >*   接口：setConst  功能：      添加编辑项目报价费用说明
> >*   接口：PaidItems  功能：      根据项目key查询项目报价可选付费项目
> >*   接口：setPaidItems  功能：      添加编辑项目报价可选付费项目
> >*   接口：NotIncluded  功能：      根据项目key查询项目报价费用不包括
> >*   接口：setNotIncluded  功能：      添加编辑项目报价费用不包括
> ###api-json/json/label.php
> >*   接口：label_add  功能：     添加标签
> ###api-json/json/logout.php
> >*   接口：index  功能：     退出登录
> ###api-json/json/message.php
> >*   接口：MessageNumber  功能：     消息列表    长轮询查询  后期优化目标   即时通讯   
> >*   接口：MessageList  功能：     消息列表
> ###api-json/json/open_view.php
>#### 项目基本信息 接口  不需要登录 主要后台审视使用  不会根据当前登录用户 作为分库对象
> >*   接口：：Cost  功能：      根据项目key查询费用核算
> >*   接口：quotation  功能：      获取项目行程报价
> >*   接口：Const_quotation  功能：      获取项目行程报价列表
> >*   接口：NotIncluded  功能：      根据项目key查询项目报价费用不包括
> >*   接口：PaidItems  功能：      根据项目key查询项目报价可选付费项目
> >*   接口：quotation_type  功能：     获取项目行程报价分类
> >*   接口：supplement  功能：      根据项目key查询项目报价补充说明
> >*   接口：Project_data  功能：获取项目基本信息   
> >*   接口：Project_day  功能：获取项目全部天数的 景点 酒店  交通 相关城市
> >*   接口：GetItinerary  功能：获取项目基础信息 亮点 行程介绍 定制师笔记
> >*   接口：TravelRoute  功能：      根据项目key获取项目日期内全部信息
> >*   接口：Getbooking  功能：      根据项目key获取项目内全部日期酒店信息
> >*   接口：note  功能：      获取笔记详情
> >*   接口：resource  功能：      获取poi详情
> >*   接口：trip  功能：      获取亮点详情
> >*   接口：GetProjectPoi  功能：      获取poi坐标点信息  无需登录
> ###api-json/json/project_auxiliary.php
> >*   接口：：project_log  功能：      修改项目日志备注
> ###api-json/json/project_export.php
> >*   接口：：Export  功能：      根据项目key导出项目数据
> >*   接口：：Copy  功能：      根据项目key复制项目数据
> >*   接口：：project  功能：     行程路线库列表
> >*   接口：：Project_data  功能：     行程路线库基础信息/获取导出项目基本信息
> >*   接口：：Project_day  功能：     行程路线库全部天数的 景点 酒店  交通 相关城市/获取导出项目全部天数的 景点 酒店  交通 相关城市
> >*   接口：：TravelRoute  功能：      根据行程路线库/导出项目key获取项目日期内全部信息
> >*   接口：GetItinerary  功能：获取行程路线库/导出项目基础信息 亮点 行程介绍 定制师笔记
> >*   接口：：Cost  功能：      根据项目key查询行程路线库/导出项目费用核算
> >*   接口：quotation  功能：      获取行程路线库/导出项目行程报价
> >*   接口：Const_quotation  功能：      获取行程路线库/导出项目行程报价列表
> >*   接口：NotIncluded  功能：      根据行程路线库/导出项目key查询项目报价费用不包括
> >*   接口：PaidItems  功能：      根据行程路线库/导出项目key查询项目报价可选付费项目
> >*   接口：quotation_type  功能：     获取行程路线库/导出项目行程报价分类
> >*   接口：supplement  功能：      根据行程路线库/导出项目key查询项目报价补充说明
> >*   接口：DelExportPorject  功能：      根据行程路线库/导出项目key 删除内容-伪删除
> >*   接口：ExportCopy  功能：      根据行程路线库/导出项目key 复制内容
> >*   接口：GetDay  功能：获取行程路线库/导出项目日期的相关信息  周几 日期 城市
> >*   接口：GetItinerary_day  功能：获取行程路线库/导出项目对应天数基础信息  景点 行程介绍 定制师笔记
> >*   接口：GetItinerary_notes  功能：获取行程路线库/导出项目备注基础信息  行程介绍 定制师笔记
> >*   接口：import  功能：將行程路线库/导出项目导入现有的项目中  会覆盖原项目数据
> >*   接口：Project_datas  功能：获取行程路线库/导出项目基本信息 - 对应接口使用（有些接口不需要返回一些值）
> >*   接口：editProject  功能：设置行程路线库/导出项目基本信息  （后期修改接口   头像等）
> >*   接口：add_project_day  功能：添加行程路线库/导出项目项目天数
> >*   接口：del_project_day  功能：去除行程路线库/导出项目项目天数
> ###api-json/json/project_information.php
> >*   接口：：demand  功能：     根据项目key查询项目需求
> >*   接口：：EditDemand  功能：      根据项目key编辑项目需求
> >*   接口：：TravelRoute  功能：      根据项目key获取项目日期内全部信息
> >*   接口：：Getbooking  功能：      根据项目key获取项目内全部日期酒店信息
> >*   接口：：Cost  功能：      根据项目key查询费用核算
> >*   接口：：GetDayClassCost  功能：      根据项目key查询费用核算
> >*   接口：：AddDayClassCost  功能：      根据项目key编辑费用核算
> ###api-json/json/project_list.php
> >*   接口：：project  功能：     出行项目列表
> >*   接口：：project_list  功能：      出行项目列表-不同参数返回
> >*   接口：：project_del  功能：      已删除出行项目列表
> >*   接口：：project_list_del  功能：      已删除出行项目列表
> ###api-json/json/project_quotation.php
> >*   接口：quotation_type  功能：     获取项目行程报价分类
> >*   接口：quotation  功能：      获取项目行程报价
> >*   接口：supplement  功能：      根据项目key查询项目报价补充说明
> >*   接口：Const  功能：      根据项目key查询项目报价费用说明
> >*   接口：PaidItems  功能：      根据项目key查询项目报价可选付费项目
> >*   接口：NotIncluded  功能：      根据项目key查询项目报价费用不包括
> >*   接口：classification  功能：      获取项目行程报价具体信息
> >*   接口：setTime  功能：      获取项目行程报价表时间条例
> >*   接口：setConst  功能：      添加编辑项目报价费用说明
> >*   接口：setsupplement  功能：      添加编辑项目报价补充说明
> >*   接口：setPaidItems  功能：      添加编辑项目报价可选付费项目
> >*   接口：setNotIncluded  功能：      添加编辑项目报价费用不包括
> >*   接口：DelQuotation  功能：      去除项目报价补充说明
> ###api-json/json/recyclebin.php
> >*   接口：recyclebinList  功能：     回收站列表  参数type说明： 1，行程路线图 2，poi 3，图片 4，笔记 5，酒店 6，活动，7，亮点
> ###api-json/json/resource_activities.php
> >*   接口：activities  功能：     添加活动信息
> >*   接口：activities_list  功能：     查询活动列表
> ###api-json/json/resource_city.php
> >*   接口：city  功能：     添加城市信息
> ###api-json/json/resource_details.php
> >*   接口：resource  功能：     查询poi详情
> >*   接口：hotel  功能：     查询酒店详情
> >*   接口：picture  功能：     查询图片详情
> >*   接口：note  功能：     查询笔记详情
> >*   接口：city  功能：     查询城市名称详情
> >*   接口：trip  功能：     查询亮点详情
> >*   接口：activities  功能：     查询活动详情
> ###api-json/json/resource_edit.php
> >*   接口：add_trip  功能：     添加项目中亮点行程总览
> >*   接口：del_trip  功能：     去除项目亮点行程总览
> >*   接口：add_note  功能：     添加项目笔记总览
> >*   接口：add_note_notes  功能：     添加项目备注笔记总览
> >*   接口：del_note  功能：     去除项目笔记总览
> >*   接口：del_note_notes  功能：     去除项目备注笔记总览
> >*   接口：add_day_city  功能：     添加项目城市信息
> >*   接口：del_day_city  功能：     去除项目城市信息
> >*   接口：add_project_content  功能：     添加项目行程介绍
> >*   接口：add_project_content_notes  功能：     添加项目备注行程介绍
> ###api-json/json/resource_img.php
> >*   接口：picture  功能：     添加图片内容
> >*   接口：default  功能：     设置poi默认图片
> >*   接口：default_hotel  功能：     设置酒店默认图片
> >*   接口：DelPicture  功能：     去除默认图片
> ###api-json/json/resource_list.php
> >*   接口：resource  功能：     查询poi列表
> >*   接口：picture  功能：     图片库列表
> >*   接口：label  功能：     标签列表
> >*   接口：note  功能：     笔记列表
> >*   接口：hotel  功能：     酒店库列表
> >*   接口：template  功能：     poi关联图片列表
> >*   接口：template_hotel  功能：     酒店关联图片列表
> >*   接口：city  功能：     城市名称列表
> >*   接口：city_all  功能：     城市名称列表-可以查不是自已的
> >*   接口：project_city  功能：     查看项目城市名称列表
> >*   接口：project_city_export  功能：     查看行程路线库/导出项目城市名称列表
> >*   接口：trip  功能：     亮點列表
> >*   接口：allResource  功能：     查询poi/酒店列表-全部（本身加后台管理员编辑的）
> >*   接口：GetActivity  功能：     活动服务列表
> ###api-json/json/resource_note.php
> >*   接口：note  功能：     添加笔记内容
> >*   接口：delNote  功能：     删除笔记内容
> ###api-json/json/resource_traffic.php  （未使用）
> >*   接口：traffic  功能：     添加交通内容   （当前未用到）
> ###api-json/json/resources_wonderful.php  
> >*   接口：wonderful  功能：     添加亮点内容
> ###api-json/json/tool.php  
> >*   接口：address  功能：     根据城市关键字搜索对应城市信息   
> >*   接口：picture  功能：     全局上传文件接口  （优化点读取上传文件后缀名） 
> >*   接口：search_poi  功能：     搜索poi 当前搜索前1000条，可不加了  后期可改为翻页（前端没这功能）
> >*   接口：projectDayTraffic  功能：     项目日期出行方案
> >*   接口：editprojectDayTraffic  功能：     编辑项目日期出行方案
> >*   接口：AddDining  功能：     编辑项目日期的餐饮情况
> >*   接口：projectDayHotel  功能：     编辑项目日期  酒店预定
> >*   接口：DelprojectDayhotel  功能：     去除项目日期的酒店预定
> >*   接口：GetProjectPoi  功能：     获取项目日期的日程安排poi信息
> >*   接口：GetProjectPoi  功能：     添加项目日期的日程安排poi信息
> >*   接口：DelProjectPoi  功能：     去除项目日期的日程安排poi信息
> >*   接口：GetProjectTraffic  功能：     获取项目日期的交通信息
> >*   接口：：editProjectPoisort  功能：     项目中日程安排顺序更改
> >*   接口：：editProjectTraffic  功能：     项目交通乘车顺序
> >*   接口：add_project_day  功能：添加项目项目天数
> >*   接口：del_project_day  功能：去除项目项目天数
> >*   接口：GetCoordinatePoints  功能：根据坐标点返回poi  当前范围为5000米  更改方法为`Get_coordinate_max($lng,$lat,***);` 其中 lng，lat坐标点  ***为距离多少米
> >*   接口：GetCoordinatePointsHotel  功能：根据坐标点返回酒店 当前范围为5000米  更改方法为`Get_coordinate_max($lng,$lat,***);` 其中 lng，lat坐标点  ***为距离多少米
> >*   接口：Gettourism  功能：旅游局信息列表
> >*   接口：label_del  功能：去除标签
> >*   接口：GetQRcode  功能：生成二维码
> ###api-json/json/user.php  
> >*   接口：GetUser  功能：     获取当前登录用户的基本信息   
> >*   接口：Setusersculpture  功能：     上传用户头像   
> >*   接口：SetUserData  功能：     编辑用户信息   




## /lushu/ 文件介绍
### 当前文件夹  访问方式为  /lushu/#1.html
###  #1 代表当前文件夹下的view文件的php文件名
###  当前文件只做简单说明  作用和引入地址 自行在代码中查看
> ###/details/
> >*   Highlights.php  亮点详情弹出层
> >*   note.php   笔记详情弹出层
> >*   notes.php   笔记详情弹出层  -样式不同   
> >*   poi.php   poi详情弹出层
> >*   poi_view.php   poi详情弹出层 -样式不同
> ###/js/      js处理文件  vue-2   /view/文件同下用处
> >*   home.php  旅游局    
> >*   index.php  首页
> >*   information.php   我的资料
> >*   Itinerary_pdf_view.php   行程单生成pdf等待页面
> >*   Itinerary_view.php   行程单web展示页面
> >*   open_view.php   后台预览页面
> >*   project.php   项目列表/工作台
> >*   project_cost.php   项目详情页-费用核算
> >*   project_cost_edit.php  项目详情页-费用核算编辑页
> >*   project_cost_edit_export.php  导出项目详情页-费用核算编辑页
> >*   project_demand.php  项目详情页-行程需求
> >*   project_edit.php  项目编辑页-行程总览
> >*   project_edit_day.php  项目编辑页-行程天数总览
> >*   project_edit_day_export.php   导出项目编辑页-行程天数总览
> >*   project_edit_export.php  导出项目编辑页-行程总览
> >*   project_edit_notes.php   项目编辑页-行程备注
> >*   project_edit_notes_export.php  导出项目编辑页-行程备注
> >*   project_pdf.php   行程报价生成pdf等待页面
> >*   project_quotation.php  项目详情页-行程报价
> >*   project_quotation_edit.php 项目详情页-行程报价编辑页面
> >*   project_quotation_edit_export.php  导出项目编辑页-行程报价编辑页面
> >*   project_trip.php   项目详情页-行程制作
> >*   recovery.php     项目回收站
> >*   recyclebin.php    旅行资源库回收站
> >*   resources.php  旅行资源库-行程路线列表
> >*   resources_activities.php 旅行资源库-活动与服务列表
> >*   resources_activities_details.php  旅行资源库-活动与服务详情页
> >*   resources_city.php  旅行资源库-城市名称列表
> >*   resources_city_details.php   旅行资源库-城市名称详情页
> >*   resources_hotel.php  旅行资源库-酒店列表
> >*   resources_hotel_details.php   旅行资源库-酒店详情页
> >*   resources_hotel_material.php   旅行资源库-酒店详情页-相关素材页
> >*   resources_hotel_template.php   旅行资源库-酒店详情页-模版页
> >*   resources_note.php  旅行资源库-笔记列表
> >*   resources_note_details.php 旅行资源库-笔记详情页
> >*   resources_picture.php  旅行资源库-图片列表
> >*   resources_picture_details.php  旅行资源库-图片详情页
> >*   resources_poi.php   旅行资源库-poi列表
> >*   resources_poi_details.php 旅行资源库-poi详情页
> >*   resources_poi_material.php   旅行资源库-poi详情页-相关素材页
> >*   resources_poi_template.php    旅行资源库-poi详情页-模板页
> >*   resources_traffic.php      旅行资源库-交通列表  （未使用）
> >*    resources_trip.php    旅行资源库-亮点列表
> >*    resources_trip_details.php   旅行资源库-亮点详情页
> >*    share.php   项目分享页
> >*    staging_project.php     项目详情页- 概述页
> >*    staging_project_export.php  导出项目详情页- 概述页
> >*    tag_library.php   标签列表页
> ###/layout/  组件库  组件可在view文件夹中文件找到用处 （有些组件可能多次使用，修改添加新js（vue属性）需要全局使用文件统一添加）
> ###/search/  搜索头部组件库








