<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-12 ">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
      
      <?php echo form_open('inventory/submit',array('class'=>'form-horizontal','role'=>'form'));
      $equipments = array();
      foreach($maequipment as $row ){
      $equipments[$row->id] = $row->name; 
        }

 
        $etypes = array();
        foreach($matype as $row ){
        $etypes[]="Select One";
        $etypes[$row->id] = $row->name; 
          }
          // var_dump($array1);
          // die();
      ?>
     
      <div class="row"> 
         <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Equipment Name</b></label>
                  <?php echo form_dropdown('equipment',$equipments , $equipment, 'id="equipment" class="form-control"  AutoComplete=off');?>
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Equipment Type</b></label>
                  <?php echo form_dropdown('etype',$etypes , $etype, 'id="etype" class="form-control"  AutoComplete=off');?>
                </div><!--/form-group-->
            </div>

            </div><br/>
            <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Equipment Part</b></label>
                  <input type="text" name="part_type" placeholder="Enter Equipment part" class="form-control">
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
                  <label><b>Equipment Brand</b></label>
                  <input type="text" name="brand" class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Equipment Model</b></label>
                  <input type="text" name="model"  class="form-control">
                </div><!--/form-group-->
            </div>
            </div><br/>

      <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Catalogue #</b></label>
                  <input type="text" name="catalogue"  class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Unit Price</b></label>
                  <input type="text" name="unit_price"  class="form-control">
                </div><!--/form-group-->
            </div>
            </div><br/>
            <div class="row">
            <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Quantity #</b></label>
                  <input type="text" name="quantity"  class="form-control">
                </div><!--/form-group-->
            </div><!--/span-->
             <div class="col-lg-6">
             <div class="control-group">
                  <label><b>Date of Purchase</b></label>
                  <input type="text" name="date_purchased"  class="form-control">
                </div><!--/form-group-->
            </div>
            </div><br/>

      <button class="btn btn-lg btn-danger" name="submit" type="submit">Submit</button>
      <a class="btn btn-lg btn-info " href="<?php echo site_url('inventory');?>">CANCEL</a>
     
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>
  <script type="text/javascript">
              $(document).ready(function () { 
                
                //start of checker
                    $('#equipment select').change(function () {
                    var selEquip = $(this).val();
                    console.log(selEquip);
                    console.log("Detected change... ");
                    
                

                });
            //End of user basestation assignment

            });
               
               
               
        </script>  

