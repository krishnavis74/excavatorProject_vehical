@extends('backend.master')
@section('content')
    {{-- <style>
    hr {
        margin-top: 0;
        border: 1px solid #d9dbda;
    }

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
</style> --}}

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
                        <a href="{{ route('vehicle_workplace_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ;  "><i
                                    class="fa fa-plus-circle"></i> &nbsp; Vehicle Workplace List &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid" style="width:70%;">
            <div class="row ">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="  padding:0;">

                    <div class="card card-primary shadow   rounded-3" style="  padding:0;">
                        <div class="  " style="background-color: #2f5ffa;color:white; ">
                            <p class="card-title " style="font-size: 20px; color:white;  padding:7px; ">Vehicle
                                Workplace</p>
                        </div>
                        {!! Form::open(['url' => '', 'method' => 'post', 'name' => 'vehicle_workplace', 'id' => 'vehicle_workplace']) !!}
                        <div class="card-body">
                            <div class="form-group ">
                                {{ Form::hidden('code', '', ['id' => 'editcode']) }}

                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('vehicle_serial_no', 'Vehicle Serial No:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::select('vehicle_serial_no', ['' => 'select Vehicle Serial No.'], null, ['id' => 'vehicle_serial_no', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('state', 'State', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::select('state', ['' => 'Select State'], null, ['id' => 'state', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('district', 'District', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('district', null, ['id' => 'district', 'class' => 'form-control', 'placeholder' => 'District', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('address', 'Address', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('operator', 'Operator', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::select('operator', ['' => 'select operator'], null, ['id' => 'operator', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}

                                    <!-- {{ Form::text('operator', null, ['id' => 'operator', 'class' => 'form-control', 'placeholder' => 'Vehicle Type', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }} -->
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
        let vehicle_serial_no_data;
        let state_data;
        let operator_name;

        $(document).ready(function() {

            select_vehicle_serial_no();
            select_operator();
            select_state();

            $('#vehicle_workplace').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    vehicle_serial_no: {
                        validators: {
                            notEmpty: {
                                message: 'Vehicle serial number is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s.-]+$/i,
                                message: 'Only alphanumeric value, Space, - and . Allowed Here'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Vehicle serial number accept maximum of 100 characters'
                            }
                        }
                    },
                    state: {
                        validators: {
                            notEmpty: {
                                message: 'State name is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Only alphanumeric value,/,- ,Space and . Allowed Here'
                            },
                        }
                    },
                    district: {
                        validators: {
                            notEmpty: {
                                message: 'District name is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Only alphanumeric ,/,-, Space and . Allowed Here'
                            },
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Address is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s.,/-]+$/i,
                                message: 'Address feild accept Only alphanumeric value,-,/, Space and . Allowed Here'
                            },
                        }
                    },
                    operator: {
                        validators: {
                            notEmpty: {
                                message: 'Operator is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Only Alphabate Space,-,/ and . Allowed Here'
                            },

                        }
                    },
                }
            }).on('success.form.bv', function(e) {
                e.preventDefault();
                vehicle_workplace_details();
            });
        });

        function vehicle_workplace_details() {
            let code = $("#editcode").val();
            let vehicle_serial_no = $("#vehicle_serial_no").val();
            let state = $("#state").val();
            let district = $("#district").val();
            let address = $("#address").val();
            let operator = $("#operator").val();

            let fd = new FormData();
            if (code > 0) {
                var action_url = "update_vehicle_workplace";
            } else {
                var action_url = "save_vehicle_workplace";

            }
            fd.append('code', code);
            fd.append('vehicle_serial_no', vehicle_serial_no);
            fd.append('state', state);
            fd.append('district', district);
            fd.append('address', address);
            fd.append('operator', operator);
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
                        const msg = "<strong>SUCCESS: </strong> Vehicle Workplace details Save Successfully";

                        $.confirm({
                            title: 'Success!',
                            type: 'green',
                            icon: 'fa fa-check',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    window.location.href = "vehicle_workplace_list";
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
                                    window.location.href = "vehicle_workplace_list";
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
        function select_vehicle_serial_no() {
            // alert('nnn');
            $("#loader-container").show();

            $.ajax({
                url: "get_vehicle_serial_no",
                method: 'post',
                type: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',

                },
                success: function(data) {
                    $("#loader-container").hide();
                    //alert(data.status);
                    $('#vehicle_serial_no').html('<option value="" style="color:#939ba2;">Select Vehicle serial no.</option>');

                    $.each(data, function(key, value) {
                        $("#vehicle_serial_no").append('<option value=' + key + '>' + value + '</option>');
                    });
                    $("#vehicle_serial_no").val(vehicle_serial_no_data);
                }

            });
        }

        function select_operator() {
            // alert('nnn');
            $("#loader-container").show();
            $.ajax({
                url: "get_operator",
                method: 'post',
                type: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',

                },
                success: function(data) {
                    $("#loader-container").hide();

                    //alert(data.status);

                    $('#operator').html(
                        '<option value="">Select Operator</option>');

                    $.each(data, function(key, value) {
                        $("#operator").append('<option value=' + key + '>' +
                            value +
                            '</option>');
                    });
                    $("#operator").val(operator_name);
                }

            });
        }
        function select_state() {
            // alert('nnn');
            $("#loader-container").show();

            $.ajax({
                url: "get_state",
                method: 'post',
                type: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',

                },
                success: function(data) {
                    $("#loader-container").hide();

                    //alert(data.status);

                    $('#state').html(
                        '<option value="">Select State</option>');

                    $.each(data, function(key, value) {
                        $("#state").append('<option value=' + key + '>' +
                            value +
                            '</option>');
                    });
                    $("#state").val(state_data);
                }

            });
        }
    </script>


    @isset($edit)
        <script>
            $("#editcode").val("{{ $edit['code'] }}");
            vehicle_serial_no_data = "{{ $edit['vehicle_serial_no'] }}";
            state_data = "{!! $edit['state'] !!}";
            $("#district").val("{!! $edit['district'] !!}");
            $("#address").val("{{ $edit['address'] }}");
            operator_name = "{!! $edit['operator'] !!}";
        </script>
    @endisset
@endsection
