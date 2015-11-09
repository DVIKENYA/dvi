<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      <h1>Add New Vaccine</h1>
      <?php echo form_open('vaccines/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Name','Vaccine_name');
        echo form_error('Vaccine_name');
        echo form_input(['name' => 'Vaccine_name', 'id' => 'vaccines',  'value' => $Vaccine_name ,'class' => 'form-control', 'placeholder' => 'Enter vaccine name']);
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Doses Required','Doses_required');
        echo form_error('Doses_required');
        echo form_input(['name' => 'Doses_required', 'id' => 'vaccines',  'value' => $Doses_required ,'class' => 'form-control', 'placeholder' => 'Enter doses required']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Wastage Factor','Wastage_factor');
        echo form_error('Wastage_factor');
        echo form_input(['name' => 'Wastage_factor', 'id' => 'vaccines',  'value' => $Wastage_factor ,'class' => 'form-control', 'placeholder' => 'Enter wastage factor']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Tray Color','Tray_color');
        echo form_error('Tray_color');
        echo form_input(['name' => 'Tray_color', 'id' => 'vaccines',  'value' => $Tray_color ,'class' => 'form-control', 'placeholder' => 'Enter tray color']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Designation','Vaccine_designation');
        echo form_error('Vaccine_designation');
        echo form_input(['name' => 'Vaccine_designation', 'id' => 'vaccines',  'value' => $Vaccine_designation ,'class' => 'form-control', 'placeholder' => 'Enter vaccine designation']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Formulation','Vaccine_formulation');
        echo form_error('Vaccine_formulation');
        echo form_input(['name' => 'Vaccine_formulation', 'id' => 'vaccines',  'value' => $Vaccine_formulation ,'class' => 'form-control', 'placeholder' => 'Enter vaccine formuation']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Mode of Administration','Mode_administration');
        echo form_error('Mode_administration');
        echo form_input(['name' => 'Mode_administration', 'id' => 'vaccines',  'value' => $Mode_administration ,'class' => 'form-control', 'placeholder' => 'Enter mode of administration']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Presentation','Vaccine_presentation');
        echo form_error('Vaccine_presentation');
        echo form_input(['name' => 'Vaccine_presentation', 'id' => 'vaccines',  'value' => $Vaccine_presentation ,'class' => 'form-control', 'placeholder' => 'Enter vaccine presentation']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Fridge Compartment','Fridge_compart');
        echo form_error('Fridge_compart');
        echo form_input(['name' => 'Fridge_compart', 'id' => 'vaccines',  'value' => $Fridge_compart ,'class' => 'form-control', 'placeholder' => 'Enter fridge compartment']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Packed Volume(cm3/dose)','Vaccine_pck_vol');
        echo form_error('Vaccine_pck_vol');
        echo form_input(['name' => 'Vaccine_pck_vol', 'id' => 'vaccines',  'value' => $Vaccine_pck_vol ,'class' => 'form-control', 'placeholder' => 'Enter vaccine volume packed']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Diluents Packed Volume(cm3/dose)','Diluents_pck_vol');
        echo form_error('Diluents_pck_vol');
        echo form_input(['name' => 'Diluents_pck_vol', 'id' => 'vaccines',  'value' => $Diluents_pck_vol ,'class' => 'form-control', 'placeholder' => 'Enter diluents volume packed']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Price($USD/Vial)','Vaccine_price_vial');
        echo form_error('Vaccine_price_vial');
        echo form_input(['name' => 'Vaccine_price_vial', 'id' => 'vaccines',  'value' => $Vaccine_price_vial ,'class' => 'form-control', 'placeholder' => 'Enter vaccine price per vial']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Price($USD/Dose)','Vaccine_price_dose');
        echo form_error('Vaccine_price_dose');
        echo form_input(['name' => 'Vaccine_price_dose', 'id' => 'vaccines',  'value' => $Vaccine_price_dose ,'class' => 'form-control', 'placeholder' => 'Enter vaccine price per dose']);
        ?>
      </div>
      <div class="col-lg-14 col-lg-offset-0.3">
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Create Vaccine</button>
      </div>
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>
