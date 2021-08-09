@extends('layout.default') 
@section('title', 'Manage Users')
@section('content')
<div class="row mt-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="text-primary">Employee Management / View</h4>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('index') }}">Go to List</a>
        </div>
    </div>
</div>
<hr>

<div class=" rounded bg-white">
    <form class="row g-3" action="{{ route('employee.update', $employee->id) }}" method="POST" enctype='multipart/form-data'>
    @csrf
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3">
                <img class="rounded-circle mt-5" width="150px" src="{{asset('storage/'.$employee->profile_image ?? '')}}">
                <span class="font-weight-bold">{{$employee->first_name ?? ''}}</span>
                <span class="text-black-50">{{$employee->email ?? ''}}</span><span> </span>
            </div>
        </div>
        <div class="col-md-7 border-right">
            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                    <input type="hidden" name="_method" value="PUT">

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name*</label>
                            <input type="text" value="{{ old('firstName', $employee->first_name ?? null) }}" name="firstName" class="form-control" id="firstName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name*</label>
                            <input type="text" value="{{ old('lastName', $employee->last_name ?? null) }}" name="lastName" class="form-control" id="lastName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" value="{{ old('email', $employee->email ?? null) }}" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date Of Birth*</label>
                            <input type="date" value="{{ old('dob', $employee->dob ?? null) }}" name="dob" class="form-control" id="dob" required>
                        </div>
                        <div class="col-md-6">
                            <label for="profileImage" class="form-label">Profile Image(optional)</label>
                            <input type="file" name="profileImage" class="form-control" id="profileImage" accept="image/png, image/gif, image/jpeg">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <label for="currentAddress" class="form-label">Current Address*</label>
                            <input type="text" value="{{ old('currentAddress', $employee->current_address ?? null) }}" name="currentAddress" class="form-control" id="currentAddress" placeholder="Building, Sector, City, State" required>
                        </div>
                        <div class="col-12">
                            <label for="permanentAddress" class="form-label">Permanent Address*</label>
                            <input type="text" value="{{ old('permanentAddress', $employee->permanent_address ?? null) }}" name="permanentAddress" class="form-control" id="permanentAddress" placeholder="Building, Sector, City, State" required>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        <a href="{{ route('index') }}" class="btn btn-danger">Cancel</a>
                    </div>
            </div>
        </div>
        <div class="col-md-2">
        	<div class="py-3">
	        	<h4>Assign Role(optional)</h4>
				<div class="form-group">
		            @foreach ($roles as $role)
		                <input name="employee_roles[]" type="checkbox" value="{{ $role->id }}" {{ in_array($role->id, old('employee_roles', $employee_roles)) ? 'checked' : '' }}>
		                <label for="{{$role->name}}"> {{ucfirst($role->name)}}</label>
		                <br>
		            @endforeach
		        </div>
        	</div>
        </div>
    </div>
    </form>
</div>
</div>
</div>

</body>

@endsection

@section('footer_js')

@endsection