@extends('salesheader')
@section('content')
<!-- Content Header (Page header) -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-12 sales_right_panel">
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-12">
			<div class="main_title">Dashboard</div>
		</div>
	</div>
	<div class="row margin_top_20">
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

		<div class="col-lg-12 col-md-12 col-sm-12 col-12 sales_dahboard_ul">
			<ul>
				<li>
					<a href="<?php echo URL::to('sales/route')?>">
						<div class="icon"><i class="fas fa-route"></i></div>
						<div class="text">Route</div>
					</a>
				</li>
				<li>
					<a href="<?php echo URL::to('sales/shop')?>">
						<div class="icon"><i class="fas fa-building"></i></div>
						<div class="text">Shop</div>
					</a>
				</li>
				<li>
					<a href="<?php echo URL::to('sales/start_day_stock')?>">
						<div class="icon"><i class="fas fa-cubes"></i></div>
						<div class="text">Start day stock</div>
					</a>
				</li>
				<?php
				$date = date('Y-m-d');
				$buttton_view='';
				$start_end_button = DB::table('start_day')->where('sales_id', $user_id)->where('start_date', $date)->first();
				if(count($start_end_button)){
					$buttton_view ='<li>
					<a href="'.URL::to('sales/end_day_stock').'">
						<div class="icon"><i class="fas fa-layer-group"></i></div>
						<div class="text">End day stock</div>
					</a>
				</li>';
				}
				
				echo $buttton_view;
				?>

				<li>
					<a href="<?php echo URL::to('sales/time_sheet')?>">
						<div class="icon"><i class="fas fa-clock"></i></div>
						<div class="text">Time Sheet</div>
					</a>
				</li>


				
				
				<li style="display: none;">
					<a href="<?php echo URL::to('sales/stock_month')?>">
						<div class="icon"><i class="fas fa-calendar-alt"></i></div>
						<div class="text">Stock take of the month</div>
					</a>
				</li>
				<li>
					<a href="<?php echo URL::to('sales/check_sim')?>">
						<div class="icon"><i class="fas fa-sim-card"></i></div>
						<div class="text">Check SIM</div>
					</a>
				</li>
				<li>
					<a href="<?php echo URL::to('sales/search')?>">
						<div class="icon"><i class="fas fa-search"></i></div>
						<div class="text">Search</div>
					</a>
				</li>

			</ul>
		</div>

	</div>

</div>
		
		
	</div>
</div>              
<!-- /.content -->
@stop