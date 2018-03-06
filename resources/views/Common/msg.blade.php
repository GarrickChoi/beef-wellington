    @if (session('msg'))
        <div class="alert alert-success" style="color: red; margin-left: 110px">
            {{ session('msg') }}
        </div>
    @endif