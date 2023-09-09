@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(Session::has('danger'))
    <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
        {{ Session::get('danger') }}        
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
