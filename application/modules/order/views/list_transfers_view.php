<form id="list_transfers_fm">
  <div>
      <ol class="breadcrumb">
        <li><a href="#">Vaccines Tranfers</a></li><span class="divider">/</span>
        <li class="active"><a href="#"><?php echo $page_title;?></a></li><span class="divider">/</span>
      </ol>
    </div>
   <div>
   <a href='<?php echo site_url('admin/order_management/transfer_vaccines');?>' class='btn btn-info state_change' id="issue_vaccines" value="Issue Vaccines">Issue Vaccines</a>
   <hr></hr>

    <table class="table" id="list_transfers_tbl">
<thead>
  <tr><td>Issue No</td><td>Issued To </td><td>Date Issued </td><td>Status</td><td>Action</td></tr>
</thead>
<tbody>
<tr><td></td><td> </td><td></td><td></td>
<td><a href="#">View</a><span class="divider"> | </span><a href="#">Edit</a></td></tr>
</tbody>
</table>
</form>