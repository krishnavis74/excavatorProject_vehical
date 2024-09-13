@extends('layouts.master')
@section('content')
    <style>
        .nav_page_styl {
            background-color: rgb(6, 146, 180);
            box-shadow: 2px 2px 2px black;
        }

        .nav_page_styl:hover {
            background-color: rgb(6, 146, 180);
            box-shadow: 2px 2px 2px black;
        }
    </style>
    {{-- <link rel="stylesheet" href="{{ asset('css/formdesign.css') }}"> --}}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {!! Form::hidden('clr_scrn', '', ['id' => 'clr_scrn']) !!}
                {!! Form::hidden('code', '', ['id' => 'code']) !!}
                {!! Form::button(
                    '<i class="fa fa-desktop"></i> Dash Board /  <a href="enquiry_list" style="color:white"><b> List Of Land Conversion</b></a>',
                    ['class' => 'btn btn-primary add-new-button nav_page_styl'],
                ) !!}
            </h1>

            <ol class="breadcrumb">
                <li><a href="addnewenquiry"> {!! Form::button('<i class="fa fa-plus-circle"></i> Add Land Conversion', [
                    'id' => 'add-new-button',
                    'class' => 'btn btn-primary btn-sm nav_page_styl',
                    'style' => 'margin-top: -10px;',
                ]) !!}</a></li>
            </ol>

        </section>

        <section class="content">

            <div class="row">
                <section class="col-lg-12 connectedSortable tab-part">
                    <div class="nav-tabs-custom">
                        <div class="tab-content no-padding">
                            <div class="data-area-prt">
                                <div class="clearfix"> </div>
                                <hr>
                                {!! Form::open([
                                    'url' => 'enquirysave',
                                    'name' => 'enquirysave',
                                    'id' => 'enquirysave',
                                    'class' => 'form-block',
                                ]) !!}
                                <h3 class="form-title" style="text-align:center">
                                    Add Land Conversion
                                </h3>
                                <hr>
                                <div class="row form-group">
                                    {!! Form::hidden('code', '', ['id' => 'editcode']) !!}
                                    <div class="col-md-3">
                                        {!! Form::label('district', 'District Name', ['class' => 'required']) !!}

                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('district', ['' => 'select District Name'], null, [
                                            'id' => 'district',
                                            'class' => 'form-control',
                                            'placeholder' => 'Select',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group subdivision">
                                    <div class="col-md-3">
                                        {!! Form::label('subdivision_name', 'Subdivision Name:', ['class' => 'required']) !!}

                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('subdivision_name', ['' => 'select Subdivision Name'], null, [
                                            'id' => 'subdivision_name',
                                            'class' => 'form-control',
                                            'placeholder' => 'Select',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group block">
                                    <div class="col-md-3">
                                        {!! Form::label('block_name', 'Block Name:', ['class' => 'required']) !!}

                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('block_name', ['' => 'select Block Name'], null, [
                                            'id' => 'block_name',
                                            'class' => 'form-control',
                                            'placeholder' => 'Select',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-3">


                                        {!! Form::label('applicant_name', 'Applicant Name:', ['class' => 'required']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::text('applicant_name', null, [
                                            'placeholder' => 'Enter Applicant Name',
                                            'applicant_name' => 'cnno',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        {!! Form::label('cnno', 'CNNO:', ['class' => 'required']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::text('cnno', null, [
                                            'placeholder' => 'Enter CN No',
                                            'id' => 'cnno',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        {!! Form::label('jlno', 'JLNO:', ['class' => 'required']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::text('jlno', null, [
                                            'placeholder' => 'Enter JL NO',
                                            'id' => 'jlno',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">
                                        {!! Form::label('mouzano', 'MOUZA Name:', ['class' => 'required']) !!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::text('mouzano', null, [
                                            'placeholder' => 'Enter MOUZA Name',
                                            'id' => 'mouzano',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-3">
                                        {!! Form::label('plotno', 'PLOT:', ['class' => 'required']) !!}
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        {!! Form::text('plotno', null, [
                                            'placeholder' => 'Enter PLOT NO',
                                            'id' => 'plotno',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        {!! Form::select('present_classification', ['' => 'Select Recorded Classification'], null, [
                                            'id' => 'present_classification',
                                            'class' => 'form-control',
                                            'placeholder' => 'Select',
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        {!! Form::select('proposed_classification', ['' => 'Select Proposed Classification'], null, [
                                            'id' => 'proposed_classification',
                                            'class' => 'form-control',
                                            'placeholder' => 'Select',
                                        ]) !!}
                                    </div>

                                    <div class="col-sm-1 form-group">
                                        {!! Form::text('f_1', null, [
                                            'placeholder' => 'Applied Area',
                                            'id' => 'f_1',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        {!! Form::text('f_2', null, [
                                            'placeholder' => 'Share',
                                            'id' => 'f_2',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        {!! Form::text('f_3', null, [
                                            'placeholder' => 'Total Area',
                                            'id' => 'f_3',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-2">
                                        {{ Form::button('Add', ['name' => 'button', 'id' => 'addplot', 'class' => 'btn btn-success']) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-6">
                                        <table class='table table-striped table-bordered' id="plot_id"
                                            style='border: 1px solid black;'>
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;">Plot No</th>
                                                    <th style="width: 10%;">Recorded Classification</th>
                                                    <th style="width: 10%;">Proposed Classification</th>
                                                    <th style="width: 20%;">Applied Area(In Acre)</th>
                                                    <th style="width: 10%;">Share</th>
                                                    <th style="width: 10%;">Total Area</th>
                                                    <th style="width: 10%;">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody id="plot_datas">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5"></div>
                                    <div class="col-md-5 btn_save">
                                        {{ Form::submit('Save', ['name' => 'submit', 'class' => 'btn btn-primary']) }}
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                {!! Form::close() !!}
                </section>
            </div>
        </section>
    </div>
    <script>
        var plot_array = [];
        var plot = [];
        var present = [];
        var proposed = [];
        var f1_arr = [];
        var f2_arr = [];
        var f3_arr = [];

        function create_plot_table() {
            var str = "";
            $.each(plot_array, function(key, value) {
                str += "<tr>";
                str += "<td>" + value.plotno + "</td>";
                str += "<td>" + value.present_classification_name + "</td>";
                str += "<td>" + value.proposed_classification_name + "</td>";
                str += "<td>" + value.f1 + "</td>";
                str += "<td>" + value.f2 + "</td>";
                str += "<td>" + value.f3 + "</td>";
                str +=
                    "<td><button type='button' data-id=" + key +
                    " class='remove_plot_data btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td>";
                str += "</tr>";

            });
            $("#plot_datas").html(str);

        }
        $(document).on('click', "button.remove_plot_data", function() {

            plot_array.splice($(this).data('id'), 1);
            plot.splice($(this).data('id'), 1);
            present.splice($(this).data('id'), 1);
            proposed.splice($(this).data('id'), 1);
            f1_arr.splice($(this).data('id'), 1);
            f2_arr.splice($(this).data('id'), 1);
            f3_arr.splice($(this).data('id'), 1);
            create_plot_table();
            if (plot_array != '') {
                $('.btn_save').show();
            } else {

                $.alert({
                    title: 'Error!!',
                    type: 'red',
                    icon: 'fa fa-warning',
                    content: "Please Add Atleast One Plot No,Present Classification,Proposed classification",
                });

            }
        });


        $(function() {
            $("#addplot").click(function() {
                var plotno = $("#plotno").val();
                var present_classification_name = $("#present_classification option:selected").text();
                var present_classification_val = $("#present_classification").val();
                var proposed_classification_name = $("#proposed_classification option:selected").text();
                var proposed_classification_val = $("#proposed_classification").val();
                var f1 = $("#f_1").val();
                var f2 = $("#f_2").val();
                var f3 = $("#f_3").val();

                plot_array.push({
                    plotno: plotno,
                    present_classification_val: present_classification_val,
                    present_classification_name: present_classification_name,
                    proposed_classification_val: proposed_classification_val,
                    proposed_classification_name: proposed_classification_name,
                    f1: f1,
                    f2: f2,
                    f3: f3,
                });
                plot.push(plotno);

                present.push(present_classification_val);
                proposed.push(proposed_classification_val);
                f1_arr.push(f1);
                f2_arr.push(f2);
                f3_arr.push(f3);
                $("#plotno").val('');
                $("#present_classification").val('');
                $("#proposed_classification").val('');
                $("#f_1").val('');
                $("#f_2").val('');
                $("#f_3").val('');

                console.table(plot_array);
                create_plot_table();
                if (plot_array != '') {
                    $('.btn_save').show();
                } else {

                    // $.confirm({
                    //     title: 'PLease Add Atleast One Plot No,Present Classification,Proposed Classification',
                    //     type: 'orange',
                    //     icon: 'fa fa-error',
                    //     content: msg,
                    //     buttons: {
                    //         ok: function() {
                    //             $("#plotno").val('');
                    //             $("#present_classification").val('');
                    //             $("#proposed_classification").val('');
                    $('.btn_save').hide();

                    //         }

                    //     }
                    // });
                }

            });
            // product_arr.splice(pos, 1);

            // $(".remove_plot_data").click(function() {
            //     // console.log($(this).data('id'));
            //     // var pos = $(this).attr('data-id');
            //     // plot_array.splice(pos, 1);
            //     // create_plot_table();
            //     alert("amake abr keno dakchish");
            // });


            @isset($enquiry_data)
                $("#cnno").val("{{ $enquiry_data['cnno'] }}");
                $("#mouzano").val("{{ $enquiry_data['mouzano'] }}");
                $("#editcode").val("{{ $enquiry_data['code'] }}");
                $("#plotno").val("{{ $enquiry_data['plotno'] }}");
                $("#applicant_name").val("{{ $enquiry_data['applicant_name'] }}");
                $("#jlno").val("{{ $enquiry_data['jlno'] }}");
                designation("{{ $enquiry_data['designation_code'] }}");
                get_district("{{ $enquiry_data['dist_code'] }}");
                get_classification("{{ $enquiry_data['classification'] }}");
                $("#classification").val("{{ $enquiry_data['classification'] }}");
                get_division("{{ $enquiry_data['sub_code'] }}", "{{ $enquiry_data['block_code'] }}");
                // alert("{{ $enquiry_data['block_code'] }}");


                // var enquiry_data = {!! isset($enquiry_data) ? json_encode($enquiry_data) : 'null' !!};

                @foreach ($enquiry_data['plot_data_total'] as $plot_array_data)
                    plot_array.push({
                        plotno: "{{ $plot_array_data['plotno'] }}",
                        present_classification_val: "{{ $plot_array_data['present_classification_val'] }}",
                        present_classification_name: "{{ $plot_array_data['present_classification_name'] }}",
                        proposed_classification_val: "{{ $plot_array_data['proposed_classification_val'] }}",
                        proposed_classification_name: "{{ $plot_array_data['proposed_classification_name'] }}",
                        f1: "{{ $plot_array_data['field_1'] }}",
                        f2: "{{ $plot_array_data['field_2'] }}",
                        f3: "{{ $plot_array_data['field_3'] }}",
                    });
                    plot.push("{{ $plot_array_data['plotno'] }}");
                    present.push("{{ $plot_array_data['present_classification_val'] }}");
                    proposed.push("{{ $plot_array_data['proposed_classification_val'] }}");
                    f1_arr.push("{{ $plot_array_data['field_1'] }}");
                    f2_arr.push("{{ $plot_array_data['field_2'] }}");
                    f3_arr.push("{{ $plot_array_data['field_3'] }}");
                @endforeach

                create_plot_table();
            @endisset
            if ($("#editcode").val() == '') {
                get_division('', '')
            }
            // } else {


            //     // get_allblock('');
            //     // get_allgp('');


            get_district();
            get_classification();
            get_division_search();
            $("#subdivision_name").change(function() {
                block($("#subdivision_name").val());
            });
            // block();
            $('.assign_code').select2({
                placeholder: "Select RI/RO",
                minimumInputLength: 1,
                maximumInputLength: 20,
                allowClear: true,
                ajax: {
                    url: 'getassign_name',
                    dataType: 'json',
                    method: 'POST',
                    data: function(params) {
                        return {
                            q: $.trim(params.term),
                            _token: $("input[name='_token']").val()
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.options, function(item) {
                                return {
                                    text: item.name,
                                    id: item.code
                                }

                            })
                        };
                    },
                    cache: true
                }
            }).on("select2:select", function(event) {

            });

            $('#enquirysave')
                .bootstrapValidator({
                    message: 'This value is not valid',

                    feedbackIcons: {
                        valid: '',
                        invalid: '',
                        validating: 'fa fa-refresh',
                    },
                    fields: {

                        applicant_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Applicant Name is required'
                                },
                                regexp: {
                                    regexp: /^[A-Za-z\s]+$/i,
                                    message: 'Only Alphabateand Space Allowed Here'
                                }


                            }
                        },
                        cnno: {
                            validators: {
                                notEmpty: {
                                    message: 'CNNO is required'
                                },
                                regexp: {
                                    regexp: /^[A-Za-z0-9/\s]+$/i,
                                    message: 'Only Alphabate and Number and Space Allowed Here'
                                }


                            }
                        },
                        classification: {
                            validators: {
                                notEmpty: {
                                    message: 'Classification is required'
                                },
                            }
                        },

                        subdivision_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Division is required'
                                }

                            }
                        },
                        district: {
                            validators: {
                                notEmpty: {
                                    message: 'District is required'
                                }

                            }
                        },

                        jlno: {
                            validators: {
                                notEmpty: {
                                    message: 'JLNO is required'
                                },

                                regexp: {
                                    regexp: /^[a-zA-Z0-9/]+$/i,
                                    message: 'Only Alphabet and digit Allowed Here'
                                }

                            }
                        },
                        mouzano: {
                            validators: {
                                notEmpty: {
                                    message: 'MouzaNO is required'
                                },
                                regexp: {
                                    regexp: /^[A-Za-z0-9/\s]+$/i,
                                    message: 'Only Alphabet and digit Allowed Here'
                                }

                            }
                        },
                        plotno: {
                            validators: {

                                regexp: {
                                    regexp: /^[a-zA-Z0-9/]+$/i,
                                    message: 'Only Alphabet /,and  digit Allowed Here'
                                }

                            }
                        },
                        proposed_classification: {
                            validators: {

                                regexp: {
                                    regexp: /^[a-zA-Z0-9]+$/i,
                                    message: 'Only Alphabet and digit Allowed Here'
                                }

                            }
                        },
                        present_classification: {
                            validators: {
                                regexp: {
                                    regexp: /^[a-zA-Z0-9]+$/i,
                                    message: 'Only Alphabet and digit Allowed Here'
                                }

                            }
                        },
                        f_1: {
                            validators: {

                                regexp: {
                                    regexp: /^[0-9.]+$/i,
                                    message: 'Only digit Allowed Here'
                                }

                            }
                        },
                        f_2: {
                            validators: {

                                regexp: {
                                    regexp: /^[0-9.]+$/i,
                                    message: 'Only digit Allowed Here'
                                }

                            }
                        },
                        f_3: {
                            validators: {

                                regexp: {
                                    regexp: /^[0-9.]+$/i,
                                    message: 'Only digit Allowed Here'
                                }

                            }
                        },

                    }

                }).on('success.form.bv', function(e) {

                    // Prevent form submission
                    e.preventDefault();

                    if (plot_array != '') {

                        var token = $("input[name='_token']").val();
                        var cnno = $("#cnno").val();
                        var subdivision_name = $("#subdivision_name").val();
                        var block_name = $("#block_name").val();
                        var district = $("#district").val();
                        var jlno = $("#jlno").val();
                        var mouzano = $("#mouzano").val();
                        var plotno = $("#plotno").val();
                        var classification = $("#classification").val();
                        var editcode = $("#editcode").val();
                        var applicant_name = $("#applicant_name").val();
                        // var plot_arr = [];
                        // plot_arr.push({
                        //     plot_array
                        // });
                        // console.log(plot_arr);
                        var formData_save = new FormData();
                        formData_save.append('_token', token);
                        formData_save.append('cnno', cnno);
                        formData_save.append('subdivision_name', subdivision_name);
                        formData_save.append('district', district);
                        formData_save.append('jlno', jlno);
                        formData_save.append('block_name', block_name);
                        formData_save.append('mouzano', mouzano);
                        formData_save.append('plot', plot);
                        formData_save.append('present', present);
                        formData_save.append('proposed', proposed);
                        formData_save.append('f1_arr', f1_arr);
                        formData_save.append('f2_arr', f2_arr);
                        formData_save.append('f3_arr', f3_arr);
                        formData_save.append('applicant_name', applicant_name);
                        if (editcode != '') {
                            formData_save.append('editcode', editcode);
                        }

                    } else if (plot_array == '') {
                        $.alert({
                            title: 'Error!!',
                            type: 'red',
                            icon: 'fa fa-warning',
                            content: "Please Add Atleast One Plot No,Present Classification,Proposed classification",
                        });
                    }

                    formData_save.append('_token', token);
                    $(".se-pre-con").fadeIn("slow");
                    $.ajax({
                        type: "POST",
                        url: "add_enquiry_details",
                        data: formData_save,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            //         var msg = "Please Check The Date Carefully Because Data Cannot Be Editable?"
                            // $.confirm({
                            //     title: 'Warning!',
                            //     type: 'orange',
                            //     icon: 'fa fa-exclamation-triangle',
                            //     content: msg,
                            //     buttons: {
                            //         OK: function() {
                            if (data.status == 1) {
                                // get_mouza_details();

                                var msg =
                                    "<strong>SUCCESS: </strong>Enquiry details save successfully";

                                $.confirm({
                                    title: 'Success!',
                                    type: 'green',
                                    icon: 'fa fa-check',
                                    content: msg,
                                    buttons: {
                                        ok: function() {

                                            $('#enquirysave').get(0)
                                                .reset();
                                            $(".se-pre-con").fadeOut(
                                                "slow");
                                            location.reload();
                                        }

                                    }
                                });
                                //alert(msg);
                            } else if (data.status == 2) {
                                // get_Enquiry_details();

                                var msg =
                                    "<strong>SUCCESS: </strong>Enquiry details updated successfully";

                                $.confirm({
                                    title: 'Success!',
                                    type: 'green',
                                    icon: 'fa fa-check',
                                    content: msg,
                                    buttons: {
                                        ok: function() {
                                            $('#enquirysave').get(0)
                                                .reset();
                                            $(".se-pre-con").fadeOut(
                                                "slow");
                                            location.reload();
                                            window.location.href = "enquiry_list";
                                        }

                                    }
                                });

                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $(".se-pre-con").fadeOut("slow");
                            var msg = "";
                            if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                                msg += "<strong>" + jqXHR.status + ": " + errorThrown +
                                    "</strong>";
                            } else {
                                if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                    msg += "Exception: <strong>" + jqXHR.responseJSON
                                        .exception_message + "</strong>";
                                } else {
                                    msg += "Error(s):<strong><ul>";
                                    $.each(jqXHR.responseJSON['errors'], function(key,
                                        value) {
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

                });
        });


        function get_division(subcode, blockcode) {
            // alert(subcode);
            // alert(blockcode);
            var token = $("input[name='_token']").val();

            $.ajax({
                url: "select_division",
                method: 'post',
                type: 'json',
                data: {
                    _token: token
                },
                success: function(data) {

                    $('#subdivision_name').html('<option value="">Select Subdivision</option>');
                    $.each(data.options, function(key, value) {
                        $("#subdivision_name").append('<option value=' + key + '>' + value +
                            '</option>');
                    });
                    if (subcode > 0) {
                        $("#subdivision_name").val(subcode);
                        block(subcode, blockcode);
                    } else if ({{ auth()->user()->block_code }} > 0) {
                        $("#subdivision_name").val({{ auth()->user()->subdivision_code }});
                        block({{ auth()->user()->subdivision_code }}, {{ auth()->user()->block_code }});
                    }

                },

            });

        }

        function get_division_search() {
            // console.log("start 2");
            var token = $("input[name='_token']").val();

            $.ajax({
                url: "select_division",
                method: 'post',
                type: 'json',
                data: {
                    _token: token
                },
                success: function(data) {
                    console.log(data);

                    $('#search_division').html('<option value="">Select Subdivision</option>');
                    $.each(data.options, function(key, value) {
                        $("#search_division").append('<option value=' + key + '>' + value +
                            '</option>');
                    });
                    if ({{ auth()->user()->subdivision_code }} > 0) {

                        $("#search_division").val({{ auth()->user()->subdivision_code }});
                    }
                    //     get_block({{ auth()->user()->subdivision_code }},
                    //         {{ auth()->user()->block_code }});
                    // }

                }

            });

        }

        function get_district() {

            var token = $("input[name='_token']").val();

            $.ajax({
                url: "select_district",
                method: 'post',
                type: 'json',
                data: {
                    _token: token
                },
                success: function(data) {
                    //alert(data.status);

                    $('#district').html('<option value="">Select District</option>');
                    $.each(data.options, function(key, value) {
                        $("#district").append('<option selected value=' + key + '>' +
                            value +
                            '</option>');
                    });
                    $('#search_district').html('<option  value="">Select District</option>');
                    $.each(data.options, function(key, value) {
                        $("#search_district").append('<option selected value=' + key + '>' +
                            value +
                            '</option>');
                    });


                }

            });

        }

        function get_userlevel() {
            $.ajax({
                type: 'post',
                url: 'getuserlevel',
                async: false,
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataSrc: 'Alllevel',
                dataType: "json",
                success: function(data) {
                    $("#user_level").html('');
                    $("#user_level").append('<option value="" >Select User Level</option>');

                    $.each(data.Alllevel, function(key, value) {

                        $("#user_level").append('<option value=' + key + '>' + value +
                            '</option>');
                    });

                    if ({{ auth()->user()->user_type }} > 0) {
                        $("#user_level").val({{ auth()->user()->user_type }});
                    }

                    designation($("#user_level").val());
                    change_data($("#user_level").val());

                },
            });
        }

        function get_userlevel_search() {
            $.ajax({
                type: 'post',
                url: 'getuserlevel',
                async: false,
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataSrc: 'Alllevel',
                dataType: "json",
                success: function(data) {
                    $("#search_user_type").html('');
                    $("#search_user_type").append('<option value="" >Select User Level</option>');


                    $.each(data.Alllevel, function(key, value) {

                        $("#search_user_type").append('<option value=' + key + '>' + value +
                            '</option>');
                    });

                    if ({{ auth()->user()->user_type }} != 0) {
                        $("#search_user_type").val({{ auth()->user()->user_type }});
                    }

                    get_designation($("#search_user_type").val());
                    change_data_search($("#search_user_type").val());

                },
            });
        }

        function change_data(level) {



            console.log(level)
            if (level == '1') {
                $(".subdivision_m").hide();
                $(".block_m").hide();
            } else if (level == '2') {
                $(".subdivision_m").show();
                $(".block_m").hide();
            } else if (level == '3') {
                $(".subdivision_m").show();
                $(".block_m").show();
            }

        }

        function change_data_search(search_user_type) {


            if (search_user_type == '1') {
                $(".subdivision").hide();
                $(".block").hide();
            } else if (search_user_type == '2') {
                $(".subdivision").show();
                $(".block").hide();
            } else if (search_user_type == '3') {
                console.log(search_user_type);
                $(".subdivision").show();
                $(".block").show();
            }
        }

        function get_designation(user_level) {

            $.ajax({
                type: 'post',
                url: 'getdesignation',
                async: false,
                data: {
                    user_level: user_level,
                    '_token': '{{ csrf_token() }}'
                },
                dataSrc: 'Alldesignation',
                dataType: "json",
                success: function(data) {
                    $("#search_designation").html('');
                    $("#search_designation").append(
                        '<option value="" >Select Designation</option>');
                    $.each(data.Alldesignation, function(key, value) {
                        $("#search_designation").append('<option value=' + key + '>' +
                            value +
                            '</option>');
                    });
                    $("#search_designation").val({{ auth()->user()->degnisn }})
                },
            });
        }

        function designation(user_level) {
            // alert(stream_name);
            $.ajax({
                type: 'post',
                url: 'getdesignation',
                async: false,
                data: {
                    'user_level': user_level,
                    '_token': '{{ csrf_token() }}'
                },
                dataSrc: 'Alldesignation',
                dataType: "json",
                success: function(data) {
                    $("#designation").html('');
                    $("#designation").append('<option value="" >Select Designation</option>');
                    $.each(data.Alldesignation, function(key, value) {
                        $("#designation").append('<option value=' + key + '>' + value +
                            '</option>');
                    });
                    $("#designation").val(user_level);
                },
            });
        }

        function get_block() {

            $.ajax({
                type: 'post',
                url: 'getblock',
                async: false,
                data: {
                    'subdision_name': sub_code,
                    '_token': '{{ csrf_token() }}'
                },
                dataSrc: 'Allblock',
                dataType: "json",
                success: function(data) {

                    $("#search_block").html('');
                    $("#search_block").append('<option value="" >Select Block</option>');


                    $.each(data.Allblock, function(key, value) {

                        $("#search_block").append('<option value=' + key + '>' + value +
                            '</option>');
                    });
                    // console.log(block_code);
                    if ({{ auth()->user()->block_code }} > 0) {

                        $("#search_block").val({{ auth()->user()->block_code }});
                    }
                },
            });
        }



        function block(sub_code, block_code) {
            //alert(sub_code);
            // alert(block_code);
            $.ajax({
                type: 'post',
                url: 'getblock',
                async: false,
                data: {
                    'subdision_name': sub_code,

                    '_token': '{{ csrf_token() }}'
                },
                dataSrc: 'Allblock',
                dataType: "json",
                success: function(data) {
                    $("#block_name").html('');
                    $("#block_name").append('<option value="1" >Select Block</option>');

                    $.each(data.Allblock, function(key, value) {

                        $("#block_name").append('<option value=' + key + '>' + value +
                            '</option>');
                    });
                    if (block_code > 0) {
                        $("#block_name").val(block_code);
                    } else if ({{ auth()->user()->block_code }} > 0) {

                        $("#block_name").val({{ auth()->user()->block_code }});
                    }


                },
            });
        }


        function get_classification() {
            var token = $("input[name='_token']").val();

            $.ajax({
                url: "get_classification",
                method: 'post',
                type: 'json',
                data: {
                    _token: token
                },
                success: function(data) {
                    //alert(data.status);

                    $('#proposed_classification').html(
                        '<option value="">Select Proposed Classification</option>');
                    $('#present_classification').html(
                        '<option value="">Select Recorded Classification</option>');
                    $.each(data.options, function(key, value) {
                        $("#proposed_classification").append('<option value=' + key + '>' +
                            value +
                            '</option>');
                    });
                    $.each(data.options, function(key, value) {
                        $("#present_classification").append('<option value=' + key + '>' +
                            value +
                            '</option>');
                    });
                }

            });
        }


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
@stop
