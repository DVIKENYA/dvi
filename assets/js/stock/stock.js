  
// Add another row in the form on click add

           $('#stock_issue').delegate( '.add', 'click', function () {
           	
             var thisRow =$('#stock_issue tr:last');
              var cloned_object = $( thisRow ).clone();

              var issue_row = cloned_object.attr("issue_row");
			  var next_issue_row = parseInt(issue_row) + 1;
			   cloned_object.attr("issue_row", next_issue_row);
                
                var vaccine_id = "vaccine" + next_issue_row;
			    var vaccine = cloned_object.find(".vaccine");
				vaccine.attr('id',vaccine_id);
               
               var batch_id = "batch_no" + next_issue_row;
			    var batch = cloned_object.find(".batch_no");
				batch.attr('id',batch_id);

				var expiry_id = "expiry_date" + next_issue_row;
				var expiry = cloned_object.find(".expiry_date");
				expiry.attr('id',expiry_id);

				var amt_ordered_id = "amt_ordered" + next_issue_row;
			    var amt_ordered = cloned_object.find(".amt_ordered");
				amt_ordered.attr('id',amt_ordered_id);

				var amt_issued_id = "amt_issued" + next_issue_row;
			    var amt_issued = cloned_object.find(".amt_issued");
				amt_issued.attr('id',amt_issued_id);

				var vvm_id= "vvm" + next_issue_row;
			    var vvm_status = cloned_object.find(".vvm_s");
				vvm_status.attr('id',vvm_id);


                cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
             
                });
// Remove a row from the form
           $('#stock_issue').delegate('.remove', 'click', function(){
             $(this).closest('tr').remove();});


          

	 $("#issuestock_fm").submit(function(e)
         {
         	e.preventDefault();//STOP default action
         	var vaccine_count=0;
         	$.each($(".vaccine"), function(i, v) {
                   vaccine_count++;
         	});

		   
		   var formURL="<?php echo base_url();?>stock/save_issued_stock";

		   var vaccines = retrieveFormValues_Array('vaccine');
		   var batch_no = retrieveFormValues_Array('batch_no');
		   var expiry_date = retrieveFormValues_Array('expiry_date');
		   var amt_ordered = retrieveFormValues_Array('amt_ordered');
		   var amt_issued = retrieveFormValues_Array('amt_issued');
		   var vvm_status = retrieveFormValues_Array('vvm_status');
		   var date_issued = retrieveFormValues('date_issued');
		   var issued_to= retrieveFormValues('issued_to');
		   var transaction_type= retrieveFormValues('transaction_type');



		   	for(var i = 0; i < vaccine_count; i++) {
		   		var get_vaccine=vaccines[i];
		   		var get_batch=batch_no[i];
		   		var get_expiry=expiry_date[i];
		   		var get_amt_ordered=amt_ordered[i];
		   		var get_amt_issued=amt_issued[i];
		   		var get_vvm_status=vvm_status[i];
		   		var get_date_issued=date_issued;
                var get_issued_to=issued_to;
                var get_transaction_type=transaction_type;

			    $.ajax(
			    {
			        url : formURL,
			        type: "POST",
			        data : {"transaction_type":get_transaction_type,"date_issued":get_date_issued,"issued_to":get_issued_to,"vaccine":get_vaccine,"batch_no":get_batch,"expiry_date":get_expiry,"amt_issued":get_amt_issued,"vvm_status":get_vvm_status},
			       /* dataType : json,*/
			        success:function(data, textStatus, jqXHR) 
			        {
			        	var new_url="<?php echo base_url().'stock/list_inventory'?>";
			        	window.location.replace(new_url);
			            //data: return data from server
			        },
			        error: function(jqXHR, textStatus, errorThrown) 
			        {
			            //if fails      
			        }
			    });
		 }
		   // e.unbind(); //unbind. to stop multiple form submit.
           });

		$("#vaccine").change(function(){
			var stock_row=$(this);
		   var selected_vaccine=$(this).val();
		   load_batches(selected_vaccine,stock_row);
		});

		function load_batches(selected_vaccine,stock_row){
		
				var _url="<?php echo base_url();?>stock/get_batches";
						
				var request=$.ajax({
			     url: _url,
			     type: 'post',
			     data: {"selected_vaccine":selected_vaccine},

			    });
			    request.done(function(data){
			    	data=JSON.parse(data);
			    	console.log(data);
			    	stock_row.closest("tr").find(".batch_no option").remove();
			    	stock_row.closest("tr").find(".expiry_date ").val("");
			    	stock_row.closest("tr").find(".available_quantity").val("");
			    	stock_row.closest("tr").find(".vvm_s").val("");
			    	stock_row.closest("tr").find(".batch_no ").append("<option value='0'>Select batch </option> ");
			    	$.each(data,function(key,value){
			    		stock_row.closest("tr").find(".batch_no").append("<option value='"+value.batch_number+"'>"+value.batch_number+"</option> ");

			    		
			    		/*value[0].batch_number;*/
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}
		
		$(".batch_no").change(function(){
			var stock_row=$(this);
		   var selected_batch=$(this).val();
		   batch_details(selected_batch,stock_row);
		});

		function batch_details(selected_batch,stock_row){
			var _url="<?php echo base_url();?>stock/get_batch_details";
						
				var request=$.ajax({
					     url: _url,
					     type: 'post',
					     data: {"selected_batch":selected_batch},

			    });
			    request.done(function(data){
			    	data=JSON.parse(data);
			    	console.log(data);
			    	stock_row.closest("tr").find(".expiry_date ").val("");
			    	stock_row.closest("tr").find(".available_quantity").val("");
			    	stock_row.closest("tr").find(".vvm_s").val("");
			    	$.each(data,function(key,value){
			    		stock_row.closest("tr").find(".expiry_date").val(value.expiry_date);
			    		stock_row.closest("tr").find(".available_quantity").val(value.stock_balance);
			    		stock_row.closest("tr").find(".vvm_s").val(value.name);

			    		
			    		/*value[0].batch_number;*/
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}

		 //This function loops the whole form and saves all the input, select, e.t.c. elements with their corresponding values in a javascript array for processing

           function retrieveFormValues(name) {
                      var dump;
                        $.each($("input[name=" + name + "], select[name=" + name + "]"), function(i, v) {
                            var theTag = v.tagName;
                            var theElement = $(v);
                            var theValue = theElement.val();
                            dump = theValue;
                        });
                      return dump;
            }
	
	        function retrieveFormValues_Array(name) {
								var dump = new Array();
								var counter = 0;
									$.each($("input[name=" + name + "], select[name=" + name + "]"), function(i, v) {
											var theTag = v.tagName;
											var theElement = $(v);
											var theValue = theElement.val();
											/*dump[counter] = theElement.attr("value");*/
											dump[counter] = theValue;

											counter++;
									});
								return dump;
				}


