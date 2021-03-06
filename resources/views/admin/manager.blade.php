@extends('adminheader')
@section('content')
<!-- Content Header (Page header) -->

<div class="modal fade sim_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="min-width: 75%;">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title sim_title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                <table class="table table-striped" id="sim_table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Network Id</th>
                      <th scope="col">Product Id</th>                     
                      <th scope="col">SSN</th>
                      <th scope="col">Cli</th>
                      <th scope="col">Allocation Date</th>
                      <th scope="col">Sales Rep</th>
                      <th scope="col">Shop Name</th>
                      <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody class="output_import">
                  
                  
                </tbody>
            </table>
          </div>

                </div>
                <div class="modal-footer">                    
                    
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="add-form" method="post" action="<?php echo URL::to('admin/area_manager_add')?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title active_deactive_title" id="exampleModalLabel">Add New Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                	<div class="row">
                		<div class="col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom: 15px;">
                			<label>Choose Area</label>
                			<div class="row">

                				<?php
                				$output_area='';
                				if(count($arealist)){
                					foreach ($arealist as $area) {
                						$output_area.='
                						<div class="col-lg-3 col-md-6 col-sm-12 col-12">
		                					<label class="form_checkbox">'.$area->area_name.'
											   <input type="checkbox" value="'.$area->area_id.'" class="area_checkbox" style="width:1px; height:1px" name="area_checkbox[]"  required>
											   <span class="checkmark_checkbox"></span>
											</label>
		                				</div>                                        
                                        ';
                					}
                				}
                				else{
                					$output_area='<div class="col-lg-12">Empty</div>';
                				}
                				echo $output_area;
                				?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label id="area_checkbox[]-error" class="error" style="display: none;" for="area_checkbox[]" style="display: inline-block;">Please choose atleast one area</label>
                                </div>

                			</div>
                		</div>
                		<div class="col-lg-4 col-md-12 col-sm-12">
                			<div class="form-group">
		                    	<label>Enter First Name</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter First Name" required name="firstname">
		                    </div>
		                </div>
		                <div class="col-lg-4 col-md-12 col-sm-12">
		                    <div class="form-group">
		                    	<label>Enter Surname</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter Surname" required name="surename">
		                    </div>
		                </div>
		                <div class="col-lg-4 col-md-12 col-sm-12">
		                    <div class="form-group">
		                    	<label>Enter Personal Email ID</label>
		                    	<input type="email" class="form-control add_input" placeholder="Enter Personal Email ID" required name="personal_email">
		                    </div>		                    
                		</div>
                		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
		                    <div class="form-group">
		                    	<label>Address line 1</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter Address line 1" required  name="addressone">
		                    </div>
		                </div>
		                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
		                    <div class="form-group">
		                    	<label>Enter Address line 2</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter Address line 2" name="addresstwo">
		                    </div>
		                </div>
		                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
		                    <div class="form-group">
		                    	<label>Enter Address line 3</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter Address line 3" name="addressthree">
		                    </div>
		                </div>
		                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
		                    <div class="form-group">
		                    	<label>Enter City</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter City" required name="city">
		                    </div>
		                </div>
		                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
		                    <div class="form-group">
		                    	<label>Enter Postcode</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter Postcode" required name="postcode">
		                    </div>
		                </div>
		                <div class="col-lg-4 col-md-12 col-sm-12">
		                    <div class="form-group">
		                    	<label>Mobile Number</label>
		                    	<input type="number" maxlength="11" minlength="11" class="form-control add_input" placeholder="Mobile Number" required name="mobile">
		                    </div>
                		</div>
                		<div class="col-lg-4 col-md-12 col-sm-12">
                			<div class="form-group">
		                    	<label>Enter Username</label>
		                    	<input type="text" class="form-control add_input" placeholder="Enter Username" required name="email_id">
		                    </div>
		                 </div>
		                 <div class="col-lg-4 col-md-12 col-sm-12">
		                    <div class="form-group">
		                    	<label>Enter Password</label>
		                    	<input type="password" class="form-control add_input" placeholder="Enter Password" required name="password">
		                    </div>
		                </div>

                	</div>
                    
                    


                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary model_add_button">Add New</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="edit-form" method="post" action="<?php echo URL::to('admin/area_manager_update')?>">
                <div class="modal-header">
                    <h5 class="modal-title active_deactive_title" id="exampleModalLabel">Edit Area Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom: 15px;">
                      <label>Choose Area</label>
                      <div class="row area_class">

                        


                      </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                      <div class="form-group">
                          <label>Enter First Name</label>
                          <input type="text" class="form-control firstname_class" placeholder="Enter First Name" required name="firstname">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label>Enter Surname</label>
                          <input type="text" class="form-control surname_class" placeholder="Enter Surname" required name="surename">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label>Enter Personal Email ID</label>
                          <input type="email" class="form-control personal_email_class" placeholder="Enter Personal Email ID" required name="personal_email">
                        </div>                        
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <label>Address line 1</label>
                          <input type="text" class="form-control address1_class" placeholder="Enter Address line 1" required  name="addressone">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <label>Enter Address line 2</label>
                          <input type="text" class="form-control address2_class" placeholder="Enter Address line 2" name="addresstwo">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <label>Enter Address line 3</label>
                          <input type="text" class="form-control address3_class" placeholder="Enter Address line 3" name="addressthree">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <label>Enter City</label>
                          <input type="text" class="form-control city_class" placeholder="Enter City" required name="city">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <label>Enter Postcode</label>
                          <input type="text" class="form-control postcode_class" placeholder="Enter Postcode" required name="postcode">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label>Mobile Number</label>
                          <input type="number" maxlength="11" minlength="11" class="form-control mobile_class" placeholder="Mobile Number" required name="mobile">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                      <div class="form-group">
                          <label>Enter Username</label>
                          <input type="text" class="form-control email_class" placeholder="Enter Username" required name="email_id">
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label>Enter Password</label>
                          <input type="text" class="form-control" placeholder="Enter Password" required name="password">
                        </div>
                    </div>

                  </div>
                    
                    


                </div>
                <div class="modal-footer">
                    <input type="hidden" class="id_filed" name="id">
                    <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary model_add_button update_button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade status_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="<?php echo URL::to('admin/area_manager_status')?>">
                <div class="modal-header">
                    <h5 class="modal-title active_deactive_title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="sub_title3 active_deactive_content" style="line-height: 25px;"></div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" class="id_filed" value="" name="id">
                    <input type="hidden" class="status_filed" value="" name="status">
                    <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary model_add_button">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="col-lg-11 col-md-12 col-sm-12 col-12 offset-lg-1 right_panel">
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-6">
			<div class="main_title">Manage <span>Area Manager</span></div>
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
			<a href="javascript:" class="common_button float_right add_button_class" data-toggle="modal" data-target=".add_modal">Add New Manager</a>
		</div>
		<div class="col-lg-12">
			<div class="table-responsive">
		        <table class="table table-striped" id="data_table">
		          <thead class="thead-dark">
		            <tr>
		              <th scope="col">#</th>
		              <th scope="col">Name</th>
		              <th scope="col">Email Id / Username</th>
		              <th scope="col">Area Name</th>
		              <th scope="col">Total SIM</th>
                      <th scope="col">Active SIM</th>
		              <th scope="col">Inactive SIM</th>                                  
		              <th scope="col" width="100px" style="text-align: center;">Action</th>
		            </tr>
		          </thead>
		          <tbody>
                  <?php
                  $output_manager='';
                  $i=1;
                  if(count($userlist)){
                    foreach ($userlist as $user) {
                        $user_details = DB::table('area_manager')->where('user_id',$user->user_id)->first();
                        $explode_area = explode(',', $user_details->area);

                        $area_for_manager='';
                        if(count($explode_area)){
                            foreach ($explode_area as $area) {
                                $area_details = DB::table('area')->where('area_id', $area)->first();
                                if($area_for_manager == ''){
                                    $area_for_manager = $area_details->area_name;
                                }
                                else{
                                    $area_for_manager  = $area_details->area_name.', '.$area_for_manager;
                                }
                                
                            }
                        }
                        else{
                            $area_for_manager='';
                        }

                        if($user->status == 0){
                            $status = '<a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Deactive" style="color: #33CC66"><i class="fas fa-check deactive_class" data-element="'.base64_encode($user->user_id).'"></i></a>';
                        }
                        else{
                            $status = '<a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Active" style="color: #E11B1C"><i class="fas fa-times active_class" data-element="'.base64_encode($user->user_id).'"></i></a>';
                        }

                        $explode_area_sim = explode(',', $user_details->area);

                        $total_sim='';
                        $total_active_sim='';
                        $total_inactive_sim='';
                        /*if(count($explode_area_sim)){
                          foreach ($explode_area_sim as $area_sim) {
                            $total_sim_user = DB::table('sim_allocate')->where('area_id',$area_sim)->where('sim', '!=', '')->get();
                            if(count($total_sim_user)){
                              foreach ($total_sim_user as $sim_user) {
                                $explode_sim = explode(',', $sim_user->sim);
                                $total_sim = $total_sim+count($explode_sim);

                                if(count($explode_sim)){
                                  foreach ($explode_sim as $sim) {

                                    $active_sim = DB::table('sim')->where('id',$sim)->where('activity_date', '!=', '0000-00-00')->where('shop_id', $sim_user->shop_id)->first();

                                    $inactive_sim = DB::table('sim')->where('id',$sim)->where('activity_date', '0000-00-00')->where('shop_id', $sim_user->shop_id)->first();

                                    if(count($active_sim)){
                                      $total_active_sim = $total_active_sim+1 ;
                                    }

                                    if(count($inactive_sim)){
                                      $total_inactive_sim = $total_inactive_sim+1 ;
                                    }

                                  }                              
                                }
                                
                              }
                            }
                            


                          }
                        }*/



                        $output_manager.='
                        <tr>
                          <td>'.$i.'</td>
                          <td>'.$user_details->firstname.'</td>
                          <td>'.$user->email_id.'</td>
                          <td>'.$area_for_manager.'</td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center">
                          <a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Edit Area" ><i class="far fa-edit edit_icon" data-element="'.base64_encode($user->user_id).'"></i></a>&nbsp;&nbsp;&nbsp;    
                          '.$status.'
                          </td>
                        </tr>
                        ';
                        $i++;
                    }
                  }
                  else{
                    $output_manager='
                    <tr>
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
                  echo $output_manager;
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
  $(".loading_css").addClass("loading");
  var value = $(e.target).attr("data-element");
  setTimeout(function() {  
    $.ajax({
        url:"<?php echo URL::to('admin/area_manager_details')?>",
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
  $(".loading_css").addClass("loading");
  var value = $(e.target).attr("data-element");
  setTimeout(function() {
    $.ajax({
        url:"<?php echo URL::to('admin/area_manager_details')?>",
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
  $(".loading_css").addClass("loading");
  setTimeout(function() {
    var value = $(e.target).attr("data-element");
    var base_url = "<?php echo URL::to('/')?>"+'/';
    $.ajax({
        url:"<?php echo URL::to('admin/area_manager_details')?>",
        dataType:'json',
        data:{id:value, type:3},
        type:"post",
        success: function(result)
        {
          $(".id_filed").val(result['id']);
          $(".firstname_class").val(result['firstname']);
          $(".surname_class").val(result['surname']);
          $(".personal_email_class").val(result['personal_email']);
          $(".address1_class").val(result['address1']);
          $(".address2_class").val(result['address2']);
          $(".address3_class").val(result['address3']);
          $(".city_class").val(result['city']);
          $(".postcode_class").val(result['postcode']);
          $(".mobile_class").val(result['mobile_number']);
          $(".email_class").val(result['email_id']);
          $(".area_class").html(result['output_area']);
        	$(".edit_modal").modal("show");
          $(".loading_css").removeClass("loading");
        }
      })
  },500);
}


if($(e.target).hasClass("total_sim")){
  $(".loading_css").addClass("loading");
  setTimeout(function() {
  $("#sim_table").dataTable().fnDestroy();
  var value = $(e.target).attr("data-element");
  $.ajax({
      url:"<?php echo URL::to('admin/total_sim')?>",
      dataType:'json',
      data:{id:value, type:1},
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
      data:{id:value, type:1},
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
        data:{id:value, type:1},
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




if($(e.target).hasClass("add_button_class")){
	$(".add_input").val('');  
  //$('label[.error]').hide();
  $(".area_checkbox").prop("checked", false);
	
}



})
</script>

<script type="text/javascript">
$.ajaxSetup({async:false});
$('#add-form').validate({
    rules: {    
    	"area_checkbox[]":{required: true},
    	firstname:{required: true},        	
    	surename:{required: true},
    	personal_email:{required: true},    	
    	addressone:{required: true},
    	city:{required: true},
    	postcode:{required: true},
      mobile:{required: true},
      email_id: {required: true, remote:"<?php echo URL::to('admin/users_email_check')?>"},
      password:{required: true},      
    },
    messages: {        
    	"area_checkbox[]":{required:"Please choose atleast one area"},
    	firstname:{required:"Enter First Name"},
    	surename:{required:"Enter Sure Name"},    	
    	personal_email:{required:"Enter Personal Email Id"},
    	addressone:{required:"Enter Address"},
    	city:{required:"Enter City"},
    	postcode:{required:"Enter Postcode"},
      mobile:{required:"Enter Mobile Number"},
      email_id : {
          required : "Enter Username",
          remote : "Username is already exists",
      },
      password:{required:"Enter Password"},
    },
});
$.ajaxSetup({async:false});
$('#edit-form').validate({
    rules: {
    	"edit_area_checkbox[]":{required: true},
      firstname:{required: true},         
      surename:{required: true},
      personal_email:{required: true},      
      addressone:{required: true},
      city:{required: true},
      postcode:{required: true},
      mobile:{required: true},
      email_id : {required: true, remote: { url:"<?php echo URL::to('admin/users_email_check')?>", 
                  data: {'user_id':function(){return $('.id_filed').val()}},
                  async:false 
              },
          },
      password:{required: false},            
        
    },
    messages: {
    	"edit_area_checkbox[]":{required:"Please choose atleast one area"},
      firstname:{required:"Enter First Name"},
      surename:{required:"Enter Sure Name"},      
      personal_email:{required:"Enter Personal Email Id"},
      addressone:{required:"Enter Address"},
      city:{required:"Enter City"},
      postcode:{required:"Enter Postcode"},
      mobile:{required:"Enter Mobile Number"},
      email_id: {
          required : "Enter Username",
          remote : "Username is already exists",
      },
      password:{required:"Enter Password"},  
    },
});

$.ajaxSetup({async:false});
$(".update_button").click(function(){
   if($("#edit-form").valid()){
    $("#edit-form").submit();
   }

})


</script>
@stop