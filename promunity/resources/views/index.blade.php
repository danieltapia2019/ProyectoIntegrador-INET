<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php //dd($curso) ?>
   @foreach($cursos as $curso)
    <p>{{$curso['lenguaje']}}</p>
   @endforeach
</body>
</html>