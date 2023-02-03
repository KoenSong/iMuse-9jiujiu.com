/*
Powered by ly200.com		http://www.ly200.com
广州联雅网络科技有限公司		020-83226791
*/

onerror=function(){
	return true;
}

//------------------------------------------------------------------------登录页面-----------------------------------------------------------------------
function login(){
	if($_('username').value=='' || $_('password').value=='' || $_('excode').value==''){
		if($_('username').value==''){
			$_('username').focus();
		}else if($_('password').value==''){
			$_('password').focus();
		}else{
			$_('excode').focus();
		}
		return false;
	}
	return true;
}

//------------------------------------------------------------------------主页面-----------------------------------------------------------------------
var zIndex=1;	//弹出窗口叠层
var divWindowsArray=new Array();	//窗口对象
var divWindowsCount=0;	//窗口数量
var divWindowsMoveModel=1;	//窗口拖动模式，0：只允许在工作桌面内拖动，1：允许右边、下边、左边超出工作桌面，2：允许右边、下边超出工作桌面
var currentDivWindowsId=null;	//当前窗口的ID号
var desktopPadding=0;	//工作桌面与窗口的间距
var leftMenuWidth, topMenuHeight, docWidth, docHeight, desktopWidth, desktopHeight, divWindowsWidth, divWindowsHeight;

function ly200_init(act){
	var o0=$_('loading');
	var o1=$_('ly200');
	var o2=$_('leftMenu');
	var o3=$_('topMenu');
	var o4=$_('footer');
	var o5=$_('rightContents');
	var o6=$_('loginInfo');
	var o7=$_('windowsNav');
	var o8=$_('desktop');
	
	o0.style.display='none';
	o1.style.display='block';
	
	leftMenuWidth=o2.clientWidth;	//左菜单宽度
	topMenuHeight=o3.clientHeight;	//顶部高度
	var footerHeight=o4.clientHeight;	//底部高度
	
	docWidth=doc.clientWidth;	//浏览器可见区域宽度
	docWidth<1000 && (docWidth=1000);
	docHeight=doc.clientHeight;	//浏览器可见区域高度
	docHeight<600 && (docHeight=600);
	
	desktopWidth=docWidth-leftMenuWidth-desktopPadding*2;	//工作桌面宽度
	var lineListCount=parseInt((desktopWidth-22)/110);	//每行能显示的个数，22为关闭所有按钮的宽度
	var lineCount=Math.ceil(divWindowsCount/lineListCount);
	lineCount<=0 && (lineCount=1);
	o7.style.height=lineCount*27+2+'px';
	loginInfoHeight=o6.clientHeight;	//信息条高度
	windowsNavHeight=o7.clientHeight;	//导航条高度
	desktopHeight=docHeight-topMenuHeight-footerHeight-loginInfoHeight-windowsNavHeight-desktopPadding*2;	//工作桌面高度
	divWindowsWidth=desktopWidth;	//新窗口默认宽度
	divWindowsHeight=desktopHeight;	//新窗口默认高度
	
	o1.style.width=(parseInt(o1.clientWidth, 10)<=docWidth || parseInt(o1.clientWidth, 10)>=docWidth)?docWidth+'px':'100%';
	o2.style.height=desktopHeight+windowsNavHeight+desktopPadding*2+'px';
	o5.style.width=desktopWidth+desktopPadding*2+'px';
	o5.style.height=desktopHeight+windowsNavHeight+desktopPadding*2+'px';
	o8.style.width=desktopWidth+'px';
	o8.style.height=desktopHeight+'px';
	
	isIe?o1.onselectstart=function(){return false;}:o1.onmousedown=o1.onmouseup=function(){return false;};
	currentDivWindowsId!=null && divWindowsArray[currentDivWindowsId].focusWindows(currentDivWindowsId);
	act=='load' && ($_('checkiframe').src='main.php?check=1');
}

function openWindows(id, title, url){
	for(var key in divWindowsArray){	//判断窗口是否已经打开
		if(divWindowsArray[key].id==id){
			divWindowsArray[key].focusWindows(id);
			$_('divWindowsContentsIframe_'+id).src=url;
			return true;
		}
	}
	
	divWindowsCount++;
	currentDivWindowsId=id;
	divWindowsArray[id]=new divWindows(id, title, divWindowsWidth, divWindowsHeight, url);
	divWindowsArray[id].openWindows();
	divWindowsArray[id].navListWindows();	//打开新窗口后不需要focusWindows，因为navListWindows后，会执行ly200_init，ly200_init再执行focusWindows
}

function divWindows(id, title, width, height, url){	//创建弹出窗口，构造函数
	this.id=id; //窗口id
	this.title=title; //弹出窗口标题
	this.url=url; //弹出窗口内容
	this.width=width; //弹出窗口宽度
	this.height=height; //弹出窗口高度
	this.left=(desktopWidth-this.width)/2; //弹出窗口位置
	this.left<0 && (this.left=0);
	this.top=(desktopHeight-this.height)/2; //弹出窗口位置
	this.top<0 && (this.top=0);
	
	if(this.width>=desktopWidth && this.height>=desktopHeight){
		this.pLeft=parseInt((desktopWidth-this.width*0.6)/2, 10);
		this.pTop=parseInt((desktopHeight-this.height*0.8)/2, 10);
		this.size='full';
	}else{
		this.pLeft=this.left;
		this.pTop=this.top;
		this.size='zoom';
	}
}

divWindows.prototype={
	registerEvent:function(element, eventType, handler){	//注册事件函数
		if(element.attachEvent){
			element.attachEvent('on'+eventType, handler);
		}else if(element.addEventListener){
			element.addEventListener(eventType, handler, false);
		}else{
			element['on'+eventType]=handler;
		}
	},
	
	bindFunction:function(obj, handler){	//绑定函数到对象
		var args=[];
		for(var i=2; i<arguments.length; i++){
			args.push(arguments[i]);
		}
		return function(){handler.apply(obj, args)};
	},
	
	focusWindows:function(id, ct){		//窗口获得焦点
		for(var key in divWindowsArray){
			if(divWindowsArray[key].id==null){
				continue;
			}
			$_('divWindowsContentsRemark_'+divWindowsArray[key].id).style.display='block';
			$_('windowsList_'+divWindowsArray[key].id).className='list0';
		}
		if(id){
			var o0=$_('divWindows_'+id);
			var o1=$_('windowsList_'+id);
			var o2=$_('divWindowsContents_'+id);
			var o3=$_('divWindowsContentsIframe_'+id);
			var o4=$_('divWindowsContentsRemark_'+id);
			
			o0.style.zIndex=zIndex=zIndex+1;
			o1.className='list1';
			
			if(ct==1 && currentDivWindowsId==id){	//点击导航栏时，如果状态为隐藏则显示，否则则反之
				if(id=='win_manage_index_page'){
					o4.style.display='none';
					return true;
				}
				o0.style.display='none';
				o4.style.display='block';
				currentDivWindowsId=null;
				divWindowsArray[key].focusWindows();
			}else{
				if(divWindowsArray[id].size=='full'){	//当前窗口状态为全屏，调整窗口大小
					o0.style.width=desktopWidth+'px';
					o0.style.height=desktopHeight+'px';
					o2.style.height=o3.style.height=o4.style.height=desktopHeight-23+(divWindowsArray[id].id=='win_manage_index_page'?27:0)+'px';
				}
				o0.style.display='block';	//窗口有可能被最小化了，所以要设置回显示状态
				o4.style.display='none';
				currentDivWindowsId=id;
			}
		}else{	//关闭窗口时查找zIndex值最大的窗口作为当前窗口
			var czIndex=0;
			currentDivWindowsId=null;
			for(var key in divWindowsArray){
				if(divWindowsArray[key].id==null || $_('divWindows_'+divWindowsArray[key].id).style.display=='none'){
					continue;
				}
				if($_('divWindows_'+divWindowsArray[key].id).style.zIndex>czIndex){
					czIndex=$_('divWindows_'+divWindowsArray[key].id).style.zIndex;
					currentDivWindowsId=divWindowsArray[key].id;
				}
			}
			currentDivWindowsId!=null && divWindowsArray[key].focusWindows(currentDivWindowsId);
		}
	},
	
	navListWindows:function(){	//窗口导航条
		var html='';
		var windowsArray=divWindowsArray.sort();
		
		for(var key in windowsArray){
			if(windowsArray[key].id==null){
				continue;
			}
			html+='<div class="list0" id="windowsList_'+key+'" onclick="divWindowsArray[\''+key+'\'].focusWindows(\''+windowsArray[key].id+'\', 1);" title="'+windowsArray[key].title+'">';
				html+='<div class="title">'+windowsArray[key].title+'</div>';
				windowsArray[key].id!='win_manage_index_page' && (html+='<div class="close" onclick="divWindowsArray[\''+key+'\'].closeWindows(\''+windowsArray[key].id+'\');"><img title="'+Ly200JsLang._windows._close+'" src="images/win_close_0.gif" onmouseover="mouse_over_out_img(\'over\', this);" onmouseout="mouse_over_out_img(\'out\', this);"></div>');
			html+='</div>';
		}
		divWindowsCount>=5 && (html+='<div class="closeall" onclick="divWindowsArray[\''+key+'\'].closeWindows(\'all\');"><img src="images/close_all_0.gif" title="'+Ly200JsLang._windows._close_all+'" onmouseover="mouse_over_out_img(\'over\', this);" onmouseout="mouse_over_out_img(\'out\', this);"></div>');
		$_('windowsList').innerHTML=html;
		ly200_init();
	},
	
	zoomDivWindows:function(id){	//最大化、还原窗口
		if(id=='win_manage_index_page'){
			return false;
		}
		var o0=$_('divWindows_'+id);
		var o1=$_('divWindowsTopZoomImg_'+id);
		var o2=$_('divWindowsContents_'+id);
		var o3=$_('divWindowsContentsIframe_'+id);
		var o4=$_('divWindowsContentsRemark_'+id);
		
		if(divWindowsArray[id].size=='full'){	//当前状态为最大化则缩小
			var w=parseInt(desktopWidth*0.6, 10);
			var h=parseInt(desktopHeight*0.8, 10);
			var l=divWindowsArray[id].pLeft;
			var t=divWindowsArray[id].pTop;
			o1.src='images/zoom0.gif';
			o1.title=Ly200JsLang._windows._max;
			divWindowsArray[id].size='zoom';
		}else{
			var w=desktopWidth;
			var h=desktopHeight+2;
			var l=t=0;
			o1.src='images/zoom1.gif';
			o1.title=Ly200JsLang._windows._zoom;
			divWindowsArray[id].size='full';
		}
		
		o0.style.width=w+'px';
		o0.style.height=h+'px';
		o0.style.left=l+'px';
		o0.style.top=t+'px';
		o2.style.height=o3.style.height=o4.style.height=h-27+'px';
		
		divWindowsArray[id].width=w;
		divWindowsArray[id].height=h;
	},
	
	minDivWindows:function(id){	//最小化窗口
		$_('divWindows_'+id).style.display='none';
		divWindowsArray[id].focusWindows();
	},
	
	moveDivWindows:function(id){	//移动弹出窗口
		if(id=='win_manage_index_page'){
			return false;
		}
		var o0=$_('divWindows_'+id);
		var o1=$_('divWindowsContents_'+id);
		var o2=$_('divWindowsContentsIframe_'+id);
		var win_id=id;
		var display_hidden_iframe=function(m){
			if(m==0){
				o1.style.background='#ccc';
				o1.style.borderStyle='dashed';
				o2.style.display='none';
			}else{
				o1.style.background='#fff';
				o1.style.borderStyle='solid';
				o2.style.display='';
			}
		}
		
		o0.onmousedown=function(evt){
			evt=evt||window.event;
			var x=evt.layerX||evt.offsetX;
			var y=evt.layerY||evt.offsetY;
			
			if(x<22){
				return false;
			}
			
			display_hidden_iframe(0);
			
			document.onmousemove=function(evt){
				evt=evt||window.event;
				
				xp=evt.clientX-x-leftMenuWidth-desktopPadding-2;
				yp=evt.clientY-y-topMenuHeight-loginInfoHeight-windowsNavHeight-desktopPadding-2;
				yp=yp<0?0:yp;	//限制距离顶端
				
				if(divWindowsMoveModel==0){
					xp=xp+o0.clientWidth>desktopWidth?desktopWidth-o0.clientWidth:xp;
					xp=xp<0?0:xp;
					yp=yp+o0.clientHeight>desktopHeight?desktopHeight-o0.clientHeight:yp;
				}else if(divWindowsMoveModel==1){
					xp=desktopWidth-xp<100?desktopWidth-100:xp;
					xp=xp+o0.clientWidth<100?-(o0.clientWidth-100):xp;
					yp=desktopHeight-yp<100?desktopHeight-100:yp;
				}else{
					xp=desktopWidth-xp<100?desktopWidth-100:xp;
					xp=xp<0?0:xp;
					yp=desktopHeight-yp<100?desktopHeight-100:yp;
				}
				o0.style.left=xp+'px';
				o0.style.top=yp+(document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop)+'px';
			}
			
			document.onmouseup=function(){
				o0.onmousedown=document.onmousemove=document.onmouseup=null;
				
				xp=parseInt(o0.style.left, 10);
				(xp<=30 && xp>=-30) && (xp=0);
				yp=parseInt(o0.style.top, 10);
				(yp<=30 && yp>=-30) && (yp=0);
				
				o0.style.left=xp+'px';
				o0.style.top=yp+'px';
				display_hidden_iframe(1);
				
				if(divWindowsArray[win_id].width<desktopWidth && divWindowsArray[win_id].height<desktopHeight){
					divWindowsArray[win_id].pLeft=xp;
					divWindowsArray[win_id].pTop=yp;
				}
			}
		}
	},
	
	openWindows:function(){	//弹出窗口
		//整个窗口容器
		var divWindows=document.createElement('div');
		divWindows.setAttribute('id', 'divWindows_'+this.id);
		divWindows.className='divWindows';
		divWindows.style.zIndex=zIndex;
		divWindows.style.width=this.width+'px';
		divWindows.style.height=this.height+'px';
		divWindows.style.left=this.left+'px';
		divWindows.style.top=this.top+'px';
		this.registerEvent(divWindows, 'mousedown', this.bindFunction(divWindows, this.focusWindows, this.id));
		
		//窗口头部框体
		var divWindowsTopDiv=document.createElement('div');
		divWindowsTopDiv.setAttribute('id', 'divWindowsTop_'+this.id);
		divWindowsTopDiv.className='divWindowsTopDiv';
		this.registerEvent(divWindowsTopDiv, 'mousedown', this.bindFunction(divWindowsTopDiv, this.moveDivWindows, this.id));
		this.registerEvent(divWindowsTopDiv, 'dblclick', this.bindFunction(divWindowsTopDiv, this.zoomDivWindows, this.id));
		
		//显示窗口的最小化按钮
		var divWindowsTopMinDiv=document.createElement('div');
		divWindowsTopMinDiv.setAttribute('id', 'divWindowsTopMin_'+this.id);
		divWindowsTopMinDiv.className='divWindowsTopMinDiv';
		divWindowsTopMinDiv.innerHTML='<img src="images/min.gif" title="'+Ly200JsLang._windows._min+'">';
		this.registerEvent(divWindowsTopMinDiv, 'click', this.bindFunction(divWindowsTopMinDiv, this.minDivWindows, this.id));
		
		//显示窗口的放大、缩小按钮
		var divWindowsTopZoomDiv=document.createElement('div');
		divWindowsTopZoomDiv.setAttribute('id', 'divWindowsTopZoom_'+this.id);
		divWindowsTopZoomDiv.className='divWindowsTopZoomDiv';
		if(this.width>=desktopWidth && this.height>=desktopHeight){
			var img=1;
			var title=Ly200JsLang._windows._zoom;
		}else{
			var img=0;
			var title=Ly200JsLang._windows._max;
		}
		divWindowsTopZoomDiv.innerHTML='<img src="images/zoom'+img+'.gif" title="'+title+'" id="divWindowsTopZoomImg_'+this.id+'">';
		this.registerEvent(divWindowsTopZoomDiv, 'click', this.bindFunction(divWindowsTopZoomDiv, this.zoomDivWindows, this.id));
		
		//显示弹出窗口标题
		var divWindowsTopTitleDiv=document.createElement('div');
		divWindowsTopTitleDiv.setAttribute('id', 'divWindowsTopTitle_'+this.id);
		divWindowsTopTitleDiv.className='divWindowsTopTitleDiv';
		divWindowsTopTitleDiv.innerHTML='<img src="images/home.gif" align="absmiddle">'+this.title;
		
		//显示弹出窗口的关闭按钮
		var divWindowsTopCloseDiv=document.createElement('div');
		divWindowsTopCloseDiv.setAttribute('id', 'divWindowsTopClose_'+this.id);
		divWindowsTopCloseDiv.className='divWindowsTopCloseDiv';
		divWindowsTopCloseDiv.innerHTML='<img src="images/close.gif" title="'+Ly200JsLang._windows._close+'">';
		this.registerEvent(divWindowsTopCloseDiv, 'click', this.bindFunction(divWindowsTopCloseDiv, this.closeWindows, this.id));
		
		//显示窗口内容
		var divWindowsContentsDiv=document.createElement('div');
		divWindowsContentsDiv.setAttribute('id', 'divWindowsContents_'+this.id);
		divWindowsContentsDiv.className='divWindowsContentsDiv';
		
		//窗口内容之框架
		var divWindowsContentsDivIframe=document.createElement('iframe');
		divWindowsContentsDivIframe.setAttribute('id', 'divWindowsContentsIframe_'+this.id);
		divWindowsContentsDivIframe.setAttribute('frameBorder', 0);
		(isIe && ie_version==6) && divWindowsContentsDivIframe.setAttribute('scrolling', 'yes');
		divWindowsContentsDivIframe.setAttribute('src', this.url);
		divWindowsContentsDivIframe.className='divWindowsContentsDivIframe';
		
		//窗口内容之遮罩层
		var divWindowsContentsDivRemark=document.createElement('div');
		divWindowsContentsDivRemark.setAttribute('id', 'divWindowsContentsRemark_'+this.id);
		divWindowsContentsDivRemark.className='divWindowsContentsDivRemark';
		
		//将整个窗口内容写入到文档中
		divWindowsTopDiv.appendChild(divWindowsTopTitleDiv);
		divWindowsTopDiv.appendChild(divWindowsTopCloseDiv);
		divWindowsTopDiv.appendChild(divWindowsTopZoomDiv);
		divWindowsTopDiv.appendChild(divWindowsTopMinDiv);
		
		divWindowsContentsDiv.appendChild(divWindowsContentsDivIframe);
		divWindowsContentsDiv.appendChild(divWindowsContentsDivRemark);
		
		divWindows.appendChild(divWindowsTopDiv);
		divWindows.appendChild(divWindowsContentsDiv);
		
		$_('workWindows').appendChild(divWindows);
		
		this.id=='win_manage_index_page' && (divWindowsTopDiv.style.display='none');	//后台首页隐藏控制按钮
	},

	closeWindows:function(id){		//关闭窗口
		for(var key in divWindowsArray){
			if((id=='all' || divWindowsArray[key].id==id) && divWindowsArray[key].id!=null && divWindowsArray[key].id!='win_manage_index_page'){
				$_('windowsList_'+divWindowsArray[key].id).onclick=function(){return false;};	//在FF下，点击导航条关闭按钮时会同时触发两个函数，所以要注销掉，只响应关闭动作
				$_('workWindows').removeChild($_('divWindows_'+key));
				divWindowsArray[key].id=null;
				divWindowsCount--;
			}
		}
		
		currentDivWindowsId=null;
		divWindowsArray[key].navListWindows();
		divWindowsArray[key].focusWindows();
	}
}

//------------------------------------------------------------------------其他-----------------------------------------------------------------------
function click_button(obj, form_id, action_button_id){
	$_(action_button_id).value=obj.name;
	obj.disabled=true;
	$_(form_id).submit();
}

function change_all(checkbox_name){
	var obj=document.getElementsByTagName('input');
	for(var i=0; i<obj.length; i++){
		(obj[i].type.toLowerCase()=='checkbox' && obj[i].name==checkbox_name && obj[i].disabled==false) && (obj[i].checked=obj[i].checked?false:true);
	}
}

function turn_page(form){
	var page_value=parseInt(form.page.value);
	var total_pages_value=parseInt(form.total_pages.value);
	(page_value<1 || page_value>total_pages_value) && (form.page.value=1);
	form.submit!='undefined' && (form.submit.disabled=true);
}

function add_wholesale_price_item(obj){
	var newrow=$_(obj).insertRow(-1);
	newcell=newrow.insertCell(-1);
	newcell.innerHTML=Ly200JsLang._ly200._qty+':<input name="Qty[]" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" type="text" value="" class="form_input" size="5" maxlength="10">'+Ly200JsLang._ly200._price_symbols+'<input name="WholesalePrice[]" type="text" value="" class="form_input" size="5" maxlength="10" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);"><a href="javascript:void(0)" onclick="$_(\'wholesale_price_list\').deleteRow(this.parentNode.parentNode.rowIndex);"><img src="../images/del.gif" hspace="5" /></a>';
}

function add_survey_item(obj){
	var newrow=$_(obj).insertRow(-1);
	newcell=newrow.insertCell(-1);
	newcell.innerHTML='<input name="ItemTitle[]" type="text" value="" class="form_input" size="45" maxlength="100">'+Ly200JsLang._ly200._votes_count+':<input name="VotesCount[]" type="text" value="" class="form_input" size="5" maxlength="5"><a href="javascript:void(0)" onclick="$_(\'survey_item_list\').deleteRow(this.parentNode.parentNode.rowIndex);"><img src="../images/del.gif" hspace="5" /></a>';
}

function mouse_over_out_img(eventType, obj){//变换图片，如<img src='a_0.jpg' onmouseover="mouse_over_out_img('over', this);" onmouseout="mouse_over_out_img('out', this);">，图片必须以_0和_1规则命名
	obj.src=eventType=='over'?obj.src.replace('_0.', '_1.'):obj.src.replace('_1.', '_0.');
}

function show_hidden_menu_list(obj, c_obj){
	var o=$_('menu_list_'+obj);
	if(o.style.display=='none'){
		o.style.display='block';
		c_obj.style.background='url(images/menu_bg_0.jpg)';
	}else{
		o.style.display='none';
		c_obj.style.background='url(images/menu_bg_1.jpg)';
	}
}

function change_ad_type(v){
	$_('ad_pic_qty').style.display=v==0?'block':'none';
}

function change_order_status(v){
	if(v==5 || v==6){
		$_('shipping_info_0') && ($_('shipping_info_0').style.display='');
		$_('shipping_info_1').style.display=$_('shipping_info_2').style.display=$_('shipping_info_3').style.display=$_('shipping_info_4').style.display='';
		$_('tracking_number_input').setAttribute('check', $_('tracking_number_input').getAttribute('check_tmp'));
	}else{
		$_('shipping_info_0') && ($_('shipping_info_0').style.display='none');
		$_('shipping_info_1').style.display=$_('shipping_info_2').style.display=$_('shipping_info_3').style.display=$_('shipping_info_4').style.display='none';
		$_('tracking_number_input').setAttribute('check', '');
	}
}

function mod_order_price(){
	var _TotalPrice=parseFloat($_('TotalPriceInput').value);
	var _Discount=parseFloat($_('DiscountInput').value);
	var _ShippingPrice=parseFloat($_('ShippingPriceInput').value);
	var _PayAdditionalFee=parseFloat($_('PayAdditionalFeeInput').value);
	
	if(isNaN(_TotalPrice) || isNaN(_Discount) || isNaN(_ShippingPrice) || isNaN(_PayAdditionalFee)){
		return false;
	}
	
	_TotalPrice<0 && ($_('TotalPriceInput').value=_TotalPrice=0);
	(_Discount<0 || _Discount>1) && ($_('DiscountInput').value=_Discount=0);
	_ShippingPrice<0 && ($_('ShippingPriceInput').value=_ShippingPrice=0);
	_PayAdditionalFee<0 && ($_('PayAdditionalFeeInput').value=_PayAdditionalFee=0);
	
	
	var fee_price=(_TotalPrice*_Discount+_ShippingPrice)*(_PayAdditionalFee/100);
	$_('order_fee_value').innerHTML='('+Ly200JsLang._ly200._price_symbols+_TotalPrice.toFixed(2)+' * '+_Discount+' + '+Ly200JsLang._ly200._price_symbols+_ShippingPrice.toFixed(2)+') * '+_PayAdditionalFee.toFixed(2)+'% = '+Ly200JsLang._ly200._price_symbols+fee_price.toFixed(2);
	$_('total_price_value').innerHTML=Ly200JsLang._ly200._price_symbols+(_TotalPrice*_Discount+_ShippingPrice+fee_price).toFixed(2);
}

function change_field_type(v){
	for(var i=0; i<$_('FieldType').options.length; i++){
		$_('FieldType').options[i].value==v && ($_('FieldType').selectedIndex=i);
	}
	
	$_('color_size_type').style.display='none';
	$_('field_name').style.display='none';
	$_('text_default_value').style.display='none';
	$_('textarea_default_value').style.display='none';
	$_('ckeditor_default_value').style.display='none';
	$_('select_item').style.display='none';
	$_('default_select').style.display='none';
	$_('checkbox_default_select').style.display='none';
	
	$_(v+'_default_value') && ($_(v+'_default_value').style.display='');
	if(v=='color' || v=='size'){
		$_('color_size_type').style.display='';
	}else if(v!='brand'){
		$_('field_name').style.display='';
	}
	
	if(v=='radio' || v=='checkbox' || v=='select'){
		$_('select_item').style.display='';
		if(v=='radio' || v=='select'){
			$_('default_select').style.display='';
			$_('checkbox_default_select').style.display='none';
		}else{
			$_('default_select').style.display='none';
			$_('checkbox_default_select').style.display='';
		}
	}
}

function change_admin_group(v){
	if(v==1){
		$_('permit_list').style.display='none';
		$_('change_all_button').style.display='none';
	}else{
		$_('permit_list').style.display='';
		$_('change_all_button').style.display='';
	}
}

function change_admin_permit(name, check){
	var obj=document.getElementsByTagName('input');
	for(var i=0; i<obj.length; i++){
		if(obj[i].type.toLowerCase()=='checkbox' && obj[i].name.indexOf('permit')!=-1 && obj[i].disabled==false){
			var n=obj[i].name;
			(n==name+'_add' || n==name+'_mod' || n==name+'_del' || n==name+'_order' || n==name+'_move' || n==name+'_reset') && (obj[i].checked=check==true?true:false);
		}
	}
}

function change_all_admin_permit(){
	var obj=document.getElementsByTagName('input');
	for(var i=0; i<obj.length; i++){
		(obj[i].type.toLowerCase()=='checkbox' && obj[i].name.indexOf('permit')!=-1 && obj[i].disabled==false) && (obj[i].checked=obj[i].checked?false:true);
	}
}

function category_sub_menu(ext_category){
	if(ext_category!=-1){
		ext_list=$_('ext_category_'+ext_category).value.split(',');
		display=$_('category_img_'+ext_category).src.indexOf('jt_0.jpg')!=-1?true:false;
		$_('category_img_'+ext_category).src='/manage/images/jt_'+(display?1:0)+'.jpg';
		for(i=0; i<ext_list.length-1; i++){
			$_('category_'+ext_list[i]).style.display=display?'':'none';
		}
	}else{
		display=$_('category_img').src.indexOf('jt_0.jpg')!=-1?true:false;
		$_('category_img').src='/manage/images/jt_'+(display?1:0)+'.jpg';
		topCateId=parseInt($_('ext_category').value, 10);
		for(i=1; i<topCateId; i++){
			ext_list=$_('ext_category_'+i).value.split(',');
			$_('category_img_'+i).src='/manage/images/jt_'+(display?1:0)+'.jpg';
			for(j=0; j<ext_list.length-1; j++){
				$_('category_'+ext_list[j]).style.display=display?'':'none';
			}
		}
	}
}

function quick_update_data_init(str, group){
	var obj=document.getElementsByTagName('span');
	var data_format=str.split('|');
	var data_type=data_format[1].split(',');
	
	for(var i=0; i<obj.length; i++){
		if(obj[i].getAttribute('rel')==group){
			for(var m=0; m<obj[i].childNodes.length; m++){
				if(obj[i].childNodes[m].nodeType!=1){
					continue;
				}
				var class_name=obj[i].childNodes[m].className;
				var cur_obj=obj[i].childNodes[m];
				
				if(class_name=='id'){
					var id=cur_obj.innerHTML;
					var id_obj=cur_obj;
				}else if(class_name=='value'){
					var value=cur_obj.innerHTML;
					var input_html='<'+data_format[0]+' onblur="quick_update_data_post(this, \''+str+'|'+id+'\');" name="'+data_type[0]+'"';
					if(data_type[1]=='float' || data_type[1]=='int'){
						input_html+=' onkeyup="set_number(this, '+(data_type[1]=='float'?1:0)+');" onpaste="set_number(this, '+(data_type[1]=='float'?1:0)+');"';
					}
					if(data_format[0]=='input'){
						input_html+=' value="'+value+'" class="form_input" size="'+data_format[2]+'" maxlength="'+data_format[3]+'" />';
					}else{
						input_html+=' class="form_area" rows="'+data_format[2]+'" cols="'+data_format[3]+'">'+value+'</'+data_format[0]+'>';
					}
					
					id_obj.innerHTML=input_html;
					cur_obj.innerHTML='<a href="javascript://;" onclick="quick_update_data_show_input(this);">'+value+'</a>';
				}
			}
		}
	}
}

function quick_update_data_show_input(obj){
	var span_obj=obj.parentNode.parentNode.getElementsByTagName('span');
	for(var i=0; i<span_obj.length; i++){
		if(span_obj[i].className=='id'){
			span_obj[i].style.display='inline';
			if(span_obj[i].getElementsByTagName('input').length){
				span_obj[i].getElementsByTagName('input')[0].focus();
				span_obj[i].getElementsByTagName('input')[0].select();
				_value=span_obj[i].getElementsByTagName('input')[0].value;
			}else{
				span_obj[i].getElementsByTagName('textarea')[0].focus();
				span_obj[i].getElementsByTagName('textarea')[0].select();
				_value=span_obj[i].getElementsByTagName('textarea')[0].value;
			}
		}else if(span_obj[i].className=='value'){
			span_obj[i].style.display='none';
		}
	}
}

function quick_update_data_post(obj, str){
	var span_obj=obj.parentNode.parentNode.getElementsByTagName('span');
	for(var i=0; i<span_obj.length; i++){
		if(span_obj[i].className=='id'){
			var id_obj=span_obj[i];
		}else if(span_obj[i].className=='value'){
			var value_obj=span_obj[i];
		}
	}
	
	if(id_obj.getElementsByTagName('input').length){
		var value=id_obj.getElementsByTagName('input')[0].value;
	}else{
		var value=id_obj.getElementsByTagName('textarea')[0].value;
	}
	
	if(value!=_value && value!=''){
		data_posting(true);
		quick_update_obj=new request_data();
		quick_update_post(value, str, id_obj, value_obj);
	}else{
		value_obj.style.display='inline';
		id_obj.style.display='none';
	}
}

function quick_update_post(value, str, id_obj, value_obj){
	quick_update_obj.open('GET', '../system/quick_update.php?value='+value+'&data='+str+'&r='+Math.random(), true);
	quick_update_obj.onreadystatechange=function(){quick_update_result(value, id_obj, value_obj)};
	quick_update_obj.send(null);
}

function quick_update_result(value, id_obj, value_obj){
	if(quick_update_obj.readyState==4){ // 判断对象状态
		if(quick_update_obj.status==200){ // 信息已经成功返回，开始处理信息
			var txt=quick_update_obj.responseText;
			if(txt!=null && txt!=''){
				if(txt=='fail'){
					pop_info_tips(Ly200JsLang._ly200._update_fail);
				}else if(txt=='update_no_permit'){
					pop_info_tips(Ly200JsLang._ly200._update_no_permit);
				}else{
					id_obj.style.display='none';
					if(id_obj.getElementsByTagName('input').length){
						id_obj.getElementsByTagName('input')[0].value=txt;
					}else{
						id_obj.getElementsByTagName('textarea')[0].value=txt;
					}
					value_obj.style.display='inline';
					value_obj.getElementsByTagName('a')[0].innerHTML=txt;
				}
			}
		}
	}
	data_posting(false);
}

function mouse_trBgcolor(){
	var obj=$_('mouse_trBgcolor_table');
	if(obj){
		var not_mouse_trBgcolor_tr_Value='|'+obj.getAttribute('not_mouse_trBgcolor_tr')+'|';
		var tr_obj=obj.getElementsByTagName('tr');
		
		for(var i=0; i<tr_obj.length; i++){
			if(tr_obj[i].id!=''){
				if(not_mouse_trBgcolor_tr_Value.indexOf('|'+tr_obj[i].id+'|')!=-1){
					continue;
				}
			}
			form_id=tr_obj[i].parentNode.parentNode.parentNode.id;
			
			if(form_id!='act_form' && form_id!='list_form' && form_id!='category_list_form' && form_id.substring(0, 11)!='detail_card'){
				continue;
			}
			tr_obj[i].onmouseover=function(){this.className=this.className.replace(' mouseout', '')+' mouseover';};
			tr_obj[i].onmouseout=function(){this.className=this.className.replace(' mouseover', '')+' mouseout';};
		}
	}
}