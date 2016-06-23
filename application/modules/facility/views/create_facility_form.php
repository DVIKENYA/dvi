<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php echo form_open('facility/submit',array('class'=>'form-horizontal', 'id' =>'facility'));


 //echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');
      ?>
 <div class="row">
      <div class="col-lg-4 col-lg-offset-4">
        <!--Start of First Block--> 
      <div class="first block1 show">       
        <div class="form-group">
          <?php
          echo form_label('Facility Name','facility_name');
          echo form_error('facility_name');
          echo form_input(['name' => 'facility_name', 'id' => 'facility_name',  'value' =>  $facility_name,'class' => 'form-control', 'readonly'=>'true']);
          ?>
        </div>
    

        <div class="form-group">
          <?php
          echo form_label('Name of Officer In-charge','incharge');
          echo form_error('officer_incharge');
          echo form_input(['name' => 'officer_incharge','pattern'=>'[a-zA-Z\s]+', 'id' => 'officer_incharge',  'value' => $officer_incharge , 'class'=> 'form-control']);
          ?>
        </div>

        <div class="form-group">
          <?php
          echo form_label('Email Address','email');
          echo form_error('email');
          echo form_input(['name' => 'email', 'id' => 'email', 'pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 'value' => $email, 'placeholder'=>'e.g. someone@example.com', 'class'=> 'form-control']);
          ?>
        </div>

        <div class="form-group">
          <?php
          echo form_label('Phone Number','phone');
          echo form_error('phone');
          echo form_input(['name' => 'phone', 'pattern'=>"[07]{2}[0-9]{8}",'id' => 'phone',  'value' => $phone, 'class'=> 'form-control','placeholder' => 'e.g. 0712345678']);
          ?>
        </div>
        
        <div class="form-group">
          <?php
          echo form_label('Number of staff','staff');
          echo form_error('staff');
          echo form_input(['name' => 'staff','type'=>'number' ,'min'=>'0', 'id' => 'staff', 'value' =>  $staff, 'class' => 'form-control', 'placeholder' => 'Staff involved in immunization']);
          ?>
        </div>
        
        <div class="form-group">
          <?php
          echo form_label('Nearest Town','nearest_town');
          echo form_error('nearest_town');
          echo form_input(['name' => 'nearest_town','type'=>'number', 'min'=>'0','step'=>'0.1', 'id' => 'nearest_town',  'value' =>  $nearest_town, 'class' => 'form-control']);
          ?>
          </div>
          
        <div class="form-group">
          <?php
          echo form_label('Distance to Nearest Town','nearest_town_distance');
          echo form_error('nearest_town_distance');
          echo form_input(['name' => 'nearest_town_distance','type'=>'number', 'min'=>'0','step'=>'0.1', 'id' => 'nearest_town_distance', 'placeholder' =>'In Km', 'value' =>  $nearest_town_distance, 'class' => 'form-control']);
          ?>
        </div>
        
        <div class="form-group">
          <?php
          echo form_label('Distance to Sub-county depot','nearest_depot_distance');
          echo form_error('nearest_depot_distance');
          echo form_input(['name' => 'nearest_depot_distance','type'=>'number', 'min'=>'0','step'=>'0.1', 'id' => 'nearest_depot_distance', 'placeholder' =>'In Km', 'value' =>  $nearest_depot_distance, 'class' => 'form-control']);
          ?>
        </div>

        <div class="form-group">
          <?php
          echo form_label('WCBA Population (15-49)','wcba_population');
          echo form_error('wcba_population');
          echo form_input(['name' => 'wcba_population', 'type'=>'number', 'min'=>'0','id' => 'wcba_population',  'value' =>  $wcba_population, 'class' => 'form-control']);
          ?>
        </div>  
        
        <div class="form-group">
          <?php
          echo form_label('Total Catchment Population','catchment_population');
          echo form_error('catchment_population');
          echo form_input(['name' => 'catchment_population','type'=>'number', 'min'=>'0', 'id' => 'catchment_population',  'value' =>  $catchment_population, 'class' => 'form-control']);
          ?>
        </div>  
          
        <div class="form-group">
          <?php
          echo form_label('Catchment Population (Under 1 yr)','catchment_population_under_one');
          echo form_error('catchment_population_under_one');
          echo form_input(['name' => 'catchment_population_under_one','type'=>'number', 'min'=>'0', 'id' => 'catchment_population_under_one',  'value' =>  $catchment_population_under_one, 'class' => 'form-control']);
          ?>
        </div>
        
         <div class="form-group">
          <?php   
          echo form_label('Number of Cold Boxes','cold_box');
          echo form_error('cold_box');      
          echo form_input(['name' =>'cold_box','type'=>'number', 'min'=>'0' ,'value' => $cold_box, 'id' => 'cold_box', 'class' =>'form-control']);
          ?>
        </div>      

        <div class="form-group">
          <?php   
          echo form_label('Number of Vaccine Carriers','vaccine_carrier');
          echo form_error('vaccine_carrier');     
          echo form_input(['name' =>'vaccine_carrier', 'type'=>'number', 'min'=>'0', 'value' => $vaccine_carrier, 'id' => 'vaccine_carrier', 'class' =>'form-control']);
          ?>
        </div>
        
        
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
          <?php echo form_submit('submit', 'Submit', 'class="btn btn-lg btn-danger pull-right " id="submit"');
                     if (isset($update_id)){
                        echo form_hidden('update_id', $update_id);
                      }
                      echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
</div>
</div>