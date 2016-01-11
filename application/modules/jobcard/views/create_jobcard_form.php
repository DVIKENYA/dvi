<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12 ">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      
      <?php echo form_open('',array('class'=>'form-horizontal','role'=>'form'));?>
      <div class="well well-sm"><b>Basic Job Information</b></div>
      <div class="row"> 
    <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Station Base Level</b></label>
                  <input type="text" name="station_base" placeholder="Enter station base" class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Facility Name</b></label>
                  <input type="text" name="facility" placeholder="Enter facility name" class="form-control">
                </div><!--/form-group-->
            </div>

            </div><br/>
            <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Type of Equipment</b></label>
                  <input type="text" name="equipment" placeholder="Enter Equipment type" class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Inventory/Serial No #</b></label>
                  <input type="text" name="serial"  class="form-control">
                </div><!--/form-group-->
            </div>
            </div><br/>
            <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Previous Repair Date</b></label>
                  <input type="text" name="last_repair_date" class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Previously Repaired By</b></label>
                  <input type="text" name="last_repaired_by"  class="form-control">
                </div><!--/form-group-->
            </div>
            </div><br/>
     <div class="well well-sm"><b>Equipment Repair Details</b></div>
      <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  <label><b>Diagnosis (Defects)</b></label>
                  <!-- <input type="textarea" name="station_base"  class="form-control"> -->
                  <textarea class="form-control" name="defects"></textarea>
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>

            <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  <label><b>Actions Taken</b></label>
                  <!-- <input type="textarea" name="station_base"  class="form-control"> -->
                  <textarea class="form-control" name="action"></textarea>
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>
            <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  <label><b>Spare Parts Used</b></label>
                  <!-- <input type="textarea" name="station_base"  class="form-control"> -->
                 <table class="table table-bordered ">
        <thead>
                <tr><td align="center">Item</td><td>Description</td><td>Catalogue No #</td><td>Quantity No #</td></tr>
        </thead>

        <tbody>
              <tr>
              <td align="center">1</td>
              <td><input type="text" name="spare_1" class="form-control"></td>
              <td><input type="text" name="catalogue_1" class="form-control"></td>
              <td><input type="text" name="quantity_1" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">2</td>
              <td><input type="text" name="spare_2" class="form-control"></td>
              <td><input type="text" name="catalogue_2" class="form-control"></td>
              <td><input type="text" name="quantity_2" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">3</td>
              <td><input type="text" name="spare_3" class="form-control"></td>
              <td><input type="text" name="catalogue_3" class="form-control"></td>
              <td><input type="text" name="quantity_3" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">4</td>
              <td><input type="text" name="spare_4" class="form-control"></td>
              <td><input type="text" name="catalogue_4" class="form-control"></td>
              <td><input type="text" name="quantity_4" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">5</td>
              <td><input type="text" name="spare_5" class="form-control"></td>
              <td><input type="text" name="catalogue_5" class="form-control"></td>
              <td><input type="text" name="quantity_5" class="form-control"></td>
              </tr>
               <tr>
              <td align="center">6</td>
              <td><input type="text" name="spare_6" class="form-control"></td>
              <td><input type="text" name="catalogue_6" class="form-control"></td>
              <td><input type="text" name="quantity_6" class="form-control"></td>
              </tr>

        </tbody>
        </table> 
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>
             
            <div class="row"> 
              <div class="col-lg-12">
              <label><b>Reason for Failure</b></label> 
            <div class="control-group">
            <div class="col-lg-6">
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox1" value="option1"> Wear and Tear </label><br/>
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox2" value="option2"> Contamination </label><br/>
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox3" value="option3"> User Fault </label><br/>
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox3" value="option3"> Improper Instalation</label><br/>
                  </div>
                  <div class="col-lg-6">
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox1" value="option1"> Unstable Mains </label><br/>
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox2" value="option2"> User Error </label><br/>
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox3" value="option3"> Dirt </label><br/>
          <label class="checkbox-inline"><input type="checkbox" id="inlinecheckbox3" value="option3"> Other (Specify below) </label><br/>
                  </div>
                </div><!--/form-group--> 
                </div><!--/span-->  
            </div><br/>
              <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  <label><b>* Specify</b></label>
                  <input type="text" name="other"  class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>
            <div class="well well-sm"><b>Test Administered Before Dispatch</b></div>


            <div class="row"> 
              <div class="col-lg-12">
              <label><b>Gas Leak</b></label> 
            <div class="control-group">
            <label class="radio-inline"><input type="radio" name="gasleak" id="inlineradio1" value="1">Yes </label>
            <label class="radio-inline"><input type="radio" name="gasleak" id="inlineradio1" value="0">No </label>   
                </div><!--/form-group--> 
                </div><!--/span-->  
            </div><br/>

            <div class="row"> 
              <div class="col-lg-12">
              <label><b>Temprature within +2<sup>o</sup> C to +8<sup>o</sup> C </b></label> 
            <div class="control-group">
            <label class="radio-inline"><input type="radio" name="temppos" id="inlineradio1" value="1">Yes </label>
            <label class="radio-inline"><input type="radio" name="temppos" id="inlineradio1" value="0">No </label>   
                </div><!--/form-group--> 
                </div><!--/span-->  
            </div><br/>

            <div class="row"> 
              <div class="col-lg-12">
              <label><b>Temprature within -15<sup>o</sup> C to -25<sup>o</sup> C </b></label> 
            <div class="control-group">
            <label class="radio-inline"><input type="radio" name="tempneg" id="inlineradio1" value="1">Yes </label>
            <label class="radio-inline"><input type="radio" name="tempneg" id="inlineradio1" value="0">No </label>   
                </div><!--/form-group--> 
                </div><!--/span-->  
            </div><br/>

            <div class="row"> 
              <div class="col-lg-12">
              <label><b>Door Seal</b></label> 
            <div class="control-group">
            <label class="radio-inline"><input type="radio" name="doorseal" id="inlineradio1" value="Loose">Loose </label>
            <label class="radio-inline"><input type="radio" name="doorseal" id="inlineradio1" value="Broken">Broken </label>
            <label class="radio-inline"><input type="radio" name="doorseal" id="inlineradio1" value="Intact">Intact </label>   
            </div><!--/form-group--> 
            </div><!--/span-->  
            </div><br/>
            <div class="row"> 
    <div class="col-lg-12">
             <div class="control-group">
                  <label><b>Additional Comments</b></label>
                  <input type="text" name="other"  class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
            </div><br/>

<div class="well well-sm"><b>Technician Details</b></div>

      <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Technician Name</b></label>
                  <input type="text" name="technician_name"  class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Full Name Initials</b></label>
                  <input type="text" name="signature"  class="form-control">
                </div><!--/form-group-->
            </div>
            </div><br/>

      <button class="btn btn-lg btn-danger" name="submit" type="submit">Submit</button>
     
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>
