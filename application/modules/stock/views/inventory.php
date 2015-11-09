 <div class="row">
    <div class="col-lg-12">
<div class="table-responsive">
 <?php echo $this->session->flashdata('msg');  ?>
<table class="table table table-bordered table-hover table-striped" id="inventory">
        <thead>
                
              <th>Vaccine/Diluents</th>
              <th>Vaccine Formulation</th>
              <th>Mode Of Administration</th>
              <th>Action</th>
        </thead>

        <tbody>

             <?php foreach ($vaccines as $vaccine) {
              $ledger_url = base_url().'stock/get_vaccine_ledger/'.$vaccine['ID'];
              ?>
              <tr>
                    <td><?php echo $vaccine['Vaccine_name']?></td>
                    <td><?php echo $vaccine['Vaccine_formulation']?></td>
                    <td><?php echo $vaccine['Mode_administration']?></td>  
                    <td align="center"><a href="<?php echo $ledger_url ?>"> <span class="label label-success">view vaccine ledger</span> <i class="fa  fa-book semiround"></i> </a></td>

              </tr>
               <?php }?>

        </tbody>
        </table>
</div>

        <script type="text/javascript">

               window.setTimeout(function() {
                  $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
                      $(this).remove(); 
                  });
              }, 2000);
        </script> 