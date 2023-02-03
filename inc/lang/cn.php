<?php
/*
Powered by ly200.com		http://www.ly200.com
广州联雅网络科技有限公司		020-83226791
*/

$Ly200Lang=array(
	'ly200'			=>	array(
							'system_title'			=>	'网站后台管理系统',
							'n_y_array'				=>	array('否', '<font class="fc_red">是</font>'),
							'lang_array'			=>	array('lang_0'=>'中文版', 'lang_1'=>'英文版'),
							'time_format_ymd'		=>	'Y-m-d',
							'time_format_full'		=>	'Y-m-d H:i:s',
							'price_symbols'			=>	get_cfg('ly200.price_symbols'),
							
							'ip'					=>	'IP',
							'alt'					=>	'Alt',
							'logo'					=>	'Logo',
							'add'					=>	'添加',
							'del'					=>	'删除',
							'copy'					=>	'复制',
							'mod'					=>	'修改',
							'submit'				=>	'提交',
							'move'					=>	'移动',
							'order'					=>	'排序',
							'turn'					=>	'跳转',
							'search'				=>	'搜索',
							'category'				=>	'分类',
							'list'					=>	'列表',
							'select'				=>	'选择',
							'anti_select'			=>	'反选',
							'number'				=>	'序号',
							'photo'					=>	'图片',
							'time'					=>	'时间',
							'operation'				=>	'操作',
							'return'				=>	'返回',
							'preview'				=>	'预览',
							'title'					=>	'标题',
							'name'					=>	'名称',
							'qty'					=>	'数量',
							'under_the'				=>	'隶属',
							'reset'					=>	'重置',
							'download'				=>	'下载',
							'view'					=>	'查看',
							'set'					=>	'设置',
							'invocation'			=>	'启用',
							'explanation'			=>	'说明',
							'default'				=>	'默认',
							'symbols'				=>	'符号',
							'email'					=>	'邮箱',
							'full_name'				=>	'姓名',
							'cancel'				=>	'取消',
							'remark'				=>	'备注',
							'refer'					=>	'刷新',
							'not_invocation'		=>	'未启用',
							'pre_page'				=>	'上一页',
							'next_page'				=>	'下一页',
							'del_success'			=>	'删除成功',
							'display'				=>	'前台显示',
							'category_name'			=>	'类别名称',
							'language'				=>	'语言版本',
							'other_property'		=>	'其他属性',
							'brief_description'		=>	'简短介绍',
							'contents'				=>	'详细内容',
							'description'			=>	'详细介绍',
							'current_location'		=>	'当前位置',
							'is_in_index'			=>	'首页显示',
							'add_item'				=>	'增加选项',
							'filled_out'			=>	'请正确填写',
							'correct_upload'		=>	'请正确上传',
							'move_selected_to'		=>	'把选中的移动到',
							'no_permit'				=>	'对不起，您没有权限进行本次操作！',
							'confirm_del'			=>	'确定要删除吗？删除后不可还原，继续吗？',
							'confirm_reset'			=>	'确定要重置吗？重置后将删除所有的数据并且不可还原，继续吗？',
							'seo'					=>	array('seo'=>'搜索优化', 'title'=>'标题', 'keywords'=>'关键词', 'description'=>'描述'),
						),
	
	//ckeditor
	'ckeditor'		=>	array(
							'file_type_error'		=>	'上传失败，文件类型错误！',
							'file_upload_succ'		=>	'文件上传成功！',
						),
	
	//登录页
	'login'			=>	array(
							'tips'					=>	'请输入用户名与密码，登录网站后台管理中心！',
							'tips_v_code_error'		=>	'错误的验证码，请重新登录！',
							'tips_locked'			=>	'您的帐号被管理员锁定，无法登录！',
							'tips_failed'			=>	'错误的用户名或密码，请重新登录！',
							'success'				=>	'成功登录后台',
							'username'				=>	'用户名',
							'password'				=>	'密&nbsp;&nbsp;码',
							'v_code'				=>	'验证码',
							'reload_v_code'			=>	'看不清验证码？刷新',
						),
	
	//后台首页
	'home'			=>	array(
							'noscript'				=>	'您的浏览器还未启用Javascript，请先启用！',
							'service_tel'			=>	'商务合作热线:15820227258',
							'welcome'				=>	'您好，<span>%s</span>！欢迎您使用九啾啾后台管理系统！',
							'website_home'			=>	'网站首页',
							'copyright'				=>	'<a href="http://9jiujiu.com/" target="_blank">广州九啾啾科技有限公司 &copy; 版权所有</a>',
							'system_home'			=>	'后台首页',
							'last_login'			=>	'上次登录时间',
							'current_login'			=>	'本次登录时间',
							'system_info'			=>	'系统信息',
							'php_version'			=>	'PHP程式版本',
							'mysql_version'			=>	'数据库版本',
							'mysql_size'			=>	'数据库占用',
							'system_os'				=>	'服务器端信息',
							'upload_max_size'		=>	'最大上传限制',
							'max_execution_time'	=>	'最大执行时间',
							'mail_support'			=>	'邮件支持模式',
							'cookie_test'			=>	'Cookie测试',
							'service_time'			=>	'服务器时间',
						),
	
	//左菜单大项目
	'menu'			=>	array(
							'menu_index'			=>	'后台管理中心',
							'set'					=>	'系统全局设置',
							'info'					=>	'文章管理系统',
							'instance'				=>	'案例管理系统',
							'download'				=>	'下载管理系统',
							'article'				=>	'信息管理系统',
							'product'				=>	'产品管理系统',
							'sale'					=>	'销售管理系统',
							'count'					=>	'数据统计查看',
							'feedback'				=>	'反馈管理系统',
							'admin'					=>	'后台用户管理',
							'other'					=>	'其他相关管理',
							'ext'					=>	'辅助管理选项',
						),
	//会员管理系统
	'member'		=>	array(
							'member_manage'			=>	'会员管理系统',
							'member_check'			=>	'教师审核',
							'title'					=>	'性别',
							'reg_time'				=>	'注册时间',
							'reg_ip'				=>	'注册IP',
							'login_time'			=>	'登录时间',
							'login_ip'				=>	'登录IP',
							'last_login_time'		=>	'最后登录时间',
							'last_login_ip'			=>	'最后登录IP',
							'consumption_price'		=>	'消费金额',
							'login_times'			=>	'登录次数',
							'base_info'				=>	'基本信息',
							'address_info'			=>	'地址信息',
							'wish_lists'			=>	'收藏夹',
							'shopping_cart'			=>	'购物车',
							'order_info'			=>	'订单信息',
							'login_info'			=>	'登录信息',
							'shipping_address'		=>	'收货地址',
							'billing_address'		=>	'账单地址',
							'mod_password'			=>	'修改密码',
							'member_level_manage'	=>	'会员级别管理',
							'level'					=>	array(
															'level_name'	=>	'会员级别名称',
															'price'			=>	'升级所需消费金额',
															'discount'		=>	'购物享受折扣'
														),
							'member_holder'			=>  array(
															'holder_info'    =>'开户信息',
															'Holder_UserName'=>'开户人姓名',
															'Holder_City'    =>'开户城市',
															'Holder_Bank'	 =>'绑定银行',
															'Holder_Detail'  =>'开户详细名称',
															'Holder_Num'	 =>'银行卡号',
														)
						),
	//会员管理系统
	'member_two'	=>	array(
							'member_manage'			=>	'教师申请管理系统',
							'member_check'			=>	'教师审核',
							'title'					=>	'性别',
							'reg_time'				=>	'注册时间',
							'reg_ip'				=>	'注册IP',
							'login_time'			=>	'登录时间',
							'login_ip'				=>	'登录IP',
							'last_login_time'		=>	'最后登录时间',
							'last_login_ip'			=>	'最后登录IP',
							'consumption_price'		=>	'消费金额',
							'login_times'			=>	'登录次数',
							'base_info'				=>	'基本信息',
							'address_info'			=>	'教师信息',
							'wish_lists'			=>	'收藏夹',
							'shopping_cart'			=>	'购物车',
							'order_info'			=>	'订单信息',
							'login_info'			=>	'登录信息',
							'shipping_address'		=>	'收货地址',
							'billing_address'		=>	'账单地址',
							'mod_password'			=>	'修改密码',
							'member_level_manage'	=>	'会员级别管理',
							'level'					=>	array(
															'level_name'	=>	'会员级别名称',
															'price'			=>	'升级所需消费金额',
															'discount'		=>	'购物享受折扣'
														),
						),
	
	//系统设置
	'set'			=>	array(
							'global'				=>	array(
															'set'			=>	'系统全局设置',
															'js_code'		=>	'JS代码',
														),
						'exchange_rate'			=>	array(
															'set'			=>	'汇率设置管理',
															'rate'			=>	'汇率',
														),
						),
	
	//文章管理系统
	'info'			=>	array(
							'category_manage'		=>	'文章类别管理',
							'info_manage'			=>	'文章管理系统',
							'author'				=>	'作者',
							'provenance'			=>	'来源',
							'burden'				=>	'责任编辑',
							'ext_url'				=>	'外部链接',
							'is_hot'				=>	'热点文章',
						),
	
	//成功案例管理系统
	'instance'		=>	array(
							'category_manage'		=>	'案例类别管理',
							'instance_manage'		=>	'案例管理系统',
							'is_classic'			=>	'经典案例',
						),
	
	//下载中心管理系统
	'download'		=>	array(
							'category_manage'		=>	'下载类别管理',
							'download_manage'		=>	'下载中心管理',
							'file'					=>	'文件',
							'upload_file'			=>	'上传小文件',
							'file_path'				=>	'或文件路径',
						),
	
	//信息管理系统
	'article'		=>	array(
							'group_0'				=>	'网站信息管理',
							'group_1'				=>	'关于我们',
							'group_2'				=>	'老师指南',
							'group_3'				=>	'学生指南',
							'group_4'				=>	'',
						),
	
	//产品管理系统
	'product'		=>	array(
							'circle'				=>  '商圈',
							'circle_manage'			=>  '商圈管理',				
							'color_manage'			=>	'授课地区管理',
							'size_manage'			=>	'产品尺寸管理',
							'brand_manage'			=>	'产品品牌管理',
							'category_manage'		=>	'产品分类管理',
							'product_manage'		=>	'产品管理系统',
							'color'					=>	'授课地区',
							'size'					=>	'尺寸',
							'brand'					=>	'品牌',
							'item_number'			=>	'编号',
							'model'					=>	'型号',
							'identity'				=>	'身份认证',
							'degree'				=>	'学历认证',
							'certification'			=>	'专业认证',
							'sold_out'				=>	'下架',
							'stock'					=>	'库存',
							'start_from'			=>	'起订量',
							'weight'				=>	'重量',
							'weight_unit'			=>	'KG',
							'price'					=>	'价格',
							'is_hot'				=>	'热卖产品',
							'is_recommend'			=>	'推荐产品',
							'is_new'				=>	'新品上市',
							'copy_success'			=>	'产品复制成功，请进入编辑页面！',
							'price_list'			=>	array('price_0'=>'机构价', 'price_1'=>'在线价'),
							'special_offer'			=>	'特价',
							'wholesale_price'		=>	'批发价',
							'stock_asc'				=>	'库存低到高',
							'stock_desc'			=>	'库存高到低',
							'time_asc'				=>	'时间低到高',
							'time_desc'				=>	'时间高到低',
							'ext'					=>	array(
															'Volume'=>'性格描述（12个字内）',
															'T_age'	=>	'教龄',
															'Applicable'	=>	'性别',
															'P_age'	=>	'年龄',
															'S_0'	=>	'约课成功率',
															'S_1'	=>	'学生总数',
															'S_2'	=>	'授课时长',
															'S_3'	=>	'续课率',															
															'Warranty0' => '教学理念',
															'Warranty1' => '教学特长',
															'Warranty2' => '教学教学经历',
															'Warranty3' => '教学成果',
															'Warranty4' => '教学成就',
														),
						),
	//订单管理系统
	'orders'		=>	array(
							'orders_manage'			=>	'约课管理系统',
							'order_number'			=>	'订单号',
							'item_costs'			=>	'产品总价',
							'shipping_charges'		=>	'运费',
							'shipping_method'		=>	'送货方式',
							'tracking_number'		=>	'邮包号',
							'grand_total'			=>	'总价',
							'discount'				=>	'折扣',
							'discount_remark'		=>	'填写范围：0至1，1为不打折，0.8即为8折',
							'view_member_info'		=>	'查看用户信息',
							'order_status'			=>	'订单状态',
							'payment_method'		=>	'付款方式',
							'base_info'				=>	'基本信息',
							'address_info'			=>	'地址信息',
							'order_status'			=>	'订单状态',
							'products_list'			=>	'产品列表',
							'print_order'			=>	'打印订单',
							'export_order'			=>	'导出订单',
							'shipping_address'		=>	'收货地址',
							'billing_address'		=>	'账单地址',
							'orders_comments'		=>	'订单留言',
							'cancel_reason'			=>	'取消原因',
							'weight'				=>	'订单重量',
							'shipping_time'			=>	'发货时间',
							'payment_info'			=>	'付款信息',
							'auto_upd_price'		=>	'自动重新计算订单价格',
							'auto_upd_ship_price'	=>	'修改时自动重新计算运费',
							'auto_upd_ship_price_1'	=>	'修改时且同步到收货地址时自动重新计算运费',
							'product'				=>	'产品',
							'sub_total'				=>	'小计',
							'product_add'			=>	'添加产品',
						),
	//订单管理系统
	'order_twos'		=>	array(
							'order_twos_manage'		=>	'续课管理系统',
							'order_two_number'		=>	'订单号',
							'item_costs'			=>	'产品总价',
							'shipping_charges'		=>	'运费',
							'shipping_method'		=>	'送货方式',
							'tracking_number'		=>	'邮包号',
							'grand_total'			=>	'总价',
							'discount'				=>	'折扣',
							'discount_remark'		=>	'填写范围：0至1，1为不打折，0.8即为8折',
							'view_member_info'		=>	'查看用户信息',
							'order_two_status'		=>	'订单状态',
							'payment_method'		=>	'付款方式',
							'base_info'				=>	'基本信息',
							'address_info'			=>	'地址信息',
							'order_two_status'		=>	'订单状态',
							'products_list'			=>	'产品列表',
							'print_order_two'		=>	'打印订单',
							'export_order_two'		=>	'导出订单',
							'shipping_address'		=>	'收货地址',
							'billing_address'		=>	'账单地址',
							'order_twos_comments'	=>	'订单留言',
							'cancel_reason'			=>	'取消原因',
							'weight'				=>	'订单重量',
							'shipping_time'			=>	'发货时间',
							'payment_info'			=>	'付款信息',
							'auto_upd_price'		=>	'自动重新计算订单价格',
							'auto_upd_ship_price'	=>	'修改时自动重新计算运费',
							'auto_upd_ship_price_1'	=>	'修改时且同步到收货地址时自动重新计算运费',
							'product'				=>	'产品',
							'sub_total'				=>	'小计',
							'product_add'			=>	'添加产品',
						),
	
	//邮件发送系统
	'send_mail'		=>	array(
							'send_mail_system'		=>	'邮件发送系统',
							'to'					=>	'收件人',
							'send_to_all_member'	=>	'同时发送到网站所有注册用户',
							'send_to_all_newsletter'=>	'同时发送到邮件列表里的邮箱',
							'tips'					=>	'备注: 多个收件人请每行填写一个，并且每个收件人的<font class="fc_red">邮箱地址</font>与<font class="fc_red">姓名</font>用<font class="fc_yellow">/</font>分隔开，如: webmaster@ly200.com<font class="fc_yellow">/</font>cai yuzhuan<br><br>邮件主题或邮件内容可用变量（红色内容）:<br><font class="fc_red">{Email}</font>: 邮箱地址<br><font class="fc_red">{FullName}</font>: 姓名',
							'subject'				=>	'邮件主题',
							'send'					=>	'发送邮件',
							'send_success'			=>	'发送邮件成功',
							'member_list'			=>	'注册用户列表',
						),
	//在线留言管理系统
	'feedback'		=>	array(
							'feedback_manage'		=>	'在线留言管理',
							'company'				=>	'公司',
							'phone'					=>	'电话',
							'mobile'				=>	'手机',
							'qq'					=>	'QQ',
							'subject'				=>	'主题',
							'message'				=>	'内容',
							'reply'					=>	'回复',
							'reply_status'			=>	array('<font class="fc_red">未回复</font>', '已回复'),
						),
	
	//在线询盘管理系统
	'product_inquire'=>	array(
							'product_inquire_manage'=>	'在线询盘管理',
							'full_name'				=>	'姓名',
							's_c_a'					=>	'省份城市',
							'address'				=>	'地址',
							'city'					=>	'市',
							'state'					=>	'州',
							'country'				=>	'国家',
							'postal_code'			=>	'邮编',
							'phone'					=>	'电话',
							'fax'					=>	'传真',
							'subject'				=>	'主题',
							'message'				=>	'内容',
							'inquire_product'		=>	'询盘产品',
						),
	
	//产品评论管理系统
	'product_review'=>	array(
							'product_review_manage'	=>	'老师评论管理',
							'product'				=>	'老师',
							'full_name'				=>	'评论的者',
							'rating'				=>	'评分',
							'reply'					=>	'回复',
							'reply_status'			=>	array('<font class="fc_red">未回复</font>', '已回复'),
						),
	//产品评论管理系统
	'product_two_review'=>	array(
							'product_two_review_manage'	=>	'学生评论管理',
							'product'				=>	'学生',
							'full_name'				=>	'评论的者',
							'rating'				=>	'评分',
							'reply'					=>	'回复',
							'reply_status'			=>	array('<font class="fc_red">未回复</font>', '已回复'),
						),
						
	//会员充值记录系统
	'recharge_record'=>	array(
							'recharge_record_manage'=>	'充值记录管理',
							'full_name'				=>	'会员昵称',
							'price'					=>  '金额',
							'phone'					=>  '手机',
							'status'				=>  '状态',
							'oid'					=>  '充值号',
						),
						
	//会员提现管理系统
	'withdraw'=> array(
							'withdraw_manage'		=>  '会员提现管理',
							'full_name'				=>	'会员昵称',
							'price'					=>  '金额',
							'status'				=>  '状态',
							'mod'					=>  '修改',
						),
						
	//后台用户管理系统
	'admin'			=>	array(
							'admin_manage'			=>	'后台用户管理',
							'username'				=>	'用户名',
							'username_left_len'		=>	'用户名的长度必须为6位以上！',
							'user_exist'			=>	'对不起，添加失败，此用户名已经存在！',
							'password'				=>	'登录密码',
							'password_left_len'		=>	'登录密码的长度必须为8位以上！',
							're_password'			=>	'确认密码',
							'repwd_dif_pwd'			=>	'确认密码与登录密码不一致，请重新填写！',
							'locked'				=>	'锁定',
							'keep_null_unmodpwd'	=>	'留空则不修改密码！',
							'last_login_time'		=>	'上次登录时间',
							'last_login_ip'			=>	'上次登录IP',
							'update_password'		=>	'修改我的密码',
							'old_password'			=>	'旧密码',
							'new_password'			=>	'新密码',
							'new_pwd_left_len'		=>	'新密码的长度必须为8位以上！',
							'old_password_err'		=>	'旧密码不正确，请重新输入！',
							'update_pwd_success'	=>	'密码修改成功，请牢记新密码！',
							'welcome'				=>	'您好，<span>%s</span>！欢迎您使用本系统！上次登录IP：<span>%s</span>，时间：<span>%s</span>，本次登录IP：<span>%s</span>',
							'logout'				=>	'安全退出',
							'group_1'				=>	'超级管理员',
							'group_2'				=>	'一般管理员',
							'permit'				=>	'权限',
						),
	
	//国家地区管理系统
	'country'		=>	array(
							'country_manage'		=>	'国家地区管理',
							'country'				=>	'国家地区',
							'country_exist'			=>	'对不起，此国家地区已经存在！',
						),
	
	//广告图片管理
	'ad'			=>	array(
							'ad_manage'				=>	'广告图片管理',
							'pagename'				=>	'页面名称',
							'ad_position'			=>	'广告位置',
							'ad_type'				=>	'广告类型',
							'ad_type_ary'			=>	array('图片', '动画', '编辑器'),
							'pic_qty'				=>	'图片数量',
							'width'					=>	'广告宽度',
							'height'				=>	'广告高度',
							'contents'				=>	'广告内容',
							'photo'					=>	'广告图片',
							'flash'					=>	'上传动画',
							'name'					=>	'广告名称',
							'url'					=>	'链接地址',
						),
	
	//在线调查管理
	'survey'		=>	array(
							'survey_manage'			=>	'在线调查管理',
							'subject'				=>	'调查主题',
							'item'					=>	'调查选项',
							'votes_count'			=>	'票数',
						),
	
	//友情链接管理系统
	'links'			=>	array(
							'links_manage'			=>	'友情链接管理',
							'url'					=>	'链接地址',
						),
	
	//翻译链接管理系统
	'translate'		=>	array(
							'translate_manage'		=>	'银行管理系统',
							'url'					=>	'链接地址',
						),
	
	//热门搜索管理系统
	'search_keyword'=>	array(
							'search_keyword_manage'	=>	'热门搜索管理',
							'keyword'				=>	'关键词',
						),
	
	//静态化管理系统
	'html'			=>	array(
							'html_manage'			=>	'静态化管理',
							'page_name'				=>	'页面名称',
							'option'				=>	'选项',
							'processing'			=>	'正在处理中...',
							'write_success'			=>	'成功生成文件',
							'process_success'		=>	'处理完成',
							'step_info'				=>	'共要处理%s个文件，已成功处理%s个！<br>正在准备进入下一轮操作，如果浏览器不会自动跳转，请点击<a href="%s" class="red">这里</a>',
							'all_list'				=>	'总列表页',
							'page'					=>	array(
															'index'				=>	'首页',
															'article'			=>	'信息页',
															'info_category'		=>	'文章分类页',
															'info_detail'		=>	'文章详细页',
															'instance_list'		=>	'案例列表页',
															'instance_category'	=>	'案例分类页',
															'instance_detail'	=>	'案例详细页',
															'download_list'		=>	'下载列表页',
															'download_category'	=>	'下载分类页',
															'product_list'		=>	'产品列表页',
															'product_category'	=>	'产品分类页',
															'product_detail'	=>	'产品详细页',
														),
						),
	
	//网站日志管理系统
	'manage_log'	=>	array(
							'log_manage'			=>	'网站管理日志',
							'admin_user_name'		=>	'管理员名称',
							'page_url'				=>	'请求URL',
							'ip'					=>	'IP地址',
							'ip_to_address'			=>	'IP地址来源',
							'log_contents'			=>	'日志内容',
						),
	
	//数据库备份还原
	'database'		=>	array(
							'database_manage'		=>	'数据库管理',
							'database_backup'		=>	'数据库备份',
							'database_restore'		=>	'数据库还原',
							'backup'				=>	'备份',
							'backup_s'				=>	'开始备份数据库>>',
							'backup_ing'			=>	'正在备份数据库，这个过程可能长达数分钟，请耐心等待...',
							'backup_ok'				=>	'数据库备份完成！',
							'restore'				=>	'还原',
							'restore_ing'			=>	'正在还原数据库，这个过程可能长达数分钟，请耐心等待...',
							'restore_ing_limit'		=>	'成功还原第 <font class="fc_red">%s</font> 卷数据，共 <font class="fc_red">%s</font> 卷！',
							'restore_ok'			=>	'数据库还原完成！',
							'confirm_restore'		=>	'确定要还原数据吗？还原前强烈建议备份现有数据，继续吗？',
							'file_size'				=>	'备份文件大小',
							'file_count'			=>	'文件卷数',
							'backup_time'			=>	'备份时间',
						),
	
	//phpMyAdmin
	'phpmyadmin'	=>	array(
							'phpmyadmin'			=>	'phpMyAdmin',
						),
	
	//扩展预留，如果有新的语言需要加入，放在这里就可以了，读取方法：get_lang('ext.数组下标')
	'ext'			=>	array(
							
						),
);

$Ly200JsLang=array(
	'ly200'			=>	array(
							'price_symbols'			=>	get_cfg('ly200.price_symbols'),
							'qty'					=>	'数量',
							'votes_count'			=>	'票数',
							'update_fail'			=>	'对不起，更新失败！',
							'update_no_permit'		=>	'对不起，您没有权限进行此操作！',
						),
	
	//日期
	'date'			=>	array(
							'months'				=>	array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'),
							'weeks'					=>	array('日', '一', '二', '三', '四', '五', '六'),
							'clear'					=>	'清空',
							'today'					=>	'今天',
							'close'					=>	'关闭',
						),
	
	//窗口
	'windows'		=>	array(
							'min'					=>	'最小化',
							'max'					=>	'最大化',
							'zoom'					=>	'还原',
							'tips'					=>	'提示',
							'close'					=>	'关闭',
							'close_all'				=>	'关闭全部',
						),
);
?>