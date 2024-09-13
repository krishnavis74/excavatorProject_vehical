<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\documentType;
use App\models\tbl_vehicle;
use App\models\vehiclewise_document;

class vehicleDocumentcontroller extends Controller
{
    public function add_vehicle_document()
    {
        return view('backend.add_vehicle_document');
        // return view('backend.vehicle_details_list');
    }
    public function add_vehicle_document_save(Request $request)
    {
        //  dd($request->all());

        $request->validate(
            [
                'vehicle_reg_no' => 'required|regex:/^[a-zA-Z0-9\s\-.]+$/i',
                'document_type' => 'required|regex:/^[a-zA-Z0-9\s\-.]+$/i',
                'pdf_file' => 'required|mimes:pdf|max:512',
            ],
            [
                'vehicle_reg_no.required' => 'Vehicle registration number is required',
                'vehicle_reg_no.regex' => 'Vehicle Registration number accept Only Alphabate, . , and Space',

                'document_type.required' => 'Document Type is required',
                'document_type.regex' => 'Document Type number accept Only Alphabate, . , and Space',

                'pdf_file.required' => 'Document Is Required',
                'pdf_file.max' => 'Document file cancont be greater than 512Kb.',
                'pdf_file.mimes' => 'Document file must be a pdf file.',
            ],
        );

        $vehicle_document = new vehiclewise_document();
        $vehicle_document->vehicle_reg_no_id = $request->vehicle_reg_no;
        $vehicle_document->document_type_id = $request->document_type;

        if (!empty($request->file('pdf_file'))) {
            $file_admit = $request->file('pdf_file');
            $file_ext = $file_admit->getClientOriginalExtension();
            $filename_upload = date('dmYhms') . rand(10001, 99999) . '.' . $file_ext;
            $galary_photo_destination_path = 'uploads/document';
            $file_admit->move($galary_photo_destination_path, $filename_upload);
            $file_document = $filename_upload;
            $vehicle_document->document_pdf = $file_document;
        }
        if ($vehicle_document->save()) {
            $response = [
                'status' => 1,
            ];
            return $response;
        }
    }

    public function vehicle_document_list()
    {
        return view('backend.vehicle_document_list');
    }
    public function show_vehicle_document_list(Request $request)
    {
        $this->validate(
            $request,
            [
                'draw' => 'required|integer|between:0,9999999999',
                'start' => 'required|integer|between:0,999999999',
                'length' => 'required|integer|between:0,100',
                'search.*' => 'nullable|regex:/^[A-Za-z0-9\s]+$/i',
                'order' => 'array',
                'offset' => 'regex:/^[0-9]+$/i',
                'order.*.column' => 'required|integer|between:0,7',
                'order.*.dir' => 'required|in:asc,desc',
            ],
            [
                'draw.required' => 'Invalid Input',
                'draw.between' => 'Invalid Input',
                'draw.integer' => 'Invalid Input',

                'start.required' => 'Invalid Input',
                'start.between' => 'Invalid Input',
                'start.integer' => 'Invalid Input',

                'length.required' => 'Invalid Input',
                'length.between' => 'Invalid Input',
                'length.integer' => 'Invalid Input',

                'order.array' => 'Invalid Input',

                'order.*.column.required' => 'Invalid Input',
                'order.*.column.integer' => 'Invalid Input',
                'order.*.column.between' => 'Invalid Input',

                'order.*.dir.required' => 'Invalid Input',
                'order.*.dir.in' => 'Invalid Input',
                'search.*.regex' => 'Invalid Input',
                'offset.regex' => 'Offset value can only integer',
            ],
        );
        $draw = $request->draw;
        $length = $request->length;
        $offset = $request->start;
        $search = $request->search['value'];
        //   dd($length);
        $allrecord = [];
        $data = [];
        $show_data = vehiclewise_document::join('tbl_vehicle', 'tbl_vehicle.code', 'vehiclewise_document.vehicle_reg_no_id')
            ->join('document_type', 'document_type.code', 'vehiclewise_document.document_type_id')
            ->select('vehiclewise_document.code', 'vehiclewise_document.document_pdf', 'tbl_vehicle.vehicle_reg_no', 'document_type.document_name')
            ->orderby('vehiclewise_document.code', 'desc')
            ->where(function ($q) use ($search) {
                $q->orwhere('document_type.document_name', 'like', '%' . $search . '%');
                // $q->orwhere('email','like', '%'  .$search . '%');
            });

        // dd($show_data);
        $filtered_count = $show_data->count();
        // dd($dep_data);
        $record = $show_data;
        $page_displayed = $record
            ->offset($offset)
            ->limit($length)
            ->get();
        $count = $offset + 1;

        foreach ($page_displayed as $item) {
            $data['code'] = $count;
            $data['document_name'] = $item->document_name;
            $data['vehicle_reg_no'] = $item->vehicle_reg_no;

            $document_pdf = $item->document_pdf;

            if ($document_pdf) {
                // $data['document_pdf'] = "<a id='" . $document_pdf . "'><button class='view_pdf' id='" . $document_pdf . "' type='submit' data-toggle='tooltip'  style='margin-left: 1px' class='fa fa-file-pdf-o' title='Pdf'>&nbsp;&nbsp;Pdf&nbsp;&nbsp;</button></a>";

                $data['document_pdf'] = "<a id='" . $document_pdf . "'><button class='view_pdf' id='" . $document_pdf . "' style='margin-left: 1px'  title='Pdf'>&nbsp;&nbsp;Pdf&nbsp;&nbsp;</button></a>";
            }

            // $data['document_pdf'] = "<a href='uploads/document/" . $document_pdf . "'download ><img  src='pdf/pdf_img_symbole.png'  style=' width:50px; height:35px; margin: 2px 0px 2px 0px;'></a>";

            $data['action'] = "<button type='button' class='btn btn-warning edit_btn' id=" . $item->code . "><i class='fa fa-edit'></i></button> <button type='button' class='btn btn-danger delete_btn'  id=" . $item->code . "><i class='fa fa-trash'></i></button>";
            $count++;
            $allrecord[] = $data;
        }
        $response = [
            'draw' => $draw,
            'recordsTotal' => $filtered_count, //Should be changed #7
            'recordsFiltered' => $filtered_count,
            'record_details' => $allrecord, //Should be changed #8
        ];
        return response()->json($response);
    }

    public function edit_vehicle_document(Request $request)
    {
        $edit_data = vehiclewise_document::join('tbl_vehicle', 'tbl_vehicle.code', 'vehiclewise_document.vehicle_reg_no_id')
            ->join('document_type', 'document_type.code', 'vehiclewise_document.document_type_id')
            ->select('vehiclewise_document.code', 'vehiclewise_document.document_pdf', 'tbl_vehicle.vehicle_reg_no', 'document_type.document_name', 'vehiclewise_document.vehicle_reg_no_id', 'vehiclewise_document.document_type_id')
            ->first();
        // dd($edit_data );
        $edit_data = [
            'code' => $edit_data->code,
            'vehicle_reg_no' => $edit_data->vehicle_reg_no_id,
            'document_name' => $edit_data->document_type_id,
            'document_pdf' => $edit_data->document_pdf,
        ];
        //    dd($send_data);
        return view('backend.add_vehicle_document')->with('edit_send_data', $edit_data);
    }

    public function update_vehicle_document_data(Request $request)
    {
        //  dd($request->all());

        if (!empty($request->file('pdf_file'))) {
            $this->validate(
                $request,
                [
                    'pdf_file' => 'required|mimes:pdf|max:512',
                ],
                [
                    'pdf_file.required' => 'Document Is Required',
                    'pdf_file.max' => 'Document file cancont be greater than 512Kb.',
                    'pdf_file.mimes' => 'Document file must be a pdf file.',
                ],
            );
        }

        $request->validate(
            [
                'vehicle_reg_no' => 'required|regex:/^[a-zA-Z0-9\s\-.]+$/i',
                'document_type' => 'required|regex:/^[a-zA-Z0-9\s\-.]+$/i',
                // 'pdf_file' => 'required|mimes:pdf|max:512',
            ],
            [
                'vehicle_reg_no.required' => 'Vehicle registration number is required',
                'vehicle_reg_no.regex' => 'Vehicle Registration number accept Only Alphabate, . , and Space',

                'document_type.required' => 'Document Type is required',
                'document_type.regex' => 'Document Type number accept Only Alphabate, . , and Space',

                // 'pdf_file.required' => 'Document Is Required',
                // 'pdf_file.max' => 'Document file cancont be greater than 512Kb.',
                // 'pdf_file.mimes' => 'Document file must be a pdf file.',
            ],
        );

        $code = $request->code;
        $vehicle_reg_no = $request->vehicle_reg_no;
        $document_type = $request->document_type;
        $old_pdf = $request->old_pdf_name;

        if (!empty($request->file('pdf_file'))) {
            if ($old_pdf != '') {
                if (file_exists(public_path('uploads/document/' . $old_pdf))) {
                    unlink(public_path('uploads/document/' . $old_pdf));
                }
            }

            $file_admit = $request->file('pdf_file');
            $file_ext = $file_admit->getClientOriginalExtension();
            $filename_upload = date('dmYhms') . rand(10001, 99999) . '.' . $file_ext;
            $galary_photo_destination_path = 'uploads/document';
            $file_admit->move($galary_photo_destination_path, $filename_upload);
            $file_document = $filename_upload;

            $old_pdf = $file_document;
        }

        $update = vehiclewise_document::where('code', '=', $code)->update(['vehicle_reg_no_id' => $vehicle_reg_no, 'document_type_id' => $document_type, 'document_pdf' => $old_pdf]);
        if ($update) {
            $response = [
                'status' => 2,
            ];

            return $response;
        }
    }

    public function delete_vehicle_document(Request $request)
    {
        $this->validate(
            $request,
            ['code' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );
        try {
            $result = vehiclewise_document::select('document_pdf')->where('code', '=', $request->code)->first();
            // dd($result->all());
            $filename_img_old = $result->document_pdf;
            // echo $filename_img_old;die;
            if ($filename_img_old != '') {
                if (file_exists(public_path('uploads/document/' . $filename_img_old))) {
                    unlink(public_path('uploads/document/' . $filename_img_old));
                }
            }
            $progress_data = vehiclewise_document::where('code', '=', $request->code);
            if (!empty($progress_data)) {
                $progress_data = $progress_data->delete();
            }
            if ($progress_data) {
                $response = [
                    'status' => 3,
                ];
            }
            // return $response;
        } catch (\Exception $e) {
            $response = [
                'exception' => true,
                'exception_message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return $response;
        }
    }
    public function dropdown_vehicle_document()
    {
        $vehicledocument = documentType::pluck('document_name', 'code');

        $response = [
            'vehicledocument' => $vehicledocument,
            'status' => 1,
        ];
        return $response;
    }
    public function dropdown_vehicle_repairing(Request $request)
    {
        $vehicle_name = tbl_vehicle::pluck('vehicle_reg_no', 'code');
        // dd($vehicle_name);
        $response = [
            'vehicle_name' => $vehicle_name,
            'status' => 1,
        ];
        return $response;
    }
}
