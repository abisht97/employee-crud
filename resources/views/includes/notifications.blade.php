@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
	<ul>
	    @foreach ($errors->all() as $message)
	        <li>{!! $message !!}</li>
	    @endforeach
	</ul>
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    <strong>Success:</strong> {!! $message !!}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    <strong>Error:</strong> {!! $message !!}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    <strong>Warning:</strong> {!! $message !!}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    <strong>Info:</strong> {!! $message !!}
</div>
@endif

@if ($message = Session::get('alert'))
    @if(!empty($message))
        @foreach($message as $class=>$msg)
            @if(!empty($msg))
                <div class="alert alert-{{$class}} alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    @if(is_array($msg))
                        <ul>
                        @foreach($msg as $value)
                            <li>{!! $value !!}</li>
                        @endforeach
                        </ul>
                        @else
                        <strong>{{ucwords($class)}}:</strong> {!! $msg !!}
                    @endif
                </div>
            @endif
        @endforeach
    @endif
@endif