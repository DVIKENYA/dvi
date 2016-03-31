<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <?php 
      $administration = array(
          "Intramuscular Injection" => "Intramuscular Injection",
          "Oral Administration" => "Oral Administration",
          "Subcutaneous Injection" => "Subcutaneous Injection",
          "Intradermal Injection" => "Intradermal Injection",
          "Intranasal Spray Application" => "Intranasal Spray Application"
      );

      ?>
      <?php 
      $formulation = array(
          "Liquid"=>"Liquid",
          "Tablet"=>"Tablet",
          "Semi-liquid"=>"Semi-liquid"
      );
      ?>
      <h1>Add New Vaccine/Diluent/Supply</h1>
      <?php echo form_open('vaccines/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Name / Diluents','Vaccine_name');
        echo form_error('Vaccine_name');
        echo form_input(['name' => 'Vaccine_name', 'id' => 'vaccines', 'value' => $Vaccine_name ,'class' => 'form-control', 'placeholder' => 'Enter vaccine name']);
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
        echo form_input(['name' => 'Wastage_factor', 'id' => 'vaccines', 'type'=>'number', 'min'=>'0', 'step'=>'0.1',  'value' => $Wastage_factor ,'class' => 'form-control', 'placeholder' => 'Enter wastage factor']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Formulation','Vaccine_formulation');
        echo form_error('Vaccine_formulation');
        echo form_dropdown('Vaccine_formulation',$formulation , $Vaccine_formulation, 'id="Vaccine_formulation" class="form-control"'); 
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Mode of Administration','Mode_administration');
        echo form_error('Mode_administration');
        echo form_dropdown('Mode_administration',$administration , $Mode_administration, 'id="Mode_administration" class="form-control"'); 

        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Presentation','Vaccine_presentation');
        echo form_error('Vaccine_presentation');
        echo form_input(['name' => 'Vaccine_presentation', 'id' => 'vaccines', 'type'=>'number','min'=>'0', 'step'=>'0.1','value' => $Vaccine_presentation ,'class' => 'form-control', 'placeholder' => 'Enter vaccine presentation']);
        ?>
      </div>

      <div class="form-group">
        <?php
        echo form_label('Vaccine/Diluents Packed Volume(cm3/dose)','Vaccine_pck_vol');
        echo form_error('Vaccine_pck_vol');
        echo form_input(['name' => 'Vaccine_pck_vol', 'id' => 'vaccines',  'value' => $Vaccine_pck_vol ,'class' => 'form-control', 'placeholder' => 'Enter vaccine volume packed']);
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
