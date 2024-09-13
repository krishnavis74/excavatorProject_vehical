@extends('backend.master')
@section('title', 'Add user')
@section('content')
 

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
                        <a href="{{ route('user_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "><i
                                    class="fa fa-plus-circle"></i> &nbsp;User List &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid" style="width:70%;">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="padding:0;">

                    <div class="card card-primary shadow rounded-3" style="padding:0;">

                        <div class=" " style="background-color: #2f5ffa;color:white; ">
                            <p class="card-title update_time" style="font-size: 20px; color:white;  padding:7px; ">User
                            </p>
                        </div>

                        {!! Form::open(['url' => '', 'id' => 'vehicle_user']) !!}
                        <div class="card-body">
                            <div class="form-group ">
                                {{ Form::hidden('code', '', ['id' => 'editcode']) }}
                                {{-- {{ Form::hidden('old_pdf_name', '', ['id' => 'old_pdf_name']) }} --}}
                            </div>

                            <div class="form-group row">
                                <div class="col-md-5">
                                    {{ form::label('', 'Name', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {!! form::text('name', '', [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'id' => 'name',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ form::label('', 'Mobile No', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {!! form::text('mobile_id', '', [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'id' => 'mobile_id',
                                        'maxlength' => '10',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) !!}

                                </div>
                            </div>

                            <div id="hide_show">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        {{ form::label('', 'User Name', ['class' => 'form-label required']) }}
                                    </div>
                                    <div class="col-md-7">
                                        {!! form::text('User_name_id', '', [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'id' => 'User_name_id',
                                            'style' => 'border-radius: 0.65rem; margin:6px',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <div class="col-md-5">
                                        {{ form::label('', 'Password', ['class' => 'form-label required']) }}
                                    </div>
                                    <div class="col-md-7">
                                        {!! form::text('password_id', '', [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'id' => 'password_id',
                                            'style' => 'border-radius: 0.65rem; margin:6px',
                                        ]) !!}
                                    </div>

                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {!! form::label('', 'User Type', ['class' => 'form-label required']) !!}
                                </div>
                                <div class="col-md-7">
                                    {!! form::select(
                                        'select_type',
                                        ['vehicle operator' => 'vehicle operator', 'admin' => 'admins', 'others' => 'others'],
                                        null,
                                        [
                                            'placeholder' => '--Select Type --',
                                            'class' => 'form-control',
                                            'id' => 'type',
                                            'style' => 'border-radius: 0.65rem; margin:6px',
                                        ],
                                    ) !!}

                                </div>
                            </div>

                            <div class="card-footer mt-2" style="text-align:center; padding:0;">
                                <!-- <button type="submit" class="btn btn-primary" id="submit_btn"><i class="fas fa-plus-circle"></i> &nbsp;Add &nbsp;</button> -->
                                {{ Form::submit('Submit', ['class' => 'btn btn-warning', 'class' => 'btn btn-primary']) }}
                            </div>
                            <!-- </form> -->
                        </div>
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
            $('#vehicle_user').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        message: 'Name is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            },
                            stringLength: {
                                min: 2,
                                max: 30,
                                message: 'Name must be more than 2 and less than 30 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\s]+$/,
                                message: 'Name can only consist of alphabetical and space'
                            }
                        }
                    },
                    password_id: {
                        message: 'password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Password is required'
                            },
                            stringLength: {
                                min: 8,
                                max: 30,
                                message: 'Password must be more than 8 and less than 30 characters long'
                            },
                            regexp: {
                                regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/,
                                // regexp: /^[a-zA-Z.\s0-9]+$/,
                                message: 'Password can only consist of uppercase letter, lowercase letter,special character, number'
                            }
                        }
                    },
                    User_name_id: {
                        message: 'User Name is not valid',
                        validators: {
                            notEmpty: {
                                message: 'User name is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: 'User name must be more than 6 and less than 30 characters'
                            },
                            regexp: {
                                regexp: /^[@a-zA-Z\s0-9]+$/i,
                                message: 'User name Only Alphanumeric @  Allowed Here'
                            },

                        }
                    },
                    select_type: {
                        validators: {
                            notEmpty: {
                                message: 'Type is required'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\s]+$/i,
                                message: ' Type Only Alpha  and  Space Allowed Here'
                            },

                        }
                    },
                    mobile_id: {
                        validators: {
                            notEmpty: {
                                message: 'Mobile Number is required'
                            },
                            different: {
                                field: 'Mobile',
                                message: 'Mobile Number is required'
                            },
                            stringLength: {
                                min: 10,
                                message: 'Mobile Number must have at least 10 Digits'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'Numeric Value Allowm here'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function(e) {
                // alert('kjhg');
                e.preventDefault();
                add_user_data();
            });
        });

        var action_url = "add_user_vehicle_save";

        function add_user_data() {
            var name = $("#name").val();
            var type = $("#type").val();
            var mobile_id = $("#mobile_id").val()
            var User_name_id = $("#User_name_id").val();
            var password_id = $("#password_id").val();
            var editcode = $("#editcode").val();
            var fn = new FormData();
            fn.append('code', editcode);
            fn.append('name', name);
            fn.append('type', type);
            fn.append('mobile_id', mobile_id);
            fn.append('User_name_id', User_name_id);
            fn.append('password_id', password_id);
            fn.append('_token', "{{ csrf_token() }}");
            $.ajax({
                type: "post",
                url: action_url,
                data: fn,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {
                        var msg = "<strong>Success: </strong>User  Details Save Successfully";
                        $.confirm({
                            icon: 'glyphicon glyphicon-heart',
                            title: "Success !",
                            // theme: 'my-theme',
                            type: 'green',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    window.location.href = "user_list";
                                }
                            }
                        });
                    } else if (data.status == 2) {
                        var msg = "<strong>Success:</strong>User Details Update Successfully";
                        $.confirm({
                            title: "Success !",
                            type: 'green',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    window.location.href = "user_list";
                                }
                            }
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // $(".se-pre-con").fadeOut("slow");
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
                }
            });
        }
    </script>

    @isset($send_data)
        <script>
            var action_url = "user_update_data";
            $('.update_time').html("Edit user");
            $('#btn_submit').val("Update");
            $('#editcode').val("{{ $send_data['code'] }}");
            $('#type').val("{{ $send_data['type'] }}");
            $('#name').val("{{ $send_data['name'] }}");
            $("#mobile_id").val("{{ $send_data['mobile_no'] }}");
            $("#hide_show").hide();
        </script>
    @endisset

@endsection
