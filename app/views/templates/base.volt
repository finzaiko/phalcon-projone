<!DOCTYPE html>
<!-- (c)Finzaiko -->

<html>
    <head>
        {{ get_title() }}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ this.assets.outputCss('style') }}
        {{ this.assets.outputJs('js') }}
        
        {% block head%}
        {% endblock %}
    </head>
    <body>
        <div class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project One</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('signin/')}}">Sign in</a></li>
                        <li><a href="{{ url('signin/register')}}">Register</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        
        {{ flash.output() }}
        
        {% block content %}
        {% endblock %}
    </body>
</html>


