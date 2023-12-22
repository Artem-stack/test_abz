<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Abz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>

  <div class="row">
    <div class="col mx-2 mt-4">
        <a href="{{ route('user.token') }}" class="btn btn-outline-primary btn-block">My token</a>
    </div>
    <div class="col mx-2 mt-4">
<form action="{{ route('user.profile.search') }}" method="get">
    <div class="mb-3">
        <input type="number" name="id" class="form-control" id="userId" placeholder="Enter id" min="1" required>
    </div>
    <button type="submit" class="btn btn-outline-primary btn-block">Find user</button>
</form>

<script>
    document.getElementById('userId').addEventListener('input', function() {
        if (this.value.length > 6) {
            this.value = this.value.slice(0, 6);
        }
    });
</script>

    </div>
    <div class="col mx-2 mt-4">
        <a href="{{ route('user.positions') }}" class="btn btn-outline-primary btn-block">User positions</a>
    </div>
  </div>

  <div>
      @yield('content')
  </div>

</body>
</html>
