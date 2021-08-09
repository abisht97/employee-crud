@extends('layout.default') 
@section('content')
<div class="row mt-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="text-primary">Role Management (Total : {{count($roles) ?? 0}})</h4>
        </div>
        <div>
        	<a class="btn btn-warning" href="{{ route('index') }}">Employees</a>
            <a class="ajax btn btn-primary" data-url="{{ route('role.create') }}">Add Role</a>
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
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                    	<tr>
                    		<td>{{ $role->id }}</td>
                    		<td>{{ $role->name ?? '' }}</td>
                    		<td>
                    			<a class="ajax btn btn-primary" data-url="{{ route('role.edit', $role->id) }}">Edit</a>

                    			{!! deleteButtonModal($role->id,'Delete') !!}
                                {!! deleteModalPost(route("role.destroy", $role->id),$role->id) !!}
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
    </div>
</div>
</body>

@endsection