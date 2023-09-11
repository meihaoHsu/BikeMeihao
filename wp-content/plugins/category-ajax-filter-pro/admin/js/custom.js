function enableAnalytics(data,val) {
 jQuery.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	           dataType : "html",
            data : {action: "tc_caf_enable_analytics",nonce_ajax : tc_caf_ajax.nonce,data:data,val:val},
            success : function( response ) {
             var res=JSON.parse(response);
             if(res['result']=='success') {
              location.reload();
             }
     }
     });	
}

function filterAnalytics(val) {
 var href=location.href;
 if(val=='today' && href.indexOf("filter=all")>-1) {
  var hr=href.replace('&filter=all','&filter='+val);
 }
 else if(val=='all' && href.indexOf("filter=today")>-1) {
  var hr=href.replace('&filter=today','&filter='+val);
 }
 else {
  var hr=href+"&filter="+val;
 }
 window.location=hr;
}

function resetAnalytics(event,data) {
 event.preventDefault();
jQuery.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	           dataType : "html",
            data : {action: "tc_caf_reset_analytics",nonce_ajax : tc_caf_ajax.nonce,data:data},
            success : function( response ) {
             var res=JSON.parse(response);
             if(res['result']=='success') {
              location.reload();
             }
     }
     });	
}

google.charts.load('45', {'packages':['corechart']});
function drawBasic(arr,div,title) {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Terms');
      data.addColumn('number', 'Clicks');
 data.addRows(arr);
 var ht=arr.length*100;
 if(ht>500) {
  ht=500;
 }
 var wid=jQuery(".caf-tab-content").width()-50;
  var options = {
                 'orientation': 'vertical',
                 'title':'How Many Clicks you got on this taxonomy!',
                 'width':wid,
                 'height':ht,
                 'colors': ['#fd7936','#f6c7b6'],
                 'backgroundColor': '#ffffff',
                 'vAxis':{textPosition:'in','title':'Terms'},
   'hAxis': {format:'0',gridlines:{ minSpacing: 1,count:4}},

                };
      var chart = new google.visualization.ColumnChart(
      document.getElementById(div));
      chart.draw(data, options);
    }
 
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
jQuery(function($){
 
 $( "ul.category-lists.taxn").sortable();
//  $("ul.each-tax-data").sortable({
//     items: "li"
//   });
 if(getCookie("hashcaf")!='') {
  url=getCookie("hashcaf");
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
  var get_text=$.trim($(".tab-content "+url+" .manage-top-dash.text").text());
  $(".manage-top-dash.general-tab.new-tab span.text").text(get_text);
  //console.log(get_text);
} 
 
 if(getCookie("hashcafsub")!='') {
  url=getCookie("hashcafsub");
  //console.log(url);
    var ht=$(".tab-header[data-content='"+url+"']").toggleClass('active');
  var dataDiv=".tab-content."+url;
 var hdrdiv=".tab-header[data-content='"+url+"']";
$(dataDiv).addClass('active');	
$(hdrdiv).find("i.fa-angle-down").removeClass("rotate2").addClass('rotate');
} 

 $("#myTab a").click(function(){ 
 var hashurl=$(this).attr('href');
setCookie("hashcaf",hashurl,30);
  var get_text=$.trim($(".tab-content "+hashurl+" .manage-top-dash.text").text());
  $(".manage-top-dash.general-tab.new-tab span.text").text(get_text);
})
//console.log("I am working!!");

/*---- Start Function For Tab Click ----*/	

$("#app-tab a").click(function(e){

e.preventDefault();

var href=$(this).attr("href");
//console.log(href);
$("#app-tab a").each(function(){

$(this).removeClass('active');	

});

$("#app-tab-content .app-tab-content").each(function(){

$(this).removeClass('active');	

});

	

$(this).addClass('active');	

$("#app-tab-content").find(href).addClass('active');

});

/*---- END Function For Tab Click ----*/		



/*---- Start Function For CUSTOM POST TYPE SELECT ----*/
$("#caf_top_meta_box #custom-post-type-select").change(function(){
var val=$(this).val();
var post_id=$("#post_ID").val();
$.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	        dataType : "json",
            data : {action: "tc_caf_get_taxonomy",nonce_ajax : tc_caf_ajax.nonce,cpt:val,post_id:post_id},
            success : function( response ){
          //  console.log(response);
				var div="#caf_top_meta_box ul.category-lists";
				$(div).html('');
    $("#caf_top_meta_box #caf-default-term").html('');
    $(".vertical-setting").html('');
				for(i=0;i<response['tax'].length;i++)
	{	
				  var ch='';
      if(i==0){
      var ch="checked";
      }
      $("#caf_top_meta_box ul.category-lists.taxn").append('<li><input name="caf-taxonomy[]" class="caf-taxonomy check" id="caf-taxonomy_'+response['tax'][i]+'" type="checkbox" value="'+response['tax'][i]+'" '+ch+'><label for="caf-taxonomy_'+response['tax'][i]+'" class="category-list-label">'+response['tax'][i]+'</label></li>');
      $(".vertical-setting").append("<label><input type='checkbox' name='vertical-expand[]' class='vertical-check' value='"+response['tax'][i]+"'/>"+response['tax'][i]+"</label>");
      }
             var trc=response['trc'];
             var ic=''
      var sel_ic_val='';
             if(trc){
             // console.log();
      if(trc['all']){
       ic=trc['all'];
        sel_ic_val=ic+"(all)";
      }}         //var terms=JSON.parse(response);
				//console.log(response['terms']);
				if(response['terms'].length>0){
					$("#caf_top_meta_box ul.category-lists.all-terms").append("<li id='all-cat' data-id='all'><input type='hidden' name='category-list-icon[]' id='hidall' class='hid-icon' data-name='category-list-idall' data-selected='' value='"+sel_ic_val+"'><input name='all-select' class='category-list-all check' id='category-all-btn' type='checkbox' onClick='selectAllCats()'><label for='category-all-btn' class='category-list-all-label'>All</label><div class='caf-selected-ico'><i onclick='removeIcon(this,event)' class='"+ic+" caf-selected-ic'></i></div><span><i class='fa fa-cog' aria-hidden='true'></i></span></li>");
					if($("#caf-all-ed").val()=="enable") {
     $("#caf_top_meta_box #caf-default-term").append('<option value="all" class="remove_it">All</option>');
					}
     $("#caf_top_meta_box ul.category-lists.all-terms").append("<ul class='category-lists-sub'><ul class='each-tax-data "+response['tax1']+"' data-name='"+response['tax1']+"'></ul></ul>");
					
					$("#caf_top_meta_box ul.category-lists.all-terms").find(".each-tax-data."+response['tax1']).append(response['terms']);
					 var trc=response['trc'];
					tc_caf_list_cats();
				}
				else if(response['terms'].length=='0') {
					$("#caf_top_meta_box ul.category-lists.all-terms").append('<div class="notice-error">No Category added for this custom post type/taxonomy.</div>');
				}
				else {
				$("#caf_top_meta_box ul.category-lists").append('<div class="notice-error">Error Occured..</div>');
				}
     }
});	
});
/*---- End Function For CUSTOM POST TYPE SELECT ----*/
 tc_caf_list_cats();
 $("#tabs-panel").on("click",".trusty-separate-bars .fa-info-circle",function(){
 $(this).closest(".trusty-separate-bar").toggleClass("active");
 });

 function tc_caf_list_cats() {
  $("ul.each-tax-data .trusty-separate-bars").remove();
  var ht="<div class='trusty-separate-bars'>";
  ht+= "<div class='trusty-separate-bar tr-name'>Name</div>";
  ht+= "<div class='trusty-separate-bar tr-sett'>Setting</div>";
  ht+= "<div class='trusty-separate-bar tr-icon'>Icon</div>";
  ht+= "<div class='trusty-separate-bar tr-parent'>Parent Dropdown <i class='fa fa-info-circle' aria-hidden='true'></i><span>This feature will only work if you use parent child category filter layout.</span></div>";
  ht+= "</div>";
  $(ht).insertAfter($("ul.each-tax-data").find("hr"));
	 $("ul.each-tax-data li").each(function(i){
		var div=$(this).find("a").eq(0);
		var class_str=$(this).attr('class');
  var id1 = class_str.substr(18,class_str.length);
		var tx_name=$(this).closest("ul.each-tax-data").attr("data-name");
		var id=tx_name+"___"+id1;
     //console.log(id);
		var cats=$("#category_list_arr").val().split(',');
		 var pcats=$("#category_parent_arr").val().split(',');
  // console.log(cats,id);
if($(this).find(".category-list").length==0)
    {
  if(cats.includes(id)) {
	 // console.log("in");
   var check='checked';
  }
  else {
	 // console.log("out");
   var check='';
  }
     if(pcats.includes(id)) {
      //console.log("in");
   var pcheck='checked';
  }
  else {
   var pcheck='';
  }
   var text=$(div).text();
   //  console.log(text);
    // $(this).text('');
		$(this).attr("data-id",id1);
		var ic='';
      var sel_ic_val='';
     var sel_ic_val1='';
     //console.log(id1,$(".cat-term-ic[data-key='"+id1+"']").length);
 if($(".cat-term-ic[data-key='"+id1+"']").length>0) {
  var sel_ic_val=$(".cat-term-ic[data-key='"+id1+"']").val();
  var sel_ic_val1=$(".cat-term-ic[data-key='"+id1+"']").val()+"("+id1+")";
  }
 var count=$(this).find("span.count_link:eq(0)").text();
		 $("<div class='trusty-manage-bar-sec-label'><label for='category-list-id"+id1+"'><input type='hidden' name='category-list-icon[]' id='hid"+id1+"' class='hid-icon' data-name='category-list-id"+id1+"' data-selected='' value='"+sel_ic_val1+"'><input class='category-list check' type='checkbox' name='category-list[]' value='"+id+"' id='category-list-id"+id1+"' "+check+">"+text+"&nbsp;"+count+"</label></div>").insertBefore(div);
     
		$('<span class="setting-tc-caf"><i class="fa fa-cog" aria-hidden="true"></i></span><div class="caf-selected-ico"><i class="'+sel_ic_val+' caf-selected-ic" onclick="removeIcon(this,event)"></i></div><div class="set_parent"><input type="checkbox" name="caf-term-parent-tab[]" value="'+id+'" class="parent_checkb" '+pcheck+'></div>').insertAfter($(this).find('.trusty-manage-bar-sec-label'));
   if(jQuery(this).find('ul.children').length>0) {
   jQuery(this).addClass('tc-caf-has-child');
   if($(this).hasClass('tc-caf-has-child')) {
  $(this).find('.trusty-manage-bar-sec-label').append('<i class="fa fa-plus" aria-hidden="true" onclick="toggleHier(this)"></i>');
  }
	  
  } 
		 }
	 })
  
$("ul.each-tax-data li a").click(function(e){
	e.preventDefault();
})
 }
 
/*---- Start Function For TAXONOMY selection ----*/
 $('#caf_top_meta_box').on('click', '.caf-taxonomy.check', function () {
 //$("#caf_top_meta_box .caf-taxonomy.check").change(function(){
  var cr_tax=$(this).val();
  var cr_state='uncheck'
  if($(this).prop('checked') == true){
   cr_state='check';
}
  //console.log(cr_tax,cr_state);
  var arr=[];
  var i=0;
  var prepare_class="ul.category-lists.all-terms .each-tax-data."+cr_tax;
  if($(prepare_class).length>0 && cr_state=='check') {
   //console.log("test");
   return;
  }
  
 //if($("#caf_top_meta_box .caf-taxonomy.check:checked").length>0) {
  $("#caf_top_meta_box .caf-taxonomy.check:checked").each(function(){
   var val=$(this).val();
  arr[i++]=val;
  });
  var div="#caf_top_meta_box ul.category-lists.all-terms";
  var div1="#caf_top_meta_box #caf-default-term";
  
  var post_id=$("#post_ID").val();
  if(cr_state=='uncheck') {
$(prepare_class).each(function(){
    $(this).remove();
   }); 
	 $(div1+" option[data-id='"+cr_tax+"']").remove(); 
   return ;
  }
  $.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	           dataType : "html",
            data : {action: "tc_caf_get_terms_pro",nonce_ajax : tc_caf_ajax.nonce,taxonomy:arr,post_id:post_id,cr_tax:cr_tax,cr_state:cr_state},
            success : function( response ) {
				//console.log(response);
             $(div).find(".category-lists-sub").append(response);
				 tc_caf_list_cats();
}
     });	
  
  $.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	           dataType : "json",
            data : {action: "tc_caf_get_terms_pro_def",nonce_ajax : tc_caf_ajax.nonce,taxonomy:arr},
            success : function( response ){
            if(response['terms'].length>0){
				var ln=$(div1).find("option[value='all']").length;
				$(div1).html('');
				if($("#caf-all-ed").val()=="enable") {
            $(div1).append("<option value='all' class='remove_it'>All</option>"); 
				}
            for(i=0;i<response['terms'].length;i++)
			{
					       var tid=response['terms'][i]['term_id'];
					       var tname=response['terms'][i]['name'];
            var tax=response['terms'][i]['taxonomy'];
            $(div1).append('<option data-id="'+tax+'" value="'+tax+"___"+tid+'">'+tname+'</option>');
			}
            }
     }
     });
 //}
 });
 
 
/*---- End Function For TAXONOMY selection ----*/
 
 
/*---- Start Function To Get Terms Of Taxonomy ----*/
$("#caf_top_meta_box #caf-taxonomy").change(function(){
var val=$(this).val();
$.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	           dataType : "json",
            data : {action: "tc_caf_get_terms",nonce_ajax : tc_caf_ajax.nonce,taxonomy:val},
            success : function( response ) {
            //console.log(response['terms']);
				var div="#caf_top_meta_box ul.category-lists";
    var div1="#caf_top_meta_box #caf-default-term";
				$(div).html('');
    $(div1).html('');
				if(response['terms'].length>0) {
					$(div).append("<li id='all-cat'><input name='all-select' class='category-list-all check' id='category-all-btn' type='checkbox' onClick='selectAllCats()'><label for='category-all-btn' class='category-list-all-label'>All</label></li>");
     $(div1).append("<option value='all' class='remove_it'>All</option>");
				for(i=0;i<response['terms'].length;i++)
					{
					var tid=response['terms'][i]['term_id'];
					var tname=response['terms'][i]['name'];
					$(div).append('<li><input name="category-list[]" class="category-list check" id="category-list-id'+tid+'" type="checkbox" value="'+tid+'"><label for="category-list-id'+tid+'" class="category-list-label">'+tname+'</label></li>');
      $(div1).append('<option value="'+tid+'">'+tname+'</option>');
					}
				}
				else if(response['terms'].length=='0') {
					$(div).append('<div class="notice-error">No Category added for this custom post type/taxonomy.</div>');	
     $(div1).html('');	
				}
				else {
				$(div).append('<div class="notice-error">Error Occured.</div>');	
				}
     }
     });	
});

/*---- End Function For CUSTOM POST TYPE SELECT ----*/

/*---- START Function To Change layout design preview ----*/

$(".filter-reset").click(function(e){
e.preventDefault();
var layout=$("#caf-filter-layout").val();
var btn1=".filter-color-combo .filter-primary-color button";
var field_value1=".filter-color-combo .filter-primary-color .my-color-field";
var btn2=".filter-color-combo .filter-sec-color button";
var field_value2=".filter-color-combo .filter-sec-color .my-color-field";
var btn3=".filter-color-combo .filter-sec-color2 button";
var field_value3=".filter-color-combo .filter-sec-color2 .my-color-field";
if(layout=='filter-layout1') {
$(btn1).css({"background-color":"#ff8ca2"});
$(field_value1).val("#ff8ca2");
$(btn2).css({"background-color":"#ffffff"});
$(field_value2).val("#ffffff");
$(btn3).css({"background-color":"#262626"});
$(field_value3).val("#262626");
}
if(layout=='filter-layout2') {
$(btn1).css({"background-color":"#262626"});
$(field_value1).val("#262626");
$(btn2).css({"background-color":"#848484"});
$(field_value2).val("#848484");
$(btn3).css({"background-color":"#ffffff"});
$(field_value3).val("#ffffff");
}
if(layout=='filter-layout3') {
$(btn1).css({"background-color":"#262626"});
$(field_value1).val("#262626");
$(btn2).css({"background-color":"#ffffff"});
$(field_value2).val("#ffffff");
$(btn3).css({"background-color":"#ffffff"});
$(field_value3).val("#ffffff");
}
});



$(".post-reset").click(function(e){
e.preventDefault();
var layout=$("#caf-post-layout").val();
var btn1=".post-color-combo .post-primary-color button";
var field_value1=".post-color-combo .post-primary-color .my-color-field";
var btn2=".post-color-combo .post-sec-color button";
var field_value2=".post-color-combo .post-sec-color .my-color-field";
var btn3=".post-color-combo .post-sec-color2 button";
var field_value3=".post-color-combo .post-sec-color2 .my-color-field";
if(layout=='post-layout3') {
$(btn1).css({"background-color":"#ff8ca2"});
$(field_value1).val("#ff8ca2");
$(btn2).css({"background-color":"#ffffff"});
$(field_value2).val("#ffffff");
$(btn3).css({"background-color":"#2d2d2d"});
$(field_value3).val("#2d2d2d");
}

});

	

/*---- END Function To Change layout design preview ----*/

/*---- START Function To check value of switcher Managae Filter ----*/	

	$('.checkstate').change(function() {
		var val=$(this).prop('checked');
		var dn="#"+$(this).attr("data-name");
		//console.log(fields);
		if(val==true) {
			$(dn).val('on');
		$(".manage-filters").removeClass('caf-hide');
		} 
		else {
			$(dn).val('off');
			$(".manage-filters").addClass('caf-hide');
		}
		var obj=get_obj_data();
      //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
    });
 
	$('.analytics_check').change(function() {
		var val=$(this).prop('checked');
		var id=$(this).attr("data-name");
		if(val==true) {
   enableAnalytics(id,'Enable');
		} 
		else {
 enableAnalytics(id,'Disable');
		}
    });
 
	/*---- END Function To check value of switcher ----*/
 
var cpval=$("#caf-pagination-status").val();
 if(cpval=="off") {
  $(".manage-page-type").addClass('caf-hide');
 }
 else {
  $(".manage-page-type").removeClass('caf-hide');
 }
 if($("#caf-filter-more").val()=="off") {
  $(".caf-control-more").addClass('caf-hide');
 }
 else {
  $(".caf-control-more").removeClass('caf-hide');
 }
 
 
 if($("#caf-filter-more-scroll").val()=="off") {
  $(".caf-control-more-scroll").addClass('caf-hide');
 }
 else {
  $(".caf-control-more-scroll").removeClass('caf-hide');
 }
 if($("#caf-filter-search").val()=="off") {
  $(".caf-control-search").addClass('caf-hide');
 }
 else {
  $(".caf-control-search").removeClass('caf-hide');
 }
 
 if($("#caf-filter-layout").val()!="filter-layout1") {
   $(".control-more-full").addClass("caf-hide");
  }
  else {
   $(".control-more-full").removeClass("caf-hide");
  }
 if($("#caf-filter-layout").val()=="alphabetical-layout") {
   $(".control-search-div").addClass("caf-hide");
  }
  else {
   $(".control-search-div").removeClass("caf-hide");
  }
 
 if($("#caf-filter-layout").val()=="multiple-taxonomy-filter-hor") {
   $(".horizontal-btn-row").removeClass("caf-hide");
  }
  else {
   $(".horizontal-btn-row").addClass("caf-hide");
  }
 //console.log($("#caf-filter-layout").val());
 
 
 if($("#caf-filter-layout").val()=="multiple-checkbox") {
   $(".manage-relation-row").removeClass("caf-hide");
  }
  else {
   $(".manage-relation-row").addClass("caf-hide");
  }
 
 if($("#caf-filter-layout").val()=="tabfilter-layout1") {
   $("#caf-filter-search-layout option:nth-child(2)").addClass("caf-hide");
  }
  else {
  $("#caf-filter-search-layout option:nth-child(2)").removeClass("caf-hide");
  }
 
 
 //,.control-search-div
 $('.checkpagi').change(function() {

		var val=$(this).prop('checked');

		var dn="#"+$(this).attr("data-name");

		//console.log(fields);

		if(val==true) {

			$(dn).val('on');

		$(".manage-page-type").removeClass('caf-hide');

		} 

		else {

			$(dn).val('off');

			$(".manage-page-type").addClass('caf-hide');

		}

		var obj=get_obj_data();

      //$('#console-event').html('Toggle: ' + $(this).prop('checked'))

    });
 
  $('.checkmore').change(function() {
		var val=$(this).prop('checked');
		var dn="#"+$(this).attr("data-name");
		//console.log(fields);
		if(val==true) {
			$(dn).val('on');
		$(".caf-control-more").removeClass('caf-hide');
		} 
		else {
			$(dn).val('off');
			$(".caf-control-more").addClass('caf-hide');
		}
    });
 
 $('.checkmorescroll').change(function() {
		var val=$(this).prop('checked');
		var dn="#"+$(this).attr("data-name");
		//console.log(fields);
		if(val==true) {
			$(dn).val('on');
		$(".caf-control-more-scroll").removeClass('caf-hide');
		} 
		else {
			$(dn).val('off');
			$(".caf-control-more-scroll").addClass('caf-hide');
		}
    });
 
 
 $('.checksearch').change(function() {
		var val=$(this).prop('checked');
		var dn="#"+$(this).attr("data-name");
		//console.log(fields);
		if(val==true) {
			$(dn).val('on');
		$(".caf-control-search").removeClass('caf-hide');
		} 
		else {
			$(dn).val('off');
			$(".caf-control-search").addClass('caf-hide');
		}
    });
 
 $("#caf-filter-layout").change(function(){
  if($(this).val()!="filter-layout1") {
   $(".control-more-full").addClass("caf-hide");
  }
  else {
   $(".control-more-full").removeClass("caf-hide");
  }
  //,.control-search-div
  
  if($(this).val()!="tabfilter-layout1") {
   $(".control-more-scroll-full").addClass("caf-hide");
   $("#caf-filter-search-layout option:nth-child(2)").removeClass('caf-hide');
  }
  else {
   $(".control-more-scroll-full").removeClass("caf-hide");
   $("#caf-filter-search-layout option:nth-child(2)").addClass('caf-hide');
  }
  if($(this).val()=="multiple-checkbox") {
   $(".manage-relation-row").removeClass("caf-hide");
  }
  else {
   $(".manage-relation-row").addClass("caf-hide");
  }
  if($(this).val()=="alphabetical-layout") {
   $(".control-search-div").addClass("caf-hide");
  }
  else {
   $(".control-search-div").removeClass("caf-hide");
  }
  
  if($(this).val()=="multiple-taxonomy-filter") {
   $(".control-vertical-layout").removeClass('caf-hide');
  }
  else {
    $(".control-vertical-layout").addClass('caf-hide');
  }

  if($(this).val()=="multiple-taxonomy-filter-hor") {
   $(".horizontal-btn-row").removeClass("caf-hide");
  }
  else {
   $(".horizontal-btn-row").addClass("caf-hide");
  }
 })

 
 
	/*---- START Function To check value of switcher Meta Filter ----*/	

	$('.checkstateofmeta').change(function() {

		var val=$(this).prop('checked');

		//console.log(val);

		if(val==true) { $(this).val('1'); 

					   //$(".meta-fields-row").fadeIn();

					  } 

		else {

			$(this).val('0');

			//$(".meta-fields-row").fadeOut();

		}

      //$('#console-event').html('Toggle: ' + $(this).prop('checked'))

    });

	/*---- END Function To check value of switcher Meta Filter ----*/

	

	/*---- START Function To check value of switcher Meta Filter ----*/	

	$('.checkstateofpgn').change(function() {

		var val=$(this).prop('checked');

		//console.log(val);

		if(val==true) { $(this).val('1'); 

		$(".p-type").fadeIn();

					  } 

		else {

			$(this).val('0');

			$(".p-type").fadeOut();

		}

      //$('#console-event').html('Toggle: ' + $(this).prop('checked'))

    });

	/*---- END Function To check value of switcher Meta Filter ----*/

	/*---- START Function To LOAD Wp COLOR ----*/

	$('.my-color-field').wpColorPicker();

	/*---- END Function To LOAD Wp COLOR ----*/

	var total_check=jQuery("#caf_top_meta_box .category-lists .category-list.check").length;

var checked_check=jQuery("#caf_top_meta_box .category-lists .category-list.check:checked").length;

	if(total_check==checked_check) {

		jQuery("#caf_top_meta_box .category-lists .category-list-all").attr("checked","checked");}

});


/*---- START Function To SELECT ALL CATEGORIES ----*/

function selectAllCats(e) {

var total_check=jQuery("#caf_top_meta_box .category-lists .category-list.check").length;

var checked_check=jQuery("#caf_top_meta_box .category-lists .category-list.check:checked").length;

//console.log(total_check,checked_check,checked_check2);

jQuery("#caf_top_meta_box .category-lists .category-list.check").each(function(i){

var check=jQuery(this).attr("checked");

if(total_check==checked_check) { jQuery(this).removeAttr("checked");} 

else {jQuery(this).attr("checked","checked");}

})



}

/*---- End Function To SELECT ALL CATEGORIES ----*/

jQuery(function($){
var div="#tabs-panel .tab-panel .tab-header";
var divs="#tabs-panel .tab-panel .tab-content";	
$(div).click(function(){
 var hashcafsub=$(this).attr("data-content");
 setCookie("hashcafsub",hashcafsub,30);
$(this).toggleClass('active');	
var dataDiv="."+$(this).attr("data-content");
//console.log(dataDiv);
if($(dataDiv).hasClass('active')) {
//console.log('exist');
$(dataDiv).removeClass('active');
$(this).find("i.fa-angle-down").removeClass('rotate').addClass('rotate2');
}
else{
//console.log('not');
$(dataDiv).addClass('active');	
$(this).find("i.fa-angle-down").removeClass("rotate2").addClass('rotate');
}	
});	
});


jQuery(function($){
$("#caf-post-layout").change(function(){
var playout=$(this).val();
//conditional_fields_for_post_layout(playout);
});
var playout=$("#caf-post-layout").val();
jQuery(".clm-layout").fadeIn();	
  jQuery(".manage-post-author").fadeIn();	
  jQuery(".manage-post-date").fadeIn();	
  jQuery(".manage-post-comments").fadeIn();	
  jQuery(".manage-post-cats").fadeIn();	
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeIn();
//conditional_fields_for_post_layout(playout);	
get_obj_data();
});



function conditional_fields_for_post_layout(playout) {
 if(playout=='post-layout1') {
  jQuery(".clm-layout").fadeIn();	
  jQuery(".manage-post-author").fadeIn();	
  jQuery(".manage-post-date").fadeIn();	
  jQuery(".manage-post-comments").fadeIn();	
  jQuery(".manage-post-cats").fadeOut();	
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeIn();
 }
 if(playout=='post-layout2') {
  jQuery(".clm-layout").fadeIn();
  jQuery(".manage-post-author").fadeIn();	
  jQuery(".manage-post-date").fadeIn();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeIn();
  jQuery(".manage-post-rd").fadeOut();
  jQuery(".manage-post-dsc").fadeOut();
 }
 if(playout=='post-layout3') {
  jQuery(".clm-layout").fadeIn();	
  jQuery(".manage-post-author").fadeIn();	
  jQuery(".manage-post-date").fadeIn();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeIn();
  jQuery(".manage-post-rd").fadeOut();
  jQuery(".manage-post-dsc").fadeOut();
 }
 if(playout=='post-layout4') {
 jQuery(".clm-layout").fadeOut();
  jQuery(".manage-post-author").fadeOut();	
  jQuery(".manage-post-date").fadeOut();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeIn();	
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeIn();
 }
 if(playout=='post-layout5') {
  jQuery(".clm-layout").fadeIn();
  jQuery(".manage-post-author").fadeIn();	
  jQuery(".manage-post-date").fadeOut();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeOut();	
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeIn();
 }
 if(playout=='post-layout6') {
  jQuery(".clm-layout").fadeIn();
  jQuery(".manage-post-author").fadeIn();	
  jQuery(".manage-post-date").fadeOut();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeOut();
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeIn();
 }
 if(playout=='post-layout7') {
  jQuery(".clm-layout").fadeIn();
  jQuery(".manage-post-author").fadeIn();	
  jQuery(".manage-post-date").fadeIn();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeOut();
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeIn();
 }
 if(playout=='carousel-slider') {
  jQuery(".clm-layout").fadeIn();	
  jQuery(".manage-post-author").fadeOut();	
  jQuery(".manage-post-date").fadeOut();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeOut();
  jQuery(".manage-post-rd").fadeOut();
  jQuery(".manage-post-dsc").fadeIn();
 }
 if(playout=='post-layout9') {
  jQuery(".clm-layout").fadeIn();
  jQuery(".manage-post-author").fadeOut();	
  jQuery(".manage-post-date").fadeOut();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeOut();
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeOut();
 }
 if(playout=='post-layout10') {
  jQuery(".clm-layout").fadeIn();
  jQuery(".manage-post-author").fadeOut();	
  jQuery(".manage-post-date").fadeIn();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeOut();
  jQuery(".manage-post-rd").fadeOut();
  jQuery(".manage-post-dsc").fadeOut();
 }
 if(playout=='post-layout11') {
  jQuery(".clm-layout").fadeIn();	
  jQuery(".manage-post-author").fadeOut();	
  jQuery(".manage-post-date").fadeIn();	
  jQuery(".manage-post-comments").fadeOut();	
  jQuery(".manage-post-cats").fadeOut();
  jQuery(".manage-post-rd").fadeIn();
  jQuery(".manage-post-dsc").fadeIn();
 }


}

var fields = {};
function get_obj_data(){
jQuery("#caf_top_meta_box").find(".tc_caf_object_field").each(function() {
fields[this.name] = jQuery(this).val();
});
var obj = {fields: fields};	
//console.log(obj);
}

jQuery(function($){
$("#import-layout-button").click(function(e){
e.preventDefault();
var json=$("#import-caf-layout").val();	
var obj = JSON.parse(json);
//console.log(obj);
$.each(obj, function(key,value){
$(".caf_import[data-import='"+key+"']").val(value);	
});	
$('#publish').click();	
});
 
 jQuery(function($){
$("#import-layout-button-pro").click(function(e){
e.preventDefault();
 var sel_layout=$("#caf-post-layout-import").val();
 var path=tc_caf_ajax.plugin_path;
 $.getJSON(path+"admin/json/"+sel_layout+".json", function(data){
  sel_layout = sel_layout.replace(/-|\s/g,"");
  var obj=data[sel_layout][0];
$.each(obj, function(key,value){
$(".caf_import[data-import='"+key+"']").val(value);	
});	
  $('#publish').click();	
        }).fail(function(){
            console.log("An error has occurred.");
        });
});
});
 
 $("#caf-pagination-type").change(function(){
  var val=$(this).val();
  disablepaginationfield(val);
 });
 var val=$("#caf-pagination-type").val();
 disablepaginationfield(val);
});

function disablepaginationfield(val) {
// console.log(val);
 if(val=="load-more") {
   jQuery("div.prev-text,div.next-text").hide();
  jQuery("div.caf-load-more-text").fadeIn();
  }
 else {
  jQuery("div.prev-text,div.next-text").fadeIn();
  jQuery("div.caf-load-more-text").hide();
 }
}


jQuery(function($){
 $('.terms-row-admin').off().on('click', '.category-lists li i.fa-cog', function(e) {
  var div='';
  div=$(this);
 //console.log('ok');
	
  $(".trusty-pop-up-caf").addClass('active');
  
  $(".caf-p-icon i").off().click(function(){
   var ico=$(this).attr("data-icon-name");
   //console.log(ico,div);
   //var data_id=$(div).closest('li').attr("data-id");
   //console.log(data_id);
	   var data_id=$(div).closest('li').attr("data-id");
	 var data_tax=$(div).closest('ul.each-tax-data').attr("data-name");
	 //console.log(data_id,data_tax);
	 var trm=data_tax+"___"+data_id;
	 //console.log(trm);
	  
	  
   if(data_id=='all') {
    var final_val=ico+"("+data_id+")";
   var find_me="#hidall";
   }
   else {
   var final_val=ico+"("+data_id+")";
   var find_me="#hid"+data_id;
   }
	 //console.log(final_val);
   $(find_me).val(final_val);
	  //console.log(div);
   $(div).closest("li").find(".caf-selected-ico:eq(0)").html("<i onclick='removeIcon(this,event)' class='caf-selected-ic "+ico+"'></i>");
   $(".trusty-pop-up-caf").removeClass('active');
  });
	 
	 
	 
  $("#caf-term-parent-tab").change(function(){
		 var data_id=$(div).closest('li').attr("data-id");
	var data_tax=$(div).closest('ul.each-tax-data').attr("data-name");
	 //console.log(data_id,data_tax);
	 var trm=data_tax+"___"+data_id;
	// console.log(trm);
	  //$( '.caf-parent-ed' ).attr( {value:trm} );
		  
    
});

	 
	 
	 
 
   $(".fa-times.cls").click(function(){
  $(".trusty-pop-up-caf").removeClass('active'); 
  });
  $("#caf-pop-sr").keyup(function(){
   var val=$(this).val().toUpperCase();
   iconsWrapper = document.getElementById("caf_icon_wrapper");
	allIcons = iconsWrapper.getElementsByTagName('div');
   for (i = 0; i < allIcons.length; i++) {
    txtValue = allIcons[i].getElementsByTagName("i")[0].getAttribute("data-icon-name");
    //console.log(txtValue);
    if (txtValue.toUpperCase().indexOf(val) > -1) {
		allIcons[i].style.display = "";
	  } else {
		allIcons[i].style.display = "none";
	  }
   }
  });
});
});

function removeIcon(div,event) {
 //console.log(div,event);
 event.preventDefault();
 jQuery(div).removeClass().addClass('caf-selected-ic');
 var d_id=jQuery(div).closest("li").attr("data-id");
 jQuery(".cat-term-ic[data-key='"+d_id+"']").val('');
 jQuery(div).closest('li').find('.hid-icon').val('');
}



	  jQuery(function ($) {
$('#caf-all-ed').change(function()  {
	var eall=$(this).val();	
	if(eall=="disable") {
		
		$('#caf-default-term .remove_it').remove();
	}
	else {
		$('#caf-default-term').prepend('<option class="remove_it" value="all">All</option>');
	}
})
	
});
jQuery(document).ready(function($) {
  wp.codeEditor.initialize($('#cum-css'), cm_settings);
})
jQuery(document).ready(function($) {
	$(".icon_tab").click(function(){
  $(".lt_content").hide();
   $(".rt_content").show();
  });
									
  $(".parent_tab").click(function(){
  $(".lt_content").show();
   $(".rt_content").hide();
  });
 
 $("button.caf-exp-btn").click(function(){
  var postId=$("#post_ID").val();
  jQuery.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	           dataType : "json",
            data : {action: "tc_caf_export_me",nonce_ajax : tc_caf_ajax.nonce,postId:postId},
            success : function( response ) {
            //console.log(response);
            if(response.result=='success') {
            var link=document.createElement('a');
            document.body.appendChild(link);
            link.href=response.file;
            link.setAttribute('download',response.filename);              
            link.click();
            link.remove();
             }
     }
     });	
 });
 
 
 $("button.caf-imp-btn").click(function(){
  if($(".caf-imp-file").prop("files").length>0) {
     var postId=$("#post_ID").val();
  var filedata=$(".caf-imp-file").prop("files")[0];
  //console.log($(".caf-imp-file").prop("files").length);
  var form = new FormData();
  form.append('file', filedata);
  form.append('action', "tc_caf_import_me");
  form.append('nonce_ajax', tc_caf_ajax.nonce);
  form.append('postId', postId);
  jQuery.ajax({
            url : tc_caf_ajax.ajax_url,
            type : 'post',
	           dataType : "json",
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success : function( response ) {
            //console.log(response);
             if(response.result=='success') {
              location.reload();
             }
     }
     });	
  //console.log("ok!!",postId);
  }
 })
})

function toggleHier(div) { 
 jQuery(div).toggleClass('fa-minus');
 jQuery(div).closest('li').find("ul").eq(0).toggleClass('tc_caf_active_list');
   }
