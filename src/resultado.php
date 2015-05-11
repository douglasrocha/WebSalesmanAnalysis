<?php
require("lib/operacoes.php");

$sex = "invalid";

if (isset($_POST['sex']))
{
    $sex = $_POST['sex'];
}

$linha = "invalid";
if (isset($_POST['final_transcript']))
{
    $linha = $_POST['final_transcript'];
}

calculateWavInformation("temp.wav");

?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css"
        rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <div class="cover">
            <div class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="index.php" class="navbar-brand"><span>Perfani</span></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="about.php">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cover-image" style="background-image : url('http://pingendo.github.io/pingendo-bootstrap/assets/blurry/800x600/7.jpg')"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Sua nota foi...
                            <br>
                        </h1>
                        <?php echo calculaNotaFinal($sex, $linha); ?>
                        <br>
                        <br>
                        <a href="index.php" class="btn btn-lg btn-default">Retornar</a>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>