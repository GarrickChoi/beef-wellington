
    @if (count($errors) > 0)
    <div style="color: red; margin-left: 110px">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif