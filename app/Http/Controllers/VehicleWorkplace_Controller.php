<?php

namespace App\Http\Controllers;

use App\Models\tbl_vehicle;
use App\Models\userVehicle;
use App\Models\tbl_VehicleWorkplace;
use App\Models\tbl_state;
use Illuminate\Http\Request;

class VehicleWorkplace_Controller extends Controller
{
    //
    public function vehicle_workplace_list(Request $request)
    {
        return view('backend.vehicle_workplace_list');
    }

    public function add_vehicle_workplace(Request $request)
    {
        return view('backend.add_vehicle_workplace');
    }

    public function get_state()
    {
        $state_data = tbl_state::pluck('state', 'code');
        if ($state_data) {
            $response = $state_data;
            return $response;
        }
    }

    public function get_vehicle_serial_no()
    {
        $data = tbl_vehicle::pluck('vehicle_serial_no', 'code')->all();

        if ($data) {
            $response = $data;
            return $response;
        }
    }

    public function get_operator()
    {
        $data = userVehicle::where('type', '=', 'vehicle operator')->pluck('name', 'code');
        // dd($data);

        if ($data) {
            $response = $data;
            return $response;
        }
    }

    public function save_vehicle_workplace(Request $request)
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
                'vehicle_serial_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'state' => 'required|regex:/^[a-zA-Z0-9\s]+$/i',
                'district' => 'required|regex:/^[a-zA-Z0-9\s\.-]+$/i',
                'address' => 'required|regex:/^[a-zA-Z0-9\s\/,.-]+$/i',
                'operator' => 'required|regex:/^[a-zA-Z0-9\s.]+$/i',
            ],
            [
                'vehicle_serial_no.required' => 'Vehicle serial number is required',
                'vehicle_serial_no.regex' => 'Only alphanumeric value, Space, - and . Allowed Here',
                'vehicle_serial_no.max' => 'Vehicle serial number accept only 100 characters.',

                'state.required' => 'State name is required',
                'state.regex' => 'State name accept Only Alphabate and Space',

                'district.required' => 'District name is required',
                'district.regex' => 'District name accept Only Alphabate and Space',

                'address.required' => 'Address is required',
                'address.regex' => 'Address accept Only alphanumeric,/,-, . , and Space',

                'operator.required' => 'Operator is required',
                'operator.regex' => 'Operator accept Only Alphabate, . , and Space',
            ],
        );
        try {
            $vehicle_workplace = new tbl_VehicleWorkplace();
            $vehicle_workplace->vehicle_serial_no = $request->vehicle_serial_no;
            $vehicle_workplace->state = $request->state;
            $vehicle_workplace->district = $request->district;
            $vehicle_workplace->address = $request->address;
            $vehicle_workplace->operator = $request->operator;

            if ($vehicle_workplace->save()) {
                $response = ['status' => 1];
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

    public function show_vehicle_workplace_list(Request $request)
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
            $users = tbl_VehicleWorkplace::join('tbl_vehicle', 'tbl_VehicleWorkplace.vehicle_serial_no', 'tbl_vehicle.code')
                ->join('tbl_state', 'tbl_VehicleWorkplace.state', 'tbl_state.code')

                ->join('user_vehicle', 'tbl_VehicleWorkplace.operator', 'user_vehicle.code')
                ->select('tbl_VehicleWorkplace.*', 'tbl_state.state', 'user_vehicle.name', 'tbl_vehicle.vehicle_serial_no')
                ->orderby('code', 'desc')
                ->where(function ($q) use ($search) {
                    $q->orwhere('name', 'like', '%' . $search . '%');
                });

            $filtered_count = $users->count();
            // dd($filtered_count);
            $record = $users;
            // dd($record);
            // $filtered_count = $users->count();
            $page_displayed = $record
                ->offset($offset)
                ->limit($length)
                ->get();
            $count = $offset + 1;
            foreach ($page_displayed as $user) {
                $nestedData['code'] = $count;
                $nestedData['vehicle_serial_no'] = $user->vehicle_serial_no;
                $nestedData['state'] = $user->state;
                $nestedData['district'] = $user->district;
                $nestedData['address'] = $user->address;
                $nestedData['operator'] = $user->name;
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
    public function edit_vehicle_workplace(Request $request)
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
        $edit_data = tbl_VehicleWorkplace::select('*')
            ->where('code', '=', $request->code)
            ->first();
        return view('backend.add_vehicle_workplace')->with('edit', $edit_data);
    }

    public function update_vehicle_workplace(Request $request)
    {
        //  dd($request->all());

        $this->validate(
            $request,
            [
                'vehicle_serial_no' => 'required|max:100|regex:/^[a-zA-Z0-9\s.-]+$/i',
                'state' => 'required|regex:/^[a-zA-Z0-9\s]+$/i',
                'district' => 'required|regex:/^[a-zA-Z0-9\s\.-]+$/i',
                'address' => 'required|regex:/^[a-zA-Z0-9\s\/,.-]+$/i',
                'operator' => 'required|regex:/^[a-zA-Z0-9\s.]+$/i',
            ],
            [
                'vehicle_serial_no.required' => 'Vehicle serial number is required',
                'vehicle_serial_no.regex' => 'Only alphanumeric value, Space, - and . Allowed Here',
                'vehicle_serial_no.max' => 'Vehicle serial number accept only 100 characters.',
                'state.required' => 'State name is required',
                'state.regex' => 'State name accept Only Alphabate and Space',
                'district.required' => 'District name is required',
                'district.regex' => 'District name accept Only Alphabate and Space',
                'address.required' => 'Address is required',
                'address.regex' => 'Address accept Only alphanumeric,/,-, . , and Space',
                'operator.required' => 'Operator is required',
                'operator.regex' => 'Operator accept Only Alphabate, . , and Space',
            ],
        );

        $code = $request->code;
        $vehicle_serial_no = $request->vehicle_serial_no;
        $state = $request->state;
        $district = $request->district;
        $address = $request->address;
        $operator = $request->operator;

        $update = tbl_VehicleWorkplace::where('code', $code)->update([
            'vehicle_serial_no' => $vehicle_serial_no,
            'state' => $state,
            'district' => $district,
            'address' => $address,
            'operator' => $operator,
        ]);

        if ($update) {
            $response = ['status' => 2];
            return $response;
        }
    }

    public function delete_vehicle_workplace(Request $request)
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
            $delete_data = tbl_VehicleWorkplace::where('code', '=', $request->code);
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
