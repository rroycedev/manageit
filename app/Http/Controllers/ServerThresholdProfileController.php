<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ServerThresholdProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serverthresholdprofiles = DB::table('threshold_profiles')
            ->orderBy('profile_name', 'asc')
            ->get();

        return view('serverthresholdprofiles', ["profiles" => $serverthresholdprofiles]);
    }

    private function makeValidator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60',
            'description' => 'required|max:60',
            'warninglevel' => 'required|numeric',
            'errorlevel' => 'required|numeric',
        ]);

        return $validator;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('serverthresholdprofiles.add');
    }
    public function insert(Request $request)
    {
        $params = $request->all();

        if (array_key_exists("donebtn", $params)) {
            return redirect('serverthresholdprofiles');
        }

        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $warning = $request->input('warninglevel');
        $error = $request->input('errorlevel');

        $validator = $this->makeValidator($request);

        if ($validator->fails()) {
            return redirect('serverthresholdprofiles/add')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $profiles = DB::table('threshold_profiles')
                ->select('*')
                ->where(array('profile_name' => $name))
                ->get();

            if (count($profiles) > 0) {
                $validator->errors()->add('name', 'Profile already exists with that name');
                return redirect('serverthresholdprofiles/add')
                    ->withErrors($validator)
                    ->withInput();
            }
        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles/add')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::table('threshold_profiles')->insert(
                ['profile_name' => $name, "description" => $description, "profile_type" => $type, "warning_level" => $warning, "error_level" => $error]

            );
            return redirect()->back()->with('message', 'Threshold profile was added successfully');
        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles/add')
                ->withErrors($validator)
                ->withInput();
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        $profileId = $request->route('profileid');

        $validator = Validator::make($request->all(), [
        ]);

        try {
            $profiles = DB::table('threshold_profiles')
                ->select('*')
                ->where(array('profile_id' => $profileId))
                ->get();

        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles')
                ->withErrors($validator)
                ->withInput();
        }

        $profile = $profiles[0];

        return view('serverthresholdprofiles.change', ["profile" => $profile]);
    }

    public function update(Request $request)
    {
        $params = $request->all();

        if (array_key_exists("cancelbtn", $params)) {
            return redirect('serverthresholdprofiles');
        }

        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $warning = $request->input('warninglevel');
        $error = $request->input('errorlevel');

        $profileId = $request->input('profile_id');

        $validator = $this->makeValidator($request);

        if ($validator->fails()) {
            return redirect('serverthresholdprofiles/change/' . $profileId)
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $profiles = DB::table('threshold_profiles')
                ->select('*')
                ->where(array('profile_name' => $name))
                ->get();

        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles/change/' . $profileId)
                ->withErrors($validator)
                ->withInput();
        }

        if (count($profiles) > 0) {
            if ($profiles[0]->profile_id != $profileId) {
                $validator->errors()->add('name', 'Server group already exists with that name');
                return redirect('serverthresholdprofiles/change/' . $profileId)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        try {
            DB::table('threshold_profiles')->where('profile_id', $profileId)
                ->update(['profile_name' => $name, "description" => $description, "profile_type" => $type, "warning_level" => $warning, "error_level" => $error]
                );
            return redirect('serverthresholdprofiles')->with('message', 'Threshold profile was updated successfully');
        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles/change/' . $profileId)
                ->withErrors($validator)
                ->withInput();
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $profileId = $request->route('profileid');

        $validator = Validator::make($request->all(), [
        ]);

        try {
            $profiles = DB::table('threshold_profiles')
                ->select('*')
                ->where(array('profile_id' => $profileId))
                ->get();

        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles')
                ->withErrors($validator)
                ->withInput();
        }

        $profile = $profiles[0];

        return view('serverthresholdprofiles.delete', ["profile" => $profile]);
    }

    public function remove(Request $request)
    {
        $params = $request->all();

        if (array_key_exists("cancelbtn", $params)) {
            return redirect('serverthresholdprofiles');
        }

        $profileId = $request->input("profile_id");

        $validator = Validator::make($request->all(), [
        ]);

        try {
            DB::table('threshold_profiles')->where('profile_id', "=", $profileId)
                ->delete();
        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles/delete/' . $profileId)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::table('threshold_profiles')->where('profile_id', "=", $profileId)
                ->delete();
            return redirect('serverthresholdprofiles')->with('message', 'Threshold profile was deleted successfully');
        } catch (\Exception $ex) {
            $validator->errors()->add('insert', $ex->getMessage());
            return redirect('serverthresholdprofiles/delete/' . $profileId)
                ->withErrors($validator)
                ->withInput();
        }
    }
}