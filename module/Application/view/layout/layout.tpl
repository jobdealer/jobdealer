{$this->doctype()}
<html lang="en">
    <head>
        <meta charset="utf-8">
        {*$this->headTitle('ZF2 '. $this->translate('Skeleton Application'))->setSeparator(' - ')->setAutoEscape(false)*}

        {$this->headMeta()->appendName('viewport', 'width=device-width, initial-scale=1.0')}

        <!-- Le styles -->
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        {*$this->headLink(array('rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => $this->basePath() . '/img/favicon.ico'))
                        ->prependStylesheet($this->basePath() . '/css/bootstrap-responsive.min.css')
                        ->prependStylesheet($this->basePath() . '/css/style.css')
                        ->prependStylesheet($this->basePath() . '/css/bootstrap.min.css')*}

        <!-- Scripts -->
        <script type="text/javascript" charset="utf-8" src="./js/html5.js"></script>
        <script type="text/javascript" charset="utf-8" src="./js/bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="./js/jquery.min.js"></script>
        {*$this->headScript()->prependFile($this->basePath() . '/js/html5.js', 'text/javascript', array('conditional' => 'lt IE 9',))
                                      ->prependFile($this->basePath() . '/js/bootstrap.min.js')
                                      ->prependFile($this->basePath() . '/js/jquery.min.js')*}

    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="{$this->url('home')}">{$this->translate('JobDealer')}</a>
                    <div class="nav-collapse collapse">
                        <p class="navbar-text pull-right">
                            Logged in as <a href="#" class="navbar-link">Username</a>
                        </p>
                        <ul class="nav">
                            <li{if $this->url() == $this->url('home')} class="active"{/if}>
                                <a href="{$this->url('home')}">{$this->translate('Dashboard')}</a>
                            </li>
                            <li{if $this->url() == $this->url('server')} class="active"{/if}>
                                <a href="{$this->url('server')}">{$this->translate('Server')}</a>
                            </li>
                            <li{if $this->url() == $this->url('task')} class="active"{/if}>
                                <a href="{$this->url('task')}">{$this->translate('Task')}</a>
                            </li>
                            <li{if $this->url() == $this->url('workflow')} class="active"{/if}>
                                <a href="{$this->url('workflow')}">{$this->translate('Workflow')}</a>
                            </li>
                            <li{if $this->url() == '/about'} class="active"{/if}>
                                <a href="/about">{$this->translate('About')}</a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            {$this->content}
            <hr>
            <footer>
                <p>&copy; 2013 - {date('Y')} by JobDealer's Team {$this->translate('All rights reserved.')}</p>
            </footer>

        </div> <!-- /container -->
        {$this->inlineScript()}
    </body>
</html>