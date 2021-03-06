@extends('adminheader')
@section('content')



<div class="col-lg-11 col-md-12 col-sm-12 col-12 offset-lg-1 right_panel">
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-6">
			<div class="main_title">Shop Details for <span><?php echo $shop_details->shop_name;?></span></div>
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
          <p class="alert alert-info message_sim_save" style="display: none;">

            
                         
          </p>            
        </div>
    
		
		
    
    
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div id="shop_details">
      <div class="table-responsive">
            <table class="own_table">
                <tr>
                  <td><b>Account Name:</b> <?php echo $shop_details->shop_name;?></td>
                </tr>
                <tr>
                  <td><b>Account Number:</b> CC-<?php echo $shop_details->shop_id;?></td>
                </tr>
                <tr>
                  <td><b style="float: left;">Address:&nbsp;</b> 
                    <div style="float: left;">
                      <?php
                      if($shop_details->address2 != ''){
                        $address2 = $shop_details->address2.'<br/>';
                      }
                      else{
                        $address2 = $shop_details->address2;
                      }
                      if($shop_details->address3 != ''){
                        $address3 = $shop_details->address3.'<br/>';
                      }
                      else{
                        $address3 = $shop_details->address3;
                      }
                      ?>
                      <?php echo $shop_details->address1;?><br/>
                      <?php echo $address2;?>
                      <?php echo $address3;?>
                      <?php echo $shop_details->city;?><br/>
                      <?php echo $shop_details->postcode;?>
                    </div></td>
                </tr>
                <tr>
                  <td><b>route:</b> <?php echo $route_details->route_name?></td>
                </tr>
                <tr>
                  <td><b>Contact name:</b> <?php echo $shop_details->customer_name ?></td>
                </tr>
                <tr>
                  <td><b>Phone number:</b> <?php echo $shop_details->phone_number ?></td>
                </tr>
                <tr>
                  <td><b>Shop type:</b> 
                    <?php 
                    if($shop_details->shop_type != '') {                      
                      $shoptype = DB::table('shop_type')->where('type_id', $shop_details->shop_type)->first();                      
                      echo $shoptype->shop_type;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Mode of payment:</b>
                    <?php 
                    if($shop_details->payment_mode != '') {
                      $payment_mode = DB::table('mode_payment')->where('payment_id', $shop_details->payment_mode)->first();
                      echo $payment_mode->mode_text;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Payee Name:</b> <?php echo $shop_details->payee_name ?></td>                  
                </tr>
                <tr>
                  <td><b>Email address:</b> <?php echo $shop_details->email_id ?></td>
                </tr>
                <tr>
                  <td><b>Shop potential sales:</b>
                    <?php 
                    if($shop_details->shop_potential != '') {
                      $potential = DB::table('potential_sale')->where('potential_id', $shop_details->shop_potential)->first();
                      echo $potential->shop_potential;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Sales Rep name:</b>
                    <?php
                    /*$sales_rep_details = DB::table('sales_rep')->where('user_id', $shop_details->sales_rep)->first();
                    echo $sales_rep_details->firstname*/
                    $route_details = DB::table('route')->where('route_id', $shop_details->route)->first();
                    $explode_route = explode(',', $route_details->sales_rep_id);
                    $salesrep='';
                    if(count($explode_route)){
                      foreach ($explode_route as $route) {
                        $sales_rep = DB::table('sales_rep')->where('user_id', $route)->first();

                        if(count($sales_rep)){
                          if($salesrep == ''){
                              $salesrep = $sales_rep->firstname;
                          }
                          else{
                              $salesrep  = $sales_rep->firstname.', '.$salesrep;
                          }
                        }
                        else{
                          $salesrep = '';
                        }

                        
                      }
                    }
                    else{
                      $salesrep = '';
                    }
                    echo $salesrep;
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Last visit date :</b> 
                    <?php                    
                    $last_vist = DB::table('sim_allocate')->where('shop_id', $shop_details->shop_id)->orderBy('date', 'DESC')->first();
                    if(count($last_vist)){
                      echo date('d-M-Y', strtotime($last_vist->date));
                    }                    

                    
                    
                    ?>
                  </td>
                </tr>


          </table>
      </div>
      </div>

      <div id="network_activation">

      <div class="sub_title2 margin_top_50">Network Activations</div>

      <div class="table-responsive">
        <table class="own_table">
            <thead>
              <tr>                
                <th style="text-align: center;">Network</th>  

                <?php
                for ($j = 0; $j <= 2; $j++) {
                    $last_three_month[] =  date("M-Y-m", strtotime(" -$j month"));                    
                }
                krsort($last_three_month);

                $output_month_three='';
                $month_three_array = array();
                $month_total_array = array();
                if(count($last_three_month)){
                  foreach ($last_three_month as $three_month) {
                    $explode_three_month_year = explode('-', $three_month);

                    $sim_count_three_details = DB::table('sim')->where('shop_id', $shop_details->shop_id)->where('activity_date', '!=','0000-00-00')->get();
                    $month_three_year = $explode_three_month_year[1].'-'.$explode_three_month_year[2];
                    array_push($month_three_array,$month_three_year);                    
                    $count_three_month=0;
                    if(count($sim_count_three_details)){
                      foreach ($sim_count_three_details as $sim_count_three) {
                        $activity_date = substr($sim_count_three->activity_date,0,7);

                        if($month_three_year == $activity_date){
                          $count_three_month = $count_three_month+1;                          
                        }
                      }
                    }
                    array_push($month_total_array,$count_three_month);

                    $output_month_three.='
                    <th style="text-align: center;">'.$explode_three_month_year[0].'&nbsp;('.$count_three_month.')</th>
                    ';
                  }
                }
                echo $output_month_three;
                ?>
                <th style="text-align: center;">Updated</th>
                <th style="text-align: center;">FC</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $output_network='';   

              if(count($networklist)){
                foreach ($networklist as $network) {  
                $output_total='';                
                  if(count($month_three_array))
                  {
                    $output_network.='<tr><td align="left">'.$network->network_name.'</td>';
                    foreach($month_three_array as $mon_three)
                    {                      
                      $sim_network_count = DB::table('sim')->where('shop_id', $shop_details->shop_id)->where('network_id', $network->network_name)->where('activity_date','like',$mon_three.'%')->count();
                      
                      if($sim_network_count == 0){
                        $sim_network_count='-';
                      }
                      $output_network.='<td align="center">'.$sim_network_count.'</td>'; 
                      $output_total.='<td align="center"></td>';
                    }
                    $output_network.='<td></td><td></td></tr>';                 
                  }

                }
                $output_total='';
                if(count($month_total_array)){
                  foreach ($month_total_array as $total_array) {
                    $output_total.='<td align="center">'.$total_array.'</td>';
                  }
                }

                $output_network.='<tr style="background: #eaeaea; font-weight:bold;">
                                  <td style="background: #eaeaea;">Total</td>'.$output_total.'
                                  <td></td>
                                  <td></td>
                                  </tr>';
              }
              else{
                $output_network='
                <tr>
                <td colspan="7" align="center">Empty</td>
              </tr>';
              }

              echo $output_network;
              ?>
            </tbody>
          </table>
      </div>
    </div>

    <div id="sim_activation_report">

      <div class="sub_title2 margin_top_50">Sim Activation report</div>

      <div class="table-responsive">
        <table class="own_table">
            <thead>
              <tr>
                <th>#</th>
                <?php
                for ($j = 0; $j <= 5; $j++) {
                    $last_six_month[] =  date("M-Y-m", strtotime(" -$j month"));                    
                }
                krsort($last_six_month);

                $output_month='';

                $month_array = array();
                $month_six_total_array = array();
                if(count($last_six_month)){
                  foreach ($last_six_month as $month) {
                    $explode_month_year = explode('-', $month);

                    $sim_count_details = DB::table('sim')->where('shop_id', $shop_details->shop_id)->where('activity_date', '!=','0000-00-00')->get();
                    $month_year = $explode_month_year[1].'-'.$explode_month_year[2];
                    array_push($month_array,$month_year);
                    $count_month=0;
                    if(count($sim_count_details)){
                      foreach ($sim_count_details as $sim_count) {
                        $activity_date = substr($sim_count->activity_date,0,7);

                        if($month_year == $activity_date){
                          $count_month = $count_month+1;                          
                        }
                      }
                    }
                    array_push($month_six_total_array,$count_month);
                    $output_month.='
                    <th style="text-align: center;">'.$explode_month_year[0].'&nbsp;('.$count_month.')</th>
                    ';
                  }
                }
                echo $output_month;
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
                $output_network='';
                if(count($networklist)){
                  foreach ($networklist as $network) {
                    $explode_product=explode(',', $network->product_id);
                    $output_product='';                    
                    if(count($explode_product)){
                      foreach ($explode_product as $product) {

                        if(count($month_array))
                        {
                          $output_product.='<tr><td align="left">'.$product.'</td>';
                          foreach($month_array as $mon)
                          {
                            $sim_count_network = DB::table('sim')->where('shop_id', $shop_details->shop_id)->where('product_id', $product)->where('activity_date','like',$mon.'%')->count();

                            if($sim_count_network == 0){
                              $sim_count_network='-';
                            }

                            $output_product.='<td align="center">'.$sim_count_network.'</td>';
                          }
                          $output_product.='</tr>';
                        }
                      }                      
                    }
                    else{
                      $output_product='
                        <tr>
                        <td colspan="7" align="center">Empty</td>
                      </tr>';
                    }


                    $output_network.='<tr>
                      <td colspan="7">'.$network->network_name.'</td>
                    </tr>'.$output_product;
                  }
                  $output_total='';
                  if(count($month_six_total_array)){
                    foreach ($month_six_total_array as $total_array) {
                      $output_total.='<td align="center">'.$total_array.'</td>';
                    }
                  }

                  $output_network.='<tr style="background: #eaeaea; font-weight:bold;"><td style="background: #eaeaea;">Total</td>'.$output_total.'</tr>';
                }
                else{
                  $output_network='
                  <tr>
                    <td colspan="7" align="center">Empty</td>
                  </tr>';
                }
              echo $output_network;
              ?>
              
            </tbody>
          </table>
      </div>
</div>
      




      <div class="sub_title2 margin_top_50">Shop Commission details </div>

      <div class="table-responsive">
          <table class="own_table">
            <thead>
              <tr>
                <th>Month</th>
                <th style="text-align: right;">Commission</th>
                <th style="text-align: right;">Bonus</th>                
              </tr>
            </thead>
            <tbody>
              <?php
              $get_shop_dates = DB::table('sim_processed')->where('shop_id',$shop_details->shop_id)->orderBy('month_year','desc')->groupBy('month_year')->get();
              if(count($get_shop_dates))
              {
                foreach($get_shop_dates as $date)
                {
                  ?>
                  <tr>
                      <td><?php echo date('F-Y', strtotime($date->date)); ?></td>
                      <td align="right">&#163; 
                        <?php
                        $sum_commission = DB::table('sim_processed')->where('shop_id',$shop_details->shop_id)->where('month_year',$date->month_year)->sum('commission');
                        echo $sum_commission;
                        ?>
                      </td>
                      <td align="right">&#163; 
                        <?php
                        $sum_bonus = DB::table('sim_processed')->where('shop_id',$shop_details->shop_id)->where('month_year',$date->month_year)->sum('bonus');
                        echo $sum_bonus;
                        ?>
                      </td>
                    </tr>
                  <?php
                }
              }
              else
              {
                ?>
                <tr>
                  <td colspan="4" align="center">Empty</td>
                </tr>
                <?php
              }
              ?>
              </tbody>
        </table>
      </div>


    </div>


	</div>
		</div>
	</div>
</div>                

<script type="text/javascript">
/*$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});*/
$(window).click(function(e) {




})




</script>

@stop