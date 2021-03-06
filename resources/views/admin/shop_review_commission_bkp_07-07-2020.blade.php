@extends('adminheader')
@section('content')
<!-- Content Header (Page header) -->
<style type="text/css">
.input_rate{width: 100%; float:left; padding: 5px; }

</style>
<div class="modal fade release_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm ">
    <div class="modal-content">
      <form method="post" action="<?php echo URL::to('admin/release_cheque')?>"  enctype="multipart/form-data" id="release-form">
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Release Commission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">                    
      						<div class="form-group">
      						    <label>Select Sales REP</label>
      						    <select class="form-control" required name="salesrep">
      						    	
      						    	<?php
      						    	$output_salesrep='<option value="">Select Sales Rep</option>';
      						    	$route_details = DB::table('route')->where('route_id', $shop_details->route)->first();
      						    	$explode_salesrep = explode(',', $route_details->sales_rep_id);
      						    	if(count($explode_salesrep)){
      						    		foreach ($explode_salesrep as $salesrep) {
      						    			$salesrep_details = DB::table('sales_rep')->where('user_id', $salesrep)->first();
      						    			$output_salesrep.='<option value="'.$salesrep_details->user_id.'">'.$salesrep_details->firstname.' '.$salesrep_details->surname.'</option>';
      						    		}
      						    	}
      						    	else{
      						    		$output_salesrep='<option value="">No Sales REP</option>';
      						    	}

      						    	echo $output_salesrep;

      						    	?>
      						    </select>
      						</div>
      						<div class="form-group">
      						    <label>Enter Amount</label>
      						    <input type="number" class="form-control" placeholder="Enter Amount" name="amount">
      						    <input type="text" value="<?php echo base64_encode($shop_details->shop_id)?>" name="shop_id">
      						</div>
      				  </div>                                      
            </div>                
      </div>
      <div class="modal-footer">       
        <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn model_add_button add_button">Release</button>
      </div>
      </form>
    </div>
  
  </div>
</div>

<div class="modal fade release_edit_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm ">
    <div class="modal-content">
      <form method="post" action="<?php echo URL::to('admin/release_cheque_update')?>"  enctype="multipart/form-data" id="release-edit-form">
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Release Commission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">                    
      						<div class="form-group">
      						    <label>Select Sales REP</label>
      						    <select class="form-control salesrep_class" required name="salesrep">
      						    	
      						    	<?php
      						    	$output_salesrep='<option value="">Select Sales Rep</option>';
      						    	$route_details = DB::table('route')->where('route_id', $shop_details->route)->first();
      						    	$explode_salesrep = explode(',', $route_details->sales_rep_id);
      						    	if(count($explode_salesrep)){
      						    		foreach ($explode_salesrep as $salesrep) {
      						    			$salesrep_details = DB::table('sales_rep')->where('user_id', $salesrep)->first();
      						    			$output_salesrep.='<option value="'.$salesrep_details->user_id.'">'.$salesrep_details->firstname.' '.$salesrep_details->surname.'</option>';
      						    		}
      						    	}
      						    	else{
      						    		$output_salesrep='<option value="">No Sales REP</option>';
      						    	}

      						    	echo $output_salesrep;

      						    	?>
      						    </select>
      						</div>
      						<div class="form-group">
      						    <label>Enter Amount</label>
      						    <input type="number" class="form-control amount_class" placeholder="Enter Amount" name="amount">      						    
      						</div>
      				  </div>                                      
            </div>                
      </div>
      <div class="modal-footer">
      	<input type="text" class="class_id" name="id">

        <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn model_add_button add_button">Update</button>
      </div>
      </form>
    </div>
  
  </div>
</div>


	<div class="col-lg-11 col-md-12 col-sm-12 col-12 offset-lg-1 right_panel">
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-6">
			<div class="main_title">Shop Commission for <span><?php echo $shop_details->shop_name?></span></div>
		</div>
		<div class="col-lg-6 col-sm-6 col-6">
			<a href="#" class="logout_button"><i class="fas fa-sign-in-alt"></i> &nbsp;Logout</a>
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
		<?php
		$today_output = '';
		$get_pending_networks = DB::table('shop_commission')->where('shop_id',$shop_id)->where('status',0)->orderBy('commission_date','asc')->groupBy('commission_date')->get();
		$ival = 1;
		$allotted_euros = 0;
		if(count($get_pending_networks))
		{
			$url = URL::to('admin/update_commission_for_date_shop');
			$today_output.='<div class="col-lg-12">
				<h6>Commission Pending</h6>
			</div>
			<form action="'.$url.'" method="post" id="shop_commission_form">';
			foreach($get_pending_networks as $networks)
			{
				$get_pending_network = DB::table('shop_commission')->where('shop_id',$shop_id)->where('commission_date',$networks->commission_date)->where('status',0)->get();
				if(count($get_pending_network))
				{
					
					$today_output.='<div class="col-lg-12 col-md-12 col-sm-12">
							<b class="margin_top_40">'.date('d-M-Y', strtotime($networks->commission_date)).'</b>
							<div class="table-responsive">
								<table class="table table-striped">
						        	<thead>
						        		<tr>       			
						        			<th colspan="12" style="text-align: center;">Commission Details</th>
						        		</tr>
						        		<tr>		        			
						        			<th>Network</th>
						        			<th>1st Connections</th>
						        			<th>Bonus</th>
						        			<th>2 Topup</th>		        					        			
						        			<th>3 Topup</th>
						        			<th>4 Topup</th>
						        			<th>5 Topup</th>
						        			<th>6 Topup</th>
						        			<th>7 Topup</th>
						        			<th>8 Topup</th>
						        			<th>9 Topup</th>
						        			<th>10 Topup</th>
						        			<th>Total Rate</th>
						        		</tr>
						        	</thead>
						        	<tbody>';
						        	$sub_pending_total = 0;
			        				$sub_allotted_total = 0;
			        				$pending_bonus_total = 0;
			        				$allotted_bonus_total = 0;
			        				
									foreach($get_pending_network as $network)
									{
										$get_plan = DB::table('commission')->where('commission_id',$network->plan_id)->first();
										if(count($get_plan))
										{
											$one_array = unserialize($get_plan->first);
											$bonus_array = unserialize($get_plan->bonus);
											$two_array = unserialize($get_plan->second);
											$three_array = unserialize($get_plan->third);
											$four_array = unserialize($get_plan->fourth);
											$five_array = unserialize($get_plan->fifth);
											$six_array = unserialize($get_plan->sixth);
											$seven_array = unserialize($get_plan->seventh);
											$eight_array = unserialize($get_plan->eighth);
											$nine_array = unserialize($get_plan->ninth);
											$ten_array = unserialize($get_plan->tenth);

											$one_pending_euro = $network->one_connection * $one_array[$network->network_id];
											$bonus_pending_euro = $network->one_connection * $bonus_array[$network->network_id];
											$two_pending_euro = $network->two_topup * $two_array[$network->network_id];
											$three_pending_euro = $network->three_topup * $three_array[$network->network_id];
											$four_pending_euro = $network->four_topup * $four_array[$network->network_id];
											$five_pending_euro = $network->five_topup * $five_array[$network->network_id];
											$six_pending_euro = $network->six_topup * $six_array[$network->network_id];
											$seven_pending_euro = $network->seven_topup * $seven_array[$network->network_id];
											$eight_pending_euro = $network->eight_topup * $eight_array[$network->network_id];
											$nine_pending_euro = $network->nine_topup * $nine_array[$network->network_id];
											$ten_pending_euro = $network->ten_topup * $ten_array[$network->network_id];

											$total_pending_euro = $one_pending_euro + $two_pending_euro + $three_pending_euro + $four_pending_euro + $five_pending_euro + $six_pending_euro + $seven_pending_euro + $eight_pending_euro + $nine_pending_euro + $ten_pending_euro;
											$sub_pending_total = $sub_pending_total + $total_pending_euro;
											$pending_bonus_total = $pending_bonus_total + $bonus_pending_euro;


											$one_euro = $network->one_allotted * $one_array[$network->network_id];
											$bonus_euro = $network->one_allotted * $bonus_array[$network->network_id];
											$two_euro = $network->two_allotted * $two_array[$network->network_id];
											$three_euro = $network->three_allotted * $three_array[$network->network_id];
											$four_euro = $network->four_allotted * $four_array[$network->network_id];
											$five_euro = $network->five_allotted * $five_array[$network->network_id];
											$six_euro = $network->six_allotted * $six_array[$network->network_id];
											$seven_euro = $network->seven_allotted * $seven_array[$network->network_id];
											$eight_euro = $network->eight_allotted * $eight_array[$network->network_id];
											$nine_euro = $network->nine_allotted * $nine_array[$network->network_id];
											$ten_euro = $network->ten_allotted * $ten_array[$network->network_id];

											$total_allotted_euro = $one_euro + $two_euro + $three_euro + $four_euro + $five_euro + $six_euro + $seven_euro + $eight_euro + $nine_euro + $ten_euro;

											$sub_allotted_total = $sub_allotted_total + $total_allotted_euro;
											$allotted_bonus_total = $allotted_bonus_total + $bonus_euro;
										}
										if(isset($_GET['type']))
										{
											if($_GET['type'] == "completed")
											{
												$disabled = 'disabled';
											}
											else{
												$disabled = '';
											}
										}
										else{
											$disabled = '';
										}
										$today_output.='<tr>
						        			<td>
						        			'.$network->network_id.'
						        			<input type="hidden" name="hidden_network_'.$ival.'[]" value="'.$network->network_id.'">
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->one_connection.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->one_allotted.'" class="form-control input_rate alloted_sim" data-element="one" data-value="'.$network->id.'" name="one_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->one_connection.'" class="form-control input_rate" name="">
						        				<input type="number" readonly value="'.$network->one_allotted.'" class="form-control input_rate bonus_rate alloted_sim" data-element="bonus" data-value="'.$network->id.'" name="bonus_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->two_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->two_allotted.'" class="form-control input_rate alloted_sim" data-element="two" data-value="'.$network->id.'" name="two_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->three_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->three_allotted.'" class="form-control input_rate alloted_sim" data-element="three" data-value="'.$network->id.'" name="three_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->four_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->four_allotted.'" class="form-control input_rate alloted_sim" data-element="four" data-value="'.$network->id.'" name="four_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->five_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->five_allotted.'" class="form-control input_rate alloted_sim" data-element="five" data-value="'.$network->id.'" name="five_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->six_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->six_allotted.'" class="form-control input_rate alloted_sim" data-element="six" data-value="'.$network->id.'" name="six_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->seven_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->seven_allotted.'" class="form-control input_rate alloted_sim" data-element="seven" data-value="'.$network->id.'" name="seven_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->eight_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->eight_allotted.'" class="form-control input_rate alloted_sim" data-element="eight" data-value="'.$network->id.'" name="eight_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->nine_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->nine_allotted.'" class="form-control input_rate alloted_sim" data-element="nine" data-value="'.$network->id.'" name="nine_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				<input type="text" readonly value="'.$network->ten_topup.'" class="form-control input_rate" name="">
						        				<input type="number" value="'.$network->ten_allotted.'" class="form-control input_rate alloted_sim" data-element="ten" data-value="'.$network->id.'" name="ten_allotted_'.$ival.'[]" min="0" required '.$disabled.'>
						        			</td>
						        			<td>
						        				&euro; '.$total_pending_euro.'<br/>
			        							&euro; <spam class="pending_euros" id="euros_'.$shop_id.'_'.$network->id.'" style="line-height:80px">'.$total_allotted_euro.'</spam>
						        			</td>		        			
						        		</tr>
						        		<tr class="tr_total tr_'.$shop_id.'_'.$network->id.'" data-element="'.$shop_id.'_'.$network->id.'">
						        			<td></td>
						        			<td align="center">&euro;'.$one_pending_euro.' - &euro;<span class="allotted_euro one_allotted_euro">'.$one_euro.'</span></td>
						        			<td align="center">&euro;'.$bonus_pending_euro.' - &euro;<span class="allotted_bonus_euro bonus_allotted_euro">'.$bonus_euro.'</span></td>
						        			<td align="center">&euro;'.$two_pending_euro.' - &euro;<span class="allotted_euro two_allotted_euro">'.$two_euro.'</span></td>
						        			<td align="center">&euro;'.$three_pending_euro.' - &euro;<span class="allotted_euro three_allotted_euro">'.$three_euro.'</span></td>
						        			<td align="center">&euro;'.$four_pending_euro.' - &euro;<span class="allotted_euro four_allotted_euro">'.$four_euro.'</span></td>
						        			<td align="center">&euro;'.$five_pending_euro.' - &euro;<span class="allotted_euro five_allotted_euro">'.$five_euro.'</span></td>
						        			<td align="center">&euro;'.$six_pending_euro.' - &euro;<span class="allotted_euro six_allotted_euro">'.$six_euro.'</span></td>
						        			<td align="center">&euro;'.$seven_pending_euro.' - &euro;<span class="allotted_euro seven_allotted_euro">'.$seven_euro.'</span></td>
						        			<td align="center">&euro;'.$eight_pending_euro.' - &euro;<span class="allotted_euro eight_allotted_euro">'.$eight_euro.'</span></td>
						        			<td align="center">&euro;'.$nine_pending_euro.' - &euro;<span class="allotted_euro nine_allotted_euro">'.$nine_euro.'</span></td>
						        			<td align="center">&euro;'.$ten_pending_euro.' - &euro;<span class="allotted_euro ten_allotted_euro">'.$ten_euro.'</span></td>

						        			<td align="center"></td>		        			
						        		</tr>';
									}
									$today_output.='<tr>
					        			<td colspan="12">Sub Total</td>
					        			<td align="center">&euro; '.$sub_pending_total.' - &euro; <spam class="total_allotted_euros">'.$sub_allotted_total.'</spam></td>		        			
					        		</tr>
					        		<tr style="background-color: rgba(0,0,0,.05);">
					        			<td colspan="12">Bonus</td>
					        			<td align="center">&euro; '.$pending_bonus_total.' - &euro; <spam class="total_allotted_bonus_euros">'.$allotted_bonus_total.'</spam></td>		        			
					        		</tr>';
								$today_output.='</tbody>
						        </table>
						    </div>
						</div>
						<br/><br/>
						<input type="hidden" name="hidden_changed_date_'.$ival.'" class="hidden_changed_date" id="hidden_changed_date" value="">
						<input type="hidden" name="hidden_date_'.$ival.'" id="hidden_date" value="'.$networks->commission_date.'">
						<input type="hidden" name="hidden_shop_id_'.$ival.'" id="hidden_shop_id" value="'.$_GET['shop_id'].'">
						';
						$ival++;
						$allotted_euros = $allotted_euros + $sub_allotted_total;
				}
			}
			$loop_count = $ival - 1;
			$admin = DB::table('admin')->first();

			if(isset($_GET['type']))
			{
				if($_GET['type'] == "completed")
				{
					$display = 'display:none';
				}
				else{
					$display = '';
				}
			}
			else{
				$display = '';
			}
			$today_output.='
			<div class="col-lg-12 text-right" style="'.$display.'">
				<label style="font-size:18px;font-weight:600">Processed Value: £ <spam id="processed_value">'.$allotted_euros.'</spam></label>
				<input type="hidden" name="admin_minimum_value" id="admin_minimum_value" value="'.$admin->minimum_value.'">
			</div>
			<div class="col-lg-12 text-right" style="'.$display.'">
				<input type="text" class="form-control hidden_changed_date_all" style="max-width: 250px; float: right;" placeholder="Select Date" name="hidden_changed_date_all" required>

				<input type="hidden" name="hidden_changed_month" id="hidden_changed_month" value="">
				<input type="hidden" name="hidden_changed_year" id="hidden_changed_year" value="">
			</div><br/><br/>
			<div class="col-lg-12 text-right" style="'.$display.'">
				<input type="hidden" name="loop_count" id="loop_count" value="'.$loop_count.'">
				<input type="submit" name="update_commission" class="btn btn-primary model_add_button update_commission" value="Proceed">
			</div>
			</form>';
		}
		echo $today_output;
		?>

		<div class="col-lg-12 margin_top_30">
			<h6>Commission</h6>			

			<div class="table-responsive">
		        <table class="own_table">
		        	<thead>
		        		<tr>
		        			<th>Month</th>
		        			<th style="text-align: right;">1st Connection</th>
		        			<th style="text-align: right;">Topup Connection</th>
		        			<th style="text-align: right;">Commission</th>
		        			<th style="text-align: right;">Bonus</th>
		        			<th style="text-align: right;">Action</th>		        			
		        		</tr>
		        	</thead>
		        	<tbody>
		        		<?php
		        		$get_shop_dates = DB::table('sim_processed')->where('shop_id',$_GET['shop_id'])->orderBy('month_year','desc')->groupBy('month_year')->get();
		        		$commission_total = '';
		        		$bonus_total = '';
		        		if(count($get_shop_dates))
		        		{
		        			foreach($get_shop_dates as $date)
		        			{
		        				?>
		        				<tr>
					          		<td><?php echo date('F-Y', strtotime($date->date)); ?></td>
					          		<td>
					          			<?php
					          			$get_networks = DB::table('sim_processed')->where('shop_id',$_GET['shop_id'])->where('month_year',$date->month_year)->groupBy('network_id')->get();
					          			if(count($get_networks))
					          			{
					          				foreach($get_networks as $network)
					          				{
					          					$get_network_first_count = DB::table('sim_processed')->where('shop_id',$_GET['shop_id'])->where('month_year',$date->month_year)->where('network_id',$network->network_id)->sum('first_connection');

					          					echo $network->network_id.':'.$get_network_first_count.'<br/>';
					          				}
					          			}
					          			?>
					          		</td>
					          		<td>
					          			<?php
					          			$get_networks = DB::table('sim_processed')->where('shop_id',$_GET['shop_id'])->where('month_year',$date->month_year)->groupBy('network_id')->get();
					          			if(count($get_networks))
					          			{
					          				foreach($get_networks as $network)
					          				{
					          					$get_network_first_count = DB::table('sim_processed')->where('shop_id',$_GET['shop_id'])->where('month_year',$date->month_year)->where('network_id',$network->network_id)->sum('topups');

					          					echo $network->network_id.':'.$get_network_first_count.'<br/>';
					          				}
					          			}
					          			?>
					          		</td>
					          		<td align="right">&#163; 
					          			<?php
					          			$sum_commission = DB::table('sim_processed')->where('shop_id',$_GET['shop_id'])->where('month_year',$date->month_year)->sum('commission');
					          			echo $sum_commission;
					          			?>
					          		</td>
					          		<td align="right">&#163; 
					          			<?php
					          			$sum_bonus = DB::table('sim_processed')->where('shop_id',$_GET['shop_id'])->where('month_year',$date->month_year)->sum('bonus');
					          			echo $sum_bonus;
					          			?>
					          		</td>		
					          		<td align="right">
					          			<a href="javascript:" class="btn btn-primary model_add_button print_pdf" data-element="<?php echo $_GET['shop_id']; ?>" data-value="<?php echo date('m-Y', strtotime($date->date)); ?>">Print</a>
					          		</td>					          		
					          	</tr>
		        				<?php
		        				$commission_total = $commission_total+$sum_commission;
		        				$bonus_total = $bonus_total+$sum_bonus;
		        			}
		        			
		        		?>
		        		<tr>
		        			<td><b>Total</b></td>
		        			<td></td>
		        			<td></td>
		        			<td align="right"><b>&#163; <?php echo $commission_total?></b></td>
		        			<td align="right"><b>&#163;  <?php echo $bonus_total ?></b></td>
		        			<td></td>
		        		</tr>
		        		<?php
		        		}
		        		else{
		        			echo '<tr><td colspan="6" align="center">Empty</td></tr>';
		        		}
		        		?>
		          	</tbody>

		      </table>
		  </div>	
		  </div>
		  <?php
		  if(count($get_shop_dates)){
		  	$display_paid = 'display:block';
		  }
		  else{
		  	$display_paid = 'display:none';
		  }
		  ?>
		  <div class="col-lg-12 margin_top_30" style="<?php echo $display_paid?>">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-6 col-sm-6">
					<h6>Commission Paid</h6>
				</div>
				<div class="col-lg-6 col-md-6 col-6 col-sm-6 text-right">
					<a href="javascript:"  data-toggle="modal" data-target=".release_model" class="btn btn-primary model_add_button ">Release Check</a>
				</div>
			</div>

			<div class="table-responsive">
		        <table class="own_table">
		        	<thead>
		        		<tr>
		        			<th style="width: 80px;">S.No</th>
		        			<th style="max-width: 100px;">Date</th>
		        			<th style="">Description</th>
		        			<th style="text-align: center;">Commission</th>
		        			<th style="text-align: center;">Bonus</th>
		        			<th style="text-align: center; max-width: 100px;">Action</th>
		        			<th style="text-align: center;">Status</th>		        			
		        		</tr>
		        	</thead>
		        	<tbody>
		        		<?php
		        		$paid_details = DB::table('commission_paid')->where('shop_id', $shop_id)->get();
		        		$paid_output='';
		        		$total_paid_bonus='';
		        		$total_paid_commission='';
		        		$i=1;
		        		if(count($paid_details)){
		        			foreach ($paid_details as $paid) {
		        				if($paid->bonus != ''){
		        					$bonus = $paid->bonus;
		        					$symbol = '&#163;';
		        				}
		        				else{
		        					$bonus = '';
		        					$symbol ='';
		        				}
		        				$paid_output.='
		        			<tr>
		        				<td>'.$i.'</td>
		        				<td style="width:115px">'.date('d-M-Y', strtotime($paid->date)).'</td>		        				
		        				<td>'.$paid->description.'</td>
		        				<td style="text-align: right;">&#163; '.$paid->commission.'</td>
		        				<td style="text-align: right;">'.$symbol.' '.$bonus.'</td>
		        				<td style="width:100px; text-align:center"><a href="javascript:" data-toggle="tooltip" data-placement="top" data-original-title="Edit Cheque" ><i class="far fa-edit edit_icon" data-element="'.base64_encode($paid->paid_id).'"></i></a></td>
		        				<td></td>
		        			</tr>';
		        			$i++;
		        			$total_paid_commission = $total_paid_commission+$paid->commission;
		        			$total_paid_bonus = $total_paid_bonus+$paid->bonus;
		        			}
		        			if($total_paid_bonus != ''){
		        				$total_paid_bonus = $total_paid_bonus;
		        				$paid_symbol = '';
		        			}
		        			else{
		        				$total_paid_bonus = '';
		        				$paid_symbol ='';
		        			}

		        			$pending_commission = $commission_total-$total_paid_commission;
		        			$pending_bonus = $bonus_total-$total_paid_bonus;
		        			$paid_output.='
		        			<tr>
		        				<td><b>Total</b></td>
		        				<td></td>
		        				<td></td>
		        				<td style="text-align: right;"><b>&#163; '.$total_paid_commission.'</b></td>
		        				<td style="text-align: right;">'.$total_paid_bonus.'</td>
		        				<td></td>
		        				<td></td>
		        			</tr>';

		        			$peding_details = '
		        			<table class="own_table" style="margin-top:30px;">
		        			<tr>
		        				<td></td>
		        				<td></td>
		        				<td></td>
		        				<td style="text-align: right;"><b>Total Commission</b></td>
		        				<td style="text-align: right;"><b>&#163; '.$commission_total.'<b></td>
		        				<td style="text-align: right;"><b>Total Bonus</b></td>
		        				<td style="text-align: right;"><b>&#163; '.$bonus_total.'</b></td>
		        			</tr>
		        			<tr>
		        				<td></td>
		        				<td></td>
		        				<td></td>
		        				<td style="text-align: right;"><b>Paid Commission</b></td>
		        				<td style="text-align: right;"><b>&#163; '.$total_paid_commission.'<b></td>
		        				<td style="text-align: right;"><b>Paid Bonus</b></td>
		        				<td style="text-align: right;"><b>'.$paid_symbol.''.$total_paid_bonus.'</b></td>
		        			</tr>
		        			<tr>
		        				<td></td>
		        				<td></td>
		        				<td></td>
		        				<td style="text-align: right;"><b>Pending Commission</b></td>
		        				<td style="text-align: right;"><b>&#163; '.$pending_commission.'<b></td>
		        				<td style="text-align: right;"><b>Pending Bonus</b></td>
		        				<td style="text-align: right;"><b>&#163; '.$pending_bonus.'</b></td>
		        			</tr>
		        			</table>
		        			';

		        		}
		        		else{
		        			$paid_output='
		        			<tr>
		        				<td></td>
		        				<td></td>
		        				<td></td>
		        				<td align="right">Empty</td>
		        				<td></td>
		        				<td></td>
		        				<td></td>
		        			</tr>';
		        			$peding_details='';
		        		}
		        		echo $paid_output;		        		
		        		?>
		        	</tbody>
		        </table>
		        <?php echo $peding_details?>
	        </div>
	       </div>		



	</div>


		
		
	</div>
</div>
<script type="text/javascript">
$(function () {
  $(".hidden_changed_date_all").datetimepicker({
     format: 'L',
     format: 'YYYY-MM-DD',
     icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-clock-o",
        clear: "fa fa-trash-o"
    }
  });
});

$('.hidden_changed_date_all').on('dp.change', function(e){ 
	var formatedValue = e.date.format('YYYY-MM-DD');
	var formatedValue1 = e.date.format('MMM');
	var formatedValue2 = e.date.format('YYYY');
    $(".hidden_changed_date").val(formatedValue);

    $("#hidden_changed_month").val(formatedValue1);
    $("#hidden_changed_year").val(formatedValue2);
});
function detectPopupBlocker() {
  var myTest = window.open("about:blank","","directories=no,height=100,width=100,menubar=no,resizable=no,scrollbars=no,status=no,titlebar=no,top=0,location=no");
  if (!myTest) {
    return 1;
  } else {
    myTest.close();
    return 0;
  }
}
function SaveToDisk(fileURL, fileName) {
  
	var idval = detectPopupBlocker();
	if(idval == 1)
	{
		alert("A popup blocker was detected. Please Allow the popups to download the file.");
	}
	else{
		// for non-IE
		if (!window.ActiveXObject) {
		  var save = document.createElement('a');
		  save.href = fileURL;
		  save.target = '_blank';
		  save.download = fileName || 'unknown';
		  var evt = new MouseEvent('click', {
		    'view': window,
		    'bubbles': true,
		    'cancelable': false
		  });
		  save.dispatchEvent(evt);
		  (window.URL || window.webkitURL).revokeObjectURL(save.href);
		}
		// for IE < 11
		else if ( !! window.ActiveXObject && document.execCommand)     {
		  var _window = window.open(fileURL, '_blank');
		  _window.document.close();
		  _window.document.execCommand('SaveAs', true, fileName || fileURL)
		  _window.close();
		}
	}
	$("body").removeClass("loading");
}
function detectPopupBlocker_download() {
  var myTest = window.open("about:blank","","directories=no,height=100,width=100,menubar=no,resizable=no,scrollbars=no,status=no,titlebar=no,top=0,location=no");
  if (!myTest) {
    return 1;
  } else {
    myTest.close();
    return 0;
  }
}
function print_pdf(url){
	var idval = detectPopupBlocker_download();
	if(idval == 1)
	{
		alert("A popup blocker was detected. Please Allow the popups to download the file.");
	}
	else{
	   	var objFra = document.createElement('iframe');   // Create an IFrame.
        objFra.style.visibility = "hidden";    // Hide the frame.
        objFra.src = url;                      // Set source.
        document.body.appendChild(objFra);  // Add the frame to the web page.
        objFra.contentWindow.focus();       // Set focus.
        objFra.contentWindow.print();      // Print it.
	}
}
$(window).click(function(e) {
	if($(e.target).hasClass('update_commission'))
	{
		e.preventDefault();
		var processed_value = parseInt($("#processed_value").html());
		var minimum_value = parseInt($("#admin_minimum_value").val());
		var monthval = $("#hidden_changed_month").val();
		var yearval = $("#hidden_changed_year").val();

		monthval = monthval.toUpperCase();
		if(processed_value >= minimum_value)
		{
			if($("#shop_commission_form").valid())
			{
				var r = confirm("Are you sure you want to Proceed the Shop Commission for the month of "+monthval+" and the Year of "+yearval+"?");
				if(r)
				{
					$("#shop_commission_form").submit();
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{
			alert("Your processed value(£ "+processed_value+") is less than the minimum value(£ "+minimum_value+"). You Should Proceed the commission once the processed value is Greater than or Equal to the Minimum Value.");
			return false;
		}
	}
	if($(e.target).hasClass('print_pdf'))
	{
		var shop_id = $(e.target).attr("data-element");
		var dateval = $(e.target).attr("data-value");
		$.ajax({
			url:"<?php echo URL::to('admin/print_pdf_for_shop'); ?>",
			type:"post",
			data:{shop_id:shop_id,dateval:dateval},
			success: function(result)
			{
				print_pdf("<?php echo URL::to('papers'); ?>/"+result);
			}
		});
	}
});
$(window).keyup(function(e) {
    var valueTimmer;                //timer identifier
    var valueInterval = 500;  //time in ms, 5 second for example
    if($(e.target).hasClass('alloted_sim'))
    {
        var that = $(e.target);
        var input_val = $(e.target).val();  
        var period_id = $(e.target).attr("data-element");
        var network_id = $(e.target).attr("data-value");
    	clearTimeout(valueTimmer);
    	valueTimmer = setTimeout(doneTyping, valueInterval,input_val, period_id,network_id,that);
    }
});
$(window).change(function(e) {
    if($(e.target).hasClass('alloted_sim'))
    {
        var that = $(e.target);
        var input_val = $(e.target).val();  
        var period_id = $(e.target).attr("data-element");
        var network_id = $(e.target).attr("data-value");
        doneTyping(input_val, period_id,network_id,that);
    }
});
function doneTyping (value,period,network,that) {
	if(period == "one" || period == "bonus")
	{
		$.ajax({
		    url:"<?php echo URL::to('admin/check_commission_plan')?>",
		    type:"post",
		    data:{value:value, period:period,network:network},
		    success: function(result) {
		    	var split_result = result.split("||");
		    	that.parents("tbody").find(".tr_<?php echo $shop_id; ?>_"+network).find("."+period+"_allotted_euro").html(split_result[0]);
		    	that.parents("tbody").find(".tr_<?php echo $shop_id; ?>_"+network).find(".bonus_allotted_euro").html(split_result[1]);

		    	that.parents("tr").find(".bonus_rate").val(value);
		    	var sumcount = 0;
		    	that.parents("tbody").find(".tr_<?php echo $shop_id; ?>_"+network).find(".allotted_euro").each(function() {
		    		var textvalue = $(this).html();
		    		sumcount = sumcount + parseFloat(textvalue);
		    	});
		    	that.parents("tbody").find("#euros_<?php echo $shop_id; ?>_"+network).html(sumcount);
		    	var sumcountval = 0;
		    	that.parents("tbody").find(".pending_euros").each(function() {
		    		var textvalue = $(this).html();
		    		sumcountval = sumcountval + parseFloat(textvalue);
		    	})
		    	that.parents("tbody").find(".total_allotted_euros").html(sumcountval);

		    	var processedcountval = 0;
		    	$(".total_allotted_euros").each(function() {
		    		var textvalue = $(this).html();
		    		processedcountval = processedcountval + parseFloat(textvalue);
		    	});
		    	$("#processed_value").html(processedcountval);
		    	var sumbonusval = 0;
		    	that.parents("tbody").find(".allotted_bonus_euro").each(function() {
		    		var textvalue = $(this).html();
		    		sumbonusval = sumbonusval + parseFloat(textvalue);
		    	})
		    	that.parents("tbody").find(".total_allotted_bonus_euros").html(sumbonusval);
		    }
		});
	}
	else{
		$.ajax({
		    url:"<?php echo URL::to('admin/check_commission_plan')?>",
		    type:"post",
		    data:{value:value, period:period,network:network},
		    success: function(result) {
		    	that.parents("tbody").find(".tr_<?php echo $shop_id; ?>_"+network).find("."+period+"_allotted_euro").html(result);
		    	var sumcount = 0;
		    	that.parents("tbody").find(".tr_<?php echo $shop_id; ?>_"+network).find(".allotted_euro").each(function() {
		    		var textvalue = $(this).html();
		    		sumcount = sumcount + parseFloat(textvalue);
		    	});
		    	that.parents("tbody").find("#euros_<?php echo $shop_id; ?>_"+network).html(sumcount);
		    	var sumcountval = 0;
		    	that.parents("tbody").find(".pending_euros").each(function() {
		    		var textvalue = $(this).html();
		    		sumcountval = sumcountval + parseFloat(textvalue);
		    	})
		    	that.parents("tbody").find(".total_allotted_euros").html(sumcountval);

		    	var processedcountval = 0;
		    	$(".total_allotted_euros").each(function() {
		    		var textvalue = $(this).html();
		    		processedcountval = processedcountval + parseFloat(textvalue);
		    	});
		    	$("#processed_value").html(processedcountval);
		    }
		});
	}
}
$(".deactive_class").click(function(){
	var value = $(this).attr("data-element");
	$(".active_deactive_title").html("Deactive");
	$(".active_deactive_content").html("Are you sure want deactive "+value+"?");	
	$(".status_modal").modal();
})
$(".active_class").click(function(){
	var value = $(this).attr("data-element");
	$(".active_deactive_title").html("Active");
	$(".active_deactive_content").html("Are you sure want Active "+value+"?");	
	$(".status_modal").modal();
})
/*$(".edit_icon").click(function(){
	var value = $(this).attr("data-element");	
	$(".add_input").val(value);
	$(".model_add_button").html('Update');
	$(".add_modal").modal();	
})*/
$(".add_button_class").click(function(){	
	$(".add_input").val('');
	$(".model_add_button").html('Add New');
	$(".add_modal").modal();	
})


$(window).click(function(e) {

if($(e.target).hasClass("edit_icon")){	
  $(".loading_css").addClass("loading");
  setTimeout(function() {
    var value = $(e.target).attr("data-element");  
    $.ajax({
        url:"<?php echo URL::to('admin/cheque_details')?>",
        dataType:'json',
        data:{id:value, type:3},
        type:"post",
        success: function(result)
        {
          $(".class_id").val(result['id']);
          $(".salesrep_class").val(result['salesrep']);
          $(".amount_class").val(result['commission']);
          $(".release_edit_model").modal("show");
          $(".loading_css").removeClass("loading");
        }
      })
    },500);
}

})








$.ajaxSetup({async:false});
$('#release-form').validate({
    rules: {        
        salesrep : {required: true},
        amount : {required: true},
    },
    messages: {        
        salesrep : {required : "Select Sales REP"},        
        amount : {required : "Enter Amount"},        
    },
});

$('#release-edit-form').validate({
    rules: {        
        salesrep : {required: true},
        amount : {required: true},
    },
    messages: {        
        salesrep : {required : "Select Sales REP"},        
        amount : {required : "Enter Amount"},        
    },
});
</script>

@stop