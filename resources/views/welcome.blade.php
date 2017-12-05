<!doctype html>
<html>
<head>
  <title></title>
</head>
<body>
    <!-- ul php foreach ($tasks as $task) : ...<li> ?= $task; </li> ... php endforeach; /ul -->
    @foreach ($tasks as $task)
      <li> {{ $task->body }}</li>
    @endforeach
</body>
</html>
