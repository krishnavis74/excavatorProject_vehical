@extends('backend.master')
@section('content')
    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: white !important;
            opacity: 1;
        }

        .w-6 {
            width: 1.25rem;
        }

        .h-6 {
            height: 1.25rem;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">

                    {!! Form::button('<i class="fa fa-desktop "></i> Dash Board / <b>Vehicle</b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}

                    <!-- <h1 class="m-0">scwscs</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('vehicle_repairing_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ;  "><i
                                    class="fa fa-plus-circle"></i> &nbsp; Vehicle Repairing List &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid" style="width:75%">
            <div class="row ">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="padding:0;">

                    <div class="card card-primary shadow  rounded-3" style="  padding:0;">
                        <div class="  " style="background-color: #2f5ffa;color:white; ">
                            <p class="card-title" style="font-size: 20px; color:white;  padding:7px; ">Vehicle Repairing
                            </p>
                        </div>
                        {!! Form::open(['url' => '', 'method' => 'post', 'name' => 'vehicle', 'id' => 'vehicle_repairing']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {{ Form::hidden('code', '', ['id' => 'editcode']) }}
                                {{-- {{ Form::hidden('old_pdf_name', '',['id'=>'old_pdf_name']) }} --}}
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('', 'Vendor Name', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('vender_name', null, [
                                        'id' => 'vender_name',
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('vehicle_reg_no', 'Vehicle Registration No.', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{-- {{ Form::text('vehicle_reg_no', null, ['id' => 'vehicle_reg_no', 'class' => 'form-control',
                                     'placeholder' => '', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }} --}}
                                    {{ form::select('vehicle_reg_no', ['' => '--select--'], null, [
                                        'class' => 'form-control',
                                        'id' => 'vehicle_reg_no',
                                        'placeholder' => '',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    {!! Form::label('date', 'Date:', ['class' => 'required form-label']) !!}
                                </div>
                                <div class="col-md-7">
                                    {!! Form::text('Date', null, [
                                        'placeholder' => '',
                                        'id' => 'Date',
                                        'class' => 'form-control',
                                        'readonly',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px;background-color:white',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="form-group row" id="hide_address">
                                <div class="col-md-5">
                                    {!! Form::label('', 'Address:', ['class' => 'required form-label']) !!}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('address', null, [
                                        'id' => 'address',
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) }}
                                </div>
                            </div>

                            <div class="container" id="edit_hide">
                                <div class="row">

                                    <div class="col-md-2 form-group">
                                        {!! form::label('', 'Type', ['class' => 'form-label required']) !!}
                                        {!! form::select('select_type', ['service charge' => 'Service Charge', 'parts change' => 'Parts Change'], null, [
                                            'placeholder' => '--Select Type --',
                                            'class' => 'form-control',
                                            'id' => 'type',
                                            'style' => 'border-radius: 0.65rem; margin:6px',
                                        ]) !!}
                                    </div>

                                    <div class="col-md-3 form-group">
                                        {{ Form::label('Description', 'Description', ['class' => 'form-label required']) }}
                                        {{ Form::text('description', null, [
                                            'id' => 'description',
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'autocomplete' => 'off',
                                            'style' => 'border-radius: 0.65rem; margin:6px',
                                        ]) }}
                                    </div>

                                    <div class="col-md-1 form-group">
                                        {{ Form::label('quantity', 'QTY', ['class' => 'form-label required']) }}
                                        {{ Form::text('quantity', null, [
                                            'id' => 'quantity_id',
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'autocomplete' => 'off',
                                            'style' => 'border-radius: 0.65rem; margin:6px',
                                            'onkeypress' => 'return isNumberKey(event);',
                                        ]) }}
                                    </div>

                                    <div class="col-md-2 form-group">
                                        {{ Form::label('amount', 'Amount', ['class' => 'form-label required']) }}
                                        {{ Form::text('amount', null, [
                                            'id' => 'amount_id',
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'autocomplete' => 'off',
                                            'style' => 'border-radius: 0.65rem; margin:6px',
                                            'onkeypress' => 'return isNumberKey(event);',
                                        ]) }}
                                    </div>

                                    <div class="col-md-2 form-group">
                                        {{ Form::label('Total', 'Total', ['class' => 'form-label required']) }}
                                        {{ Form::text('total', null, [
                                            'id' => 'total',
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'autocomplete' => 'off',
                                            'style' => 'border-radius: 0.65rem; margin:6px;background:white',
                                            'readonly',
                                        ]) }}
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">&nbsp;</div>
                                        <div class="col-md-12">
                                            {{ Form::button('Add more', ['class' => 'btn btn-success mt-3', 'id' => 'add_btn_add']) }}
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="container" id="table_show" style="display:none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Desc</th>
                                                    <th>Qty</th>
                                                    <th>Amt</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="show_da">
                                                <tr>
                                                    <td colspan='6' align="center" style="padding: 1.3rem;">No Records
                                                        Added</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                            <div class="card-footer mt-5" style="text-align:center; padding:0;">
                                <!-- <button type="submit" class="btn btn-primary" id="submit_btn"><i class="fas fa-plus-circle"></i> &nbsp;Add &nbsp;</button> -->
                                {{ Form::submit('Submit', ['id' => 'btn_id', 'class' => 'btn btn-primary', 'style' => ' color: white;']) }}
                            </div>
                            <!-- </form> -->
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var totalSum;
        ///////////////////Edit Time////////////////////////
        var get_edit_data = "";

        $('#add_btn_add').attr('disabled', true);
        //  $('#table_show').hide();
        let records = [];
        // $(document).ready(function() {

        $('#add_btn_add').click(function() {

            $('#table_show').show();
            records.push({
                type: $('#type').val(),
                description: $("#description").val(),
                quantity: $('#quantity_id').val(),
                amount: $('#amount_id').val(),
                total: $("#total").val()
            });
            
            $('#type').val('');
            $('#quantity_id').val('');
            $('#amount_id').val('');
            $('#description').val('');
            // $("#total").val('');
            $('#add_btn_add').attr('disabled', true);
            show_records();
            $("#total").val('');
        });
        $('#quantity_id').keyup(function() {
            total();
            disable_data();
        });
        $('#amount_id').keyup(function() {
            total();
            disable_data();
        });

        $('#type').keyup(function() {
            disable_data();
        });
        $('#description').keyup(function() {
            disable_data();
        });

        function total() {
            var qnt = $('#quantity_id').val();
            var amt = $('#amount_id').val();
            var total_mul = qnt * amt;
            // console.log(sum);
            $("#total").val(total_mul);
            // alert(total_mul)
        }

        function disable_data() {
            var type = $('#type').val();
            var quantity = $('#quantity_id').val();
            var amount = $('#amount_id').val();
            var description = $("#description").val();
            if (type != '' && quantity != '' && amount != '' && description != '') {
                $('#add_btn_add').attr('disabled', false);
                return false;
            } else {
                $('#add_btn_add').attr('disabled', true);
                return false;
                // $("#total").val('');
            }
        }
        // });

        function show_records() {
            let str = '';
            totalSum = 0;
            records.forEach((element, index, array) => {
                str +=
                    `<tr>
                           <td>${element.type}</td>
                           <td>${element.description}</td>
                           <td>${element.quantity}</td>
                           <td>${element.amount}</td>                                
                           <td>${element.total}</td>                                                                              
                           <td>                              
                              <button type="button" onclick="removeElement(${index});" style="background: whitesmoke; color: red; padding: 3px 6px; border-radius: 5px;">
                                   <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                   </svg>
                               </button>                              
                           </td>
                       </tr>`;

                totalSum += parseInt(element.total);
                // alert(totalSum);
                // $("#total").val(totalSum);
            });
            str +=
                `<tr>
                   <td colspan=3></td>
                   <td>Grand Total</td>                                
                   <td colspan=2>${totalSum}</td>                                                                              
               </tr>`;
            str ? $('#show_da').html(str) : $('#show_da').html(
                `<tr><td colspan='7' align="center" style="padding: 1.3rem;">No Records Added</td></tr>`);
        }

        function removeElement(index) {
            records.splice(index, 1);
            show_records();
        }

        $(document).ready(function() {
            getdata();
            const quantity_id = document.getElementById('quantity_id');
            quantity_id.onpaste = e => e.preventDefault();

            const amount_id = document.getElementById('amount_id');
            amount_id.onpaste = e => e.preventDefault();
        });

        // $(document).ready(function() {

        var date = new Date();
        $("#Date").datepicker({
            todayBtn: 1,
            autoclose: true,
            format: "dd/mm/yyyy",
            //startDate: date,               
            endDate: date,
            todayHighlight: true,
            autoclose: true

        }).on('changeDate', function(selected) {
            $('#vehicle_repairing').bootstrapValidator('revalidateField', 'Date');
        });

        let d = new Date();
        let currDate = d.getDate();
        let currMonth = d.getMonth() + 1;
        let currYear = d.getFullYear();
        currDate1 = currDate < 10 ? "0" + currDate : currDate;
        currMonth1 = currMonth < 10 ? "0" + currMonth : currMonth;
        var today_date = currDate1 + "/" + currMonth1 + "/" + currYear;
        // alert(fulldate);
        $('#Date').val(today_date);

        $('#vehicle_repairing').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                vender_name: {
                    validators: {
                        notEmpty: {
                            message: 'Vender Name is required'
                        },
                        regexp: {
                            regexp: /^[A-Za-z0-9\s/-]+$/i,
                            message: 'Only Alphanumeric, Space and Allowed Here'
                        },
                        stringLength: {
                            max: 50,
                            message: 'Vender Name accept maximum of 50 characters'
                        }

                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'Address is required'
                        },
                        regexp: {
                            regexp: /^[A-Za-z0-9\s/-]+$/i,
                            message: 'Only alphanumeric value,/,- ,Space and . Allowed Here'
                        },
                        stringLength: {
                            max: 100,
                            message: 'Address accept maximum of 100 characters'
                        }

                    }
                },
                description: {
                    validators: {
                        // notEmpty: {
                        //     message: 'Description is required'
                        // },
                        regexp: {
                            regexp: /^[A-Za-z0-9\s/-]+$/i,
                            message: 'Only alphanumeric value,/,- ,Space and . Allowed Here'
                        },
                        stringLength: {
                            max: 100,
                            message: 'Description accept maximum of 100 characters'
                        }

                    }
                },
                vehicle_reg_no: {
                    validators: {
                        notEmpty: {
                            message: 'Vehicle registration number is required'
                        },
                        regexp: {
                            regexp: /^[A-Za-z0-9\s./-]+$/i,
                            message: 'Only alphanumeric ,/,-, Space and . Allowed Here'
                        },
                        stringLength: {
                            max: 50,
                            message: 'Vehicle registration number accept maximum of 50 characters'
                        }

                    }
                },
                Date: {
                    validators: {
                        notEmpty: {
                            message: 'Date  is required.'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            message: 'Date Format Is Invalid'
                        }
                    }
                },
                amount: {
                    validators: {
                        // notEmpty: {
                        //     message: 'Amount  is required'
                        // },
                        regexp: {
                            regexp: /^[0-9\s-]+$/i,
                            message: 'Only numeric value,'
                        },
                        stringLength: {
                            max: 10,
                            message: 'Amount accept maximum of 10 digit'
                        }

                    }
                },
                select_type: {
                    validators: {
                        // notEmpty: {
                        //     message: 'Type  is required'
                        // },
                        regexp: {
                            regexp: /^[A-Za-z\s./-]+$/i,
                            message: 'Only Alphabate Space,-,/ and . Allowed Here'
                        },
                        stringLength: {
                            max: 50,
                            message: 'Type accept maximum of 50 characters'
                        }

                    }
                },
                quantity: {
                    validators: {
                        // notEmpty: {
                        //     message: 'Quantity is required'
                        // },
                        regexp: {
                            regexp: /^[0-9\s]+$/i,
                            message: 'Only numeric value,'
                        },
                        stringLength: {
                            max: 6,
                            message: 'Quantity accept maximum of 6 Digits'
                        }

                    }
                },
            }
        }).on('success.form.bv', function(e) {
            e.preventDefault();
            vehicle_repairing();
        });
        // });
        var action_url = "save_vehicle_repairing";

        function vehicle_repairing() {
            // var action_url = "save_vehicle_repairing";
            let code = $("#editcode").val();
            let vendor_name = $("#vender_name").val();
            let vehicle_reg_no = $("#vehicle_reg_no").val();
            let Date = $("#Date").val();
            let address = $("#address").val();

            // let total = $("#total").val();
            // alert(total);
            // alert(vendor_name);
            // alert(vehicle_reg_no);
            // alert(Date);
            // alert(address);

            let fd = new FormData();
            fd.append('code', code);
            fd.append('vendor_name', vendor_name);
            fd.append('vehicle_reg_no', vehicle_reg_no);
            fd.append('date', Date);
            fd.append('address', address);
            fd.append('totalSum', totalSum);
            fd.append('records', JSON.stringify(records));
            fd.append('_token', '{{ csrf_token() }}');
            // console.log(records);
            $.ajax({
                type: 'POST',
                url: action_url,
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {
                        const msg =
                            "<strong>SUCCESS: </strong> Vehicle Repairing details Save Successfully";

                        $.confirm({
                            title: 'Success!',
                            type: 'green',
                            icon: 'fa fa-check',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    window.location.href = "vehicle_repairing_list";
                                },
                                // cancel: function() {
                                //     $.alert('Canceled!');
                                // },
                            }
                        });
                    } else if (data.status == 2) {

                        var msg =
                            "<strong>SUCCESS: </strong>Vehicle Repairing details updated successfully";

                        $.confirm({
                            title: 'Success!',
                            type: 'green',
                            icon: 'fa fa-check',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    // $('#Add_Project_Details').get(0).reset();
                                    // $(".se-pre-con").fadeOut("slow");
                                    // location.reload();
                                    window.location.href = "vehicle_repairing_list";
                                }
                            }
                        });

                    }
                    // $('#pLoader').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $(".se-pre-con").fadeOut("slow");
                    var msg = "";
                    if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                        msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                    } else {
                        if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                            msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message +
                                "</strong>";
                        } else {
                            msg += "Error(s):<strong><ul>";
                            $.each(jqXHR.responseJSON['errors'], function(key, value) {
                                msg += "<li>" + value + "</li>";
                            });
                            msg += "</ul></strong>";
                        }
                    }
                    $.alert({
                        title: 'Error!!',
                        type: 'red',
                        icon: 'fa fa-warning',
                        content: msg,
                    });
                    $('#pLoader').hide();

                }
            });
        }

        function getdata() {
            // alert(vehicle);
            $.ajax({
                url: "dropdown_data",
                method: 'post',
                type: 'json',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    // alert(data.status);
                    $('#vehicle_reg_no').html('<option value="">--Select vehicle repairing--</option>');

                    $.each(data.vehicle_name, function(keyt, valuet) {
                        $("#vehicle_reg_no").append('<option value=' + keyt + '>' + valuet +
                            '</option>');
                    });
                    /////////////////Edit Time////////////////////////
                    $('#vehicle_reg_no').val(get_edit_data);
                }

            });
        }
    </script>

    @isset($edit_send_data)
        <script>
            var action_url = "update_vehicle_repairing";
            // $('#edit_hide').hide();
            $('#hide_address').hide();
            $('#table_show').show();
            $('.card-title').html('Vehicle Repairing');
            //  $('#btn_id').val('update');
            $("#editcode").val("{{ $edit_send_data['code'] }}");
            $("#Date").val("{{ $edit_send_data['date'] }}");
            $("#vender_name").val("{{ $edit_send_data['vendor_name'] }}");
            $("#total").val("{{ $edit_send_data['total'] }}");
            get_edit_data = "{{ $edit_send_data['vehicle_reg_no'] }}";
        </script>

        @foreach ($edit_send_data['edit_table'] as $item)
            <script>
                records.push({
                    type: "{{ $item['type'] }}",
                    description: "{{ $item['description'] }}",
                    quantity: "{{ $item['quantity'] }}",
                    amount: "{{ $item['amount'] }}",
                    total: "{{ $item['total'] }}"
                });
                // create_plot_table();
                show_records();
            </script>
        @endforeach
        
    @endisset
@endsection
