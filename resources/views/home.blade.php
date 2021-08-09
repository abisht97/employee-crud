@extends('layout.default') 
@section('title', 'Manage Users')
@section('content')
<div class="row mt-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="text-primary">Employee Management (Total : {{$total ?? 0}})</h4>
        </div>
        <div>
        	<a class="btn btn-warning" href="{{ route('role.index') }}">Roles</a>
            <a class="btn btn-primary" href="{{ route('employee.create') }}">Add Employee</a>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-mail</th>
                        <th>DOB</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    	<tr>
                    		<td>{{ $employee->id }}</td>
                    		<td>{{ $employee->first_name ?? '' }}</td>
                    		<td>{{ $employee->last_name ?? '' }}</td>
                    		<td>{{ $employee->email ?? '' }}</td>
                    		<td>{{ $employee->dob ?? '' }}</td>
                    		<td>
                    			<a href="{{ url()->signedRoute('employee.show', $employee->id) }}" class="btn btn-primary">Edit</a>

                    			{!! deleteButtonModal($employee->id,'Delete') !!}
                                {!! deleteModalPost(route("employee.destroy", $employee->id),$employee->id) !!}
                    		</td>
                    	</tr>
                    @empty
                        <tr>
                            <td colspan="7">No Employee Added Yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="float-end">
        	{{ $employees->links() }}
        </div>
    </div>
</div>
</body>

@endsection