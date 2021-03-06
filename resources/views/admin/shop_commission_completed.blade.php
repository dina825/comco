@extends('adminheader')
@section('content')
<!-- Content Header (Page header) -->
<style type="text/css">
.search_icon{top: 24px;}
</style>
<div class="col-lg-11 col-md-12 col-sm-12 col-12 offset-lg-1 right_panel">
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-6">
			<div class="main_title">Manage <span>Shop</span></div>
		</div>
		<div class="col-lg-6 col-sm-6 col-6">
			<a href="<?php echo URL::to('admin/logout')?>" class="logout_button"><i class="fas fa-sign-in-alt"></i> &nbsp;Logout</a>
		</div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <?php
              if(Session::has('message')) { ?>
                  <p class="alert alert-info">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo Session::get('message'); ?>
                        
                    </p>
              <?php }
              ?>
        </div>
		<div class="col-lg-12">
			<div class="table-responsive">
		        <table class="table table-striped" id="data_table">
		          <thead class="thead-dark">
		            <tr>
		              <th scope="col">#</th>
                  <th scope="col">Shop Name</th>
                  <th scope="col">Account Number</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Postcode</th>
                  <th scope="col">Route</th>
		              <th scope="col">Sales REP</th>		              
		              <th scope="col">Area Name</th>
		              <th scope="col" width="100px" style="text-align: center;">Action</th>
		            </tr>
		          </thead>
		          <tbody id="shop_tbody">
                  <?php
                  $output_shop='';
                  $i=1;                  
                  if(count($shoplist)){
                    foreach ($shoplist as $shop) {
                      $route_details = DB::table('route')->where('route_id', $shop->route)->first();
                      $salesrep_details = DB::table('sales_rep')->where('user_id', $shop->sales_rep)->first();
                      $area_details = DB::table('area')->where('area_id', $shop->area_name)->first();
                      if($shop->status == 0){
                          $status = '<a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Deactive" style="color: #33CC66"><i class="fas fa-check deactive_class" data-element="'.base64_encode($shop->shop_id).'"></i></a>&nbsp;&nbsp;&nbsp;';
                      }
                      else{
                          $status = '<a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Active" style="color: #E11B1C"><i class="fas fa-times active_class" data-element="'.base64_encode($shop->shop_id).'"></i></a>&nbsp;&nbsp;&nbsp;';
                      }
                      if(count($route_details)){
                        $route = $route_details->route_name;
                      }
                      else{
                        $route='';
                      }
                      $output_shop.='
                      <tr>
                        <td>'.$i.'</td>
                        <td><a href="'.URL::to('admin/shop_view_details'.'/'.base64_encode($shop->shop_id)).'">'.$shop->shop_name.'</a></td>
                        <td>CC-'.$shop->shop_id.'</td>
                        <td>'.$shop->customer_name.'</td>
                        <td>'.$shop->postcode.'</td>
                        <td>'.$route.'</td>
                        <td>'.$salesrep_details->firstname.'</td>
                        <td>'.$area_details->area_name.'</td>
                       
                        <td align="center">
                          <a href="'.URL::to('admin/shop_review_commission?shop_id='.$shop->shop_id.'&type=completed').'" data-toggle="tooltip" data-placement="top" data-original-title="Shop Commission" ><i class="fas fa-arrow-right"></i></a>
                        </td>
                      </tr>';
                      $i++;
                    }                    
                  }
                  else{
                    $output_shop='
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td align="center">Empty</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    ';
                  }
                  echo $output_shop;
                  ?>
		          </tbody>
		        </table>
		    </div>
		</div>
	</div>
		</div>
	</div>
</div>                
<!-- /.content -->
<script type="text/javascript">
$(window).click(function(e) {

if($(e.target).hasClass("active_class")){
    var value = $(e.target).attr("data-element");
    $(".loading_css").addClass("loading"); 
    setTimeout(function() {
    $.ajax({
        url:"<?php echo URL::to('admin/shop_details')?>",
        dataType:'json',
        data:{id:value, type:1},
        type:"post",
        success: function(result)
        {
          $(".active_deactive_title").html(result['title']);
          $(".id_filed").val(result['id']);
          $(".active_deactive_content").html(result['content']);
          $(".status_filed").val(result['status']);
          $(".status_modal").modal('show');
          $(".loading_css").removeClass("loading");
        }
      })
    },500);
}
if($(e.target).hasClass("deactive_class")){
    var value = $(e.target).attr("data-element");
    $(".loading_css").addClass("loading"); 
    setTimeout(function() {
    $.ajax({
        url:"<?php echo URL::to('admin/shop_details')?>",
        dataType:'json',
        data:{id:value, type:2},
        type:"post",
        success: function(result)
        {
          $(".active_deactive_title").html(result['title']);
          $(".id_filed").val(result['id']);
          $(".active_deactive_content").html(result['content']);
          $(".status_filed").val(result['status']);
          $(".status_modal").modal('show');
          $(".loading_css").removeClass("loading");
        }
      })
    },500);
}
if($(e.target).hasClass("edit_icon")){
    var value = $(e.target).attr("data-element");
    var base_url = "<?php echo URL::to('/')?>"+'/';
    $(".loading_css").addClass("loading"); 
    setTimeout(function() {
    $.ajax({
        url:"<?php echo URL::to('admin/shop_details')?>",
        dataType:'json',
        data:{id:value, type:3},
        type:"post",
        success: function(result)
        {
          $(".id_filed").val(result['id']);
          $(".area_class_edit").val(result['area_name']);
          $(".area_class_edit").prop("disabled", true); 
          $(".salesrep_class_edit").prop("disabled", true);
          $(".route_class_edit").prop("disabled", true);         
          $(".salesrep_class_edit").html(result['output_salesrep']);
          $(".route_class_edit").html(result['output_route']);
          $(".shop_class").val(result['shop_name']);
          $(".customer_class").val(result['customer_name']);
          $(".payee_class").val(result['payee_name']);
          $(".address1_class").val(result['address1']);
          $(".address2_class").val(result['address2']);
          $(".address3_class").val(result['address3']);
          $(".city_class").val(result['city']);
          $(".postcode_class").val(result['postcode']);
          $(".phone_class").val(result['phone_number']);
          $(".payment_mode_class").val(result['payment_mode']);
          $(".shop_type_class").val(result['shop_type']);
          $(".potential_class").val(result['shop_potential']);
          $(".email_class").val(result['email_id']);
        	$(".edit_modal").modal("show");
          $("#tier_"+result['plan']).prop("checked",true);
          $(".loading_css").removeClass("loading");
        }
      })
    },500);
}






if($(e.target).hasClass("add_button_class")){
	$(".add_input").val('');  
  //$('label[.error]').hide();
  $(".salesrep_class").prop("checked", false);
  $(".route_class").prop("checked", false);
  $("#tier_add_zero").prop("checked",true);
	
}

if($(e.target).hasClass("search_shop_icon")){  
  var value = $(".search_shop").val();  
  if(value == ''){
    $("#shop_search-error").show();
  }
  else{
    $("#shop_search-error").hide();
    $(".loading_css").addClass("loading");
    setTimeout(function() {
      $("#data_table").dataTable().fnDestroy();
      $.ajax({
      url:"<?php echo URL::to('admin/search_common')?>",
      type:"post",
      dataType:"json",
      data:{value:value,type:1},
      success: function(result) { 
          $("#shop_tbody").html(result['output_shop']); 
          $('#data_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: false,
              paging: false,
              info: false
          });       
          $(".loading_css").removeClass("loading");        
        } 
      })
    },500);
  }
}

if($(e.target).hasClass("search_account_icon")){  
  var value = $(".search_account").val();  
  if(value == ''){
    $("#account_search-error").show();
  }
  else{
    $("#account_search-error").hide();
    $(".loading_css").addClass("loading");
    setTimeout(function() {
      $("#data_table").dataTable().fnDestroy();
      $.ajax({
      url:"<?php echo URL::to('admin/search_common')?>",
      type:"post",
      dataType:"json",
      data:{value:value,type:2},
      success: function(result) { 
          $("#shop_tbody").html(result['output_shop']); 
          $('#data_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: false,
              paging: false,
              info: false
          });       
          $(".loading_css").removeClass("loading");        
        } 
      })
    },500);
  }
}


if($(e.target).hasClass("search_postcode_icon")){  
  var value = $(".search_postcode").val();  
  if(value == ''){
    $("#postcode_search-error").show();
  }
  else{
    $("#postcode_search-error").hide();
    $(".loading_css").addClass("loading");
    setTimeout(function() {
      $("#data_table").dataTable().fnDestroy();
      $.ajax({
      url:"<?php echo URL::to('admin/search_common')?>",
      type:"post",
      dataType:"json",
      data:{value:value,type:3},
      success: function(result) { 
          $("#shop_tbody").html(result['output_shop']); 
          $('#data_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: false,
              paging: false,
              info: false
          });       
          $(".loading_css").removeClass("loading");        
        } 
      })
    },500);
  }
}



if($(e.target).hasClass("total_sim")){
  $(".loading_css").addClass("loading");
  setTimeout(function() {
    $("#sim_table").dataTable().fnDestroy();
    var value = $(e.target).attr("data-element");
    $.ajax({
        url:"<?php echo URL::to('admin/total_sim')?>",
        dataType:'json',
        data:{id:value, type:4},
        type:"post",
        success: function(result)
        {
          $(".output_import").html(result['output']);
          $(".sim_title").html(result['title']);
          $(".sim_modal").modal("show");
          $('#sim_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: true,
              paging: true,
              info: false
          });            
          $(".loading_css").removeClass("loading");
        }
      })
  },500);

}

if($(e.target).hasClass("active_sim")){
  $(".loading_css").addClass("loading");
  setTimeout(function() {
    $("#sim_table").dataTable().fnDestroy();
    var value = $(e.target).attr("data-element");
    $.ajax({
        url:"<?php echo URL::to('admin/active_sim')?>",
        dataType:'json',
        data:{id:value, type:4},
        type:"post",
        success: function(result)
        {
          $(".output_import").html(result['output']);
          $(".sim_title").html(result['title']);
          $(".sim_modal").modal("show");
          $('#sim_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: true,
              paging: true,
              info: false
          });            
          $(".loading_css").removeClass("loading");
        }
      })
  },500);

}

if($(e.target).hasClass("inactive_sim")){
  $(".loading_css").addClass("loading");
  setTimeout(function() {
    $("#sim_table").dataTable().fnDestroy();
    var value = $(e.target).attr("data-element");
    $.ajax({
        url:"<?php echo URL::to('admin/inactive_sim')?>",
        dataType:'json',
        data:{id:value, type:4},
        type:"post",
        success: function(result)
        {
          $(".output_import").html(result['output']);
          $(".sim_title").html(result['title']);
          $(".sim_modal").modal("show");
          $('#sim_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: true,
              paging: true,
              info: false
          });            
          $(".loading_css").removeClass("loading");
        }
      })
  },500);

}


})


$(window).change(function(e) {
if($(e.target).hasClass("area_class")){
  var id = $(e.target).val();
  $.ajax({
    url:"<?php echo URL::to('admin/shop_form_filter_area')?>",
    dataType:'json',
    data:{id:id},
    type:"post",
    success: function(result)
    {
      $(".salesrep_class").attr("disabled", false);
      $(".salesrep_class").html(result['output_salesrep']);
      $(".route_class").attr("disabled", true);
      $(".route_class").val('');
    }
  })  
}

if($(e.target).hasClass("salesrep_class")){
  var salerep_id = $(e.target).val();
  var area_id = $(".area_class").val();
  $.ajax({
    url:"<?php echo URL::to('admin/shop_form_filter_sales')?>",
    dataType:'json',
    data:{salerep_id:salerep_id,area_id:area_id},
    type:"post",
    success: function(result)
    {
      $(".route_class").attr("disabled", false);
      $(".route_class").html(result['output_route']);
    }
  })  
}


if($(e.target).hasClass("filter_area")){
  var id = $(e.target).val();
  $(".loading_css").addClass("loading"); 
  setTimeout(function() {
    $("#data_table").dataTable().fnDestroy(); 
    $.ajax({
      url:"<?php echo URL::to('admin/filter_for_shop')?>",
      dataType:'json',
      data:{id:id,type:1},
      type:"post",
      success: function(result)
      {
        $(".filter_sales_rep").prop("disabled", false);
        $(".filter_sales_rep").html(result['output_salesrep']);
        $(".filter_route").attr("disabled", true);
        $(".filter_route").val('');
        $("#shop_tbody").html(result['output_shop']); 
        $('#data_table').DataTable({        
            autoWidth: true,
            scrollX: false,
            fixedColumns: false,
            searching: false,
            paging: false,
            info: false
        });
        if(id ==''){
          $(".filter_sales_rep").attr("disabled", true);
          $(".filter_route").attr("disabled", true);
        }
        $(".loading_css").removeClass("loading");  
      }
    })  
  },500);
}

if($(e.target).hasClass("filter_sales_rep")){
  var salerep_id = $(e.target).val();
  var area_id = $(".filter_area").val();
  $(".loading_css").addClass("loading"); 
    setTimeout(function() {
    $("#data_table").dataTable().fnDestroy(); 
    $.ajax({
      url:"<?php echo URL::to('admin/filter_for_shop')?>",
      dataType:'json',
      data:{salerep_id:salerep_id,area_id:area_id,type:2},
      type:"post",
      success: function(result)
      {
        $(".filter_route").attr("disabled", false);
        $(".filter_route").html(result['output_route']);
        $("#shop_tbody").html(result['output_shop']); 
        $('#data_table').DataTable({        
            autoWidth: true,
            scrollX: false,
            fixedColumns: false,
            searching: false,
            paging: false,
            info: false
        });  
        if(salerep_id ==''){
          
          $(".filter_route").attr("disabled", true);
        }     
        $(".loading_css").removeClass("loading");
      }
    })  
  },500);
}

if($(e.target).hasClass("filter_route")){
  var route_id = $(e.target).val();
  var salerep_id = $(".filter_sales_rep").val();
  var area_id = $(".filter_area").val();
  $(".loading_css").addClass("loading"); 
  setTimeout(function() {
    $("#data_table").dataTable().fnDestroy(); 
    $.ajax({
      url:"<?php echo URL::to('admin/filter_for_shop')?>",
      dataType:'json',
      data:{salerep_id:salerep_id,area_id:area_id,route_id:route_id,type:3},
      type:"post",
      success: function(result)
      {      
        $("#shop_tbody").html(result['output_shop']); 
        $('#data_table').DataTable({        
            autoWidth: true,
            scrollX: false,
            fixedColumns: false,
            searching: false,
            paging: false,
            info: false
        });       
        $(".loading_css").removeClass("loading");
      }
    })  
  },500);
}







});


$(".search_shop").keypress(function( event ) {
  var value = $(this).val();
  if(event.which == 13 ) {
    if(value == ''){
      $("#shop_search-error").show();
    }
    else{
      $("#shop_search-error").hide();
      $(".loading_css").addClass("loading");
      setTimeout(function() {
        $("#data_table").dataTable().fnDestroy();
        $.ajax({
        url:"<?php echo URL::to('admin/search_common')?>",
        type:"post",
        dataType:"json",
        data:{value:value,type:1},
        success: function(result) { 
          $("#shop_tbody").html(result['output_shop']); 
          $('#data_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: false,
              paging: false,
              info: false
          });       
          $(".loading_css").removeClass("loading");        
        } 
      })
      },500);
    }    
  }  
})

$(".search_account").keypress(function( event ) {
  var value = $(this).val();
  if(event.which == 13 ) {
    if(value == ''){
      $("#account_search-error").show();
    }
    else{
      $("#account_search-error").hide();
      $(".loading_css").addClass("loading");
      setTimeout(function() {
        $("#data_table").dataTable().fnDestroy();
        $.ajax({
        url:"<?php echo URL::to('admin/search_common')?>",
        type:"post",
        dataType:"json",
        data:{value:value,type:2},
        success: function(result) { 
          $("#shop_tbody").html(result['output_shop']); 
          $('#data_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: false,
              paging: false,
              info: false
          });       
          $(".loading_css").removeClass("loading");        
        } 
      })
      },500);
    }    
  }  
})



$(".search_postcode").keypress(function( event ) {
  var value = $(this).val();
  if(event.which == 13 ) {
    if(value == ''){
      $("#postcode_search-error").show();
    }
    else{
      $("#postcode_search-error").hide();
      $(".loading_css").addClass("loading");
      setTimeout(function() {
        $("#data_table").dataTable().fnDestroy();
        $.ajax({
        url:"<?php echo URL::to('admin/search_common')?>",
        type:"post",
        dataType:"json",
        data:{value:value,type:3},
        success: function(result) { 
          $("#shop_tbody").html(result['output_shop']); 
          $('#data_table').DataTable({        
              autoWidth: true,
              scrollX: false,
              fixedColumns: false,
              searching: false,
              paging: false,
              info: false
          });       
          $(".loading_css").removeClass("loading");        
        } 
      })
      },500);
    }    
  }  
})


</script>

<script type="text/javascript">
$.ajaxSetup({async:false});
$('#add-form').validate({
    rules: {        	
    	area_name:{required: true},
      sales_rep:{required: true},
      route:{required: true},
      shop_name:{required: true},            
      address1:{required: true},
      city:{required: true},
      postcode:{required: true},
      
    },
    messages: {            	
    	area_name:{required:"Please Select Area"},
      sales_rep:{required:"Please Select Sales REP"},
      route:{required:"Please Select Route"},
      shop_name:{required:"Enter Shop Name"},
      address1:{required:"Enter Address"},
      city:{required:"Enter City"},
      postcode:{required:"Enter Postcode"},
    },
});
$.ajaxSetup({async:false});
$('#edit-form').validate({
    rules: {          
      area_name:{required: true},
      sales_rep:{required: true},
      route:{required: true},
      shop_name:{required: true},
      address1:{required: true},
      city:{required: true},
      postcode:{required: true},
    },
    messages: {             
      area_name:{required:"Please Select Area"},
      sales_rep:{required:"Please Select Sales REP"},
      route:{required:"Please Select Route"},
      shop_name:{required:"Enter Shop Name"},
      address1:{required:"Enter Address"},
      city:{required:"Enter City"},
      postcode:{required:"Enter Postcode"},      
    },
});

$.ajaxSetup({async:false});
$(".update_button").click(function(){
   if($("#edit-form").valid()){
    $("#edit-form").submit();
   }

})

$.ajaxSetup({async:false});
$(".add_new_button").click(function(){
   if($("#add-form").valid()){
    $("#add-form").submit();
   }

})


</script>
@stop