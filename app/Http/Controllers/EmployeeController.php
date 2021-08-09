<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;
use Storage;
use Exception;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$roles = Role::get(['name', 'id']);
        return view('employee.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'firstName' => 'required',
        	'lastName' => 'required',
        	'email' => 'required|email',
        	'dob' => 'required|date',
        	'profileImage' => 'required|file|image',
        	'currentAddress' => 'required',
        	'permanentAddress' => 'required',
        ]);

        try {
        	DB::beginTransaction();

	        $employee = new Employee;
	        $employee->first_name = $request->firstName ?? '';
	        $employee->last_name = $request->lastName ?? '';
	        $employee->email = $request->email ?? '';
	        $employee->dob = $request->dob ?? '';
	        $employee->current_address = $request->currentAddress ?? '';
	        $employee->permanent_address = $request->permanentAddress ?? '';

	        if ($request->hasFile('profileImage')) {
	            $image = $request->file('profileImage');
	            $fileName = time() . '.' . $image->getClientOriginalExtension();

	            $filePath = 'images/employee/profile';
	            $fileUri = Storage::disk('public')->putFileAs($filePath, $image, $fileName, 'public');
	            
	            if(empty($fileUri)){
	            	throw new Exception("Error occurred while uploading profile image");
	            }
	            $employee->profile_image = $fileUri ?? '';
			}

			$employee->save();

			if(count($request->employee_roles ?? []) > 0){
				$this->assignRoles($employee->id, $request->employee_roles);
			}

			DB::commit();
	        return redirect()->route('index')->with('success', 'Employee successfully added!');
        } catch (Exception $e) {
        	DB::rollback();
        	return back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $roles = Role::get(['name', 'id']);
        $employee_roles = DB::table('employee_roles')->where('employee_id', $id)->pluck('role_id')->toArray();
        return view('employee.show', compact('employee', 'roles', 'employee_roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $this->validate($request, [
        	'firstName' => 'required',
        	'lastName' => 'required',
        	'email' => 'required|email',
        	'dob' => 'required|date',
        	'profileImage' => 'nullable|file|image',
        	'currentAddress' => 'required',
        	'permanentAddress' => 'required',
        ]);

        try {
        	DB::beginTransaction();

	        $employee->first_name = $request->firstName ?? '';
	        $employee->last_name = $request->lastName ?? '';
	        $employee->email = $request->email ?? '';
	        $employee->dob = $request->dob ?? '';
	        $employee->current_address = $request->currentAddress ?? '';
	        $employee->permanent_address = $request->permanentAddress ?? '';

	        if ($request->hasFile('profileImage')) {
	            $image = $request->file('profileImage');
	            $fileName = time() . '.' . $image->getClientOriginalExtension();

	            $filePath = 'images/employee/profile';
	            $fileUri = Storage::disk('public')->putFileAs($filePath, $image, $fileName, 'public');
	            
	            if(empty($fileUri)){
	            	throw new Exception("Error occurred while uploading profile image");
	            }
	            $employee->profile_image = $fileUri ?? '';
			}

			$employee->save();

			if(count($request->employee_roles ?? []) == 0) {
				DB::table('employee_roles')->where('employee_id', $id)->delete();
			}else{
				$assigned_roles = DB::table('employee_roles')->where('employee_id', $id)->pluck('role_id')->toArray();
				$new_roles = array_diff($request->employee_roles, $assigned_roles);
				$this->assignRoles($employee->id, $new_roles);

				$unassigned_roles = array_diff($assigned_roles, $request->employee_roles);
				$this->unassignRoles($employee->id, $unassigned_roles);
			}

			DB::commit();
	        return redirect()->route('index')->with('success', 'Employee detail successfully updated!');
        } catch (Exception $e) {
        	DB::rollback();
        	return back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        DB::table('employee_roles')->where('employee_id', $uid)->delete();
        
        return back()->with('success', 'Employee record successfully deleted!');
    }

    protected function assignRoles($uid, $roles){
    	$data = [];
    	foreach($roles as $role){
    		$data['employee_id'] = $uid;
    		$data['role_id'] = $role;
    	}
    	DB::table('employee_roles')->insert($data);
    }

    protected function unassignRoles($uid, $roles){
    	DB::table('employee_roles')->where('employee_id', $uid)->whereIn('role_id', $roles)->delete();
    }
}
