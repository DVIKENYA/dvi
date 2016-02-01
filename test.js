/**
 * Created by user on 2/1/16.
 */
request.done(function(data){
    data=JSON.parse(data);


    rows = $('#issue_row11');


    console.log(rows);
    $.each(data.issue_row11,function(key,value){

        rows.closest("tr").find(".batch_no").append("<option value='"+value.batch_no+"'>"+value.batch_no+"</option> ");
        rows.closest("tr").find(".expiry_date ").val("");
        rows.closest("tr").find(".vvm_s").val("");
        $(document).on( 'change','.batch_no', function () {
            rows.find(".expiry_date").val(value.expiry_date);
            rows.find(".vvm_s").val(value.vvm_status);
        });

    });

    rows = $('#issue_row12');


    console.log(rows);
    $.each(data.issue_row12,function(key,value){

        rows.closest("tr").find(".batch_no").append("<option value='"+value.batch_no+"'>"+value.batch_no+"</option> ");
        rows.closest("tr").find(".expiry_date ").val("");
        rows.closest("tr").find(".vvm_s").val("");
        $(document).on( 'change','.batch_no', function () {
            rows.find(".expiry_date").val(value.expiry_date);
            rows.find(".vvm_s").val(value.vvm_status);
        });

    });
});
request.fail(function(jqXHR, textStatus) {

});
