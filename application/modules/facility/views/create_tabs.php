
<div class="row"  id="facility">
    <div class="col-lg-4 col-lg-offset-4">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');

	$region_array = array();
	foreach($region as $row ){
		$region_array[$row->id] = $row->region_name;
	}
	$county_array = array();
	foreach($county as $row ){
		$county_array[$row->id] = $row->county_name;
	}	
	$subcounty_array = array();
	foreach($subcounty as $row ){
		$subcounty_array[$row->id] = $row->subcounty_name;
	}
	$fridge_array = array(
		'Yes' => 'Yes',
		'No' => 'No'
	);
	$status_array = array(
		'Operational' => 'Operational',
		'Closed' => 'Closed'
	);
	$type_array = array(
		'Hospital' => 'Hospital',
		'Dispensary' => 'Dispensary',
		'Medical Centre' => 'Medical Centre',
		'Medical Clinic' => 'Medical Clinic',
	);
	$owner_array = array(
		'Private' => 'Private',
		'GOK' => 'Government of Kenya',
		'FBO' => 'Faith Based Organization'
	);
    ?>
      <h1>Add Facility</h1>
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
	  
      <div class="form-group">
        <?php
        echo form_label('Facility Name','facility_name');
        echo form_error('facility_name');
        echo form_input(['name' => 'facility_name', 'id' => 'facility_name',  'value' =>  $facility_name,'class' => 'form-control']);
        ?>
      </div>	
	  
      <div class="form-group">
        <?php
        echo form_label('Facility Type','facility_type');
        echo form_error('facility_type');
		echo form_dropdown('facility_type',$type_array , 'Hospital', 'class="form-control" id="facility_type"');
        ?>
      </div>	
	  
      <div class="form-group">
        <?php
        echo form_label('Owner','owner');
        echo form_error('owner');
        echo form_dropdown('owner',$owner_array , 'Private', 'id="owner" class="form-control"');
        ?>
      </div>
	  
      <div class="form-group">
        <?php
		echo form_label('Region','region_id');
        echo form_error('region_id');
		echo form_dropdown('region_id',$region_array , $region_id, 'id="region_id" class="form-control"'); 
        ?>
      </div>
	  
      <div class="form-group">
        <?php	
		echo form_label('County','county_id');
        echo form_error('county_id');
		echo form_dropdown('county_id',$county_array , $county_id, 'id="county_id" class="form-control"');
        ?>
      </div>
      
      <div class="form-group">
        <?php		
		echo form_label('Sub-county','subcounty_id');
        echo form_error('subcounty_id');	    
        echo form_dropdown('subcounty_id',$subcounty_array , $subcounty_id, 'id="subcounty_id" class="form-control"');
		?>
      </div>  
	  
 	  <div class="form-group">
        <?php
		echo form_label('Constituency','constituency');
        echo form_error('constituency');
		echo form_input(['name' => 'constituency', 'id' => 'constituency',  'value' =>  $constituency, 'class' => 'form-control']);
		?>
      </div>
	  
 	  <div class="form-group">
        <?php
		echo form_label('Ward','ward');
        echo form_error('ward');
		echo form_input(['name' => 'ward', 'id' => 'ward',  'value' =>  $ward, 'class' => 'form-control']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
		echo form_label('Nearest Town','nearest_town');
        echo form_error('nearest_town');
		echo form_input(['name' => 'nearest_town', 'id' => 'nearest_town',  'value' =>  '', 'class' => 'form-control']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
		echo form_label('Distance to nearest Town','nearest_town_distance');
        echo form_error('nearest_town_distance');
		echo form_input(['name' => 'nearest_town_distance', 'id' => 'nearest_town_distance',  'value' =>  '', 'class' => 'form-control']);
        ?>
      </div>

	  <div class="form-group">
        <?php
		echo form_label('Distance to Sub-county depot','nearest_depot_distance');
        echo form_error('nearest_depot_distance');
		echo form_input(['name' => 'nearest_depot_distance', 'id' => 'nearest_depot_distance',  'value' =>  '', 'class' => 'form-control']);
        ?>
      </div>

	  <div class="form-group">
        <?php
		echo form_label('WCBA population (15-49)','wcba_pop');
        echo form_error('wcba_pop');
		echo form_input(['name' => 'wcba_pop', 'id' => 'wcba_pop',  'value' =>  '', 'class' => 'form-control']);
        ?>
      </div>		  
	  
	  <div class="form-group">
        <?php
		echo form_label('Catchment population','pop');
        echo form_error('pop');
		echo form_input(['name' => 'pop', 'id' => 'pop',  'value' =>  '', 'class' => 'form-control']);
        ?>
      </div>	
	  
	  <div class="form-group">
        <?php
		echo form_label('Catchment population (Under 1)','pop_under_one');
        echo form_error('pop_under_one');
		echo form_input(['name' => 'pop_under_one', 'id' => 'pop_under_one',  'value' =>  '', 'class' => 'form-control']);
        ?>
      </div>	  

	  <div class="form-group">
        <?php
		echo form_label('Electrification Status','elec_status');
        echo form_error('elec_status');
		echo form_dropdown('status',$status_array , 'Operational', 'class="form-control"');
        ?>
      </div>	
	  
      <div class="form-group">
        <?php		
		echo form_label('Fridge','fridge');
        echo form_error('fridge');	    
        echo form_dropdown('fridge',$fridge_array , 'Yes', 'class="form-control"');
        ?>
      </div>           
	  
	  <div class="form-group">
        <?php		
		echo form_label('Number of Cold Boxes','cold_box');
        echo form_error('cold_box');	    
        echo form_input(['name' =>'cold_box', 'value' => '', 'id' => 'cold_box', 'class' =>'form-control']);
        ?>
      </div>      

	  <div class="form-group">
        <?php		
		echo form_label('Number of Vaccine Carriers','vaccine_carrier');
        echo form_error('vaccine_carrier');	    
        echo form_input(['name' =>'vaccine_carrier', 'value' => '', 'id' => 'vaccine_carrier', 'class' =>'form-control']);
        ?>
      </div>    
 	  
      <div class="form-group">
        <?php		
		echo form_label('Status','status');
        echo form_error('status');	    
		echo form_dropdown('status',$status_array , 'Operational', 'class="form-control"');
        ?>
      </div>      
      
	  <?php echo form_submit('', 'Create Facility', 'name="facility_next" ,class="btn btn-primary btn-lg btn-block" id="facility_next"');?>
      <?php       
	  if (isset($update_id)){
		  echo form_hidden('region_id_id', $region_id);
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>
  
  
    <div class="row" id="fridge">
    <div class="col-lg-4 col-lg-offset-4">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');
    ?>
	<?php 
		$type_array = array(
		'CFAC' => 'CFAC',
		'CFEG' => 'CFEG',
		'CFEK' => 'CFEK',
		'CRAK' => 'CRAK',
		'CREG' => 'CREG',
		'CREK' => 'CREK',
		'CRFR' => 'CRFR',
		'CRFR' => 'CRFR',
		'IFAC' => 'IFAC',
		'IFEK' => 'IFEK',
		'ILR'  => 'ILR',
		'SPR'  => 'SPR',
		'UREG' => 'UREG',
		'UREK' => 'UREK',
		'CRRF' => 'CRRF',
	);
	$gas_array = array(
		'R134A' => 'R134A',
		'NH3' 	=> 'NH3',
		'R134a' => 'R134a'
	);
	$zone_array = array(
		'Hot'  => 'Hot',
		'Temperature' => 'Temperature'
	);
	$power_array = array(
		'E'  => 'Electricity',
		'EG' => 'Electricity, Gas',
		'EK' => 'Electricity, Kerosene',
		'S'  => 'Solar'	
	);
	
	?>
	
      <h1>Add Fridge</h1>
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
	   <div class="form-group">
        <?php
        echo form_label('Item Type','item_type');
        echo form_error('item_type');
		echo form_dropdown('item_type',$type_array , '', 'class="form-control"', 'id="item_type"');
        ?>
      </div>	
	  
      <div class="form-group">
        <?php
        echo form_label('Library ID','library_id');
        echo form_error('library_id');
        echo form_input(['name' => 'library_id', 'id' => 'library_id',  'value' =>  $library_id,'class' => 'form-control']);
        ?>
      </div>	
	  
      <div class="form-group">
        <?php
        echo form_label('PQS','pqs');
        echo form_error('pqs');
		echo form_input(['name' => 'pqs', 'id' => 'pqs',  'value' =>  $pqs,'class' => 'form-control']);
        ?>
      </div>
      	
      <div class="form-group">
        <?php
		echo form_label('Refrigerator Make','ref_make');
        echo form_error('ref_make');
		echo form_input(['name' => 'ref_make', 'id' => 'ref_make',  'value' =>  $ref_make,'class' => 'form-control']);
        ?>
      </div>
      	  
      <div class="form-group">
        <?php
        echo form_label('Model','model_name');
        echo form_error('model_name');
        echo form_input(['name' => 'model_name', 'id' => 'model_name',  'value' =>  $model_name,'class' => 'form-control']);
        ?>
      </div>
	  	  
      <div class="form-group">
        <?php	
		echo form_label('Power Source','power_source');
        echo form_error('power_source');
		echo form_dropdown('power_source',$power_array , $power_source, 'id="power_source" class="form-control"');
        ?>
      </div>
      
      <div class="form-group">
        <?php		
		echo form_label('Refrigerant Gas Type','refrigerant_gas_type');
        echo form_error('refrigerant_gas_type');	    
		echo form_dropdown('refrigerant_gas_type',$gas_array , $refrigerant_gas_type, 'id="refrigerant_gas_type" class="form-control"');
		?>
      </div>  
	  
 	  <div class="form-group">
        <?php
		echo form_label('Net Volume','positive_net_volume');
        echo form_error('positive_net_volume');
		echo form_input(['name' => 'positive_net_volume', 'id' => 'positive_net_volume',  'value' =>  $positive_net_volume, 'class' => 'form-control']);
		?>
      </div> 
	  
	  <div class="form-group">
        <?php
		echo form_label('Net Volume','negative_net_volume');
        echo form_error('negative_net_volume');
		echo form_input(['name' => 'negative_net_volume', 'id' => 'negative_net_volume',  'value' =>  $negative_net_volume, 'class' => 'form-control']);
		?>
      </div>
 	  <div class="form-group">
        <?php
		echo form_label('Gross Volume (4 degrees)','positive_gross_volume');
        echo form_error('positive_gross_volume');
		echo form_input(['name' => 'positive_gross_volume', 'id' => 'positive_gross_volume',  'value' =>  $positive_gross_volume, 'class' => 'form-control']);
		?>
      </div> 
	  
	  <div class="form-group">
        <?php
		echo form_label('Net Volume','negative_gross_volume');
        echo form_error('negative_net_volume');
		echo form_input(['name' => 'negative_gross_volume', 'id' => 'negative_gross_volume',  'value' =>  $negative_gross_volume, 'class' => 'form-control']);
		?>
      </div>
	  
 	  <div class="form-group">
        <?php
		echo form_label('Freezing Capacity','freezing_capacity');
        echo form_error('freezing_capacity');
		echo form_input(['name' => 'freezing_capacity', 'id' => 'freezing_capacity',  'value' =>  $freezing_capacity, 'class' => 'form-control']);
        ?>
      </div>
	  
      <div class="form-group">
        <?php		
		echo form_label('Price','price');
        echo form_error('price');	    
        echo form_input(['name' => 'price', 'id' => 'price',  'value' =>  $price, 'class' => 'form-control']);
        ?>
      </div>      
 	  
      <div class="form-group">
        <?php		
		echo form_label('Electricity to run','electricity');
        echo form_error('electricity');	    
		echo form_input(['name' => 'electricity', 'id' => 'electricity',  'value' =>  $electricity, 'class' => 'form-control']);
        ?>
      </div>       
	  
	  <div class="form-group">
        <?php		
		echo form_label('Gas to run','gas');
        echo form_error('gas');	    
		echo form_input(['name' => 'gas', 'id' => 'gas',  'value' =>  $gas, 'class' => 'form-control']);
	   ?>	  
		</div> 
		
		<div class="form-group">
        <?php		
		echo form_label('Kerosene to run','kerosene');
        echo form_error('kerosene');	    
		echo form_input(['name' => 'kerosene', 'id' => 'kerosene',  'value' =>  $kerosene, 'class' => 'form-control']);
		?>
		</div>  		
		
		<div class="form-group">
        <?php		
		echo form_label('Zone','zone');
        echo form_error('zone');	    
		echo form_dropdown('zone',$zone_array , 'Hot', 'class="form-control"');
        ?>
      </div>      
      
	  <?php echo form_submit('submit', 'Add Fridge', 'name="fridge_next", class="btn btn-primary btn-lg btn-block" id="fridge_next"');?>
      <?php       
	  if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>


