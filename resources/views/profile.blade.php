<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profile</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url("/user/profile/$usr")}}">Look Book</a>

            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

          </div>
        </div>
      </nav>
    <div class="container mt-5">
            <h1 class="mb-3">{{ $usr->name }}</h1>

            <ul class="list-group">
                <li class="list-group-item">
                    <span>Email:    </span><b>{{ $usr->email }}</b>
                </li>
                <li class="list-group-item">
                    <span>User Id:  </span><b>{{ $usr->id }}</b>
                </li>
                <li class="list-group-item">
                    <span>Total Tasks: </span><b>{{ count($usr->articles) }}</b>
                </li>
                <li class="list-group-item">
                    <span>Created time: </span><b>{{ $usr->created_at }}</b>
                </li>


            </ul>
            <form action="profile"></form>
            <br>


    </div>
    <div class="justify-content-center "><a href="{{ url("/user")}}" class="">Home</a></div>

</body>
</html>
