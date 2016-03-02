   <h4>Filter By:</h4>
   <input name="reportrange" id="reportrange" />

    <div class="table-responsive">
        <table id="rewards-datatable" class="table table-striped table-bordered table-condensed" cellspacing="0" width=" 100%">
        <thead>
        <tr>
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>LOAN ACCOUNT</th>
            <th>LEVEL</th>
            <th>AMOUNT</th>
            <th>TOTAL</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>31/01/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005001</td>
            <td>1</td>
            <td>150.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>28/02/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>22200059999</td>
            <td>1</td>
            <td>150.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>15/03/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005077</td>
            <td>1</td>
            <td>150.00</td>
            <td>340.00</td>
        </tr>
        <tr>
            <td>30/04/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005004</td>
            <td>2</td>
            <td>10.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>31/01/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005001</td>
            <td>1</td>
            <td>150.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>28/02/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>22200059999</td>
            <td>1</td>
            <td>150.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>15/03/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005077</td>
            <td>1</td>
            <td>150.00</td>
            <td>340.00</td>
        </tr>
        <tr>
            <td>30/04/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005004</td>
            <td>2</td>
            <td>10.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>31/01/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005001</td>
            <td>1</td>
            <td>150.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>28/02/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>22200059999</td>
            <td>1</td>
            <td>150.00</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>15/03/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005077</td>
            <td>1</td>
            <td>150.00</td>
            <td>340.00</td>
        </tr>
        <tr>
            <td>30/04/2014</td>
            <td>PAYMENT RECEIVED</td>
            <td>2220005004</td>
            <td>2</td>
            <td>10.00</td>
            <td>150.00</td>
        </tr>

        </tbody>
        </table>

    </div>

<script>
    $(document).ready(function () {
//DATATABLE
//To display datatable without search and page length select, and to still have pagination work, instantiate like so
        var oTable = $('#rewards-datatable').dataTable({
            "sDom": "tp",
            "pageLength": 10,
            "pagination": true
        });
//DATE RANGE
//set global vars that are set by daterange picker, to be used by datatable
        var startdate;
        var enddate;
//instantiate datepicker and choose your format of the dates
        $('#reportrange').daterangepicker({
            initialText : 'Select period...',
            presetRanges: [{
                text: 'Today',
                dateStart: function() { return moment() },
                dateEnd: function() { return moment() }
            }, {
                text: 'Tomorrow',
                dateStart: function() { return moment().add('days', 1) },
                dateEnd: function() { return moment().add('days', 1) }
            }, {
                text: 'Next 7 Days',
                dateStart: function() { return moment() },
                dateEnd: function() { return moment().add('days', 6) }
            }, {
                text: 'Next Week',
                dateStart: function() { return moment().add('weeks', 1).startOf('week') },
                dateEnd: function() { return moment().add('weeks', 1).endOf('week') }
            }],
            applyOnMenuSelect: false,
            datepickerOptions: {
                minDate: 0,
                maxDate: null
            }
        });
////Filter the datatable on the datepicker apply event
//        $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
//                startdate = picker.startDate.format('YYYY-MM-DD');
//                enddate = picker.endDate.format('YYYY-MM-DD');
//                oTable.fnDraw();
//            }
//        );
//
//        $.fn.dataTableExt.afnFiltering.push(
//            function (oSettings, aData, iDataIndex) {
//                if (startdate != undefined) {
//// 0 here is the column where my dates are.
////Convert to YYYY-MM-DD format from DD/MM/YYYY
//                    var coldate = aData[0].split("/");
//                    var d = new Date(coldate[2], coldate[1] - 1, coldate[0]);
//                    var date = moment(d.toISOString());
//                    date = date.format("YYYY-MM-DD");
//
////Remove hyphens from dates
//                    dateMin = startdate.replace(/-/g, "");
//                    dateMax = enddate.replace(/-/g, "");
//                    date = date.replace(/-/g, "");
//
////console.log(dateMin, dateMax, date);
//
//// run through cases to filter results
//                    if (dateMin == "" && date <= dateMax) {
//                        return true;
//                    }
//                    else if (dateMin == "" && date <= dateMax) {
//                        return true;
//                    }
//                    else if (dateMin <= date && "" == dateMax) {
//                        return true;
//                    }
//                    else if (dateMin <= date && date <= dateMax) {
//                        return true;
//                    }
//
//// all failed
//                    return false;
//                }
//            }
//        );
    });
</script>

 

