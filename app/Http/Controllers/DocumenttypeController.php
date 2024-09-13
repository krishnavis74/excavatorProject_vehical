<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\documentType;

class DocumenttypeController extends Controller
{
    public function add_document_type()
    {
        return view('backend.add_document_type');
    }
    public function add_document_save(Request $request)
    {
        $request->validate(
            [
                'document_name' => 'required|max:50|regex:/^[a-zA-Z\s\.]+$/i',
            ],
            [
                'document_name.required' => 'Document Name Is Required',
                'document_name.regex' => 'Document Name Is accept Only Alphabate, . , and Space',
                'document_name..max' => 'Document Name accept maximum of 50 characters'
            ],
        );

        $document = new documentType();

        $document->document_name = $request->document_name;

        if ($document->save()) {
            $response = [
                'status' => 1,
            ];
            return $response;
        }
    }

    public function document_type_list()
    {
        return view('backend.document_list');
    }

    public function show_document_list(Request $request)
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
        $offset = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        // $data = [];
        $allrecord = [];
        $dep_data = documentType::select('*')
            ->orderby('code', 'desc')
            ->where(function ($q) use ($search) {
                $q->orwhere('document_name', 'like', '%' . $search . '%');
            });

        $filtered_count = $dep_data->count();
        $record = $dep_data;
        $page_displayed = $record
            ->offset($offset)
            ->limit($length)
            ->get();
        $count = $offset + 1;
        foreach ($page_displayed as $user) {
            $data['id'] = $count;
            $data['document_name'] = $user->document_name;
            $data['action'] = "<button type='button' class='btn btn-warning edit_btn' id=" . $user->code . "><i class='fa fa-edit'></i></button> <button type='button' class='btn btn-danger delete_btn'  id=" . $user->code . "><i class='fa fa-trash'></i></button>";
            $count++;
            $allrecord[] = $data;
        }

        $response = [
            'draw' => $draw,
            'recordsTotal' => $filtered_count, //Should be changed #7
            'recordsFiltered' => $filtered_count,
            'record_details' => $allrecord, //Should be changed #8
        ];
        return $response;
    }

    public function edit_document(Request $request)
    {
        $edit_data = documentType::select('*')
            ->where('code', '=', $request->code)
            ->first();

        $send_data = [
            'code' => $edit_data->code,
            'document_name' => $edit_data->document_name,
        ];
        return view('backend.add_document_type')->with('send_data', $send_data);
    }

    public function update_document_data(Request $request)
    {
        $request->validate(
            [
                'document_name' => 'required|max:50|regex:/^[a-zA-Z\s\.]+$/i',
            ],
            [
                'document_name.required' => 'Document Name Is Required',
                'document_name.regex' => 'Document Name Is accept Only Alphabate, . , and Space',
                'document_name..max' => 'Document Name accept maximum of 50 characters'
            ],
        );

        $code = $request->code;
        $document_name = $request->document_name;

        $update = documentType::where('code', $code)->update(['document_name' => $document_name]);

        if ($update) {
            $response = [
                'status' => 2,
            ];

            return $response;
        }
    }
    public function delete_document(Request $request)
    {
        $this->validate(
            $request,
            ['code' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );

        $delete = documentType::where('code', $request->code)->delete();
        if ($delete) {
            $response = [
                'status' => 3,
            ];

            return $response;
        }
    }
   
}
