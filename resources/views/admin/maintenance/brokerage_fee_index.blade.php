@extends('layouts.maintenance')
@section('content')
<div class = "container-fluid">
    <div class = "row">
        <h2>&nbsp;Maintenance |Brokerage Fee</h2>
        <hr>
        <div class = "col-md-3 col-md-offset-9">
            <button  class="btn btn-info btn-md new" data-toggle="modal" data-target="#bfModal" style = "width: 100%;">New Brokerage Fee Range</button>
        </div>
    </div>
    <br />
    <div class = "row">
        <div class = "panel-default panel">
            <div class = "panel-body">
                <table class = "table-responsive table" id = "bf_table">
                    <thead>
                        <tr>
                            <td>
                                Date Effective
                            </td>
                            <td>
                                Dutiable Value Minimum
                            </td>
                            <td>
                                Dutiable Value Maximum
                            </td>
                            <td>
                                Brokerage Fee Amount
                            </td>
                            
                            <td>
                                Actions
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<section class="content">

    <form role="form" method = "POST" class="commentForm">
        <div class="modal fade" id="bfModal" role="dialog">
            <div class="form-group">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New Brokerage Fee Range</h4>
                        </div>
                        <div class="modal-body ">       
                            <div class="form-group required">
                                <label class="control-label " for="dateEffective">Date Effective:</label>
                                <input type="date" class="form-control" name = "dateEffective" id="dateEffective" placeholder="Enter Effective Date" data-rule-required="true">
                            </div>
                        </form>
                        <br />
                        <div class = "collapse" id = "bf_table_warning">
                            <div class="alert alert-danger">
                                <strong>Warning!</strong> Requires at least one import processing fee rate.
                            </div>
                        </div>
                        <div class = "collapse" id = "bf_warning">
                            <div class="alert alert-danger">
                                <strong>Warning!</strong> Something is wrong with the range.
                            </div>
                        </div>
                        <div class = "panel panel-default">
                            <div  style="overflow-x: auto;">
                                <div class = "panel-default">
                                    {{ csrf_field() }}
                                    <form id = "bf_form" class = "commentForm">
                                        <table class="table responsive table-hover" width="100%" id= "bf_parent_table" style = "overflow-x: scroll; left-margin: 5px; right-margin: 5px;">
                                            <thead>
                                                <tr>
                                                    <td width="20%">
                                                        <div class="form-group required">
                                                            <label class = "control-label"><strong>Minimum Dutiable Value</strong></label>
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group required">
                                                            <label class = "control-label"><strong>Maximum Dutiable Value</strong></label>
                                                        </div>
                                                    </td>

                                                    <td width="20%">
                                                        <div class="form-group required">
                                                            <label class = "control-label"><strong>Brokerage Fee Amount</strong></label>
                                                        </div>
                                                    </td>
                                                    <td width="10%" style="text-align: center;">
                                                        <strong>Action</strong>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tr id = "bf-row">
                                                <td>

                                                    <div class = "form-group input-group" >
                                                        <span class = "input-group-addon">$</span>
                                                        <input type = "text" class = "form-control money bf_minimum_valid"  
                                                        value ="0.00" name = "minimum" id = "minimum"  data-rule-required="true" readonly="true"  />
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class = "form-group input-group">
                                                        <span class = "input-group-addon">$</span>
                                                        <input type = "text" class = "form-control money bf_maximum_valid"  
                                                        value ="0.00" name = "maximum" id = "maximum"  data-rule-required="true" />
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class = "form-group input-group " >
                                                        <span class = "input-group-addon">Php</span>
                                                        <input type = "text" class = "form-control money amount_valid"  
                                                        value ="0.00" name = "amount" id = "amount"  data-rule-required="true" />
                                                    </div>

                                                </td>
                                                <td style="text-align: center;">
                                                    <button class = "btn btn-danger btn-md delete-bf-row">x</button>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class = "form-group" style = "margin-left:10px">
                                            <button    class = "btn btn-primary btn-md new-bf-row pull-left">New Range</button>
                                            <br /><br />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button id = "btnSave" type = "submit" class="btn btn-success finalize-bf">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>           
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br />
    </div>
</div>
</section>
<section class="content">
    <form role = "form" method = "POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <div class="modal fade" id="confirm-delete" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Deactivate record
                    </div>
                    <div class="modal-body">
                        Confirm Deactivating
                    </div>
                    <div class="modal-footer">

                        <button class = "btn btn-danger " id = "btnDelete" >Deactivate</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
</div>

@endsection
@push('styles')
<style>
    .class-brokerage-fee
    {
        border-left: 10px solid #8ddfcc;
        background-color:rgba(128,128,128,0.1);
        color: #fff;
    }
    .maintenance
    {
        border-left: 10px solid #8ddfcc;
        background-color:rgba(128,128,128,0.1);
        color: #fff;
    }

</style>
@endpush
@push('scripts')
<script type="text/javascript">
    $('#collapse2').addClass('in');
    var minimum_id = [];
    var maximum_id = [];

    var amount_value = [];
    var minimum_id_descrp = [];
    var maximum_id_descrp = [];
    var amount_value_descrp = [];



    var data;
    $(document).ready(function(){
        var bf_row = "<tr>" + $('#bf-row').html() + "</tr>";

        
        //$(minimum).attr("disabled", true);

        var bftable = $('#bf_table').DataTable({
            processing: false,
            serverSide: false,
            deferRender:true,
            'scrollx': true,
            ajax: 'http://localhost:8000/admin/bfData',
            columns: [

            { data: 'dateEffective' },

            { data: 'minimum',
            "render": function(data, type, row){
                return data.split(",").join("<br/>");}
            },

            { data: 'maximum',
            "render": function(data, type, row){
                return data.split(",").join("<br/>");}
            },
            { data: 'amount',
            "render": function(data, type, row){
                return data.split(",").join("<br/>");}
            },

            { data: 'action', orderable: false, searchable: false }

            ],  "order": [[ 0, "desc" ]],


        });

        $("#commentForm").validate({
            rules: 
            {
                dateEffective:
                {
                    required: true,
                },

                
            },
            onkeyup: false, 
            submitHandler: function (form) {
                return false;
            }
        });

        $(document).on('click', '.new', function(e){
            resetErrors();
            $('.modal-title').text('New Brokerage Fee Range');
            
            $('#dateEffective').val("");
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            $('#dateEffective').val(today);

            $('#bfModal').modal('show');

        });


        $(document).on('click', '.edit',function(e){
            resetErrors();
            var bf_id = $(this).val();
            data = bftable.row($(this).parents()).data();
            $('#dateEffective').val(data.dateEffective);
            for(var i = 0; i < (data.minimum).length; i++){
                $('#minimum').val(data.minimum);
                $('#maximum').val(data.maximum);
                $('#amount').val(data.amount); 
            }
            
            $('.modal-title').text('Update Brokerage Fee Range');
            $('#bfModal').modal('show');
        });

        $(document).on('click', '.deactivate', function(e){
            var bf_id = $(this).val();
            data = bftable.row($(this).parents()).data();
            $('#confirm-delete').modal('show');
        });


        $(document).on('click', '.delete-bf-row', function(e){
            e.preventDefault();
            $('#bf_warning').removeClass('in');
            if($('#bf_parent_table > tbody > tr').length == 1){
                $(this).closest('tr').remove();
                $('#bf_table_warning').addClass('fade in');
            }
            else{
                $(this).closest('tr').remove();
            }
        })

        $(document).on('click', '.new-bf-row', function(e){
            e.preventDefault();
            $('#bf_table_warning').removeClass('fade in');
            if(validatebfRows() === true){

                $('#bf_parent_table').append(bf_row);

                for(var i = 0; i < minimum.length; i++){
                    minimum[i+1].value = parseFloat(maximum[i].value) + 1;
                }
            }

        })

        $(document).on('change', '.bf_minimum_valid', function(e){
            $(".bf_minimum_valid").each(function(){
                if($(this).val() != ""){
                    $(this).css('border-color', 'green');

                }
                else{
                    $(this).css('border-color', 'red');
                }
            });
        })

        $(document).on('change', '.bf_minimum_valid', function(e){
            $(".bf_minimum_valid").each(function(){
                if($(this).val() != ""){
                    $(this).css('border-color', 'green');

                    for(var i = 0; i < minimum.length; i++){
                        minimum[i+1].value = parseFloat(maximum[i].value) + 1;
                    }
                }
                else{
                    $(this).css('border-color', 'red');
                }
            });
        })

        $(document).on('keypress', '.amount_valid', function(e){
            $(".amount_valid").each(function(){
                try{
                    var amount = parseFloat($(this).val());
                }
                catch(err){

                }
                if(typeof(amount) === "string"){

                }
                else{

                }
                if($(this).val() != ""){
                    $(this).css('border-color', 'green');
                }
                else{
                    $(this).css('border-color', 'red');
                }
            });
        })

        $('#btnDelete').on('click', function(e){
            e.preventDefault();
            $.ajax({
                type: 'DELETE',
                url:  '/admin/brokerage_fee/' + data.id,
                data: {
                    '_token' : $('input[name=_token').val()
                },
                success: function (data)
                {
                    bftable.ajax.reload();
                    $('#confirm-delete').modal('hide');

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "rtl": false,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": 300,
                        "hideDuration": 1000,
                        "timeOut": 2000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr["success"]("Record deactivated successfully")
                }
            })
        });

        $(document).on('click', '.finalize-bf', function(e){
            e.preventDefault();

            if(finalvalidatebfRows() === true){

                var title = $('.modal-title').text();
                if(title == "New Brokerage Fee Range")
                {
                    console.log('min' + minimum_id);    
                    console.log(maximum_id);    
                    $.ajax({
                        type: 'POST',
                        url:  '/admin/brokerage_fee',
                        data: {
                            '_token' : $('input[name=_token]').val(),
                            'dateEffective' : $('#dateEffective').val(),
                            'minimum' : minimum_id,
                            'maximum' :maximum_id,
                            'amount' : amount_value,
                        },

                        success: function (data){



                            bftable.ajax.reload();
                            $('#bfModal').modal('hide');
                            $('.modal-title').text('New Brokerage Fee Range');
                            $('#minimum').val("0.00");
                            $('#maximum').val("0.00"); 
                            $('#amount').val("0.00");



                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "rtl": false,
                                "positionClass": "toast-bottom-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": 300,
                                "hideDuration": 1000,
                                "timeOut": 2000,
                                "extendedTimeOut": 1000,
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr["success"]("Record addded successfully")
                            
                        }
                    })
                }
            }
        });
    });





function validatebfRows()
{

    minimum_id = [];
    maximum_id = [];
    amount_value = [];

    minimum_id_descrp = [];
    maximum_id_descrp = [];
    amount_value_descrp = [];

    range_pairs = [];
    dateEffective = document.getElementsByName('dateEffective');
    minimum =  document.getElementsByName('minimum');
    maximum =   document.getElementsByName('maximum');
    amount =  document.getElementsByName('amount');
    error = "";

    if(dateEffective === ""){

        dateEffective.style.borderColor = 'red';    
        error += "Date Effective Required.";

    } 


    for(var i = 0; i < minimum.length; i++){
        var temp;




        if(maximum[i].value === "")
        {
            maximum[i].style.borderColor = 'red';
            error += "Maximum Required.";
        }

        else
        {
            maximum[i].style.borderColor = 'green';
            maximum_id_descrp.push(maximum[i].value);
            maximum_id.push(maximum[i].value);
        }

        if(amount[i].value === "")
        {
            amount[i].style.borderColor = 'red';
            error += "Amount Required.";
        }

        else
        {
            if(amount[i].value < 1){
                amount[i].style.borderColor = 'red';
                error += "Amount Required.";
            }
            else{
                amount[i].style.borderColor = 'green';
                amount_value.push(amount[i].value);
            }
        }

        if(minimum[i].value === maximum[i].value){

            maximum[i].style.borderColor = 'red';
            error += "Same.";
        }

        if(minimum[i].value>maximum[i].value){

            maximum[i].style.borderColor = 'red';
            error += "Minimum is greater than maximum";
            $('#bf_warning').addClass('in');
        }   

        pair = {
            minimum: minimum[i].value,
            maximum : maximum[i].value
        };
        range_pairs.push(pair);
    }
    var i, j, n;
    found= false;
    n=range_pairs.length;

    for (i=0; i<n; i++) {                        
        for (j=i+1; j<n; j++)
        {              
            if (range_pairs[i].minimum === range_pairs[j].maximum && range_pairs[i].maximum === range_pairs[j].maximum){
                found = true;
                
                maximum[i].style.borderColor = 'red';

                minimum[j].style.borderColor = 'red';
                maximum[j].style.borderColor = 'red';
            }
        }   
    }
    if(found == true){
        error+= "Existing rate.";
    }

        //Final validation
        if(error.length == 0){
            return true;
        }

        else
        {
            return false;
        }

    }

    function finalvalidatebfRows()
    {
        minimum_id = [];
        maximum_id = [];
        amount_value = [];

        minimum_id_descrp = [];
        maximum_id_descrp = [];
        amount_value_descrp = [];

        range_pairs = [];

        minimum = document.getElementsByName('minimum');
        maximum = document.getElementsByName('maximum');
        amount = document.getElementsByName('amount');
        
        error = "";

        if($('#dateEffective').val() == ""){

            document.getElementById("dateEffective").style.borderColor = "red";
            error += "Date Effective Required.";

        }else{
            document.getElementById("dateEffective").style.borderColor = "black";

        }

        for(var i = 0; i < minimum.length; i++){


            if(minimum[i].value === "")
            {

                error += "Minimum Required.";
                $('#bf_warning').addClass('in');
            }

            else
            {

                minimum_id_descrp.push(minimum[i].value);
                var min = minimum[i].value
                minimum_id.push(minimum[i].value);
            }
            if(maximum[i].value === ""||maximum[i].value === "0.00"||maximum[i].value === "0")
            {
                maximum[i].style.borderColor = 'red';
                error += "Maximum Required.";
                $('#bf_warning').addClass('in');
            }

            else
            {
                maximum[i].style.borderColor = 'green';
                maximum_id_descrp.push(maximum[i].value);
                maximum_id.push(maximum[i].value);
            }

            if(amount[i].value === ""||amount[i].value === "0.00"||amount[i].value === "0")
            {
                amount[i].style.borderColor = 'red';
                error += "Amount Required.";
                $('#contract_rates_warning').addClass('in');
            }

            else
            {
                if(amount[i].value < 0){
                    amount[i].style.borderColor = 'red';
                    error += "Amount Required.";
                }
                else{
                    amount[i].style.borderColor = 'green';
                    amount_value.push(amount[i].value);
                }
            }

            if(minimum[i].value === maximum[i].value){

                maximum[i].style.borderColor = 'red';
                error += "Same.";
                $('#bf_warning').addClass('in');
            }

            if(minimum[i].value>maximum[i].value){

                maximum[i].style.borderColor = 'red';
                error += "Minimum is greater than maximum";
                $('#bf_warning').addClass('in');
            }   
            pair = {
                minimum: minimum[i].value,
                maximum: maximum[i].value
            };
            range_pairs.push(pair);
        }
        var i, j, n;
        found= false;
        n=range_pairs.length;
        for (i=0; i<n; i++) {                        
            for (j=i+1; j<n; j++)
            {              
                if (range_pairs[i].minimum === range_pairs[j].minimum && range_pairs[i].maximum === range_pairs[j].maximum){
                    found = true;
                    
                    maximum[i].style.borderColor = 'red';


                    maximum[j].style.borderColor = 'red';
                }
            }   
        }
        if(found == true){
            error+= "Existing rate.";
            $('#bf_warning').addClass('in');
        }

        if(error.length == 0){
            return true;
        }
        else
        {
            return false;
        }
    }
    function resetErrors() {
        $('form input, form select').removeClass('inputTxtError');
        $('label.error').remove();
    }
</script>
@endpush