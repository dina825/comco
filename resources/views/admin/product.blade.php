@extends('adminheader')
@section('content')
<!-- Content Header (Page header) -->
<div class="modal fade add_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
      <form method="post" action="<?php echo URL::to('admin/product_add')?>"  enctype="multipart/form-data" id="add-form">
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">                    
      						<div class="form-group">
      						    <label>Enter Product Name</label>
      						    <input type="text" class="form-control add_input" name="name" required placeholder="Enter Product Name">
      						</div>

                  

                  <div class="form-group">
                      <label>Select Product Image</label>
                      <input type="file" class="form-control add_input" style="line-height: 18px;" name="picture" required placeholder="Select Product Image" accept="image/*" >
                      <span style="font-size: 12px; color: #f00">Notes: Prodcut Image Width:800px, Height:800px</span>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12"> 

                  <div class="form-group">
                      <label>Select Category</label>
                      <select class="form-control add_input" required name="category">
                        <?php
                        $output_category='<option value="">Please Select Category</option>';
                        $categorylist = DB::table('category')->get();
                        if(count($categorylist)){
                          foreach ($categorylist as $category) {
                            $output_category.='<option value="'.$category->category_id.'">'.$category->category_name.'</option>';
                          }
                        }
                        else{
                          $output_category='<option value="">No Category</option>';
                        }
                        echo $output_category;
                        ?>
                      </select>                      
                  </div>


                  <div class="form-group">
                      <label>Enter Quantity</label>
                      <input type="number" class="form-control add_input" name="qty" required placeholder="Enter Quantity">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <label style="font-style: 20px; font-weight: bold;">Price</label>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="line-height: 30px;">
                      <b>Plan 1</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Start Qty</label>
                        <input type="number" class="form-control plan1_start_class" required min="1" placeholder="Start Qty" name="plan1_start" readonly value="1">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>End Qty</label>
                        <input type="number" class="form-control add_input plan1_end_class" required min="2" placeholder="End Qty" name="plan1_end">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control add_input" required min="0"  placeholder="Price" name="plan1_price">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="line-height: 30px;">
                      <b>Plan 2</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Start Qty</label>
                        <input type="number" class="form-control add_input plan2_start_class" required placeholder="Start Qty" name="plan2_start" readonly>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>End Qty</label>
                        <input type="number" class="form-control add_input plan2_end_class" required placeholder="End Qty" name="plan2_end">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control add_input" required min="0" placeholder="Price" name="plan2_price">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="line-height: 30px;">
                      <b>Plan 3</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Above Qty</label>
                        <input type="number" class="form-control add_input plan3_above_class" required placeholder="Above Qty" name="plan3_above" readonly>
                      </div>
                    </div>                    
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control add_input" required min="0" placeholder="Price" name="plan3_price">
                      </div>
                    </div>
                  </div>

                  

                  <div class="form-group">
                      <label>Enter Description</label>
                      <textarea class="form-control add_input" style="min-height: 150px;" required placeholder="Enter Description" name="description"></textarea>                      
                  </div>
      				  </div>                                      
            </div>                
      </div>
      <div class="modal-footer">       
        <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn model_add_button add_button">Add New</button>
      </div>
      </form>
    </div>
  
  </div>
</div>

<div class="modal fade edit_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
      <form method="post" action="<?php echo URL::to('admin/product_update')?>"  enctype="multipart/form-data" id="edit-form">
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
            <div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
      						<div class="form-group">
      						    <label>Enter Product Name</label>
      						    <input type="text" class="form-control class_name" name="name" required placeholder="Enter Product Name">
      						</div>                  
                  <div class="form-group">
                      <label>Select Product Image</label>
                      <input type="file" class="form-control" style="line-height: 18px;" name="picture" placeholder="Select Product Image" accept="image/*">
                      <span style="font-size: 11px; color: #f00">Notes: Prodcut Image Width:800px, Height:800px</span>
                  </div>                

      				</div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                      <label>Select Category</label>
                      <select class="form-control class_category" required name="category">
                        <?php
                        $output_category='<option value="">Please Select Category</option>';
                        $categorylist = DB::table('category')->get();
                        if(count($categorylist)){
                          foreach ($categorylist as $category) {
                            $output_category.='<option value="'.$category->category_id.'">'.$category->category_name.'</option>';
                          }
                        }
                        else{
                          $output_category='<option value="">No Category</option>';
                        }
                        echo $output_category;
                        ?>
                      </select>                      
                  </div>

                  <div class="form-group">
                      <label>Enter Quantity</label>
                      <input type="number" class="form-control class_qty" name="qty" required placeholder="Enter Quantity">
                  </div>
              </div>

              

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <label style="font-style: 20px; font-weight: bold;">Price</label>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="line-height: 30px;">
                      <b>Plan 1</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Start Qty</label>
                        <input type="number" readonly class="form-control plan1_start_class" required min="1" placeholder="Start Qty" name="plan1_start">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>End Qty</label>
                        <input type="number" class="form-control plan1_end_class" required min="2" placeholder="End Qty" name="plan1_end">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control plan1_price_class" required min="0"  placeholder="Price" name="plan1_price">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="line-height: 30px;">
                      <b>Plan 2</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Start Qty</label>
                        <input type="number" readonly class="form-control plan2_start_class" required min="1" placeholder="Start Qty" name="plan2_start">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>End Qty</label>
                        <input type="number" class="form-control plan2_end_class" required min="1" placeholder="End Qty" name="plan2_end">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control plan2_price_class" required min="0" placeholder="Price" name="plan2_price">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="line-height: 30px;">
                      <b>Plan 3</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Above Qty</label>
                        <input type="number" readonly class="form-control plan3_above_class" required min="1" placeholder="Above Qty" name="plan3_above">
                      </div>
                    </div>                    
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control plan3_price_class" required min="0" placeholder="Price" name="plan3_price">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="form-group">
                        <img src="" class="class_picture" width="100%;" style="margin-bottom: 20px;">
                      </div>
                    </div>
                  </div>
                </div> 

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="form-group">
                      <label>Enter Description</label>
                      <textarea class="form-control class_description" style="min-height: 150px;" required placeholder="Enter Description" name="description"></textarea>                      
                  </div>
                </div>
                


            </div>                
      </div>
      <div class="modal-footer">       
      	<input type="hidden" class="class_id" name="id">
        <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn model_add_button update_button">Update</button>
      </div>
      </form>
    </div>
  
  </div>
</div>



<div class="modal fade status_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="<?php echo URL::to('admin/product_status')?>">
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
			<div class="main_title">Manage <span>Products</span></div>
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

		<div class="col-lg-12 text-left">
			<a href="#" class="common_button float_right add_button_class" data-toggle="modal" data-target=".add_model">Add New Product</a>
      <div class="dropdown dropdown_admin">
        <button class="btn btn-secondary common_button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="<?php echo URL::to('admin/accessories')?>">Dashboard</a>
          <a class="dropdown-item" href="<?php echo URL::to('admin/manage_category')?>">Manage Category</a>
          <a class="dropdown-item" href="<?php echo URL::to('admin/manage_products')?>">Manage Products</a>          
          <a class="dropdown-item" href="<?php echo URL::to('admin/order_history')?>">Manage Orders</a>
          <a class="dropdown-item" href="<?php echo URL::to('admin/manage_coupon')?>">Manage Coupon</a>
          <a class="dropdown-item" href="<?php echo URL::to('admin/accessories_salesrep')?>">Sales REP</a>
          <a class="dropdown-item" href="<?php echo URL::to('admin/accessories_setting')?>">Setting</a>
        </div>
      </div>
		</div>
		<div class="col-lg-12">
			<div class="table-responsive">
		        <table class="table table-striped" id="data_table">
		          <thead class="thead-dark">
		            <tr>
		              <th scope="col" style="width: 100px;">#</th>
		              <th scope="col">Product Name</th>
                  <th scope="col">Category</th>                  
                  <th scope="col">Quantity</th>                  
		              <th scope="col" width="100px" style="text-align: center;">Action</th>
		            </tr>
		          </thead>
		          <tbody>

		          	<?php
		          	$output='';
		          	$i=1;
		          	if(count($product_list)){
		          		foreach ($product_list as $product) {
		          			if($product->status == 0){
		          				$status = '<a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Deactive" style="color: #33CC66"><i class="fas fa-check deactive_class" data-element="'.base64_encode($product->product_id).'"></i></a>';
		          			}
		          			else{
		          				$status = '<a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Active" style="color: #E11B1C"><i class="fas fa-times active_class" data-element="'.base64_encode($product->product_id).'"></i></a>';
		          			}

                    $category = DB::table('category')->where('category_id', $product->category_id)->first();

                    


		          			$output.='
		          			<tr>
				          		<td>'.$i.'</td>
				          		<td>'.$product->product_name.'</td>
                      <td>'.$category->category_name.'</td>
                      
                      <td>'.$product->qty.'</td>
				          		<td align="center">
				          		<a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Edit Product" ><i class="far fa-edit edit_icon" data-element="'.base64_encode($product->product_id).'"></i></a>&nbsp;&nbsp;&nbsp;				          		
				          		'.$status.'
				          		</td>
				          	</tr>
		          			';
		          			$i++;
		          		}
		          	}
		          	else{
		          		$output.='<tr>
					          		<td></td>					          		
					          		<td align="center">Empty</td>					          							          		
					          		<td></td>
					          	</tr>';
		          	}
		          	echo $output;
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
  setTimeout(function() {
    var value = $(e.target).attr("data-element");
    $.ajax({
        url:"<?php echo URL::to('admin/product_details')?>",
        dataType:'json',
        data:{id:value, type:1},
        type:"post",
        success: function(result)
        {
          $(".active_deactive_title").html(result['title']);
          $(".id_filed").val(result['id']);
          $(".active_deactive_content").html(result['content']);
          $(".status_filed").val(result['status']);
          $(".status_model").modal('show');
          $(".loading_css").removeClass("loading");
        }
      })
  },500);
}
if($(e.target).hasClass("deactive_class")){
  $(".loading_css").addClass("loading");
  setTimeout(function() {
    var value = $(e.target).attr("data-element");
    $.ajax({
        url:"<?php echo URL::to('admin/product_details')?>",
        dataType:'json',
        data:{id:value, type:2},
        type:"post",
        success: function(result)
        {
          $(".active_deactive_title").html(result['title']);
          $(".id_filed").val(result['id']);
          $(".active_deactive_content").html(result['content']);
          $(".status_filed").val(result['status']);
          $(".status_model").modal('show');
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
        url:"<?php echo URL::to('admin/product_details')?>",
        dataType:'json',
        data:{id:value, type:3},
        type:"post",
        success: function(result)
        {
        	$(".class_id").val(result['id']);
        	$(".class_name").val(result['name']);
          $(".class_category").val(result['category']);
          $(".class_price").val(result['price']);
          $(".class_discount").val(result['discount']);
          $(".class_description").val(result['description']);
          $(".class_qty").val(result['qty']);

          $(".plan1_start_class").val(result['plan1_start']);
          $(".plan1_end_class").val(result['plan1_end']);
          $(".plan1_price_class").val(result['plan1_price']);

          $(".plan2_start_class").val(result['plan2_start']);
          $(".plan2_end_class").val(result['plan2_end']);
          $(".plan2_price_class").val(result['plan2_price']);

          $(".plan3_above_class").val(result['plan3_above']);          
          $(".plan3_price_class").val(result['plan3_price']);


          $(".class_picture").attr("src", base_url+result['picture']);
          $(".edit_model").modal("show");
          $(".loading_css").removeClass("loading");
        }
      })
    },500);
}




if($(e.target).hasClass("add_button_class")){
  $(".add_input").val('');  
  
}


})






$('.plan1_end_class').on("input", function() {
  var value = parseInt($(this).val()) + parseInt(1);  
  var value2 = parseInt(value) + parseInt(1);
  var value3 = parseInt(value2) + parseInt(1);
  $(".plan2_start_class").val(value);
  $(".plan2_end_class").val(value2);
  $(".plan3_above_class").val(value3);

  $(".plan2_end_class").attr({"min" : value2});
});

$('.plan2_end_class').on("input", function() {
  var value = parseInt($(this).val()) + parseInt(1);  
  $(".plan3_above_class").val(value);
});
</script>

<script type="text/javascript">


$.ajaxSetup({async:false});
$('#add-form').validate({
    rules: {        
        name : {required: true},
        category : {required: true},
        picture : {required: true},          
        description : {required: true},
        qty : {required: true},
        plan1_start : {required: true},
        plan1_end : {required: true},
        plan1_price : {required: true},
        plan2_start : {required: true},
        plan2_end : {required: true},
        plan2_price : {required: true},
        plan3_above : {required: true},
        plan3_price : {required: true},
    },
    messages: {        
        name : {required : "Enter Product Name"},
        category : {required : "Select Category"},
        picture : {required : "Select Product Image"},        
        description : {required : "Enter Description"},
        qty : {required : "Enter Quantity"},
        plan1_start : {required : "Enter Plan 1 Start Value"},
        plan1_end : {required : "Enter Plan 1 End Value"},
        plan1_price : {required : "Enter Plan 1 Price"},
        plan2_start : {required : "Enter Plan 2 Start Value"},
        plan2_end : {required : "Enter Plan 2 End Value"},
        plan2_price : {required : "Enter Plan 2 Price"},
        plan3_above : {required : "Enter Plan 3 Value"},
        plan3_price : {required : "Enter Plan 3 Price"},
    },
});
$.ajaxSetup({async:false});
$('#edit-form').validate({
    rules: {        
        name : {required: true},
        category : {required: true},
        
        description : {required: true},
        qty : {required: true},
        plan1_start : {required: true},
        plan1_end : {required: true},
        plan1_price : {required: true},
        plan2_start : {required: true},
        plan2_end : {required: true},
        plan2_price : {required: true},
        plan3_above : {required: true},
        plan3_price : {required: true},
    },
    messages: {        
        name : {required : "Enter Product Name"},
        category : {required : "Select Category"},
        
        description : {required : "Enter Description"},
        qty : {required : "Enter Quantity"},
        plan1_start : {required : "Enter Plan 1 Start Value"},
        plan1_end : {required : "Enter Plan 1 End Value"},
        plan1_price : {required : "Enter Plan 1 Price"},
        plan2_start : {required : "Enter Plan 2 Start Value"},
        plan2_end : {required : "Enter Plan 2 End Value"},
        plan2_price : {required : "Enter Plan 2 Price"},
        plan3_above : {required : "Enter Plan 3 Value"},
        plan3_price : {required : "Enter Plan 3 Price"},
    },
});

</script>
@stop