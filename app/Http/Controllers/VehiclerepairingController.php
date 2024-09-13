<?php

namespace App\Http\Controllers;

use App\models\tbl_vehicle;
use App\models\vehicleRepairing;
use Illuminate\Http\Request;
use App\models\vehicleRepairingDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VehiclerepairingController extends Controller
{
    public function add_vehicle_repairing()
    {
        return view('backend.add_vehicle_repairing');
    }

    public function save_vehicle_repairing(Request $request)
    {
        // echo '<pre>';
        // echo print_r($request->all());
        // echo '</pre>';
        //  dd($request->all());
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occured in form submit.'];
            return response()->json($response, $statusCode);
        }
        $request->validate(
            [
                'vendor_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s-]+$/i',
                'vehicle_reg_no' => 'required|max:50|regex:/^[a-zA-Z0-9\s-]+$/i',
                'date' => 'required|date_format:d/m/Y',
                'address' => 'required|max:100|regex:/^[a-zA-Z0-9\s-]+$/i',
                // 'type' => 'required|max:50|regex:/^[a-zA-Z\s]+$/i',
                // 'description'=>'required|max:50|regex:/^[A-Za-z0-9\s/-]+$/i',
                // 'quantity' => 'required|max:6|regex:/^[0-9]+$/i',
                // 'amount' => 'required|max:10|regex:/^[0-9]+$/i',
                // 'total' => 'required|max:10|regex:/^[0-9]+$/i',
            ],
            [
                'vendor_name.required' => 'Vendor Name is required',
                'vendor_name.regex' => 'Vendor Name accept Only Alphanumeric,  and Space',
                'vendor_name.max' => 'Vender Name accept maximum of 50 characters',

                'address.required' => 'Address Is Required',
                'address.regex' => 'Address accept Only Alphanumeric,  and Space',
                'address.max' => 'Address accept maximum of 100 characters',

                'vehicle_reg_no.required' => 'Vehicle registration number is required',
                'vehicle_reg_no.regex' => ' Vehicle Registration number accept Only Alphanumeric,  and Space',
                'vehicle_reg_no.max' => 'Vehicle registration number accept maximum of 50 characters',

                'date.required' => 'Date  is required',
                'date.date_format' => 'Date Format Is Invalid',

                // 'type.required' => 'Type field is required',
                // 'type.regex' => 'Type field accept only alphabet',
                // 'type.max' => 'Type field accept only 50 characters.',

                // 'quantity.required' => 'Quantity Is Required',
                // 'quantity.regex' => 'Quantity accept Only Numeric Value',
                // 'quantity.max' => 'Quantity accept 6 digits',

                // 'amount.required' => 'Amount Is Required',
                // 'amount.regex' => 'Amount accept Only Numeric Value',
                // 'amount.max' => 'Quantity accept 10 digits',

                // 'total.required' => 'Total Is Required',
                // 'total.regex' => 'Total accept Only Numeric Value',
                // 'total.max' => 'Total accept 10 digits',
            ],
        );

        // $records = json_decode($request->records, true);
        // $records = (array) $request->records;
        // $records = json_decode($request->records, true);
        // dd($records);
        $records = json_decode($request->records, true);
        // dd($records);

        if ($records == null) {
            $request->validate(
                [
                    'type' => 'required|max:50|regex:/^[a-zA-Z\s]+$/i',
                    'description' => 'required|max:50|regex:/^[A-Za-z0-9\s/-]+$/i',
                    'quantity' => 'required|max:6|regex:/^[0-9]+$/i',
                    'amount' => 'required|max:10|regex:/^[0-9]+$/i',
                    'total' => 'required|max:10|regex:/^[0-9]+$/i',
                ],
                [
                    'type.required' => 'Type field is required',
                    'type.regex' => 'Type field accept only alphabet',
                    'type.max' => 'Type field accept only 50 characters.',
                    'quantity.required' => 'Quantity Is Required',
                    'quantity.regex' => 'Quantity accept Only Numeric Value',
                    'quantity.max' => 'Quantity accept 6 digits',
                    'amount.required' => 'Amount Is Required',
                    'amount.regex' => 'Amount accept Only Numeric Value',
                    'amount.max' => 'Amount accept 10 digits',
                    'total.required' => 'Total Is Required',
                    'total.regex' => 'Total accept Only Numeric Value',
                    'total.max' => 'Total accept 10 digits',
                    'description.required' => 'Description Field Is Required.',
                    'description.max' => 'Description field accept only 50 characters.',
                    'description.regex' => 'Description accept Only Alphanumeric,  and Space',
                ],
            );
        }

        // try {

        $vehicleRepairing = new vehicleRepairing();
        $vehicleRepairing->vendor_name = $request->vendor_name;
        $vehicleRepairing->vehicle_reg_id = $request->vehicle_reg_no;
        $vehicleRepairing->date = date('Y-m-d', strtotime(trim(str_replace('/', '-', $request->date))));
        $vehicleRepairing->address = $request->address;
        $vehicleRepairing->grand_total = $request->totalSum;
        if ($vehicleRepairing->save()) {
            foreach ($records as $key => $value) {
                // print_r($value['customer_name']);
                $vehicleRepairingDetails = new vehicleRepairingDetails();
                $vehicleRepairingDetails->vehicle_repairing_code = $vehicleRepairing->code;
                $vehicleRepairingDetails->type = $value['type'];
                $vehicleRepairingDetails->description = $value['description'];
                $vehicleRepairingDetails->quantity = $value['quantity'];
                $vehicleRepairingDetails->amount = $value['amount'];
                $vehicleRepairingDetails->total = $value['total'];
                $vehicleRepairingDetails->save();
            }

            $response = [
                'status' => 1,
            ];
            // }
            // }
            // } catch (\Exception $e) {
            //     // return $response;
            //     $response = [
            //         'exception' => true,
            //         'exception_message' => $e->getMessage(),
            //     ];
            //     $statusCode = 400;
            // } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function vehicle_repairing_list(Request $request)
    {
        return view('backend.vehicle_repairing_list');
    }

    public function show_vehicle_repairing_list(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occered in Json call.'];
            return response()->json($response, $statusCode);
        }

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

        try {
            $draw = $request->draw;
            $length = $request->length;
            $offset = $request->start;
            $search = $request->search['value'];

            //  dd($search);
            $alldetails = [];
            //  echo"<pre>";
            //  print_r($so);
            //  echo"</pre>";
            $show_data = vehicleRepairing::join('tbl_vehicle', 'tbl_vehicle.code', 'tbl_vehicle_repairing.vehicle_reg_id')
                ->select('tbl_vehicle_repairing.code', 'tbl_vehicle_repairing.vendor_name', 'tbl_vehicle_repairing.date', DB::raw("DATE_FORMAT(date,'%d/%m/%Y') AS date"), 'tbl_vehicle.vehicle_reg_no')
                ->orderby('tbl_vehicle_repairing.code', 'desc')
                ->where(function ($q) use ($search) {
                    $q->orwhere('tbl_vehicle_repairing.vendor_name', 'like', '%' . $search . '%');
                    // $q->orwhere('email','like', '%'  .$search . '%');
                });

            // dd($show_data);
            $filtered_count = $show_data->count();
            $record = $show_data;
            $page_displayed = $record
                ->offset($offset)
                ->limit($length)
                ->get();
            $count = $offset + 1;

            foreach ($page_displayed as $item) {
                $data['code'] = $count;
                $data['vendor_name'] = $item->vendor_name;
                $data['vehicle_reg_no'] = $item->vehicle_reg_no;
                $data['date'] = $item->date;
                $data['action'] = "<button type='button' class='btn btn-warning edit_btn' id=" . $item->code . "><i class='fa fa-edit'></i></button>
                 <button type='button' class='btn btn-danger delete_btn'  id=" . $item->code . "><i class='fa fa-trash'></i></button>";
                $count++;
                $alldetails[] = $data;
            }
            $response = [
                'draw' => $draw,
                'recordsTotal' => $filtered_count, //Should be changed #7
                'recordsFiltered' => $filtered_count,
                'record_details' => $alldetails, //Should be changed #8
            ];
            // return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'exception' => true,
                'exception_message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function edit_vehicle_repairing(Request $request)
    {
        $this->validate(
            $request,
            ['code' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );
        //$record = [];
        $edit_table = vehicleRepairingDetails::where('vehicle_repairing_code', '=', $request->code)->get();

        // dd($edit_table);
        // foreach ($edit_table as $item) {
        //     $data['type'] = $item->type;
        //     $data['description'] = $item->description;
        //     $data['quantity'] = $item->quantity;
        //     $data['amount'] = $item->amount;
        //     $record[] = $data;
        // }
        
        $edit_data = vehicleRepairing::join('tbl_vehicle', 'tbl_vehicle.code', 'tbl_vehicle_repairing.vehicle_reg_id')
            ->select('tbl_vehicle_repairing.code', 'tbl_vehicle_repairing.vendor_name', 'tbl_vehicle_repairing.grand_total', 'tbl_vehicle_repairing.vehicle_reg_id', 'tbl_vehicle_repairing.date', DB::raw("DATE_FORMAT(date,'%d/%m/%Y') AS date"))
            ->where('tbl_vehicle_repairing.code', '=', $request->code)
            ->first();
        // dd($edit_data);

        $edit_send = [
            'code' => $edit_data->code,
            'vendor_name' => $edit_data->vendor_name,
            // 'vehicle_reg_no' => $edit_data->vehicle_reg_no,
            'date' => $edit_data->date,
            'vehicle_reg_no' => $edit_data->vehicle_reg_id,
            'grand_total' => $edit_data->grand_total,
            'total' => $edit_data->total,
            // 'record' => $record,
            'edit_table' => $edit_table,
        ];

        // dd($edit_send);
        return view('backend.add_vehicle_repairing')->with('edit_send_data', $edit_send);
    }

    public function update_vehicle_repairing(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occered in Json call.'];
            return response()->json($response, $statusCode);
        }
        $request->validate(
            [
                'vendor_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s-]+$/i',
                'vehicle_reg_no' => 'required|max:50|regex:/^[a-zA-Z0-9\s-]+$/i',
                'date' => 'required|date_format:d/m/Y',
                // 'address' => 'required|max:100|regex:/^[a-zA-Z0-9\s-]+$/i',
                // 'type' => 'required|max:50|regex:/^[a-zA-Z\s]+$/i',
                // 'description'=>'required|max:50|regex:/^[A-Za-z0-9\s/-]+$/i',
                // 'quantity' => 'required|max:6|regex:/^[0-9]+$/i',
                // 'amount' => 'required|max:10|regex:/^[0-9]+$/i',
                // 'total' => 'required|max:10|regex:/^[0-9]+$/i',
            ],
            [
                'vendor_name.required' => 'Vendor Name is required',
                'vendor_name.regex' => 'Vendor Name accept Only Alphanumeric,  and Space',
                'vendor_name.max' => 'Vender Name accept maximum of 50 characters',

                // 'address.required' => 'Address Is Required',
                // 'address.regex' => 'Address accept Only Alphanumeric,  and Space',
                // 'address.max' => 'Address accept maximum of 100 characters',

                'vehicle_reg_no.required' => 'Vehicle registration number is required',
                'vehicle_reg_no.regex' => ' Vehicle Registration number accept Only Alphanumeric,  and Space',
                'vehicle_reg_no.max' => 'Vehicle registration number accept maximum of 50 characters',

                'date.required' => 'Date  is required',
                'date.date_format' => 'Date Format Is Invalid',

                // 'type.required' => 'Type field is required',
                // 'type.regex' => 'Type field accept only alphabet',
                // 'type.max' => 'Type field accept only 50 characters.',

                // 'quantity.required' => 'Quantity Is Required',
                // 'quantity.regex' => 'Quantity accept Only Numeric Value',
                // 'quantity.max' => 'Quantity accept 6 digits',

                // 'amount.required' => 'Amount Is Required',
                // 'amount.regex' => 'Amount accept Only Numeric Value',
                // 'amount.max' => 'Quantity accept 10 digits',

                // 'total.required' => 'Total Is Required',
                // 'total.regex' => 'Total accept Only Numeric Value',
                // 'total.max' => 'Total accept 10 digits',
            ],
        );

        $records = json_decode($request->records, true);

        if ($records == null) {
            $request->validate(
                [
                    'type' => 'required|max:50|regex:/^[a-zA-Z\s]+$/i',
                    'description' => 'required|max:50|regex:/^[A-Za-z0-9\s/-]+$/i',
                    'quantity' => 'required|max:6|regex:/^[0-9]+$/i',
                    'amount' => 'required|max:10|regex:/^[0-9]+$/i',
                    'total' => 'required|max:10|regex:/^[0-9]+$/i',
                ],
                [
                    'type.required' => 'Type field is required',
                    'type.regex' => 'Type field accept only alphabet',
                    'type.max' => 'Type field accept only 50 characters.',
                    'quantity.required' => 'Quantity Is Required',
                    'quantity.regex' => 'Quantity accept Only Numeric Value',
                    'quantity.max' => 'Quantity accept 6 digits',
                    'amount.required' => 'Amount Is Required',
                    'amount.regex' => 'Amount accept Only Numeric Value',
                    'amount.max' => 'Quantity accept 10 digits',
                    'total.required' => 'Total Is Required',
                    'total.regex' => 'Total accept Only Numeric Value',
                    'total.max' => 'Total accept 10 digits',
                    'description.required' => 'Description Field Is Required.',
                    'description.max' => 'Description field accept only 50 characters.',
                ],
            );
        }

        $delete = vehicleRepairingDetails::where('vehicle_repairing_code', $request->code)->delete();
        $code = $request->code;
        $date = date('Y-m-d', strtotime(trim(str_replace('/', '-', $request->date))));
        $vendor_name = $request->vendor_name;
        $registration_id = $request->vehicle_reg_no;
        $date = $date;
        $grand_total = $request->totalSum;

        $result = vehicleRepairing::where('code', '=', $code)->update(['vendor_name' => $vendor_name, 'vehicle_reg_id' => $registration_id, 'date' => $date, 'grand_total' => $grand_total]);

        if ($result) {
            foreach ($records as $key => $value) {
                $vehicleRepairingDetails = new vehicleRepairingDetails();
                $vehicleRepairingDetails->vehicle_repairing_code = $code;
                $vehicleRepairingDetails->type = $value['type'];
                $vehicleRepairingDetails->description = $value['description'];
                $vehicleRepairingDetails->quantity = $value['quantity'];
                $vehicleRepairingDetails->amount = $value['amount'];
                $vehicleRepairingDetails->total = $value['total'];
                $vehicleRepairingDetails->save();
            }
            $response = [
                'status' => 2,
            ];
            return $response;
        }
    }
    public function delete_vehicle_repairing(Request $request)
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
            $vehicleRepairingDetails = vehicleRepairingDetails::where('vehicle_repairing_code', '=', $request->code);
            $vehicleRepairing = vehicleRepairing::where('code', '=', $request->code)->first();

            if ($vehicleRepairingDetails != '' && $vehicleRepairing != '') {
                $RepairingDetails = $vehicleRepairingDetails->delete();
                $Repairing = $vehicleRepairing->delete();
            }
            if ($RepairingDetails && $Repairing) {
                $response = [
                    'status' => 3,
                ];
                // return $response;
            }
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

    public function dropdown_data(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occered in Json call.'];
            return response()->json($response, $statusCode);
        }
        try {
            $vehicle_name = tbl_vehicle::pluck('vehicle_reg_no', 'code');
            // dd($vehicle_name);
            $response = [
                'vehicle_name' => $vehicle_name,
                'status' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'exception' => true,
                'exception_message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }
}
