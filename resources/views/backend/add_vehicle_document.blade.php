@extends('backend.master')
@section('title', 'Vehicle Document')
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
                        <a href="{{ route('vehicle_document_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "><i
                                    class="fa fa-plus-circle"></i> &nbsp;Vehicle Document List &nbsp;</button>
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

                        <div class="" style="background-color: #2f5ffa;color:white; ">
                            <p class="card-title update_time" style="font-size: 20px; color:white;  padding:7px; ">Vehicle
                                Document
                            </p>
                        </div>

                        {!! Form::open(['url' => '', 'id' => 'vehicle_document']) !!}
                        <div class="card-body">
                            <div class="form-group ">
                                {{ Form::hidden('code', '', ['id' => 'editcode']) }}
                                {{ Form::hidden('old_pdf_name', '', ['id' => 'old_pdf_name']) }}
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {!! form::label('Vehicle Registration No.', 'Vehicle Registration No.', ['class' => 'form-label required']) !!}
                                </div>
                                <div class="col-md-7">
                                    {{ form::select('vehicle_reg_no', ['' => '--select--'], null, [
                                        'class' => 'form-control',
                                        'id' => 'vehicle_reg_no',
                                        'placeholder' => '',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) }}

                                </div>
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {!! form::label('Document Type', 'Document Type', ['class' => 'form-label required']) !!}
                                </div>
                                <div class="col-md-7">
                                    {{ form::select('document_type', ['' => '--select--'], null, [
                                        'class' => 'form-control',
                                        'id' => 'document_type',
                                        'placeholder' => '',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) }}

                                </div>
                            </div>
                            {{-- <p style="color: var(--red); font-weight: 400; padding-top: 0.5rem;">
                                Note:&nbsp;
                                file format(PDF) is accepted and max size is
                                512Kb
                            </p> --}}
                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ form::label('Upload', 'Upload', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {!! form::file('pdf_file', [
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                        'id' => 'pdf_file',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) !!}

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
            $('#vehicle_document').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    vehicle_reg_no: {
                        validators: {
                            notEmpty: {
                                message: 'Vehicle registration number is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Only alphanumeric ,/,-, Space and . Allowed Here'
                            },

                        }
                    },
                    document_type: {
                        validators: {
                            notEmpty: {
                                message: 'Document Type is required and cannot be empty'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9\s./-]+$/i,
                                message: 'Document Type Only Alpha  and  Space Allowed Here'
                            },

                        }
                    },
                    pdf_file: {
                        validators: {
                            // notEmpty: {
                            //     message: 'The saving number required and cannot be empty'
                            // },
                            file: {
                                extension: 'pdf',
                                type: 'application/pdf',
                                maxSize: 512 * 512,
                                message: 'The selected file is not valid .file size should be less than 512KB.Only Pdf Allowed Here'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function(e) {
                // alert('kjhg');
                e.preventDefault();
                add_document();
            });
        });

        ///////////////////Edit Time////////////////////////
        var get_edit_data = "";
        var get_edit_data_name = "";

        var action_url = "add_vehicle_document_save";

        function add_document() {

            var vehicle_reg_no = $("#vehicle_reg_no").val();
            var document_type = $("#document_type").val();
            var pdf_file = $("#pdf_file")[0].files;
            var old_pdf_name = $("#old_pdf_name").val();

            // alert(document_type);
            // alert(vehicle_reg_no);
            // alert(mobile_id);
            // alert(User_name_id);
            // alert(password_id);
            // console.log(pdf_file);
            // console.log(document_type);
            // console.log(vehicle_reg_no);
            var editcode = $("#editcode").val();

            var fn = new FormData();
            fn.append('code', editcode);
            fn.append('vehicle_reg_no', vehicle_reg_no);
            fn.append('document_type', document_type);
            fn.append('pdf_file', pdf_file[0]);
            fn.append('old_pdf_name', old_pdf_name);
            fn.append('_token', "{{ csrf_token() }}");
            $.ajax({
                type: "post",
                url: action_url,
                data: fn,
                // dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {

                        // Swal.fire({
                        //     title: "Good job!",
                        //     text: "Vehicle Document details Save Successfully",
                        //     icon: "success"
                        // });

                        var msg = "<strong>Success: </strong> Vehicle Document details Save Successfully";
                        $.confirm({
                            icon: 'glyphicon glyphicon-heart',
                            title: "Success !",
                            // theme: 'my-theme',
                            type: 'green',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    window.location.href = "vehicle_document_list";
                                }
                            }
                        });
                    } else if (data.status == 2) {
                        var msg = "<strong>Success:</strong> Vehicle Document details Update Successfully";
                        $.confirm({
                            title: "Success !",
                            type: 'green',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    window.location.href = "vehicle_document_list";
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
        $(document).ready(function() {
            getdata();
            get_vehicle_data();
        });


        function getdata() {
            // alert(vehicle);
            $.ajax({
                url: "dropdown_vehicle_document",
                method: 'post',
                type: 'json',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    // alert(data.status);
                    $('#document_type').html('<option value="">--Select Document--</option>');

                    $.each(data.vehicledocument, function(keyt, valuet) {
                        $("#document_type").append('<option value=' + keyt + '>' + valuet +
                            '</option>');
                    });
                    /////////////////Edit Time////////////////////////
                    $('#document_type').val(get_edit_data_name);
                }

            });
        }

        function get_vehicle_data() {
            // alert(vehicle);
            $.ajax({
                url: "dropdown_vehicle_repairing",
                method: 'post',
                type: 'json',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    // alert(data.status);
                    $('#vehicle_reg_no').html('<option value="">--Select Type--</option>');

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
            var action_url = "update_vehicle_document_data";
            $("#editcode").val("{{ $edit_send_data['code'] }}");
            get_edit_data = "{{ $edit_send_data['vehicle_reg_no'] }}";
            get_edit_data_name = "{{ $edit_send_data['document_name'] }}";
            $("#old_pdf_name").val("{{ $edit_send_data['document_pdf'] }}");
        </script>
    @endisset


@endsection
