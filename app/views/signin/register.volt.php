<!DOCTYPE html>
<!-- (c)Finzaiko -->

<html>
    <head>
        <?= $this->tag->getTitle() ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->assets->outputCss('style') ?>
        <?= $this->assets->outputJs('js') ?>
        
        
    <?= $this->assets->outputCss('additional') ?>

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
                        <li><a href="<?= $this->url->get('signin/') ?>">Sign in</a></li>
                        <li><a href="<?= $this->url->get('signin/register') ?>">Register</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        
        <?= $this->flash->output() ?>
        
        
<form class="form-signin" method="post" action="<?= $this->url->get('signin/doRegister') ?>">
    <h2 class="form-signin-heading">Register</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Register">
    <input type="hidden" name="<?= $this->security->getTokenKey() ?>" value=" <?= $this->security->getToken() ?>"/>
    <!--<input type="hidden" name="<?= $tokenKey ?>" value=" <?= $token ?>"/>-->
</form>    

    </body>
</html>


