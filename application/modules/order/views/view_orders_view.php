<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <h1>Edit Vaccine</h1>
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Name','Name');
        echo form_error('Name');
        echo form_input('Name',set_value('Name',$vaccines['Name']),'class="form-control"');
  
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Doses Required','Doses_required');
        echo form_error('Doses_required');
        echo form_input('Doses_required',set_value('Doses_required',$vaccines['Doses_required']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Wastage Factor','Wastage_factor');
        echo form_error('Wastage_factor');
        echo form_input('Wastage_factor',set_value('Wastage_factor',$vaccines['Wastage_factor']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Color','Tray_color');
        echo form_error('Tray_color');
        echo form_input('Tray_color',set_value('Tray_color',$vaccines['Tray_color']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Designation','Vaccine_designation');
        echo form_error('Vaccine_designation');
        echo form_input('Vaccine_designation',set_value('Vaccine_designation',$vaccines['Vaccine_designation']),'class="form-control"');
        //echo $vaccines['Vaccine_designation'];
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Vaccine Formulation','Vaccine_formulation');
        echo form_error('Vaccine_formulation');
        echo form_input('Vaccine_formulation',set_value('Vaccine_formulation',$vaccines['Vaccine_formulation']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Mode of Administration','Mode_administration');
        echo form_error('Mode_administration');
        echo form_input('Mode_administration',set_value('Mode_administration',$vaccines['Mode_administration']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Presentation(Doses/Vial)','Vaccine_presentation');
        echo form_error('Vaccine_presentation');
        echo form_input('Vaccine_presentation',set_value('Vaccine_presentation',$vaccines['Vaccine_presentation']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Fridge Compartment','Fridge_compart');
        echo form_error('Fridge_compart');
        echo form_input('Fridge_compart',set_value('Fridge_compart',$vaccines['Fridge_compart']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Packed Volume(cm3/dose)','Vaccine_pck_vol');
        echo form_error('Vaccine_pck_vol');
        echo form_input('Vaccine_pck_vol',set_value('Vaccine_pck_vol',$vaccines['Vaccine_pck_vol']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Diluents Packed Volume(cm3/dose)','Diluents_pck_vol');
        echo form_error('Diluents_pck_vol');
        echo form_input('Diluents_pck_vol',set_value('Diluents_pck_vol',$vaccines['Diluents_pck_vol']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Price($USD/Vial)','Vaccine_price_vial');
        echo form_error('Vaccine_price_vial');
        echo form_input('Vaccine_price_vial',set_value('Vaccine_price_vial',$vaccines['Vaccine_price_vial']),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Vaccine Price($USD/Dose)','Vaccine_price_dose');
        echo form_error('Vaccine_price_dose');
        echo form_input('Vaccine_price_dose',set_value('Vaccine_price_dose',$vaccines['Vaccine_price_dose']),'class="form-control"');
        ?>
      </div>
      <?php echo form_hidden('ID',$vaccines['ID']);?>
      <?php echo form_submit('submit', 'Edit Vaccine Information', 'class="btn btn-primary btn-lg btn-block"');?>
      <?php echo form_close();?>
    </div>
  </div>
