<?php

namespace App\Http\Controllers;

use App\Models\tbl_vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    //
    public function vehicle_details_list(Request $request)
    {
        return view('backend.vehicle_details_list');
    }

    public function add_vehicle(Request $request)
    {
        return view('backend.add_vehicle');
    }

    public function save_vehicle(Request $request)
    {
        //   dd($request->all());
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occured in form submit.'];
            return response()->json($response, $statusCode);
        }

        $this->validate(
            $request,
            [
                'owner_name' => 'required|max:100|regex:/^[a-zA-Z\s.]+$/i',
                'vehicle_model_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s-]+$/i',
                'vehicle_reg_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s\-.]+$/i',
                'vehicle_purchase_date' => 'required|date_format:d/m/Y',
                'vehicle_reg_date' => 'required|date_format:d/m/Y',
                'reg_authority' => 'required|max:100|regex:/^[a-zA-Z0-9\s\/.-]+$/i',
                'vehicle_type' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'fuel_type' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'engine_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'chassis_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'vehicle_serial_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
            ],
            [
                'owner_name.required' => 'Name is required',
                'owner_name.regex' => 'Name accept Only Alphabate . and Space',
                'owner_name.max' => 'Name accept maximum of 100 characters',

                'vehicle_model_no.required' => 'Vehicle model number is required',
                'vehicle_model_no.regex' => 'Model number accept Only Alphabate . and Space',
                'vehicle_model_no.max' => 'Vehicle model number accept maximum of 100 characters',

                'vehicle_reg_no.required' => 'Vehicle registration number is required',
                'vehicle_reg_no.regex' => 'Registration number accept Only Alphabate . and Space',
                'vehicle_reg_no.max' => 'Vehicle registration number accept maximum of 100 characters',

                'vehicle_purchase_date.required' => 'Purchase Date  is required',
                'vehicle_purchase_date.date_format' => 'Date Format Is Invalid',

                'vehicle_reg_date.required' => 'Registration Date  is required.',
                'vehicle_reg_date.date_format' => 'Date Format Is Invalid',

                'reg_authority.required' => 'Registration authority is required',
                'reg_authority.regex' => 'Registration authority accept Only Alphabate .  and Space',
                'reg_authority.max' => 'Registration authority accept maximum of 100 characters',

                'vehicle_type.required' => 'Vehicle type  is required',
                'vehicle_type.regex' => 'Vehicle type accept Only Alphabate . and Space',
                'vehicle_type.max' => 'Vehicle type accept maximum of 100 characters',

                'fuel_type.required' => 'Fuel type is required',
                'fuel_type.regex' => 'Fuel type accept Only Alphabate, . , and Space',
                'fuel_type.max' => 'Fuel type accept maximum of 100 characters',

                'engine_no.required' => 'Engine number is required',
                'engine_no.regex' => 'Engine number accept Only Alphabate . and Space',
                'engine_no.max' => 'Engine number accept maximum of 100 characters',

                'chassis_no.required' => 'Chassis number is required',
                'chassis_no.regex' => 'Only alphanumeric value, Space, - and . Allowed Here',
                'chassis_no.max' => 'Chassis number accept maximum of 100 characters',

                'vehicle_serial_no.required' => 'Vehicle serial number is required',
                'vehicle_serial_no.regex' => 'Only alphanumeric value, Space, - and . Allowed Here',
                'vehicle_serial_no.max' => 'Vehicle serial number accept maximum of 100 characters',
            ],
        );
        try {
            $vehicle_data = new tbl_vehicle();
            $vehicle_data->owner_name = $request->owner_name;
            $vehicle_data->vehicle_model_no = $request->vehicle_model_no;
            $vehicle_data->vehicle_reg_no = $request->vehicle_reg_no;
            $vehicle_purchase_date = date('Y-m-d', strtotime(trim(str_replace('/', '-', $request->vehicle_purchase_date))));
            $vehicle_data->vehicle_purchase_date = $vehicle_purchase_date;
            $vehicle_reg_date = date('Y-m-d', strtotime(trim(str_replace('/', '-', $request->vehicle_reg_date))));
            $vehicle_data->vehicle_reg_date = $vehicle_reg_date;
            $vehicle_data->reg_authority = $request->reg_authority;
            $vehicle_data->vehicle_type = $request->vehicle_type;
            $vehicle_data->fuel_type = $request->fuel_type;
            $vehicle_data->engine_no = $request->engine_no;
            $vehicle_data->chassis_no = $request->chassis_no;
            $vehicle_data->vehicle_serial_no = $request->vehicle_serial_no;

            if ($vehicle_data->save()) {
                $response = [
                    'status' => 1,
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
            return response()->json($response, $statusCode);
        }
    }

    public function show_vehicle_list(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occured in form submit.'];
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
            $offset = $request->start;
            $length = $request->length;
            $search = $request->search['value'];

            $data = [];
            $users = tbl_vehicle::select('*')
                ->orderby('code', 'desc')
                ->where(function ($q) use ($search) {
                    $q->orwhere('owner_name', 'like', '%' . $search . '%');
                });

            $filtered_count = $users->count();
            $record = $users;
            $filtered_count = $users->count();
            $page_displayed = $record
                ->offset($offset)
                ->limit($length)
                ->get();
            $count = $offset + 1;
            foreach ($page_displayed as $user) {
                $nestedData['code'] = $count;
                $nestedData['owner_name'] = $user->owner_name;
                $nestedData['vehicle_model_no'] = $user->vehicle_model_no;
                $nestedData['vehicle_reg_no'] = $user->vehicle_reg_no;
                $nestedData['vehicle_purchase_date'] = date('d/m/Y', strtotime($user->vehicle_purchase_date));
                $nestedData['vehicle_reg_date'] = date('d/m/Y', strtotime($user->vehicle_reg_date));
                $nestedData['reg_authority'] = $user->reg_authority;
                $nestedData['vehicle_type'] = $user->vehicle_type;
                $nestedData['fuel_type'] = $user->fuel_type;
                $nestedData['engine_no'] = $user->engine_no;
                $nestedData['chassis_no'] = $user->chassis_no;
                $nestedData['vehicle_serial_no'] = $user->vehicle_serial_no;

                $edit_button = $delete_button = $user->code;
                $nestedData['action'] = ['e' => $edit_button, 'd' => $delete_button];
                $count++;
                $data[] = $nestedData;
            }

            $response = [
                'draw' => $draw,
                'recordsTotal' => $filtered_count,
                'recordsFiltered' => $filtered_count,
                'record_details' => $data,
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

    public function edit_vehicle(Request $request)
    {
        // dd($request->all());
        $this->validate(
            $request,
            ['code' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );
        $edit_data = tbl_vehicle::select('*', DB::raw("DATE_FORMAT(tbl_vehicle.vehicle_purchase_date,'%d/%m/%Y') AS parches_date"), DB::raw("DATE_FORMAT(tbl_vehicle.vehicle_reg_date,'%d/%m/%Y') AS reg_date"))
            ->where('code', '=', $request->code)
            ->first();
        // dd($edit_data);
        return view('backend.add_vehicle')->with('edit', $edit_data);
    }

    public function update_vehicle(Request $request)
    {
        //  dd($request->all());

        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occured in form submit.'];
            return response()->json($response, $statusCode);
        }

        $this->validate(
            $request,
            [
                'owner_name' => 'required|max:100|regex:/^[a-zA-Z\s.]+$/i',
                'vehicle_model_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s-]+$/i',
                'vehicle_reg_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s\-.]+$/i',
                'vehicle_purchase_date' => 'required|date_format:d/m/Y',
                'vehicle_reg_date' => 'required|date_format:d/m/Y',
                'reg_authority' => 'required|max:100|regex:/^[a-zA-Z0-9\s\/.-]+$/i',
                'vehicle_type' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'fuel_type' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'engine_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'chassis_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'vehicle_serial_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
            ],
            [
                'owner_name.required' => 'Name is required',
                'owner_name.regex' => 'Name accept Only Alphabate, . , and Space',
                'owner_name.max' => 'Name accept maximum of 100 characters',

                'vehicle_model_no.required' => 'Vehicle model number is required',
                'vehicle_model_no.regex' => 'Model number accept Only Alphabate, . , and Space',
                'vehicle_model_no.max' => 'Vehicle model number accept maximum of 100 characters',

                'vehicle_reg_no.required' => 'Vehicle registration number is required',
                'vehicle_reg_no.regex' => 'Registration number accept Only Alphabate, . , and Space',
                'vehicle_reg_no.max' => 'Vehicle registration number accept maximum of 100 characters',

                'vehicle_purchase_date.required' => 'Purchase Date  is required',
                'vehicle_purchase_date.date_format' => 'Date Format Is Invalid',

                'vehicle_reg_date.required' => 'Registration Date  is required.',
                'vehicle_reg_date.date_format' => 'Date Format Is Invalid',

                'reg_authority.required' => 'Registration authority is required',
                'reg_authority.regex' => 'Registration authority accept Only Alphabate, . , and Space',
                'reg_authority.max' => 'Registration authority accept maximum of 100 characters',

                'vehicle_type.required' => 'Vehicle type  is required',
                'vehicle_type.regex' => 'Vehicle type accept Only Alphabate, . , and Space',
                'vehicle_type.max' => 'Vehicle type accept maximum of 100 characters',

                'fuel_type.required' => 'Fuel type is required',
                'fuel_type.regex' => 'Fuel type accept Only Alphabate, . , and Space',
                'fuel_type.max' => 'Fuel type accept maximum of 100 characters',

                'engine_no.required' => 'Engine number is required',
                'engine_no.regex' => 'Engine number accept Only Alphabate, . , and Space',
                'engine_no.max' => 'Engine number accept maximum of 100 characters',

                'chassis_no.required' => 'Chassis number is required',
                'chassis_no.regex' => 'Only alphanumeric vlue, Space, - and . Allowed Here',
                'chassis_no.max' => 'Chassis number accept maximum of 100 characters',

                'vehicle_serial_no.required' => 'Vehicle serial number is required',
                'vehicle_serial_no.regex' => 'Only alphanumeric vlue, Space, - and . Allowed Here',
                'vehicle_serial_no.max' => 'Vehicle serial number accept maximum of 100 characters',
            ],
        );

        try {
            $code = $request->code;
            $owner_name = $request->owner_name;
            $vehicle_model_no = $request->vehicle_model_no;
            $vehicle_reg_no = $request->vehicle_reg_no;
            $vehicle_purchase_date = date('Y-m-d', strtotime(trim(str_replace('/', '-', $request->vehicle_purchase_date))));
            $vehicle_reg_date = date('Y-m-d', strtotime(trim(str_replace('/', '-', $request->vehicle_reg_date))));
            $reg_authority = $request->reg_authority;
            $vehicle_type = $request->vehicle_type;
            $fuel_type = $request->fuel_type;
            $engine_no = $request->engine_no;
            $chassis_no = $request->chassis_no;
            $vehicle_serial_no = $request->vehicle_serial_no;

            $update = tbl_vehicle::where('code', $code)->update([
                'owner_name' => $owner_name,
                'vehicle_model_no' => $vehicle_model_no,
                'vehicle_reg_no' => $vehicle_reg_no,
                'vehicle_purchase_date' => $vehicle_purchase_date,
                'vehicle_reg_date' => $vehicle_reg_date,
                'reg_authority' => $reg_authority,
                'vehicle_type' => $vehicle_type,
                'fuel_type' => $fuel_type,
                'engine_no' => $engine_no,
                'chassis_no' => $chassis_no,
                'vehicle_serial_no' => $vehicle_serial_no,
            ]);

            if ($update) {
                $response = ['status' => 2];
                // return $response;
            }
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

    public function delete_vehicle(Request $request)
    {
        // dd($request->all());
        $this->validate(
            $request,
            ['code' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );
        try {
            $delete_data = tbl_vehicle::where('code', '=', $request->code);

            if (!empty($delete_data)) {
                $delete_data = $delete_data->delete();
            }

            if ($delete_data) {
                $response = ['status' => 3];
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
}
