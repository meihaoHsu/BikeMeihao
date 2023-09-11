jQuery(function($){
 /* SEARCH BAR FUNCTIONS */
 $(document).on('keypress',function(e) {
    if(e.which == 13) {
        search_submit(e.target);
    }
});
 $("#caf-search-sub").click(function(){
  search_submit($(this));
 });
 $(".manage-caf-search-icon i").click(function(){
 if($(this).hasClass('fa-search')) {
  var cont=$(this).closest("#caf-post-layout-container");
  $(cont).find(".caf-filter-layout.srch-on.search-layout2 .caf-manage-search-bar").addClass('active');
  $(this).removeClass("fa-search").addClass("fa-times");
}
  else {
   var cont=$(this).closest("#caf-post-layout-container");
  $(cont).find(".caf-filter-layout.srch-on.search-layout2 .caf-manage-search-bar").removeClass('active');
   $(this).removeClass("fa-times").addClass("fa-search");
  }
 });
 
  /* TABS SCROLLER FUNCTIONS */
 $(".caf-scroll-right i").click(function(){ 
  var total=parseInt($(this).attr('data-count'))+1;
  var post_per_page='5';
  var len=$(".caf-tab-layout ul li.caf-tab-hide").length;
  var current_page=parseInt(len/5);
  var next_page=current_page+1;
  var show=next_page*post_per_page;
  // console.log(len,current_page,show);
  var ext=total-len;
  if(len<total && ext>=post_per_page) {
  $(".caf-tab-layout ul").each(function(i){
   var div=$(this).find("li:not('.caf-tab-hide'):lt(5)");
   $(div).addClass('caf-tab-hide');
  });
  } 
 });
 
 $(".caf-scroll-left i").click(function(){ 
  $(".caf-tab-layout ul").each(function(i){
   var div=$(this).find("li.caf-tab-hide:gt(-5)");
   $(div).removeClass('caf-tab-hide');
  });
 });
 
 /* POPUP FUNCTIONS */
 
 
function search_submit(div) {
  //console.log(div,$(div).attr('class'));
  var cl_pagination=$(div).attr('class');
  if(cl_pagination=='prev-next-input') {
    pagination_submit(div);
    return false;
  }
  var cont=$(div).closest("#caf-post-layout-container");
  var sr_val=$(cont).find("#caf-search-input").val();
  //console.log(sr_val);
  if(sr_val!='') {
   var divc=$(cont).attr("data-target-div");
  //console.log(divc,sr_val);
   var params=get_params(1,divc);	
   params.search_string=sr_val;
  // console.log(params);
   get_posts(params);
  }
 }
 
function get_params($page,div){
	var div="."+div;
  
	var params    = {
		'page' :$page,
		'tax'  : $(div).attr('data-tax'),
	  'post-type':$(div).attr('data-post-type'),
		'term' : $(div).attr('data-terms'),
		'per-page'  : $(div).attr('data-per-page'),
	  'filter-id'  : $(div).attr('data-filter-id'),
	 'caf-post-layout' : $(div).attr('data-post-layout'),
		'data-target-div':div,
  'data-filter-layout':$(div).attr('data-filter-layout'),
  'data-relation':$(div).attr('data-relation'),
  'data-default-term':$(div).attr('data-default-term'),
  'current-post-id':$(div).attr('current-post-id')
	};
  if($("#caf-search-input").val()!='') {
    params.search_string=$("#caf-search-input").val();
  }
  // if(params['data-default-term']!='all') {
  //   params['term']=params['data-default-term'];
    
  // }
  //console.log(params);
	return params;
 
}
 
$(".caf-post-layout-container").each(function(i){
var div=$(this).attr('data-target-div');
var params=get_params(1,div);	
 //console.log(params);
 //console.log(params["data-filter-layout"]);
 params['first']='first';
get_posts(params);

 
});
 
$("ul.dropdown li a").click(function(){
var cat= $(this).text();
 $(this).closest("ul.dropdown").find("span.result").html(cat);
//$("ul.dropdown span.result").html(cat);	
});	


function pagination_submit(e) {
var page=parseInt(e.value);
  var div=$(e).closest('.caf-post-layout-container').attr('data-target-div');
  var perform="pagination";
  /* SCROLLING FUNCTION START */
 cafScrollToDiv(div);
 /** SCROLLING END **/
//console.log(page,div);
var params=get_params(page,div);

 if(params["data-filter-layout"]!="alphabetical-layout") {
 params["caf-perform"]=perform;
 }

  var div_new="#caf-post-layout-container."+div;

 if($(div_new).attr("data-filter-layout")=="multiple-taxonomy-filter2") {
  	params["data-filter-layout"]="multiple-taxonomy-filter2";
 }

 if(params["data-filter-layout"]=='multiple-checkbox') {
 if($("#caf-multiple-check-filter li .check_box:checked").length>0) {
	params["data-filter-layout"]="multiple-checkbox2";
	}
	else {
		params["data-filter-layout"]="multiple-checkbox";
	}
 }
//console.log(params);
get_posts(params);
//}
}

$('.caf-post-layout-container').on('click', '.caf-pagi-btn,.caf-filter-container li a,.caf-pagination a,.caf-alpha-layout li', function clickaction(e) {
 //console.log(e.currentTarget);
var div=e.currentTarget.getAttribute("data-target-div");
var current_id=e.currentTarget.getAttribute("data-main-id");
 
if(current_id=="flt") {
$("."+div+" .caf-filter-layout ul li a").each(function(){
$(this).removeClass('active');	
});
 if($("."+div).attr("data-filter-layout")=="alphabetical-layout") {
  $("."+div+" .caf-filter-layout ul li").each(function(){
$(this).removeClass('active');	
});
 }
var id=$(this).attr('data-id');
$(this).addClass('active');
$("."+div).attr("data-terms",id);
$page='1';
 if (id.indexOf(',') > -1) {
var perform="filter-all";
  }
 else {
var perform="filter";
 }
}
else 
{
var div=e.delegateTarget.getAttribute("data-target-div");
$page = parseInt($(this).attr('href').replace(/\D/g,''));
 //caf_performance("pagination");
	//params["data-filter-layout"]="multiple-taxonomy-filter2"; 
var perform="pagination";
}
 /* SCROLLING FUNCTION START */
 cafScrollToDiv(div);
 /** SCROLLING END **/
var params=get_params($page,div);
 //console.log(params);
 if(params["data-filter-layout"]!="alphabetical-layout") {
 params["caf-perform"]=perform;
 }
  var div_new="#caf-post-layout-container."+div;
 //console.log($(div_new).attr("data-filter-layout"));
 if($(div_new).attr("data-filter-layout")=="multiple-taxonomy-filter2") {
 // console.log("okkk");
  	params["data-filter-layout"]="multiple-taxonomy-filter2";
 }
 if(params["data-filter-layout"]=='multiple-checkbox') {
 if($("#caf-multiple-check-filter li .check_box:checked").length>0) {
	params["data-filter-layout"]="multiple-checkbox2";
	}
	else {
		params["data-filter-layout"]="multiple-checkbox";
	}
 }
get_posts(params);
e.preventDefault();	
 
});

 /* START FUNCTION FOR MULTIPLE CHECKBOX FILTER */
$('.caf-post-layout-container').on('click', '#caf-multiple-check-filter li .check_box', function (e) {
 //console.log(e.currentTarget);
var div=e.currentTarget.getAttribute("data-target-div");
 var div_new="#caf-post-layout-container."+div;
var current_id=e.currentTarget.id;
  var cr_tr=$("#"+current_id).val();
 //console.log(div,current_id);
 var v=[];
 i=0;
 
$("#caf-multiple-check-filter li .check_box:checked").each(function(){
  v[i++]=$(this).val();
})
 
 var t=v.toString();
 if(t=='') {
  var sel_terms=$("."+div).attr("data-selected-terms");
  $("."+div).attr("data-terms",sel_terms);
 }
 else {
$("."+div).attr("data-terms",t);
 }
  
$page='1';	
var params=get_params($page,div);
 params["caf-perform"]='filter';
  params["caf-perform-term"]=cr_tr;
 //params["caf-perform"]='filter';
 jQuery(div_new).attr("data-filter-layout","");
if($("#caf-multiple-check-filter li .check_box:checked").length>0) {
	params["data-filter-layout"]="multiple-checkbox2";
	}
	else {
		params["data-filter-layout"]="multiple-checkbox";
	}
 cafScrollToDiv(div);
 //console.log(params);
get_posts(params);
//e.preventDefault();	
 
});
/* END FUNCTION FOR MULTIPLE CHECKBOX FILTER */
 
 /* START FUNCTION FOR MULTIPLE TAXONOMY FILTER */
 $('.caf-post-layout-container').on('click', '#caf-multiple-taxonomy-filter li .check_box', function (e) {
 //console.log(e.currentTarget);
  if(!$(this).closest("li").hasClass('act')) {
 $(this).closest("li").addClass('act');
}
  else {
   $(this).closest("li").removeClass('act');
  }
var div=e.currentTarget.getAttribute("data-target-div");
 var div_new="#caf-post-layout-container."+div;
	
var current_id=e.currentTarget.id;
  var cr_tr=$("#"+current_id).val();
 //console.log(div,$("#"+current_id).val());
 var v=[];
 i=0;
$("#caf-multiple-taxonomy-filter li .check_box:checked").each(function(){    
  v[i++]=$(this).val();
})
 
 var t=v.toString();
 if(t=='') {
  var sel_terms=$("."+div).attr("data-selected-terms");
  $("."+div).attr("data-terms",sel_terms);
 }
 else {
$("."+div).attr("data-terms",t);
 }
  
$page='1';	
var params=get_params($page,div);
  params["caf-perform"]='filter';
  params["caf-perform-term"]=cr_tr;
  

  if(v.filter(function(e) { return e !== '0' }).length==1) {
    //console.log("in");
    params["data-filter-layout"]="multiple-taxonomy-filter";
    jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter");
  }

if($("#caf-multiple-taxonomy-filter li .check_box:checked").length>1) {
	params["data-filter-layout"]="multiple-taxonomy-filter2";
  jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter2");
	}
	else {
		params["data-filter-layout"]="multiple-taxonomy-filter";
    jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter");
	}
  cafScrollToDiv(div);
// console.log(params);
get_posts(params);
//e.preventDefault();	
 
});
 /* END FUNCTION FOR MULTIPLE TAXONOMY FILTER */
 
 /* START FUNCTION FOR MULTIPLE TAXONOMY HORIZONTAL FILTER */
 $('.caf-post-layout-container').on('click', '.caf_select_multi_btn', function (e) {
 //console.log(e.currentTarget);
var div=e.currentTarget.getAttribute("data-target-div");
 var div_new="#caf-post-layout-container."+div;
var current_id=e.currentTarget.id;
 //console.log(div,current_id);
 var v=[];
 i=0;
$(".caf_select_multi").each(function(){    
  v[i++]=$(this).val();
})
 const allEqual = v => v.every( val => val === v[0] );
 var t=v.toString();
 if(t=='' || allEqual(v)) {
  var sel_terms=$("."+div).attr("data-selected-terms");
  $("."+div).attr("data-terms",sel_terms);
 }
 else {
$("."+div).attr("data-terms",t);
 }
  
$page='1';	
var params=get_params($page,div);
  //params["caf-perform"]='filter';
  if(v.filter(function(e) { return e !== '0' }).length==1) {
    //console.log("in");
    params["data-filter-layout"]="multiple-taxonomy-filter";
    jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter");
  }


if($(".caf_select_multi").length>1 && allEqual(v)==false) {
	params["data-filter-layout"]="multiple-taxonomy-filter2";
  jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter2");  
	}
	else {
		params["data-filter-layout"]="multiple-taxonomy-filter";
    jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter");  
	}
  
 /* SCROLLING FUNCTION START */
  cafScrollToDiv(div);
 /** SCROLLING END **/ 
 //console.log(params);
get_posts(params);
//e.preventDefault();	
 
});
 /* END FUNCTION FOR MULTIPLE TAXONOMY HORIZONTAL FILTER */
 
 /* START FUNCTION FOR MULTIPLE TAXONOMY HORIZONTAL MODERN FILTER */
 $("ul.caf-multi-drop-sub li").click(function(){
  var data_name=$(this).attr("data-name");
  var data_value=$(this).attr("data-value");
  
  var div=$(this).closest(".caf-post-layout-container").attr("data-target-div");
  var div_new="#caf-post-layout-container."+div;
  $(this).closest("ul.caf-multi-drop-sub").find("li").each(function(){
   $(this).removeClass('active');
  });
  $(this).addClass('active');
  $(this).closest("ul.caf-multi-drop-sub").removeClass('active');
  // console.log(data_name,div);
  $(this).closest("ul.caf_select_multi").find("li.caf_select_multi_default span").text(data_name);
  $(this).closest("ul.caf_select_multi").find("li.caf_select_multi_default").attr("data-value",data_value);
  var v=[];
 i=0;
  $("li.caf_select_multi_default").each(function(){
    v[i++]=$(this).attr("data-value");
   //console.log($(this).attr("data-value"));
  });
 // console.log(v);
  const allEqual = v => v.every( val => val === v[0] );
  var t=v.toString();
 if(t=='' || allEqual(v)) {
  var sel_terms=$("."+div).attr("data-selected-terms");
  $("."+div).attr("data-terms",sel_terms);
 }
 else {
$("."+div).attr("data-terms",t);
 }
  
$page='1';	
var params=get_params($page,div);
  params["caf-perform"]='filter';
  params["caf-perform-term"]=data_value;
  
  //console.log($(".caf_select_multi").length,allEqual(v),v.filter(function(e) { return e !== '0' }));
  if(v.filter(function(e) { return e !== '0' }).length==1) {
    //console.log("in");
    params["data-filter-layout"]="multiple-taxonomy-filter";
    jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter");
  }
  
  else if($(".caf_select_multi").length>1 && allEqual(v)==false) {
    //console.log("ok");
	params["data-filter-layout"]="multiple-taxonomy-filter2";
  jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter2");
	}
	else {
   // console.log("ok1");
		params["data-filter-layout"]="multiple-taxonomy-filter";
    jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter");
	}

  cafScrollToDiv(div);
  get_posts(params);
 });
 /* END FUNCTION FOR MULTIPLE TAXONOMY HORIZONTAL MODERN FILTER */
	
/* START FUNCTION FOR PARENT CHILD CATEGORY FILTER  */
 $('.caf-post-layout-container').on('click', '.caf-pcf-layout li .check_box', function (e) {
 //console.log(e.currentTarget);
  if(!$(this).closest("li").hasClass('act')) {
 $(this).closest("li").addClass('act');
}
  else {
   $(this).closest("li").removeClass('act');
  }
var div=e.currentTarget.getAttribute("data-target-div");
var div_new="#caf-post-layout-container."+div;
	//console.log(div_new);
var current_id=e.currentTarget.id;
//console.log(current_id);
  var cr_tr=$("#"+current_id).val();
// console.log(div,$("#"+current_id).val());
 var v=[];
 i=0;
$(".caf-pcf-layout li .check_box:checked").each(function(){    
  v[i++]=$(this).val();
})
 
 var t=v.toString();
 if(t=='') {
  var sel_terms=$("."+div).attr("data-selected-terms");
  $("."+div).attr("data-terms",sel_terms);
 }
 else {
$("."+div).attr("data-terms",t);
 }
  
$page='1';	
var params=get_params($page,div);
  params["caf-perform"]='filter';
  params["caf-perform-term"]=cr_tr;
  jQuery(div_new).attr("data-filter-layout","multiple-taxonomy-filter2");
if($(".caf-pcf-layout li .check_box:checked").length>1) {
	params["data-filter-layout"]="multiple-taxonomy-filter2";
	}
	else {
		params["data-filter-layout"]="multiple-taxonomy-filter";
	}
  cafScrollToDiv(div);
// console.log(params);
get_posts(params);
//e.preventDefault();	
 
});
 /* END FUNCTION FOR PARENT CHILD CATEGORY FILTER*/
 
$('.caf-post-layout-container').on('click', '.tp_load_more', function (e) {
 var $current=$(this).attr("data-current");
 var $next=$(this).attr("data-next");
 var $total=$(this).attr("data-total");
 //console.log($current,$next,$total);
var div=e.delegateTarget.getAttribute("data-target-div");
$page = parseInt($next);
 // console.log(div,$page);
 var params=get_params($page,div);
 if(params["data-filter-layout"]=='multiple-checkbox') {
 if($("#caf-multiple-check-filter li .check_box:checked").length>0) {
	params["data-filter-layout"]="multiple-checkbox2";
	}
	else {
		params["data-filter-layout"]="multiple-checkbox";
	}
 }
 if($page<=$total) {
 get_posts_load(params);
 }
 else {
  $(this).fadeOut();
 }
e.preventDefault();	
});


 });

function cafScrollToDiv(div) {
 var scroll_to_div=jQuery("#caf-post-layout-container."+div).attr("data-scroll");
 if(scroll_to_div!="disabled") {
  var scroll_desktop=parseInt(jQuery("#caf-post-layout-container."+div).attr("data-scroll-desk"));
  var scroll_mobile=parseInt(jQuery("#caf-post-layout-container."+div).attr("data-scroll-mob"));
  var width=jQuery(document).width();
  var position=0;
  if((scroll_to_div=="desktop")&& width>600) {
   var position=scroll_desktop;
   scroll_animate(position,div);
  }
  else if(scroll_to_div=="desktop&mobile" && width>600) {
   var position=scroll_desktop;
   scroll_animate(position,div);
  }
  else if(scroll_to_div=="mobile" && width<600) {
   var position=scroll_mobile;
   scroll_animate(position,div);
  }
  else if(scroll_to_div=="desktop&mobile" && width<600) {
   var position=scroll_mobile;
   scroll_animate(position,div);
  }
  
 }
}

function get_posts(params) {
 //console.log(params);
  var $ = jQuery.noConflict();
	var container = params['data-target-div'];
	var content   = $(container).find('#manage-ajax-response');
	var status    = $(container).find('.status');
	var img=tc_caf_ajax.plugin_path+"assets/img/loading2.gif";
 $(container).addClass('fetching');
	$(status).html('<i class="fa fa-spinner fa-spin"></i>').addClass('active');
	$(content).addClass('loading');
	$.ajax({
		url: tc_caf_ajax.ajax_url,
		data: {
			action: 'get_filter_posts',
			nonce: tc_caf_ajax.nonce,
			params: params
		},
		type: 'post',
		dataType: 'json',
		success: function(data, textStatus, XMLHttpRequest) {
   //console.log(data);
   if (typeof cafTotalResults !== 'undefined') {
          $(cafTotalResults).html(data.found);
        }
        if (typeof cafAjaxSuccess !== "undefined") { 
          data['params']=params;
            cafAjaxSuccess(data);
        }
   $(container).removeClass('fetching');
			$(content).removeClass('loading');
   
			if (data.status === 200) {
        $(content).removeClass('caf-empty-error');
				$(content).html(data.content);
       
			}
			else if (data.status === 201) {
    if(data.message=='Empty Results') {
     $(content).addClass('caf-empty-error');
     $(content).html(data.content);
    }
    else {
				$(content).html(data.content);	
    }
			}
			else if (data.status === 404) {
				$(content).html(data.content);	
			}
			else {
				$(status).html(data.message);
			}
		},
		error: function(MLHttpRequest, textStatus, errorThrown) {
			$(status).html(textStatus);
		},
		complete: function(data, textStatus) {
			msg = textStatus;
			if (textStatus === 'success') {
				msg = data.responseJSON.found;
			}
			$(status).text('Posts found: ' + msg);
		}
	}); 
}
        
function get_posts_load(params) {
 params.load_more='load_more';
var $ = jQuery.noConflict();
	var container = params['data-target-div'];
	var content   = $(container).find('#manage-ajax-response');
 var content2   = $(container).find('#manage-ajax-response .load-more-container');
	var status    = $(container).find('.status');
 $(container).addClass('fetching');
	var img=tc_caf_ajax.plugin_path+"assets/img/loading2.gif";
	$(status).html('<i class="fa fa-spinner fa-spin"></i>').addClass('active');
	$(content).addClass('loading');
 $(container).find("#tp-load-more .fa-spinner").remove();
 $(container).find("#tp-load-more").append('&nbsp;<i class="fa fa-spinner fa-spin"></i>').addClass("tp-loading");
	$.ajax({
		url: tc_caf_ajax.ajax_url,
		data: {
			action: 'get_filter_posts',
			nonce: tc_caf_ajax.nonce,
			params:params
		},
		type: 'post',
		dataType: 'json',
		success: function(data, textStatus, XMLHttpRequest) {
   // console.log(data);
   if (typeof cafTotalResults !== 'undefined') {
          $(cafTotalResults).html(data.found);
        }
        if (typeof cafAjaxSuccess !== "undefined") {
          data['params']=params; 
            cafAjaxSuccess(data);
        }
   $(container).removeClass('fetching');
			$(content).removeClass('loading');
   $(container).find("#tp-load-more").removeClass("tp-loading");
			if (data.status === 200) {
    var crpg=parseInt($(content2).find("#tp-load-more").attr("data-current"));
 var nxpg=parseInt($(content2).find("#tp-load-more").attr("data-next"));
     var ttlpg=parseInt($(content2).find("#tp-load-more").attr("data-total"));
   var crpg=crpg+1;
    var nxpg=nxpg+1;
    //console.log(ttlpg);
    if(ttlpg==crpg) {
     $(content2).find("#tp-load-more").addClass('caf-disabled-end-btn');
    }
  parseInt($(content2).find("#tp-load-more").attr("data-current",crpg));
 parseInt($(content2).find("#tp-load-more").attr("data-next",nxpg)); 
 //console.log(crpg,nxpg);
    $(data.content).insertBefore(content2);
 
			}
			else if (data.status === 201) {
				$(content).html(data.content);	
			}
			else if (data.status === 404) {
				$(content).html(data.content);	
			}
			else {
				$(status).html(data.message);
			}
		},
		error: function(MLHttpRequest, textStatus, errorThrown) {
			$(status).html(textStatus);
		},
		complete: function(data, textStatus) {
			msg = textStatus;
			if (textStatus === 'success') {
				msg = data.responseJSON.found;
			}
			$(status).html('').removeClass('active');
		}
	}); 
}



/* filter 2 dropdown code */
jQuery( document ).ready(function($){
	$("ul.dropdown").click(function() {
  $(this).find("li ul").toggle();
  $(this).find("li").toggleClass('activss');
     });
     
 $(".caf-post-layout-container").each(function() {
  if($(this).attr("data-filter-layout")=='filter-layout2') {
  var d_term=$(this).attr("data-default-term");
   $(this).find("ul.dropdown li ul li a.dfl").removeClass("active");
   var div1= $(this).find("ul.dropdown li ul li a[data-id='"+d_term+"']").not(".dfl");
   if(div1.length==0){
    $("ul.dropdown ul li:first-child a").addClass("active");
   }
   else  {
   $(div1).addClass("active");
   var text=$(div1).text();
   $(this).find(".dropdown .result").html(text);
   }
  }
 });
 
 /* FUNCTION FOR MULTIPLE TAXONOMY FILTER TOGGLE */
 $(".caf-mtf-layout h3.tax-heading").click(function(){
  if($(this).find("i").hasClass('fa-chevron-up')) {
  $(this).find("i").removeClass('fa-chevron-up').addClass('fa-chevron-down');
  }
  else {
   $(this).find("i").removeClass('fa-chevron-down').addClass('fa-chevron-up');
  }
  $(this).closest("ul").find("li").each(function(){
   $(this).slideToggle();
  });
 })
 
	});


/* SCROLL ANIMATE FUNCTION */
 function scroll_animate(pos,div) {
  if(jQuery("#caf-post-layout-container ."+div).offset()) {
   jQuery('html, body').animate({
        scrollTop: jQuery("#caf-post-layout-container ."+div).offset().top-pos
    }, 2000);
  }
  else {
   jQuery('html, body').animate({
        scrollTop: jQuery("#caf-post-layout-container."+div).offset().top-pos
    }, 2000);
  }
 }

jQuery(function($){
 $("ul.caf_select_multi li.caf_select_multi_default").click(function(){
  var th=$(this).find("ul.caf-multi-drop-sub");
  $("ul.caf_select_multi li.caf_select_multi_default").not(this).each(function(){
   $(this).closest("ul").find("ul.caf-multi-drop-sub").removeClass('active');
   $(this).find("i.caf-multi-mod-right").removeClass("fa-chevron-up");
  })
  var data_value=$(this).attr('data-value');
  $(this).find("i.caf-multi-mod-right").toggleClass("fa-chevron-up");
  $(this).closest("ul").find("ul.caf-multi-drop-sub").toggleClass('active');
 })
 
})
