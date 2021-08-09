@extends('layout.default') 
@section('title', 'Manage Users')
@section('content')
<div class="row mt-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="text-primary">Employee Management / Create</h4>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('index') }}">Go to List</a>
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-lg-12">
        <form class="row g-3" action="{{ route('employee.store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="col-md-6">
                <label for="firstName" class="form-label">First Name*</label>
                <input type="text" value="{{ old('firstName', null) }}" name="firstName" class="form-control" id="firstName" required>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name*</label>
                <input type="text" value="{{ old('lastName', null) }}" name="lastName" class="form-control" id="lastName" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email*</label>
                <input type="email" value="{{ old('email', null) }}" name="email" class="form-control" id="email" required>
            </div>
            <div class="col-md-6">
                <label for="dob" class="form-label">Date Of Birth*</label>
                <input type="date" value="{{ old('dob', null) }}" name="dob" class="form-control" id="dob" required>
            </div>
            <div class="col-md-6">
                <label for="profileImage" class="form-label">Profile Image*</label>
                <input type="file" name="profileImage" class="form-control" id="profileImage" accept="image/png, image/gif, image/jpeg" required>
            </div>
            <div class="col-12">
                <label for="currentAddress" class="form-label">Current Address*</label>
                <input type="text" value="{{ old('currentAddress', null) }}" name="currentAddress" class="form-control" id="currentAddress" placeholder="Building, Sector, City, State" required>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">Is Permanent Address same as current address?
                  </label>
                </div>
            </div>
            <div class="col-12">
                <label for="permanentAddress" class="form-label">Permanent Address*</label>
                <input type="text" value="{{ old('permanentAddress', null) }}" name="permanentAddress" class="form-control" id="permanentAddress" placeholder="Building, Sector, City, State" required>
            </div>
            
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</body>

@endsection

@section('footer_js')

    <script type="text/javascript">
        $(document).on("change", 'input[type="checkbox"]', function(){
            let currentAddress = '';
            if($(this).is(":checked")){
                currentAddress = $('input[name="currentAddress"]').val();
            }

            $('input[name="permanentAddress"]').val(currentAddress);
        });

    </script>

@endsection