<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Edit</title>
</head>
<body>

    <div class="card">
        <div class="card-header">
          Editing
        </div>
        <div class="card-body">
                <form method="POST">
                    @csrf

                    <small class="text-muted">
                        <label for="">Last updated</label>
                        {{ $arti->created_at}}
                    </small>
                    <br>
                    <div class="input-group mb-3">

                        <input type="text" name="body" class="form-control" value="{{ $arti->body}}">
                        <button class="btn btn-outline-secondary" type="submit" value="Add List">Update</button>
                    </div>
                </form>
        </div>
      </div>
</body>
</html>
