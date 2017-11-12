	<!-- start Main Wrapper -->
		
		<div class="main-wrapper scrollspy-container">
		
		
				<div class="filter-full-width-wrapper" style="padding-top:8px;padding-bottom:0px;border-bottom: 1px solid #E6E6E6;background-color:#ddd;">
				<div class="container">
				<div class="row">

									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="col-md-12">
											<div class="filter-item bb-sm no-bb-xss">
												<?php if(count($search) > 1) { ?>
					                                <h2><?php echo strtoupper($search[1]); ?> TOURS - <?php echo strtoupper($search[0]); ?></h2>
					                            <?php } else { ?>
					                                <h2><?php echo strtoupper($search[0]); ?></h2>
					                            <?php } ?>
											</div>
										</div>
										
										
										<!-- <div class="col-md-2">
										<span style="float:right;"><a href="#"><i class="fa fa-align-justify"></i></a> &nbsp;<a href="#"><i class="fa fa-th"></i></a></span>
										</div> -->
										
										
										</div>
				</div>			
				</div>
				</div>
			
			<!-- end breadcrumb -->
			
			<div class="filter-full-width-wrapper">

				<form class="">
				
					<div class="filter-full-primary">
					
						<div class="container">
					
							<div class="filter-full-primary-inner">
							
								<div class="form-holder">
								
									<div class="row">
									
										<div class="col-xs-12 col-sm-12 col-md-7">
										
											<div class="filter-item bb-sm no-bb-xss">
											
												<div class="input-group input-group-addon-icon no-border no-br-sm">
													<span class="input-group-addon input-group-addon-icon bg-white"><label><i class="fa fa-map-marker"></i> Destination:</label></span>
													<?php 
													$destination_val = '';
													foreach ($destination as $key => $value) {
														if($key <> 0) $destination_val .= ', ';
														$destination_val .=  $value->name;
													} ?>
													<input type="text" class="form-control" id="autocompleteTagging" value="<?php echo $destination_val; ?>" placeholder="" readonly />
												</div>
											
											</div>
											
										</div>

										
										<div class="col-xs-12 col-sm-12 col-md-5 act-res">
										
											<div class="filter-item-wrapper">
											
												<div class="row">
													
													<div class="col-xss-12 col-xs-6 col-sm-5">
											
														<div class="filter-item mmr res-select">
														
															<div class="input-group input-group-addon-icon no-border no-br-xs">
																<span class="input-group-addon input-group-addon-icon bg-white">
																<label class="block-xs"><i class="fa fa-sort-amount-asc"></i> Sort by:</label></span>
																<select class="selectpicker type_select form-control block-xs res-select" >
																	<option value="0"> Type</option>
																	<?php  foreach ($types as $key => $value) { ?>
																		<option value="<?php echo $value->id; ?>"> <?php echo $value->name; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
											
													<div class="col-xss-12 col-xs-6 col-sm-7">
													
														<div class="filter-item mmr res-select">
														
															<div class="input-group input-group-addon-icon no-border no-br-xs">
																<span class="input-group-addon input-group-addon-icon bg-white"><label><i class="fa fa-sort-amount-asc"></i> Tour Style:</label></span>
																<select class="selectpicker style_select form-control res-select" data-live-search="false" data-selected-text-format="count > 2" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All Types" multiple >
																	<?php foreach ($styles as $key => $value) { ?>
																		<option value="<?php echo $value->id; ?>"> <?php echo $value->name; ?></option>
																	<?php } ?>
																	
																</select>
															</div>
														
														</div>
														
													</div>
												
												</div>
											
											</div>
											
										</div>

									</div>
								
								</div>
								
								<div class="btn-holder">
									<span class="btn btn-toggle btn-refine collapsed" ">Advance Filter</span>
									<!-- <span class="btn btn-toggle btn-refine collapsed" data-toggle="collapse" data-target="#refine-result">Advance Filter</span> -->
								</div>
							
							</div>

						</div>

					</div>
					
					<div class="filter-full-secondary">
						
						<div id="refine-result" class="collapse">
						
							<div class="container"> 
						
								<div class="collapse-inner clearfix">
								
									<div class="row">
									
										<div class="col-xs-12 col-sm-12 col-md-8">
										
											<div class="row">
											
												<div class="col-xss-12 col-xs-6 col-sm-6">
													<div class="form-group">
														<label>Budget(in USD):-</label>
														<div class="sidebar-module-inner">
															<input id="budjet_range" />
														</div>
													</div>
												</div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6">
													<div class="form-group">
														<label>No of days:-</label>
														<div class="sidebar-module-inner">
															<input id="days_range" />
														</div>
													</div>
												</div>
												

												

											
											</div>
										
										</div>
										
										<div class="col-xs-12 col-sm-12 col-md-4">
										
											<div class="row">
											
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-12">
												
													<div class="form-group">
														<label>Hotel star rating:-</label>
														<div class="sidebar-module-inner">
															<input id="star_range" />
														</div>
													</div>
													
												</div>
											</div>
											
										</div>

										<div class="col-xs-12 col-sm-12 mb-10">
											<div class="bb mb-20"></div>
											<div class="col-xs-12 col-sm-6 mb-10">
											<label>Activities:-</label>
											<div class="row checkbox-wrapper">
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
													<div class="checkbox-block">
														<input id="filter_checkbox-1" name="filter_checkbox" type="checkbox" class="checkbox"/>
														<label class="" for="filter_checkbox-1">&nbsp;<img src="<?php echo base_url('assets/images/adventure-icon.png');?>"/> &nbsp;Adventure</label>
													</div>
													<div class="checkbox-block">
														<input id="filter_checkbox-2" name="filter_checkbox" type="checkbox" class="checkbox" checked/>
														<label class="" for="filter_checkbox-2">&nbsp;<img src="<?php echo base_url('assets/images/nature-icon.png');?>"/> Nature</label>
													</div>
													<div class="checkbox-block">
														<input id="filter_checkbox-3" name="filter_checkbox" type="checkbox" class="checkbox"/>
														<label class="" for="filter_checkbox-3">&nbsp;<img src="<?php echo base_url('assets/images/water-activities-icon.png');?>"/> &nbsp;Water Activities</label>
													</div>
												</div>
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
													<div class="checkbox-block">
														<input id="filter_checkbox-4" name="filter_checkbox" type="checkbox" class="checkbox"/>
														<label class="" for="filter_checkbox-4">&nbsp;<img src="<?php echo base_url('assets/images/hill-station-icon.png');?>"/> &nbsp;Hill Station</label>
													</div>
													<div class="checkbox-block">
														<input id="filter_checkbox-5" name="filter_checkbox" type="checkbox" class="checkbox"/>
														<label class="" for="filter_checkbox-5">&nbsp;<img src="<?php echo base_url('assets/images/religious-icon.png');?>"/> &nbsp;Religious</label>  
													</div>
													<div class="checkbox-block">
														<input id="filter_checkbox-6" name="filter_checkbox" type="checkbox" class="checkbox"/>
														<label class="" for="filter_checkbox-6">&nbsp;<img src="<?php echo base_url('assets/images/trekking-icon.png');?>"/> &nbsp;Trekking</label>
													</div>
												</div>
												</div>
												</div>
												
											<div class="col-xs-12 col-sm-6 mb-10">
											<label>Includes:-</label>
											<div class="row checkbox-wrapper">
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
													<div class="checkbox-block">
														<input id="filter_checkbox-i1" name="filter_checkbox" type="checkbox" class="checkbox" checked/>
														<label class="" for="filter_checkbox-i1"> &nbsp;<img src="<?php echo base_url('assets/images/flight-icon.png');?>"/> &nbsp;Flights</label>
													</div>
													<div class="checkbox-block">
														<input id="filter_checkbox-i2" name="filter_checkbox" type="checkbox" class="checkbox"/>
														<label class="" for="filter_checkbox-i2">&nbsp;<img src="<?php echo base_url('assets/images/cab-icon.png');?>"/> &nbsp;Cab</label>
													</div>
												</div>
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-6">
													<div class="checkbox-block">
														<input id="filter_checkbox-i3" name="filter_checkbox" type="checkbox" class="checkbox" checked/>
														<label class="" for="filter_checkbox-i3"> &nbsp;<img src="<?php echo base_url('assets/images/food-icon.png');?>"/> &nbsp;Meals</label>
													</div>
													<div class="checkbox-block">
														<input id="filter_checkbox-i4" name="filter_checkbox" type="checkbox" class="checkbox"/>
														<label class="" for="filter_checkbox-i4"> &nbsp;<img src="<?php echo base_url('assets/images/shared-coach-icon.png');?>"/> Shared Coach</label>
													</div>
												</div>
												</div>
												
											<div class="col-sm-12 text-right" style="padding-right:0px;margin-top:10px;">
										
												<a href="search1.html" class="btn btn-primary btn-search">Search</a>
			
											</div>
												</div>
											</div>
										</div>

									</div>
									
								</div>
							
							</div>
						
						</div>
						
					</div>

				</form>
			</div>

			<div class="pt-10 pb-50">
				<div class="container">
					<div class="trip-guide-wrapper">
						<div class="GridLex-gap-20 GridLex-gap-15-mdd GridLex-gap-10-xs">
							<div class="GridLex-grid-noGutter-equalHeight GridLex-grid-center" id="toure_list">

								<?php foreach ($tours as $key => $value) { ?>
								
								<div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12 style_hide <?php echo 'style-'.$value->s_id; ?> <?php echo 'type-'.$value->t_id; ?>" id="<?php echo 'list-'.$value->id; ?>">
									<div class="trip-guide-item bg-light-primary">
									<div class="trip-guide-image container-image">
									<img src="<?php echo base_url('assets/images/trip/'.$value->image);?>" alt="images" class="imagea"/>
									<div class="overlay">
									<div class="texta">
									<div class="col-md-12" style="padding-left:5px;padding-right:5px;">
									<p class="tour-t"><?php echo $value->description; ?> </p>
									<div class="col-md-6">
									<p class="tour-d"><?php echo $value->days; ?> Days / <?php echo ($value->days - 1); ?> Nights</p>
									</div>
									<div class="col-md-6">
									<p class="tour-d"><span>USD <?php echo $value->budget; ?></span> / Person</p>
									</div>
									</div>
									</div>
									</div>
									</div>
									<div class="trip-guide-content bg-white">
									<div class="row">
									<div class="col-xs-12 col-sm-6">
									<h3><?php echo $value->name; ?> </h3>
									</div>
									<div class="col-xs-12 col-sm-6 text-right text-left-xs">
									<a href="<?php echo base_url('/tourism/tour_detail/'.$value->id);?>" class="btn btn-primary">Details</a>
									</div>
									</div>
									</div>
									</div>
								</div>
								
								<?php } ?>
								
							</div>
						
						</div>
						
					</div>
					

				</div>
			
			</div>

		</div>
		
		<!-- end Main Wrapper -->