<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userVehicle;
class UserVehicleController extends Controller
{
    public function add_user_vehicle()
    {
        return view('add_user_vehicle');
    }

    public function add_user_vehicle_save(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occered in Json call.'];
            return response()->json($response, $statusCode);
        }
        $request->validate(
            [
                'name' => 'required|regex:/^[A-Za-z\s]+$/i|min:2|max:30',
                'mobile_id' => 'required|min:10|max:10|regex: /^[0-9]+$/',
                'User_name_id' => 'required|min:6|max:30|regex:/^[A-Za-z\s0-9@]+$/i',
                // 'password_id' => 'required|min:6|max:30|regex:/^[A-Za-z.\s0-9]+$/i',
                'password_id' => ['required', 'string', 'min:8', 'max:30', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[@$!%*#?&]/', 'regex:/[0-9]/'],
                'type' => 'required|regex:/^[a-zA-Z\s]+$/i',
            ],
            [
                'name.required' => 'Name Is required',
                'name.regex' => 'Name must be Allowed Alpha with space.',
                'name.min' => 'Name is Required Minium 2 Character',
                'name.max' => 'Name is Required Maxium 30 Character',

                'mobile_id.required' => 'Mobile number is required and cannot be empty.',
                'mobile_id.min' => 'Mobile number must be 10 digit',
                'mobile_id.regex' => 'Mobile Number allow only numerical value.',

                'User_name_id.required' => 'User Name Is Required and cannot be empty',
                'User_name_id.regex' => 'User Name Only Alphanumeric and @  Allowed Here',
                'User_name_id.min' => 'User Name is Required Minium 6 Character',
                'User_name_id.max' => 'User Name is Required Maxium 30 Character',

                'password_id.required' => 'Password is required and cannot be empty.',
                'password_id.min' => 'Password must be 8 digit  or character',
                'password_id.max' => 'Password must be 30 digit  or character',
                'password_id.regex' => 'Password required at least one uppercase letter,one lowercase letter,a special character,at least one digit',

                'type.required' => 'Type field is required',
                'type.regex' => 'Type field accept only alphabet',
                'type.max' => 'Type field accept only 100 characters.',
            ],
        );
        try {
            $usersave = new userVehicle();
            $usersave->name = $request->name;
            $usersave->mobile_no = $request->mobile_id;
            $usersave->user_name = $request->User_name_id;
            // $usersave->password = md5($request->password_id);
            $usersave->password = $request->password_id;
            $usersave->type = $request->type;
            if ($usersave->save()) {
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

    public function user_list()
    {
        return view('user_list');
    }

    public function user_list_view(Request $request)
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
            $offset = $request->start;
            $length = $request->length;
            $search = $request->search['value'];
            $data = [];
            $allrecord = [];
            $dep_data = userVehicle::select('*')
                ->orderby('code', 'desc')
                ->where(function ($q) use ($search) {
                    $q->orwhere('name', 'like', '%' . $search . '%');
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
                $data['type'] = $user->type;
                $data['name'] = $user->name;
                $data['mobile_no'] = $user->mobile_no;
                $data['user_name'] = $user->user_name;
                // $data['date'] = $user->date;
                //    dd($photo_name);
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
        } catch (\Exception $e) {
            $response = [
                'exception' => true,
                'exception_message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
        // return response()->json($response);
    }
    public function user_delete(Request $request)
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
            $delete = userVehicle::where('code', '=', $request->code)->delete();

            if ($delete) {
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
    public function user_edit_data(Request $request)
    {
        // dd($req->all());

        $this->validate(
            $request,
            ['code' => "required|regex:/^[0-9]+$/i"],
            [
                'code.required' => 'Code filed is required',
                'code.regex' => 'This field accept only numbers',
            ],
        );
        $edit_data = userVehicle::select('*')
            ->where('code', '=', $request->code)
            ->first();
        // dd($edit_data);
        $send_data = [
            'code' => $edit_data->code,
            'type' => $edit_data->type,
            'name' => $edit_data->name,
            'mobile_no' => $edit_data->mobile_no,
        ];
        return view('add_user_vehicle')->with('send_data', $send_data);
    }
    public function user_update_data(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = ['error' => 'Error occered in Json call.'];
            return response()->json($response, $statusCode);
        }
        $request->validate(
            [
                'name' => 'required|regex:/^[A-Za-z\s]+$/i|min:2|max:30',
                'mobile_id' => 'required|min:10|max:10|regex: /^[0-9]+$/',
                'type' => 'required|regex:/^[a-zA-Z\s]+$/i',
            ],

            [
                'name.required' => 'Name Is required',
                'name.regex' => ' Name must be Allowed Alpha with space.',
                'name.min' => 'Name is Required Minium 2 Character',
                'name.max' => 'Name is Required Maxium 30 Character',

                'mobile_id.required' => 'The Mobile number is required and cannot be empty.',
                'mobile_id.min' => 'Mobile number must be 10 digit',
                'mobile_id.regex' => 'Mobile Number allow only numerical value.',
                'type.required' => 'Type field is required',
                'type.regex' => 'Type field accept only alphabet',
                'type.max' => 'Type field accept only 100 characters.',
            ],
        );
        try {
            $code = $request->code;
            $name = $request->name;
            $mobile_id = $request->mobile_id;
            $type = $request->type;
            $result = userVehicle::where('code', '=', $code)->update(['name' => $name, 'mobile_no' => $mobile_id, 'type' => $type]);

            if ($result) {
                $response = [
                    'status' => 2,
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
}
