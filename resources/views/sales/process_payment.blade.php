@extends('salesheader')
@section('content')
<style type="text/css">
.heading_class{width: 100%; color: #f26e46; text-align: left; }
.heading_class:hover{text-decoration: none; color: #f26e46;}
.card_header_class{padding: 5px; border-radius: 0px; }
.card_class{border-radius:0px; margin-bottom: 2px; box-shadow: none; }
.card_body_class{padding: 3px;}
.own_table td{padding: 8px; font-size: 13px;}
.own_table th{font-size: 13px;}

</style>
<!-- Content Header (Page header) -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-12 sales_right_panel">
	<div class="row">
		<div class="col-lg-9 col-sm-9 col-8">
			<div class="main_title">Accessories for
				<span> 
					<?php 
					$id= base64_decode($shop_id);
					$shop_details = DB::table('shop')->where('shop_id', $id)->first();
					echo $shop_details->shop_name;
					?>
				</span>
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-4 text-right" style="padding-top: 20px;">
	      <div class="dropdown">
	        <button class="btn btn-secondary common_button dropdown-toggle" style="border-radius: 0px; border: 0px; padding: 5px 10px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Menu
	        </button>
	        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	          <a class="dropdown-item" href="<?php echo URL::to('sales/shop_view_details/'.$shop_id)?>">Shop Details</a>
	          <a class="dropdown-item" href="<?php echo URL::to('sales/accessories/'.$shop_id)?>">Accessories order</a>
	          <a class="dropdown-item" href="<?php echo URL::to('sales/order_process/'.$shop_id)?>">View Cart</a>	          
	          <a class="dropdown-item" href="<?php echo URL::to('sales/order_history/'.$shop_id)?>">Order History</a>
	        </div>
	      </div>
	    </div>
	</div>
	<form method="post" action="<?php echo URL::to('sales/order_confirm')?>">	
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

			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<input type="hidden" id="shop_id" value="<?php echo $shop_id?>" name="shop_id" readonly>
				<input type="hidden" value="<?php echo $order_type?>" id="order_type" name="order_type" readonly>
				<?php
				if($type == 1){
					$type_title = 'Inhand Orders';
					$invoice = 'block';
					$invoice_id = '1';
				}
				else{
					$type_title = 'Online Orders';
					$invoice = 'none';
					$invoice_id = '0';
				}
				?>
				<h5><?php echo $type_title ?></h5>
				
				<?php
				$sub_total='';
		        $output='<div class="table-responsive">
	          		<table class="own_table">
	          			<thead>
	          				<tr>
	          					<th>Product</th>
	          					<th>Quantity</th>
	          					<th style="min-width:90px">Price</th>		          					
	          					<th style="min-width:70px;">Total</th>          					
	          				</tr>
	          			</thead><tbody>';
		        if(count($orderlist)){
		        	foreach ($orderlist as $order ) {	        		
		        			$product_details = DB::table('products')->where('product_id', $order->products_id)->first();
		        			$output.='
		        			<tr class="row_class_'.base64_encode($order->process_id).'">
		        				<td>'.$product_details->product_name.'</td>
		        				<td>
		        				'.$order->qty.'
		        				<input type="hidden" min="1" value="'.$order->qty.'" readonly class="qty_value form-control" style="max-width:80px; float:left" />	        				
		        					
		        				</td>
		        				<td>&#163; '.number_format_invoice($order->price).'</td>
		        				<td>&#163; '.number_format_invoice($order->total).'</td>       				

		        			</tr>';
		        			$sub_total = $sub_total+$order->total;
		        	}
		        	$button_display='block';
		        	$admin_setting = DB::table('admin')->first();
		        	$vat = $admin_setting->vat_percentage;
		        	$vat_value = ($sub_total*$vat)/100;

		        	$total = $sub_total+$vat_value;

		        	$output.='
		        	<tr>
		        		<td></td>
		        		<td></td>
		        		<td align="right"><b>Sub Total:<b></td>
		        		<td>&#163; <span class="sub_total">'.number_format_invoice($sub_total).'</span>
		        		<input type="hidden" id="sub_total_class" value="'.$sub_total.'" readonly>
		        		</td>
		        	</tr>
		        	<tr class="vat_row">
		        		<td></td>
		        		<td></td>
		        		<td align="right"><b>VAT:<b></td>
		        		<td>&#163; '.number_format_invoice($vat_value).'</td>
		        	</tr>
		        	<tr class="total_row">
		        		<td></td>
		        		<td></td>
		        		<td align="right"><b>Total:<b></td>
		        		<td>&#163; <span class="total">'.number_format_invoice($total).'</spa>
		        		
		        		</td>
		        	</tr>
		        	<tr class="discount_row" >
		        		<td></td>
		        		<td></td>
		        		<td align="right"><b>Discount:<b></td>
		        		<td>&#163; <span class="discount_span"></span></td>
		        	</tr>
		        	<tr class="grand_row" >
		        		<td></td>
		        		<td></td>
		        		<td align="right"><b>Grand Total:<b></td>
		        		<td>&#163; <span class="grand_span">'.number_format_invoice($total).'</span>
		        		<input type="hidden" class="grand_input" readonly value="'.$total.'" />
		        		</td>
		        	</tr>

		        	</tbody></table></div>';
		        }
		        else{
		        	$output='<div class="col-lg-12 text-center"><b>Cart is Empty</b></div>';
		        	$button_display='none';
		        }
		        echo $output;
		        ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-12 margin_top_20" style="display: <?php echo $button_display?>">
			<select class="form-control coupon_class required" name="coupon_id">
				
				<?php
				$output_coupon='<option value="0">Select Coupon</option>';
				if(count($coupon_list)){
					foreach ($coupon_list as $coupon) {
						$current_date = date('Y-m-d');
						$current_str = strtotime($current_date);
						$validation = strtotime($coupon->coupon_date);

						if($validation >= $current_str){
							$output_coupon.='<option value="'.$coupon->coupon_id.'">'.$coupon->coupon_name.'</option>';
						}					
					}
				}
				else{
					$output_coupon='<option value="">Select Coupon</option>';
				}
				echo $output_coupon;
				?>
				
			</select>
			<label class="error coupon_label" style="display: none;">Please select coupon</label>
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 margin_top_20 commission_bonus" style="display: <?php echo $button_display?>">
			<div class="row">
				<div class="col-lg-2 col-md-4 col-sm-6 col-6">
					<label class="form_checkbox">Commission
					   <input type="checkbox" value="0" class="class_commission commission_bonus_class"  style="width:1px; height:1px" name="payment_type">
					   <span class="checkmark_checkbox"></span>
					</label>
				</div>
				<div class="col-lg-2 col-md-4 col-sm-6 col-6">
					<label class="form_checkbox">Bonus
					   <input type="checkbox" value="0" class="class_bonus commission_bonus_class" style="width:1px; height:1px" name="payment_type" >
					   <span class="checkmark_checkbox"></span>
					</label>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<label class="error commission_bonus_label" style="margin-bottom: 15px; display: none"></label>
				</div>
				<input type="hidden" class="commission_or_bonus" value="0" name="commission_or_bonus" readonly>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 margin_top_20">
			<div class="table-responsive">
				<table class="own_table result_table">
					
				</table>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center" style="margin-bottom: 50px; display: <?php echo $button_display?>">
			<input type="submit" value="Order Confirm" name="" class="common_button" style="font-size: 25px; float: left; width: 100%; cursor: pointer; border: 0px;">
		</div>	
</div>
</form>
		
		
	</div>
</div>              
<!-- /.content -->
<script>
$(window).click(function(e) {

/*if($(e.target).hasClass("invoice_class")){	
	if($(e.target).is(":checked")){
		$("#invoice").val('2');
		$(".vat_row").hide();
		$(".total_row").hide();
	}
	else{
		$("#invoice").val('1');		
		$(".vat_row").show();
		$(".total_row").show();
	}
	$(".discount_span").html('');
	$(".grand_span").html('');
	$(".coupon_class").val('');
}*/

if($(e.target).hasClass("class_commission")){	
	if($(e.target).is(":checked")){
		$(e.target).val('1');
	}
	else{
		$(e.target).val('0');
	}	
}
if($(e.target).hasClass("class_bonus")){	
	if($(e.target).is(":checked")){
		$(e.target).val('2');
	}
	else{
		$(e.target).val('0');
	}	
}

if($(e.target).hasClass("apply_button")){
	var coupon = $(".coupon_class").val();
	if(coupon == ''){
		$(".coupon_label").show();
		
	}
	else{
		$(".coupon_label").hide();
		
		$(".coupon_class").attr("style", "pointer-events: none;");
		$(".coupon_class").attr("readonly", 'readonly');
		/*$(".invoice_class").attr('disabled', 'disabled');
		$(".invoice_class").attr("readonly", 'readonly');
		$(".checkmark_checkbox").attr("style", "background-color:#e9ecef");*/
	}
}

if($(e.target).hasClass("commission_bonus_class")){
	var commission = $(".class_commission").val();
	var bonus = $(".class_bonus").val();
	var shop_id = $("#shop_id").val();
	var grand = $(".grand_input").val();

	$(".loading_css").addClass("loading");
	$.ajax({
		url:"<?php echo URL::to('sales/commission_bonus_check')?>",
		type:"post",
		dataType:"json",
		data:{commission:commission, bonus:bonus, shop_id:shop_id, grand:grand},
		success:function(result){
			if(result['type'] == '0'){
				$(".commission_bonus_label").html(result['output']);
				$(".commission_bonus_label").show();
			}
			else{
				$(".commission_bonus_label").hide();
				$(".result_table").html(result['output']);			
			}
			$(".commission_or_bonus").val(result['type']);
			$(".loading_css").removeClass("loading");
		}
	})
	
}





})
$(window).change(function(e) {

if($(e.target).hasClass("coupon_class")){	
	var coupon_id = $(e.target).val();
	$(".result_table").html('');
	$(".commission_or_bonus").val('0');
	$(".commission_bonus_class").attr("checked", false);

	if(coupon_id == '0'){
		$(".coupon_label").show();
	}
	else{
		$(".coupon_label").hide();
		var shop_id = $("#shop_id").val();
		var order_type = $("#order_type").val();
		var invoice = $("#invoice").val();
		var sub_total = $("#sub_total_class").val();
		$(".loading_css").addClass("loading");
		$.ajax({
			url:"<?php echo URL::to('sales/coupon_discount')?>",
			type:"post",
			dataType:"json",
			data:{coupon_id:coupon_id, shop_id:shop_id, invoice:invoice, order_type:order_type, sub_total:sub_total},
			success:function(result){
				$(".discount_span").html(result['discount']);
				$(".grand_span").html(result['grand_total']);
				$(".grand_input").val(result['grand_total_class']);
				$(".loading_css").removeClass("loading");
			}
		})
		
	}

	
}

})
</script>
@stop