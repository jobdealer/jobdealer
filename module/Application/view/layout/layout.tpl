{$this->doctype()}
<html lang="en">
    <head>
        <meta charset="utf-8">
        {$this->headTitle('JobDealer')->setSeparator(' - ')->setAutoEscape(false)}

        {$this->headMeta()->appendName('viewport', 'width=device-width, initial-scale=1.0')}
        {$basePath = $this->basePath()}

        {$this->headLink([ 'rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' =>
        "`$basePath`/images/favicon.ico"])}
        <!-- Le styles -->
        <link rel="stylesheet" type="text/css" href="{$basePath}/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" type="text/css" href="{$basePath}/css/style.css">
        <link rel="stylesheet" type="text/css" href="{$basePath}/css/bootstrap.min.css">
        {$this->headLink}

        <!-- Scripts -->
        <script type="text/javascript" charset="utf-8" src="{$basePath}/js/html5.js"></script>
        <script type="text/javascript" charset="utf-8" src="{$basePath}/js/bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="{$basePath}/js/jquery-1.10.1.min.js"></script>
        {$this->headScript()}
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
                            <li{if $smarty.server.REQUEST_URI == $this->url('home')} class="active"{/if}>
                                <a href="{$this->url('home')}">{$this->translate('Dashboard')}</a>
                            </li>
                            <li{if $this->url() == $this->url('node')} class="active"{/if}>
                                <a href="{$this->url('node')}">{$this->translate('Node')}</a>
                            </li>
                            <li{if $this->url() == $this->url('job')} class="active"{/if}>
                                <a href="{$this->url('job')}">{$this->translate('Job')}</a>
                            </li>
                            <li{if $this->url() == $this->url('workflow')} class="active"{/if}>
                                <a href="{$this->url('workflow')}">{$this->translate('Workflow')}</a>
                            </li>
                            <li{if $smarty.server.REQUEST_URI == '/about'} class="active"{/if}>
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