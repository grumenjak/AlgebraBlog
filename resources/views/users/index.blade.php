@extends('layouts.master')
    
@section('content')

    <!--ovaj withFlashMessage je dodano također i u \app\http\controllers\UserController.php -->
    <!--https://www.w3schools.com/bootstrap/bootstrap_alerts.asp -->


    <div class="mb-4">
        <a href="{{ route('users.create')  }}" class="btn btn-primary">Kreiraj novog korisnika</a>
    </div>

    @if($users->count())
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                                <!--u web.php se definira donja ruta-->
                    <td><a href="{{ route('users.show', $user->id)  }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>                    
                        <form action="{{ route('users.destroy', $user->id)  }}" method='post'>
                            <!--https://laravel.com/docs/5.8/blade#method-field-->
                            @method('DELETE')
                            <!--Ovo se dodaje u svaku formu - Cross site request forgery-->
                            @csrf 
                            <a href="{{ route('users.edit', $user->id)  }}" class="btn btn-sm btn-primary">Uredi</a>
                            <button class="btn btn-sm btn-danger">Obriši</button>
                        </form>                    
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
