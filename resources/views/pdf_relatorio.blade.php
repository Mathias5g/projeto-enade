<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            width: 100%;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        #questoes {
            width: 90vw;
            margin: 0 auto;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div id="questoes">
        @foreach($questoes as $questao)
        <div class="questao">
            <p class="enunciado">{{$questao['id']}}-({{$questao['concurso']['nome_concurso']}})/ {{$questao['pergunta']}}</p>
            <p>Alternativas</p>
            <p class="alternativa">{{$questao['resposta']}}</p>
        </div>
        @endforeach
    </div>
</body>
</html>
