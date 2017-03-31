var is_reload_page=0;
function scroll_to_div(div_id)
{
	$('html, body').animate({
		scrollTop: $('#'+div_id).offset().top -55 }, 'slow');
	/*$('html,body').animate({
		scrollTop: $("#"+div_id).offset().top}
	,'slow');*/
}
function show_comm_mask()
{
	var winW = $(window).width();
	var winH = $(window).height();
	var loaderLeft = (winW / 2) - (36 / 2);
	var loaderTop = (winH / 2) - (36 / 2);
	$('#lightbox-panel-mask').css('height', winH + "px");
	$('#lightbox-panel-mask').fadeTo('slow', 0.2);
	$('#lightbox-panel-mask').show();
	$('#lightbox-panel-loader').css({ 'left': loaderLeft + "px", 'top': loaderTop });
	//$("#lightbox-panel-loader").html(""); 
	$('#lightbox-panel-loader').show();
}
function onlyAlphabets(e, t)
{
	try 
	{
    	if (window.event)
		{
			var charCode = window.event.keyCode;
		}
		else if (e) {
			var charCode = e.which;
		}
		else { return true; }
		if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32 || charCode == 46)
			return true;
		else
			return false;
	}
	catch (err)
	{
	}
}
function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode;
 if(charCode == 43)
 {
	 return true;
 }
 else if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

 return true;
}
function hide_comm_mask()
{
	$('#lightbox-panel-mask').hide();
	$('#lightbox-panel-loader').hide();
}
function Trim(str)
{
	return str.replace(/\s/g,"");
}
var temp_div_content = new Array();

function settimeout_div(div_id,timout)
{
	timout = typeof timout !== 'undefined' ? timout : 10000;
	setTimeout(function(){ $("#"+div_id).slideUp(); }, timout);
}
function remove_element(element,timout)
{
	timout = typeof timout !== 'undefined' ? timout : 10000;
	setTimeout(function(){ $(element).remove(); }, timout);
}
function check_all()
{
	$(".checkbox_val").prop("checked",$("#all").prop("checked"))
}
function check_uncheck_all()
{
	var total_checked = $('input[name="checkbox_val[]"]:checked').length;
	var total = $('input[name="checkbox_val[]"]').length;
	if(total ==total_checked)
	{
		$("#all").prop("checked",true);
	}
	else
	{
		$("#all").prop("checked",false);	
	}
}

function search_change_limit()
{
	get_ajax_search(1);
	return false;
}
function change_order(coloumn_name,order)
{
	//alert(coloumn_name);
	$("#default_order").val(order);
	$("#default_sort").val(coloumn_name);
	get_ajax_search(1);
}
function change_sort_order(order_col)
{
	if(order_col !='')
	{
		var order_arr = order_col.split('-');
		if(order_arr[0] !='' && order_arr[1] !='')
		{
			change_order(order_arr[0],order_arr[1]);
		}
	}
}
function get_ajax_search(page_number)
{
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	
	show_comm_mask();
	$.ajax({
	   url: page_url,
	   type: "post",
	   data: {'csrf_emd':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode},
	   success:function(data){
			$("#page-content").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("page-content");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			/*$("#hash_tocken_id").val($("#hash_tocken_id_temp").val());*/
			is_reload_page = 0;
	   }
	});
	return false;
}

function update_status(status_update)
{
	if(status_update =='')
	{
		alert('Somthing wrong, Please refress page and try again.')
		return false;
	}
	var total_checked = $('input[name="checkbox_val[]"]:checked').length;
	if(total_checked == 0 || total_checked =='')
	{
		alert("Please select atleast one record to proccess");
		return false;
	}
	if(status_update =='DELETE')
	{
		if(!confirm("Are you sure to delete the record?"))
		{
			return false;
		}
	}
	var selected_val = Array();
	var i=0;
	$('input[name="checkbox_val[]"]:checked').each(function() 
	{
		selected_val[i] = this.value;
		i++;
	});

	var page_number = 1;
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	
	show_comm_mask();
	$.ajax({
	   url: page_url,
	   type: "post",
	   data: {'csrf_emd':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode,'selected_val':selected_val,'status_update':status_update},
	   success:function(data){
			$("#page-content").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("page-content");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			/*$("#hash_tocken_id").val($("#hash_tocken_id_temp").val());*/
	   }
	});
	return false;
}
function update_tocken(tocken)
{
	$(".hash_tocken_id").each(function()
	{
	   $(this).val(tocken);
	})
}
function load_pagination_code()
{	
   $("#ajax_pagin_ul li a").click(function()
   {
		var page_number = $(this).attr("data-ci-pagination-page");
		page_number = typeof page_number !== 'undefined' ? page_number : 0;
		if(page_number == 0)
		{
			return false;
		}
		if(page_number != undefined && page_number !='' && page_number != 0)
		{
			get_ajax_search(page_number);
		}
		return false;
   });
   load_checkbo();
}
function load_checkbo()
{
	$('html').checkBo({checkAllButton:"#all_check",checkAllTarget:".checkbox-row",checkAllTextDefault:"Check All",checkAllTextToggle:"Un-check All"});
}
function tog(v)
{
	return v?'addClass':'removeClass';
}
function back_list()
{
	window.history.back();
}
function edit_data_popup(id)
{
	$("#model_title").html('Edit Data');
	$("#mode").val('edit');
	$("#reponse_message").slideUp();
	$.each($('#id_'+id).data(), function(i, v) 
	{
		if($("#"+String(i)).length > 0)
		{
			//alert(v);
			$("#"+String(i)).val(v);
		/*	
			var temp_chnage = $('#'+String(i)).attr('onchange');
			if(temp_chnage !='' && temp_chnage != undefined)
			{
				$( "#"+String(i) ).trigger( "change" );
			}
		*/	
		}		
		if(i =='status')
		{
			$("input[name='"+String(i)+"'][value='"+String(v)+"']").prop('checked', true);
		}
		//alert('"' + i + '":"' + v + '",');
	});
	
	return false;
}
function add_data_popup()
{
	$("#mode").val('add');
	$("#id").val('');
	$("#model_title").html('Add Data');
	$("#reponse_message").slideUp();
	// $("#common_insert_update").reset();
	//$("#common_insert_update").find('input:radio').removeAttr('checked');
	document.getElementById('common_insert_update').reset();
	$("#APPROVED").attr("checked","checked");
}
function common_submit_fomr()
{
	var form_data = $('#common_insert_update').serialize();
	//alert(form_data);
	var action = $('#common_insert_update').attr('action');
	if(action !='' && form_data !='')
	{
		form_data = form_data+ "&is_ajax=1";
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: form_data,
		   success:function(data)
		   {
			   	$("#reponse_message").html(data.response);
				$("#reponse_message").slideDown();
				update_tocken(data.tocken);
				hide_comm_mask();
				settimeout_div("reponse_message");
				if(data.status == 'success')
				{
					is_reload_page = 1;
				}
				if($("#mode").val() =='add' && data.status == 'success')
				{
					form_reset();
				}
		   }
		});
	}
	else
	{
		alert("Some issue arise please refress page.");
	}
	return false;
}
function form_reset()
{
	var elemet_not_resest = new Array();
	var i = 0;
	$('.not_reset').each(function() 
	{
		elemet_not_resest[i] = this.value;
		i++;
	});
	document.getElementById('common_insert_update').reset();
	i = 0;
	$('.not_reset').each(function()
	{
		this.value = elemet_not_resest[i];
		i++;
	});
}
function close_popup()
{
	if(is_reload_page == 1)
	{
		get_ajax_search(1);
	}
}

function dropdownChange_mul(currnet_id,disp_on,get_list)
{
	var base_url = $("#base_url").val();
	action = base_url+ 'common_request/get_list';
	var hash_tocken_id = $("#hash_tocken_id").val();
	currnet_val = $("#"+currnet_id).val();
	if(currnet_val !='' && currnet_val !=null)
	{
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: {'csrf_emd':hash_tocken_id,'get_list':get_list,'currnet_val':currnet_val,'multivar':'multi','tocken_val':1},
		   success:function(data)
		   {
				$("#"+disp_on).html(data.dataStr);
				update_tocken(data.tocken);
				$('#'+disp_on).trigger('chosen:updated');
				hide_comm_mask();
				if(get_list =='state_list')
				{
					if($(".city_list_update").length > 0)
					{
						$(".city_list_update").html('<option value="">Select City</option>');
						$('.city_list_update').trigger('chosen:updated');
					}
				}
		   }
		});
	}
	else
	{
		$("#"+disp_on).html('<option value="">Select Value</option>');
		$('#'+disp_on).trigger('chosen:updated');
		if($(".city_list_update").length > 0)
		{
			$(".city_list_update").html('<option value="">Select City</option>');
			$('.city_list_update').trigger('chosen:updated');
		}
	}
}

function dropdownChange(currnet_id,disp_on,get_list)
{
	var base_url = $("#base_url").val();
	action = base_url+ 'common_request/get_list';
	var hash_tocken_id = $("#hash_tocken_id").val();
	currnet_val = $("#"+currnet_id).val();
	if(currnet_val !='' && currnet_val != null )
	{
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: {'csrf_emd':hash_tocken_id,'get_list':get_list,'currnet_val':currnet_val},
		   success:function(data)
		   {
				$("#"+disp_on).html(data.dataStr);
				update_tocken(data.tocken);
				hide_comm_mask();
		   }
		});
	}
	else
	{
		$("#"+disp_on).html('<option value="">Select Value</option>');
	}
}
function chnageadvType()
{
	var adv_type = $('.adv_type:checked').val();
	if(adv_type =='Image')
	{
		$(".image_adv").slideDown();
		$(".google_adv").slideUp();
	}
	else
	{
		$(".google_adv").slideDown();
		$(".image_adv").slideUp();
	}
}

function job_seek_address_val()
{
	if($("#form_address_detail").length > 0)
	{
		$("#form_address_detail").validate({
			submitHandler: function(form) 
			{
				edit_profile('address_detail','save');
				return false;
				//return true;
			}
		});
	}
}
function model_search()
{
	var form_data = $('#form_model_search').serialize();
	var action = $('#form_model_search').attr('action')
	var hash_tocken_id = $("#hash_tocken_id").val();
	form_data = form_data+ "&csrf_emd="+hash_tocken_id;	
	show_comm_mask();
	$.ajax({
	   url: action,
	   type: "post",
	   dataType:"json",
	   data: form_data,
	   success:function(data)
	   {
		    $('#myModal_filter').modal('hide');
			update_tocken(data.tocken);
			get_ajax_search(1);
	   }
	});
	return false;
}
function clear_model_filter()
{
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/clear_filter';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
	   url: action,
	   type: "post",
	   dataType:"json",
	   data: {"csrf_emd":hash_tocken_id},
	   success:function(data)
	   {
		   document.getElementById('form_model_search').reset();
		   $(".chosen-select").val('').trigger("chosen:updated");
		   $(".chosen_select_remove").html('');
		   $(".chosen_select_remove").trigger('chosen:updated');
			update_tocken(data.tocken);
			get_ajax_search(1);
	   }
	});
	return false;
}
/* for payment pop up*/
function display_payment(user_id,user_type)
{
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/plan_list';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$('#model_title_common').html('Plan Assignment');
	$('#model_body_common').html('please wait...');
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_emd":hash_tocken_id,'user_id':user_id,'user_type':user_type},
	   success:function(data)
	   {
		    $('#model_body_common').html(data);
		    update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('Plan Assignment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
	   }
	});
	return false;
}

function close_payment_pop()
{
	$('#model_title_common').html('');
	$('#model_body_common').html('');
	$('#myModal_common').modal('hide');
}
/* for payment pop up*/

/* for magnifi glass zoom*/
function OnhoverMove()
{
	var native_width = 0;
	var native_height = 0;
  	var mouse = {x: 0, y: 0};
  	var magnify;
  	var cur_img;
  	var ui = {
    	magniflier: $('.magniflier')
  	};
	if (ui.magniflier.length)
	{
    	var div = document.createElement('div');
	    div.setAttribute('class', 'glass');
    	ui.glass = $(div);
	    $('body').append(div);
  	}
	var mouseMove = function(e)
	{
    	var $el = $(this);
	    var magnify_offset = cur_img.offset();
	    mouse.x = e.pageX - magnify_offset.left;
    	mouse.y = e.pageY - magnify_offset.top;
	    if(
		     mouse.x < cur_img.width() &&
		     mouse.y < cur_img.height() &&
	      	 mouse.x > 0 &&
      		 mouse.y > 0
	    ){
      		magnify(e);
    	}
    	else {
      		ui.glass.fadeOut(100);
    	}
    	return;
  	};
  	var magnify = function(e){
    var rx = Math.round(mouse.x/cur_img.width()*native_width - ui.glass.width()/2)*-1;
    var ry = Math.round(mouse.y/cur_img.height()*native_height - ui.glass.height()/2)*-1;
    var bg_pos = rx + "px " + ry + "px";
    var glass_left = e.pageX - ui.glass.width() / 2;
    var glass_top  = e.pageY - ui.glass.height() / 2;
    ui.glass.css({
      left: glass_left,
      top: glass_top,
      backgroundPosition: bg_pos
    });
    return;
  };
  $('.magniflier').on('mousemove', function()
  {
    ui.glass.fadeIn(100);
    cur_img = $(this);
    var large_img_loaded = cur_img.data('large-img-loaded');
    var src = cur_img.data('large') || cur_img.attr('src');
    if (src) {
      ui.glass.css({
        'background-image': 'url(' + src + ')',
        'background-repeat': 'no-repeat'
      });
    }
    if (!cur_img.data('native_width')){
        var image_object = new Image();
        image_object.onload = function() {
        native_width = image_object.width;
        native_height = image_object.height;
        cur_img.data('native_width', native_width);
        cur_img.data('native_height', native_height);
        mouseMove.apply(this, arguments);
        ui.glass.on('mousemove', mouseMove);
     };
     image_object.src = src;
        return;
     }
	 else 
	 {
        native_width = cur_img.data('native_width');
        native_height = cur_img.data('native_height');
     }
	mouseMove.apply(this, arguments);
    ui.glass.on('mousemove', mouseMove);
  });
  ui.glass.on('mouseout', function() {
    ui.glass.off('mousemove', mouseMove);
  });
}
/* for magnifi glass zoom*/

function get_suggestion_list(list_id,label)
{
	var base_url = $("#base_url").val();
	var action = base_url+ 'common_request/get_list_customer';
	var hash_tocken_id = $("#hash_tocken_id").val();
	$('#'+list_id).select2({
	 placeholder: label,
	  ajax: {
		url: action,
		type: "POST",
		dataType:'json',
		data: function (params) {
		  return {
			q: params.term, // search term
			page: params.page,
			csrf_emd: hash_tocken_id,
			list_id:list_id
		  };
		},
	  }
	});
}
<!-- lazy load-->
/*! lazysizes - v2.0.7 */
!function(a,b){var c=b(a,a.document);a.lazySizes=c,"object"==typeof module&&module.exports&&(module.exports=c)}(window,function(a,b){"use strict";if(b.getElementsByClassName){var c,d=b.documentElement,e=a.Date,f=a.HTMLPictureElement,g="addEventListener",h="getAttribute",i=a[g],j=a.setTimeout,k=a.requestAnimationFrame||j,l=a.requestIdleCallback,m=/^picture$/i,n=["load","error","lazyincluded","_lazyloaded"],o={},p=Array.prototype.forEach,q=function(a,b){return o[b]||(o[b]=new RegExp("(\\s|^)"+b+"(\\s|$)")),o[b].test(a[h]("class")||"")&&o[b]},r=function(a,b){q(a,b)||a.setAttribute("class",(a[h]("class")||"").trim()+" "+b)},s=function(a,b){var c;(c=q(a,b))&&a.setAttribute("class",(a[h]("class")||"").replace(c," "))},t=function(a,b,c){var d=c?g:"removeEventListener";c&&t(a,b),n.forEach(function(c){a[d](c,b)})},u=function(a,c,d,e,f){var g=b.createEvent("CustomEvent");return g.initCustomEvent(c,!e,!f,d||{}),a.dispatchEvent(g),g},v=function(b,d){var e;!f&&(e=a.picturefill||c.pf)?e({reevaluate:!0,elements:[b]}):d&&d.src&&(b.src=d.src)},w=function(a,b){return(getComputedStyle(a,null)||{})[b]},x=function(a,b,d){for(d=d||a.offsetWidth;d<c.minSize&&b&&!a._lazysizesWidth;)d=b.offsetWidth,b=b.parentNode;return d},y=function(){var a,c,d=[],e=function(){var b;for(a=!0,c=!1;d.length;)b=d.shift(),b[0].apply(b[1],b[2]);a=!1},f=function(f){a?f.apply(this,arguments):(d.push([f,this,arguments]),c||(c=!0,(b.hidden?j:k)(e)))};return f._lsFlush=e,f}(),z=function(a,b){return b?function(){y(a)}:function(){var b=this,c=arguments;y(function(){a.apply(b,c)})}},A=function(a){var b,c=0,d=125,f=666,g=f,h=function(){b=!1,c=e.now(),a()},i=l?function(){l(h,{timeout:g}),g!==f&&(g=f)}:z(function(){j(h)},!0);return function(a){var f;(a=a===!0)&&(g=44),b||(b=!0,f=d-(e.now()-c),0>f&&(f=0),a||9>f&&l?i():j(i,f))}},B=function(a){var b,c,d=99,f=function(){b=null,a()},g=function(){var a=e.now()-c;d>a?j(g,d-a):(l||f)(f)};return function(){c=e.now(),b||(b=j(g,d))}},C=function(){var f,k,l,n,o,x,C,E,F,G,H,I,J,K,L,M=/^img$/i,N=/^iframe$/i,O="onscroll"in a&&!/glebot/.test(navigator.userAgent),P=0,Q=0,R=0,S=-1,T=function(a){R--,a&&a.target&&t(a.target,T),(!a||0>R||!a.target)&&(R=0)},U=function(a,c){var e,f=a,g="hidden"==w(b.body,"visibility")||"hidden"!=w(a,"visibility");for(F-=c,I+=c,G-=c,H+=c;g&&(f=f.offsetParent)&&f!=b.body&&f!=d;)g=(w(f,"opacity")||1)>0,g&&"visible"!=w(f,"overflow")&&(e=f.getBoundingClientRect(),g=H>e.left&&G<e.right&&I>e.top-1&&F<e.bottom+1);return g},V=function(){var a,e,g,i,j,m,n,p,q;if((o=c.loadMode)&&8>R&&(a=f.length)){e=0,S++,null==K&&("expand"in c||(c.expand=d.clientHeight>500&&d.clientWidth>500?500:370),J=c.expand,K=J*c.expFactor),K>Q&&1>R&&S>2&&o>2&&!b.hidden?(Q=K,S=0):Q=o>1&&S>1&&6>R?J:P;for(;a>e;e++)if(f[e]&&!f[e]._lazyRace)if(O)if((p=f[e][h]("data-expand"))&&(m=1*p)||(m=Q),q!==m&&(C=innerWidth+m*L,E=innerHeight+m,n=-1*m,q=m),g=f[e].getBoundingClientRect(),(I=g.bottom)>=n&&(F=g.top)<=E&&(H=g.right)>=n*L&&(G=g.left)<=C&&(I||H||G||F)&&(l&&3>R&&!p&&(3>o||4>S)||U(f[e],m))){if(ba(f[e]),j=!0,R>9)break}else!j&&l&&!i&&4>R&&4>S&&o>2&&(k[0]||c.preloadAfterLoad)&&(k[0]||!p&&(I||H||G||F||"auto"!=f[e][h](c.sizesAttr)))&&(i=k[0]||f[e]);else ba(f[e]);i&&!j&&ba(i)}},W=A(V),X=function(a){r(a.target,c.loadedClass),s(a.target,c.loadingClass),t(a.target,Z)},Y=z(X),Z=function(a){Y({target:a.target})},$=function(a,b){try{a.contentWindow.location.replace(b)}catch(c){a.src=b}},_=function(a){var b,d,e=a[h](c.srcsetAttr);(b=c.customMedia[a[h]("data-media")||a[h]("media")])&&a.setAttribute("media",b),e&&a.setAttribute("srcset",e),b&&(d=a.parentNode,d.insertBefore(a.cloneNode(),a),d.removeChild(a))},aa=z(function(a,b,d,e,f){var g,i,k,l,o,q;(o=u(a,"lazybeforeunveil",b)).defaultPrevented||(e&&(d?r(a,c.autosizesClass):a.setAttribute("sizes",e)),i=a[h](c.srcsetAttr),g=a[h](c.srcAttr),f&&(k=a.parentNode,l=k&&m.test(k.nodeName||"")),q=b.firesLoad||"src"in a&&(i||g||l),o={target:a},q&&(t(a,T,!0),clearTimeout(n),n=j(T,2500),r(a,c.loadingClass),t(a,Z,!0)),l&&p.call(k.getElementsByTagName("source"),_),i?a.setAttribute("srcset",i):g&&!l&&(N.test(a.nodeName)?$(a,g):a.src=g),(i||l)&&v(a,{src:g})),y(function(){a._lazyRace&&delete a._lazyRace,s(a,c.lazyClass),(!q||a.complete)&&(q?T(o):R--,X(o))})}),ba=function(a){var b,d=M.test(a.nodeName),e=d&&(a[h](c.sizesAttr)||a[h]("sizes")),f="auto"==e;(!f&&l||!d||!a.src&&!a.srcset||a.complete||q(a,c.errorClass))&&(b=u(a,"lazyunveilread").detail,f&&D.updateElem(a,!0,a.offsetWidth),a._lazyRace=!0,R++,aa(a,b,f,e,d))},ca=function(){if(!l){if(e.now()-x<999)return void j(ca,999);var a=B(function(){c.loadMode=3,W()});l=!0,c.loadMode=3,W(),i("scroll",function(){3==c.loadMode&&(c.loadMode=2),a()},!0)}};return{_:function(){x=e.now(),f=b.getElementsByClassName(c.lazyClass),k=b.getElementsByClassName(c.lazyClass+" "+c.preloadClass),L=c.hFac,i("scroll",W,!0),i("resize",W,!0),a.MutationObserver?new MutationObserver(W).observe(d,{childList:!0,subtree:!0,attributes:!0}):(d[g]("DOMNodeInserted",W,!0),d[g]("DOMAttrModified",W,!0),setInterval(W,999)),i("hashchange",W,!0),["focus","mouseover","click","load","transitionend","animationend","webkitAnimationEnd"].forEach(function(a){b[g](a,W,!0)}),/d$|^c/.test(b.readyState)?ca():(i("load",ca),b[g]("DOMContentLoaded",W),j(ca,2e4)),f.length?V():W()},checkElems:W,unveil:ba}}(),D=function(){var a,d=z(function(a,b,c,d){var e,f,g;if(a._lazysizesWidth=d,d+="px",a.setAttribute("sizes",d),m.test(b.nodeName||""))for(e=b.getElementsByTagName("source"),f=0,g=e.length;g>f;f++)e[f].setAttribute("sizes",d);c.detail.dataAttr||v(a,c.detail)}),e=function(a,b,c){var e,f=a.parentNode;f&&(c=x(a,f,c),e=u(a,"lazybeforesizes",{width:c,dataAttr:!!b}),e.defaultPrevented||(c=e.detail.width,c&&c!==a._lazysizesWidth&&d(a,f,e,c)))},f=function(){var b,c=a.length;if(c)for(b=0;c>b;b++)e(a[b])},g=B(f);return{_:function(){a=b.getElementsByClassName(c.autosizesClass),i("resize",g)},checkElems:g,updateElem:e}}(),E=function(){E.i||(E.i=!0,D._(),C._())};return function(){var b,d={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:!0,expFactor:1.5,hFac:.8,loadMode:2};c=a.lazySizesConfig||a.lazysizesConfig||{};for(b in d)b in c||(c[b]=d[b]);a.lazySizesConfig=c,j(function(){c.init&&E()})}(),{cfg:c,autoSizer:D,loader:C,init:E,uP:v,aC:r,rC:s,hC:q,fire:u,gW:x,rAF:y}}});	
<!--  lazy load-->


var temp_value_duplicate ='';
function check_duplicate(id_field,check_on)
{
	var id = $("#id").val();
	var mode = $("#mode").val();
	var field_value = $("#"+id_field).val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var base_url = $("#base_url").val();
	var page_url = base_url+ 'common_request/check_duplicate';
	if(id_field !='' && check_on !=''&& field_value !='' && mode !='' && temp_value_duplicate != field_value)
	{
		$.ajax({
		   url: page_url,
		   type: "post",
		   dataType:"json",
		   data: {'csrf_new_matrimonial':hash_tocken_id,'id':id,'mode':mode,'field_value':field_value,'field_name':id_field,'check_on':check_on},
		   success:function(data)
		   {
				if(data.status == 'success')
				{
					if($("#" + id_field+'-error').length == 0) 
					{
						$( "#"+ id_field ).after( '<label id="'+id_field+'-error" class="error" for="'+id_field+'"></label>' );
					}
					
					$("#"+id_field+'-error').text('Duplicate value found, please enter another one');
					$("#"+id_field+'-error').show();
					$("#"+id_field).addClass('error');
				}
				else
				{
					if($("#" + id_field+'-error').length > 0) 
					{
						$("#"+id_field+'-error').hide();
					}
					$("#"+id_field).removeClass('error');
				}
				update_tocken(data.tocken);
		   }
		});
	}
	return false;
}

function select2(list_id,label)
{
	$(list_id).select2({
	 placeholder: label
	 });
}
function get_suggestion_list(list_id,label)
{
	var base_url = $("#base_url").val();
	var action = base_url+ 'common_request/get_list_select2';
	var hash_tocken_id = $("#hash_tocken_id").val();
	$('#'+list_id).select2({
	 placeholder: label,
	  ajax: {
		url: action,
		type: "POST",
		dataType:'json',
		data: function (params) {
		  return {
			q: params.term, // search term
			page: params.page,
			csrf_new_matrimonial: hash_tocken_id,
			list_id:list_id
		  };
		},
	  }
	});
}