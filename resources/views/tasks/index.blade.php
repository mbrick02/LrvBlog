<!doctype html>
<html>
<head>
  <title></title>
</head>
<body>
    <!-- ul php foreach ($tasks as $task) : ...<li> ?= $task; </li> ... php endforeach; /ul -->
    <ul>
  		@foreach ($tasks as $task)
  			<li><a href="/tasks/{{ $task->id }}">{{ $task->body }}</a></li>
  			<!-- link to individual tasks by id -->
  		@endforeach
  	</ul>
</body>
</html>
