<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diver</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{URL::asset('css/freelancer.css')}}" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body id="page-top" class="index">
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Iniciar Sesión <i class="fa fa-bars"></i>
                </button>
                <div>
                    <img src="{{URL::asset('images/Diver-icon.png')}}" class="img-responsive img-centered pull-left">
                    <a class="navbar-brand" href="#page-top">Diver</a>    
                </div>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        {{ Form::open(
							array(
								{{-- 'novalidate' => 'novalidate', --}}
								'url' => '/iniciarSesion',
								'class' => 'navbar-form'
								))
						}}
						<div class="form-group">
							<label class="sr-only" for="usuario">Nombre de usuario</label>
							{{ Form::text('usuario', null, ['class' => 'form-control txt-diver', 'placeholder' => 'Nombre de usuario'])}}
						</div>
						<div class="form-group">
							<label class="sr-only" for="contraseña">Contraseña</label>
							{{ Form::password('contraseña', ['class' => 'form-control', 'placeholder' => 'Contraseña']) }}
						</div>
						{{ Form::submit('Iniciar sesión', ['class' => 'btn btn-diver']) }}
						{{ Form::close() }}
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="container" id="maincontent" tabindex="-1">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="{{('images/Diver-icon-L.png')}}" alt="">
                    <div class="intro-text">
                        <h1 class="name">Diver</h1>
                        <hr class="star-light">
                        <span class="skills">Navega - Unete a clubes - Comparte contenido</span>
                    </div>
                    <br>
                    <input type="button" name="btnRegistrarse" class="btn btn-lg btn-diver" value="Registrarse" data-toggle="modal" data-target="#myModal">
                </div>
            </div>
        </div>
    </header>

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Clubes</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-1">
                    <p>Un club es un espacio donde se pueden compartir imagenes de una tematica definida.</p><p>Busca alguno y subscribirte para que las publicaciones más recientes aparezcan en tu página de inicio.</p><p>Podras ver los clubes más recientes creados por la comunidad. Y a su vez, podras crear tus propios clubes y definir el contenido personalizado que los usuarios compartan en él.</p>
                </div>
                <div class="col-lg-7">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>

                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <img src="{{ URL::asset('images/perros.jpg')}}" alt="perros">
                        </div>

                        <div class="item">
                          <img src="{{ URL::asset('images/pcs.jpg')}}" alt="pcs">
                        </div>

                        <div class="item">
                          <img src="{{ URL::asset('images/comida_2.jpg')}}" alt="comida">
                        </div>
                      </div>

                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="light">Comparte Contenido</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p class="light" style="padding-top: 20px;">Expande los clubes. Comparte imagenes junto a otros usuarios y agranda la variedad de contenido que un club tiene para ofrecer. Comenta, da me gusta, navega por todo el mar de Diver.</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ URL::asset('images/logo-collage.png')}}" class="img-responsive img-centered" alt="collage">
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-6">
                        <h3>Redes Sociales</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><span class="sr-only">Facebook</span><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><span class="sr-only">Google Plus</span><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><span class="sr-only">Twitter</span><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-6">
                        <h3>Acerca de</h3>
                        <div class="row">
                            <div class="col-sm-12"><a href="" class="link-diver">Acerca de nosotros</a></div>
                            <div class="col-sm-12"><a href="" class="link-diver">Nuestras politicas</a></div>
                            <div class="col-sm-12"><a href="" class="link-diver">Terminos y condiciones</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Diver 2017
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header modal-header-diver">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="light">Registro</h4>
          </div>
          <div class="modal-body modal-body-diver">
            {{ Form::open(
						array(
							{{-- 'novalidate' => 'novalidate', --}}
							'url' => '/registrar',
							'files' => true
							))
					}}
					<div class="form-group">
						{{ Form::text('usuario', null, ['class' => 'form-control', 'placeholder' => 'Nombre de usuario', 'required' => 'required']) }}
					</div>
					<div class="form-group">
						{{ Form::email('correo', null, ['class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required' => 'required']) }}
					</div>
					<div class="form-group">
						{{ Form::password('contraseña', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required' => 'required']) }}
					</div>
					<div class="form-group">
						<h5>Fecha de nacimiento</h5>
						{{ Form::date('nacimiento', null, ['class' => 'form-control', 'required' => 'required']) }}
					</div>
					<div class="form-group">
						<label>Género</label><br>
						<label class="checkbox-inline">
							{{ Form::radio('genero','Hombre', null, ['class' => 'form-check-input', 'required' => 'required']) }}
							Hombre
						</label>
						<label class="checkbox-inline">
							{{ Form::radio('genero','Mujer', null, ['class' => 'form-check-input', 'required' => 'required']) }}
							Mujer
						</label>
					</div>
				</div>
				<div class="panel-footer text-center">
						{{ Form::submit('Registrarse', ['class' => 'btn btn-diver']) }}
					{{ Form::close() }}

          </div>
<!--           <div class="modal-footer modal-footer-diver">
            <button type="button" class="btn btn-diver" data-dismiss="modal">Registrarme</button>
          </div> -->
        </div>

      </div>
    </div>

    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

  	<script src="https://use.fontawesome.com/6349ef0231.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <script src="{{ URL::asset('js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ URL::asset('js/contact_me.js') }}"></script>

    <script src="{{ URL::asset('js/freelancer.min.js') }}"></script>

</body>

</html>
