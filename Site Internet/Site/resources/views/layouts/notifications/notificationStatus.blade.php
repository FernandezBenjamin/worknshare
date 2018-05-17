
@if(session('status'))

    <div class="form-group">
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    </div>


@endif