<h2>Index</h2>

{{$users[0]->id}}

@foreach ($users as $user)
            <div>
                <h4>{$user->email}</h4>
@endforeach
