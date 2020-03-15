@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
            <span aria-hidden="true">&times;</span>
        </button>

        {{ session('status') }}
    </div>
@endif