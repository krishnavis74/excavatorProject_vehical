@extends('backend.master')
@section('content')
    <style>
        .required:after {
            content: '*';
            color: red;
            font-weight: 700;
            margin-left: 4px;
        }

        .form-horizontal .has-feedback .form-control-feedback {
            top: 0;
            right: 15px;
        }

        .has-error {
            color: red;
            border-color: red;
        }

        .has-error .form-control {

            border-color: red;

        }

        .has-success .form-control {

            border-color: green;
        }

        #vehicle_user .inputGroupContainer .form-control-feedback,
        #vehicle_user .selectContainer .form-control-feedback {
            top: 0;
            right: -15px;
        }

        .has-error .form-control-feedback {
            color: #a94442;
        }

        .form-control-feedback {
            position: absolute;
            /* top: 25px;
                    right: 0; */
            z-index: 2;
            display: block;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            margin-left: 97%;
            margin-top: -38px;
        }

        .has-feedback .form-control-feedback {
            top: 2px;
            right: 15px;
        }

        .glyphicon {
            position: relative;
            top: 1px;
            /* display: inline-block; */
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            /* line-height: 1; */
            -webkit-font-smoothing: antialiased;
            /* -moz-osx-font-smoothing: grayscale; */
        }

        /* .glyphicon-remove:before {
                    content: "\e014";
                } */
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
                        <a href="{{ route('vehicle_details_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ;  "><i
                                    class="fa fa-plus-circle"></i> &nbsp; Vehicle List &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid " style="width:70%;">
            <div class="row ">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="  padding:0;">

                    <div class="card card-primary shadow   rounded-3" style="  padding:0;">
                        <div class="  " style="background-color: #2f5ffa;color:white; ">
                            <p class="card-title " style="font-size: 20px; color:white;  padding:7px; ">Vehicle Details
                            </p>
                        </div>
                        {!! Form::open(['url' => '', 'method' => 'post', 'name' => 'vehicle', 'id' => 'vehicle']) !!}
                        <div class="card-body">
                            <div class="form-group ">
                                {{ Form::hidden('code', '', ['id' => 'editcode']) }}
                                {{ Form::hidden('old_pdf_name', '', ['id' => 'old_pdf_name']) }}
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('owner_name', 'Owner Name:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('owner_name', null, ['id' => 'owner_name', 'class' => 'form-control', 'placeholder' => 'Owner Name', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>


                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('vehicle_model_no', 'Vehicle Model No.', ['class' => 'form-label required']) }}

                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('vehicle_model_no', null, ['id' => 'vehicle_model_no', 'class' => 'form-control', 'placeholder' => ' Vehicle Model No', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('vehicle_reg_no', 'Vehicle Registration No.', ['class' => 'form-label required']) }}

                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('vehicle_reg_no', null, ['id' => 'vehicle_reg_no', 'class' => 'form-control', 'placeholder' => ' Vehicle Registration No', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    {!! Form::label('vehicle_purchase_date', 'Vehicle Purchase Date:', ['class' => 'required form-label']) !!}
                                </div>
                                <div class="col-md-7">
                                    {!! Form::text('vehicle_purchase_date', null, [
                                        'placeholder' => 'Vehicle Purchase Date',
                                        'id' => 'vehicle_purchase_date',
                                        'class' => 'form-control',
                                        'readonly',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px;background-color:white',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-5">
                                    {!! Form::label('vehicle_reg_date', 'Registration Date:', ['class' => 'required form-label']) !!}
                                </div>
                                <div class="col-md-7">
                                    {!! Form::text('vehicle_reg_date', null, [
                                        'placeholder' => 'Registration Date',
                                        'id' => 'vehicle_reg_date',
                                        'class' => 'form-control',
                                        'readonly',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px;background-color:white',
                                    ]) !!}
                                </div>
                            </div>


                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('reg_authority', 'Registration Authority:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('reg_authority', null, ['id' => 'reg_authority', 'class' => 'form-control', 'placeholder' => 'Registration Authority', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('vehicle_type', 'Vehicle Type:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('vehicle_type', null, ['id' => 'vehicle_type', 'class' => 'form-control', 'placeholder' => 'Vehicle Type', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>
                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('fuel_type', 'Fuel Type:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('fuel_type', null, ['id' => 'fuel_type', 'class' => 'form-control', 'placeholder' => 'Fuel Type', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('engine_no', 'Engine no.:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('engine_no', null, ['id' => 'engine_no', 'class' => 'form-control', 'placeholder' => 'Engin no.', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('chassis_no', 'Chassis No.:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('chassis_no', null, ['id' => 'chassis_no', 'class' => 'form-control', 'placeholder' => 'Chassis No.', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('vehicle_serial_no', 'Vehicle Serial No.:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('vehicle_serial_no', null, ['id' => 'vehicle_serial_no', 'class' => 'form-control', 'placeholder' => 'Vehicle Serial No.', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>


                            <div class="card-footer mt-5" style="text-align:center; padding:0;">
                                <!-- <button type="submit" class="btn btn-primary" id="submit_btn"><i class="fas fa-plus-circle"></i> &nbsp;Add &nbsp;</button> -->
                                {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => ' color: white;']) }}
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
        $(document).ready(function() {
            $("#vehicle_purchase_date").datepicker({
                todayBtn: 1,
                autoclose: true,
                format: "dd/mm/yyyy",
            }).on('changeDate', function(selected) {

                //var minDate = new Date(selected.date.valueOf());
                // $('#progress_date').datepicker('setStartDate', minDate);
                $('#vehicle').bootstrapValidator('revalidateField', 'vehicle_purchase_date');
            });

            $("#vehicle_reg_date").datepicker({
                todayBtn: 1,
                autoclose: true,
                format: "dd/mm/yyyy",
            }).on('changeDate', function(selected) {

                //var minDate = new Date(selected.date.valueOf());
                // $('#progress_date').datepicker('setStartDate', minDate);
                $('#vehicle').bootstrapValidator('revalidateField', 'vehicle_reg_date');
            });

            $('#vehicle').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    owner_name: {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z\s.]+$/i,
                                message: 'Only Alphabate, Space and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Name accept maximum of 100 characters'
                            }

                        }
                    },
                    vehicle_model_no: {
                        validators: {
                            notEmpty: {
                                message: 'Vehicle model number is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Only alphanumeric value,/,- ,Space and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Vehicle model number accept maximum of 100 characters'
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
                                max: 100,
                                message: 'Vehicle registration number accept maximum of 100 characters'
                            }

                        }
                    },
                    vehicle_purchase_date: {
                        validators: {
                            notEmpty: {
                                message: 'Purchase Date  is required.'
                            },
                            date: {
                                format: 'DD/MM/YYYY',
                                message: 'Date Format Is Invalid'
                            }
                        }
                    },
                    vehicle_reg_date: {
                        validators: {
                            notEmpty: {
                                message: 'Registration Date  is required.'
                            },
                            date: {
                                format: 'DD/MM/YYYY',
                                message: 'Date Format Is Invalid'
                            }
                        }
                    },
                    reg_authority: {
                        validators: {
                            notEmpty: {
                                message: 'Registration authority is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Only alphanumeric value,-,/, Space and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Registration authority accept maximum of 100 characters'
                            }

                        }
                    },
                    vehicle_type: {
                        validators: {
                            notEmpty: {
                                message: 'Vehicle type  is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z\s./-]+$/i,
                                message: 'Only Alphabate Space,-,/ and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Vehicle type accept maximum of 100 characters'
                            }

                        }
                    },
                    fuel_type: {
                        validators: {
                            notEmpty: {
                                message: 'Fuel type is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z\s./-]+$/i,
                                message: 'Only Alphabate, Space, /,- and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Fuel type accept maximum of 100 characters'
                            }

                        }
                    },
                    engine_no: {
                        validators: {
                            notEmpty: {
                                message: 'Engine number is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Only alphanumeric vlue,/, Space, - and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Engine number accept maximum of 100 characters'
                            }

                        }
                    },
                    chassis_no: {
                        validators: {
                            notEmpty: {
                                message: 'Chassis number is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s.-]+$/i,
                                message: 'Only alphanumeric vlue, Space, - and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Chassis number accept maximum of 100 characters'
                            }

                        }
                    },
                    vehicle_serial_no: {
                        validators: {
                            notEmpty: {
                                message: 'Vehicle serial number is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s.-]+$/i,
                                message: 'Only alphanumeric vlue, Space, - and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Vehicle serial number accept maximum of 100 characters'
                            }

                        }
                    },
                }
            }).on('success.form.bv', function(e) {
                e.preventDefault();
                vehicle_details();
            });
        });

        function vehicle_details() {
            let code = $("#editcode").val();
            let owner_name = $("#owner_name").val();
            let vehicle_model_no = $("#vehicle_model_no").val();
            let vehicle_reg_no = $("#vehicle_reg_no").val();
            let vehicle_purchase_date = $("#vehicle_purchase_date").val();
            let vehicle_reg_date = $("#vehicle_reg_date").val();
            let reg_authority = $("#reg_authority").val();
            let vehicle_type = $("#vehicle_type").val();
            let fuel_type = $("#fuel_type").val();
            let engine_no = $("#engine_no").val();
            let chassis_no = $("#chassis_no").val();
            let vehicle_serial_no = $("#vehicle_serial_no").val();



            let fd = new FormData();
            if (code > 0) {
                var action_url = "update_vehicle";
            } else {
                var action_url = "save_vehicle";

            }
            fd.append('code', code);

            fd.append('owner_name', owner_name);
            fd.append('vehicle_model_no', vehicle_model_no);
            fd.append('vehicle_reg_no', vehicle_reg_no);
            fd.append('vehicle_purchase_date', vehicle_purchase_date);
            fd.append('vehicle_reg_date', vehicle_reg_date);
            fd.append('reg_authority', reg_authority);
            fd.append('vehicle_type', vehicle_type);
            fd.append('fuel_type', fuel_type);
            fd.append('engine_no', engine_no);
            fd.append('chassis_no', chassis_no);
            fd.append('vehicle_serial_no', vehicle_serial_no);


            fd.append('_token', '{{ csrf_token() }}');

            // $('#pLoader').show();
            $.ajax({
                type: 'POST',
                url: action_url,
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {
                        const msg = "<strong>SUCCESS: </strong> Vehicle details Save Successfully";

                        $.confirm({
                            title: 'Success!',
                            type: 'green',
                            icon: 'fa fa-check',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    window.location.href = "vehicle_details_list";
                                },
                                // cancel: function() {
                                //     $.alert('Canceled!');
                                // },
                            }
                        });
                    } else if (data.status == 2) {

                        var msg =
                            "<strong>SUCCESS: </strong>Vehicle details updated successfully";

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
                                    window.location.href = "vehicle_details_list";
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
                            msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
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
    </script>

    @isset($edit)
        <script>
            $("#editcode").val("{{ $edit['code'] }}");
            $("#owner_name").val("{{ $edit['owner_name'] }}");
            $("#vehicle_model_no").val("{!! $edit['vehicle_model_no'] !!}");
            $("#vehicle_reg_no").val("{!! $edit['vehicle_reg_no'] !!}");
            $("#vehicle_purchase_date").val("{{ $edit['parches_date'] }}");
            $("#vehicle_reg_date").val("{!! $edit['reg_date'] !!}");
            $("#reg_authority").val("{!! $edit['reg_authority'] !!}");
            $("#vehicle_type").val("{!! $edit['vehicle_type'] !!}");
            $("#fuel_type").val("{!! $edit['fuel_type'] !!}");
            $("#engine_no").val("{!! $edit['engine_no'] !!}");
            $("#chassis_no").val("{!! $edit['chassis_no'] !!}");
            $("#vehicle_serial_no").val("{!! $edit['vehicle_serial_no'] !!}");
        </script>
    @endisset
@endsection
