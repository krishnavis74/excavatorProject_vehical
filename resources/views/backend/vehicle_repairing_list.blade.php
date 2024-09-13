@extends('backend.master')
@section('title', 'User List')
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
                        <a href="{{ route('add_vehicle_repairing') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "><i
                                    class="fa fa-plus-circle"></i> &nbsp;Add Repairing &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="box box-warning">
            <div class="box-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="vehicle_repairing" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10%">SN</th>
                                    <th width="30%">Vendor Name</th>
                                    <th width="30%">Vehicle Reg No </th>
                                    <th width="20%">Date</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            show_project();
        });
        function show_project() {
            $('#vehicle_repairing').dataTable().fnDestroy();
            $("#vehicle_repairing").dataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    url: 'show_vehicle_repairing_list',
                    type: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    dataSrc: "record_details"
                },
                "dataType": 'json',
                "columnDefs": [{
                        className: "table-text",
                        "targets": "_all"
                    },
                    {
                        "targets": 0,
                        "data": "code",
                        "defaultContent": "",
                        // "searchable": false, 
                        // "sortable": false,
                    },
                    {
                        "targets": 1,
                        "data": "vendor_name",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 2,
                        "data": "vehicle_reg_no",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 3,
                        "data": "date",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": -1,
                        "data": "action",
                        // "searchable": false,
                        // "sortable": false,
                    },
                ]
            });
            $("#vehicle_repairing").on('draw.dt', function() {
                $(".edit_btn").click(function() {
                    var edit_code = this.id;
                    // alert(edit_code);
                    let datas = {
                        'code': edit_code,
                        '_token': "{{ csrf_token() }}"
                    };
                    redirectPost("{{ url('edit_vehicle_repairing') }}", datas);
                });
                $(".delete_btn").click(function() {
                    var code = this.id;
                    //  console.log(code);
                    // alert(code);
                    var msg = "<strong>Are You Sure To Delete </strong>";
                    $.alert({
                        title: 'Confirm!',
                        type: 'red',
                        icon: 'fa fa-exclamation-triangle',
                        content: msg,
                        buttons: {
                            yes: function() {
                                delete_data(code);
                                // location.reload();
                            },
                            cancel: function() {
                                location.reload();
                            }
                        }
                    });
                });
                function delete_data(code) {
                    let fd = new FormData();
                    fd.append('code', code);
                    fd.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        type: 'post',
                        url: "delete_vehicle_repairing",
                        data: fd,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            if (data.status == 3) {
                                var msg =
                                    "<strong>Success:</strong>Vehicle Repairing details deleted Successfully";
                                $.confirm({
                                    title: 'Success !',
                                    type: 'green',
                                    icon: 'fa fa-check',
                                    content: msg,
                                    buttons: {
                                        ok: function() {
                                            location.reload();
                                        }
                                    }
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var msg = "";
                            if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                                msg += "<strong>" + jqXHR.status + ": " +
                                    errorThrown +
                                    "</strong>";
                            } else {
                                if (jqXHR.responseJSON.hasOwnProperty(
                                        'exception')) {
                                    if (jqXHR.responseJSON.exception_code ==
                                        23000) {
                                        msg += "Some Sql Exception Occured";
                                    } else {
                                        msg += "Exception: <strong>" + jqXHR
                                            .responseJSON
                                            .exception_message +
                                            "</strong>";
                                    }
                                } else {
                                    msg += "Error(s):<strong><ul>";
                                    $.each(jqXHR.responseJSON['errors'], function(
                                        key, value) {
                                        msg += "<li>" + value + "</li>";
                                    });
                                    msg += "</ul></strong>";
                                }
                                $.alert({
                                    title: 'Error!!',
                                    type: 'red',
                                    icon: 'fa fa-warning',
                                    content: msg,
                                });
                            }
                        },
                    });
                }
            });

        };
        function redirectPost(url, data1) {
            var $form = $("<form />");
            $form.attr("action", url);
            $form.attr("method", "post");
            for (var data in data1) {
                $form.append('<input type="hidden" name="' + data + '" value="' + data1[data] + '" />');
                // console.log(data1[data]);
            }
            $("body").append($form);
            $form.submit();
        }
    </script>
@endsection
