@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <i data-feather="alert-circle"></i>
            {{$error}}
        </div>
    @endforeach
@endif
@if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        <i data-feather="alert-circle"></i>
        {{ Session::get('message') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <i data-feather="alert-circle"></i>
        {{ Session::get('error') }}
    </div>
@endif
