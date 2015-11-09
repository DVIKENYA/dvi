<div class="panel-body">
	<?php $tab = (isset($tab)) ? $tab : 'Tab1'; ?>
                <ul id="myTab" class="nav nav-tabs">
                  <li class="<?php echo ($tab == 'Tab1') ? 'active' : ''; ?>"><a href="#Tab1" data-toggle="tab">Tab1</a></li>
                  <li class="<?php echo ($tab == 'Tab2') ? 'active' : ''; ?>"><a href="#Tab2" data-toggle="tab">Tab2</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade active in" id="Tab1">
                   
				    <div class="row">
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
      <?php echo form_open('facility/submit',array('class'=>'form-horizontal'));?>
	  
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
		echo form_dropdown('facility_type',$type_array , 'Hospital', 'class="form-control"');
        ?>
      </div>	
	  
      <div class="form-group">
        <?php
        echo form_label('Owner','owner');
        echo form_error('owner');
        echo form_dropdown('owner',$owner_array , 'Private', 'class="form-control"');
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
      
	  <?php echo form_submit('submit', 'Create Facility', 'class="btn btn-primary btn-lg btn-block"');?>
      <?php       
	  if (isset($update_id)){
		  echo form_hidden('region_id_id', $region_id);
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>
</div>
                 
				 <div class="tab-pane fade" id="Tab2">
                   
				   </div>
                </div>
              </div>
</div>