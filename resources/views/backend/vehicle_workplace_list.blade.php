@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">

                    {!! Form::button('<i class="fa fa-desktop "></i> Dash Board / <b>Vehicle Workplace</b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}

                    <!-- <h1 class="m-0">scwscs</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('add_vehicle_workplace') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ;  "><i
                                    class="fa fa-plus-circle"></i> &nbsp;Add Vehicle workplace&nbsp;</button>
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
                        <table id="vehicle_workplace_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="2%">SN</th>
                                    <th width="10%">Serial no</th>
                                    <th width="10%">State</th>
                                    <th width="10%">District</th>
                                    <th width="10%">Address </th>
                                    <th width="2%"> Operator</th>

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
            $('#vehicle_workplace_table').dataTable().fnDestroy();
            $('#vehicle_workplace_table').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "show_vehicle_workplace_list",
                    type: "post",
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    dataSrc: "record_details",

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
                        "data": "vehicle_serial_no",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 2,
                        "data": "state",
                        // "searchable": false,
                        // "sortable": false,
                    }, {
                        "targets": 3,
                        "data": "district",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 4,
                        "data": "address",
                        // "searchable": false,
                        // "sortable": false,
                    },

                    {
                        "targets": 5,
                        "data": "operator",
                        // "searchable": false,
                        // "sortable": false,
                    },

                    {
                        "targets": -1,
                        "data": 'action',
                        "searchable": false,
                        "sortable": false,
                        "render": function(data, type, full, meta) {
                            var str_btns = "";

                            str_btns +=
                                '<button type="submit" data-toggle="tooltip"  style="margin-left: 1px" class="btn btn-warning  btn-sm Small edit_data" id="' +
                                data.e + '" title="Edit"><i class="fa fa-edit"></i> </button>';
                            str_btns +=
                                '<button type="submit" data-toggle="tooltip" style="margin-left: 5px" class="btn btn-danger  btn-sm Small delete-button delete_data" id="' +
                                data.d + '" title="Delete"><i class="fa fa-trash"></i> </button';

                            return str_btns;
                        }
                    }
                ]
            });
        }

        $("#vehicle_workplace_table").on('draw.dt', function() {
            $(".edit_data").click(function() {

                // alert('hi');
                let edit_code = this.id;
                // console.log(edit_code);
                let datas = {
                    'code': edit_code,
                    '_token': "{{ csrf_token() }}"
                };
                redirectPost("{{ url('edit_vehicle_workplace') }}", datas);

            });

            $('.delete_data').click(function() {
                // alert('hi');
                let code = this.id;

                var msg = "Are You Sure to <strong>delete! </strong>";
                $.alert({
                    title: 'Confirm!!',
                    type: 'red',
                    icon: 'fas fa-exclamation-triangle',
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
                    url: "delete_vehicle_workplace",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 3) {
                            var msg =
                                "<strong>SUCCESS: </strong>Vehicle Details deleted Successfully";
                            $.confirm({
                                title: 'Success!',
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
                            msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                        } else {
                            if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                if (jqXHR.responseJSON.exception_code == 23000) {
                                    msg += "Some Sql Exception Occured";
                                } else {
                                    msg += "Exception: <strong>" + jqXHR.responseJSON
                                        .exception_message +
                                        "</strong>";
                                }
                            } else {
                                msg += "Error(s):<strong><ul>";
                                $.each(jqXHR.responseJSON['errors'], function(key, value) {
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
        function redirectPost(url, data1) {
            var $form = $("<form />");
            $form.attr("action", url);
            $form.attr("method", "post");
            //         $form.attr("target", "_blank");
            for (var data in data1) {
                $form.append('<input type="hidden" name="' + data + '" value="' + data1[data] + '" />');
                console.log(data1[data]);
            }
            $("body").append($form);
            $form.submit();
        }
    </script>
@endsection
