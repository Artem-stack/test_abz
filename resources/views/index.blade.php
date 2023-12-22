@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Welcome to the Home Page!</h1>

        <div id="usersContainer" style="display: none;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td><img src="{{ asset($user->photo) }}" alt="User Photo" class="img-thumbnail" width="70" height="70">
</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->position->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

          <button id="showMoreBtn" data-count="{{ count($users) }}" class="btn btn-primary">Show more</button>
 
        <script>
            var isButtonHidden = localStorage.getItem('isButtonHidden');

            if (isButtonHidden) {
                
                document.getElementById('showMoreBtn').style.display = 'none';
                document.getElementById('usersContainer').style.display = 'block';
            }

            document.getElementById('showMoreBtn').addEventListener('click', function() {

                localStorage.setItem('isButtonHidden', 'true');

                document.getElementById('usersContainer').style.display = 'block';

                this.style.display = 'none';
            });
        </script>
 
        <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
    </div>
@endsection
