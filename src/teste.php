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

        <script type="text/javascript" src="js/recorderWorker.js"></script>    
        <script type="text/javascript" src="js/recorder.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/dictation.js"></script> 
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
                        <a class="navbar-brand" href="index.php"><span>Perfani</span></a>
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
                    <div class="col-md-12">
                        <h1 class="text-center">Cliente</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">Olá, gostaria de saber mais sobre os tipos de café que vocês possuem nesta
                            loja. Sou fanático por cafés fortes e gostaria de ter uma experiência gastronômica
                            especial. Vocês possuem algum tipo de café que me satisfaça?</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" class="text-center" action="resultado.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input name="sex" type="radio" name="optionsRadios" id="optionsRadios1" value="male"
                                        checked="">Homem</label>
                                    <label class="radio-inline">
                                        <input name="sex" type="radio" name="optionsRadios" id="optionsRadios2" value="female"
                                        checked="">Mulher</label>
                                </div>
                            </div>
                            <input type="button" id="btn_rec" name="rec" class="btn btn-success" value="Gravar" />                            
                            <input type="hidden" id="final_transcript" name="final_transcript" />
                            <input type="hidden" id="labnol" name="labnol" />
                            <input type="hidden" id="lang" name="lang" />
                            <input type="hidden" id="myfile" name="myfile" />
                            <input type="submit" id="btn_next" name="next" value="Próximo" class="btn btn-default" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>