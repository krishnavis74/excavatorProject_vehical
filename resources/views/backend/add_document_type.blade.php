@extends('backend.master')
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
                        <a href="{{ route('document_type_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ;"><i
                                    class="fa fa-plus-circle"></i> &nbsp; Document List &nbsp;</button>
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
                            <p class="card-title " style="font-size: 20px; color:white;  padding:7px; ">Document Details
                            </p>
                        </div>
                        {!! Form::open(['url' => '', 'method' => 'post', 'name' => 'vehicle', 'id' => 'document_type']) !!}
                        <div class="card-body">
                            <div class="form-group ">
                                {{ Form::hidden('code', '', ['id' => 'editcode']) }}
                                {{-- {{ Form::hidden('old_pdf_name', '', ['id' => 'old_pdf_name']) }} --}}
                            </div>

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('document name', 'Document Type:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('document_name', null, ['id' => 'document_name', 'class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="card-footer mt-5" style="text-align:center; padding:0;">
                                <!-- <button type="submit" class="btn btn-primary" id="submit_btn"><i class="fas fa-plus-circle"></i> &nbsp;Add &nbsp;</button> -->
                                {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'edit_update', 'style' => ' color: white;']) }}
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
            $('#document_type').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    document_name: {
                        validators: {
                            notEmpty: {
                                message: 'Document Name is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z\s]+$/i,
                                message: 'Only Alphabate, Space and . Allowed Here'
                            },
                            stringLength: {
                                max: 50,
                                message: 'Document Name accept maximum of 50 characters'
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
            let document_name = $("#document_name").val();

            let fd = new FormData();
            if (code > 0) {
                var action_url = "update_document_data";
            } else {
                var action_url = "add_document_save";

            }
            fd.append('code', code);

            fd.append('document_name', document_name);
            fd.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: 'POST',
                url: action_url,
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {
                        const msg = "<strong>SUCCESS: </strong> Document details Save Successfully";

                        $.confirm({
                            title: 'Success!',
                            type: 'green',
                            icon: 'fa fa-check',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    window.location.href = "document_type_list";
                                },
                                // cancel: function() {
                                //     $.alert('Canceled!');
                                // },
                            }
                        });
                    } else if (data.status == 2) {

                        var msg =
                            "<strong>SUCCESS: </strong>Document details updated successfully";

                        $.confirm({
                            title: 'Success!',
                            type: 'green',
                            icon: 'fa fa-check',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    // $('#Add_Project_Details').get(0).reset();
                                    // $(".se-pre-con").fadeOut("slow");
                                    location.reload();
                                    window.location.href = "document_type_list";
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
                    // $('#pLoader').hide();

                }
            });
        }
    </script>

    @isset($send_data)
        <script>
            //$('#edit_update').val('update');
            $("#editcode").val("{{ $send_data['code'] }}");
            $("#document_name").val("{{ $send_data['document_name'] }}");
        </script>
    @endisset
@endsection
