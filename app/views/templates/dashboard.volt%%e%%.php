a:5:{i:0;s:315:"<!DOCTYPE html>
<!-- (c)Finzaiko -->

<html>
    <head>
        <?= $this->tag->getTitle() ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->assets->outputCss('style') ?>
        <?= $this->assets->outputJs('js') ?>
        
        ";s:4:"head";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:9:"
        ";s:4:"file";s:37:"../app/views/templates/dashboard.volt";s:4:"line";i:13;}}i:1;s:1449:"
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
                        <li class="active"><a href="<?= $this->url->get('dashboard/') ?>">Dashboard</a></li>
                        <li><a href="<?= $this->url->get('project/') ?>">Project</a></li>
                        <li><a href="<?= $this->url->get('account/') ?>">Account</a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= $this->url->get('index/signout') ?>">Sign out</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        
        <?= $this->flash->output() ?>
        
        ";s:7:"content";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:9:"
        ";s:4:"file";s:37:"../app/views/templates/dashboard.volt";s:4:"line";i:45;}}i:2;s:23:"
    </body>
</html>


";}