<?php
    $hostname = shell_exec('hostname');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Server Monitoring Dashboard</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/pages/dashboard.css" rel="stylesheet">
        <link href="css/odometer.css" rel="stylesheet">

    </head>
    <body>

        <!-- Github Fork Image-->
        <!-- <a href="https://github.com/afaqurk/linux-dash"><img style="position: absolute; top: 0; right: 0; border: 0;z-index:99999999;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a> -->

        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/"><?= $hostname ?> Dashboard</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="navbar-text">Server Time: <?= date("H:i:s a", time()); ?></li>
                    </ul>
                </div>
            </div>
            <!-- /navbar-inner -->
        </nav>
        <!-- /navbar -->
        <div class="subnavbar visible-desktop visible-tablet hidden-xs">
            <div class="subnavbar-inner">
                <div class="container">
                    <ul class="mainnav">
                        <li><a href="#GeneralInfo"><i class="fa fa-info-circle"></i><span>General</span></a></li>
                        <li><a href="#RAM"><i class="fa fa-list"></i><span>RAM</span></a></li>
                        <li><a href="#DiskUsage"><i class="fa fa-list"></i><span>Disk Usage</span></a></li>
                        <li><a href="#Users"><i class="fa fa-group"></i><span>Users</span></a></li>
                        <li><a href="#Software"><i class="fa fa-list"></i><span>Software</span></a></li>
                        <li><a href="#IP"><i class="fa fa-globe"></i><span>IP</span></a></li>
                        <li><a href="#InternetSpeed"><i class="fa fa-exchange"></i><span>Internet Speed</span></a></li>
                        <li><a href="#Processes"><i class="fa fa-dashboard"></i><span>Processes</span></a></li>
                    </ul>
                </div>
                <!-- /container -->
            </div>
            <!-- /subnavbar-inner -->
        </div>
        <!-- /subnavbar -->
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <!-- <div class="lead text-center">
                        <button class="btn btn-default"><i class="fa fa-power-off"></i></button>
                        <div>A simple web dashboard to monitor your server.</div>
                    </div> -->

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="panel panel-default action-table" id="GeneralInfo">

                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left"><i class="fa fa-info-circle"></i> General Info</h3>
                                    <a href="#refresh" class="js-refresh-os pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->

                                <div class="panel-body">
                                    <p><strong class="label label-default">OS:</strong> <span id="os-info"></span></p>
                                    <p><strong class="label label-default">Uptime:</strong> <span class="odometer" id="os-uptime"></span> Hours</p>
                                    <p><strong class="label label-default">Hostname:</strong> <span id="os-hostname"></span></p>
                                </div>
                                <!-- /widget-content -->
                            </div>
                            <!-- /widget -->

                        </div>

                        <div class="col-lg-6">

                            <div class="panel panel-default" id="RAM">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left"><i class="fa fa-list"></i> RAM</h3>
                                    <a href="#refresh" class="js-refresh-ram pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->
                                <div class="panel-body">
                                    <div class="widget big-stats-container">
                                        <div class="widget-content">

                                            <div id="big_stats" class="cf">
                                                <div class="stat">
                                                    <i class="fa fa-#">Total</i>
                                                    <span class="value odometer" id="ram-total"></span> MB
                                                </div>
                                                <!-- .stat -->

                                                <div class="stat">
                                                    <i class="fa fa-#">Used</i>
                                                    <span class="value odometer" id="ram-used"></span> MB
                                                    <br><span class="value odometer" id="ram-used-per"></span> %
                                                </div>
                                                <!-- .stat -->

                                                <div class="stat">
                                                    <i class="fa fa-#">Free</i>
                                                    <span class="value odometer" id="ram-free"></span> MB
                                                    <br><span class="value odometer" id="ram-free-per"></span> %
                                                </div>
                                                <!-- .stat -->
                                            </div>
                                        </div>
                                        <!-- /widget-content -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">

                            <div class="panel panel-default" id="DiskUsage">
                                <div class="panel-heading clearfix">

                                    <h3 class="panel-title pull-left"><i class="fa fa-list"></i> Disk Usage</h3>
                                    <a href="#refresh" class="js-refresh-df pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->

                                <!-- <div class="panel-body">
                                    <div class="btn btn-error">Test</div>

                                </div> -->
                                <table id="df_dashboard" class="table table-hover table-condensed"></table>
                                <!-- /widget-content -->
                            </div>
                            <!-- /widget -->

                        </div>

                        <div class="col-lg-6">

                            <div class="panel panel-default action-table" id="Users">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left"><i class="fa fa-group"></i> Users</h3>
                                    <a href="#refresh" class="js-refresh-users pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->

                                <!-- <div class="widget-content">

                                </div> -->
                                <table id="users_dashboard" class="table table-hover table-condensed"></table>
                                <!-- /widget-content -->
                            </div>
                            <!-- /widget -->

                        </div>
                        <!-- /col-lg-6 -->
                    </div>
                    <!-- /row -->

                    <div class="row">
                        <div class="col-lg-6">

                            <div class="panel panel-default" id="Software">
                                <div class="panel-heading clearfix">

                                    <h3 class="panel-title pull-left"><i class="fa fa-list"></i> Software</h3>
                                    <a href="#refresh" class="js-refresh-whereis pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->

                                <!-- <div class="widget-content">

                                </div> -->
                                <table id="whereis_dashboard" class="table table-hover table-condensed"></table>
                                <!-- /widget-content -->
                            </div>
                            <!-- /widget -->

                        </div>
                        <!-- /span -->

                        <div class="col-lg-3">

                            <div class="panel panel-default" id="IP">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left"><i class="fa fa-globe"></i> IP</h3>
                                    <a href="#refresh" class="js-refresh-ip pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->

                                <table id="ip_dashboard" class="table table-hover table-condensed"></table>
                                <!-- /widget-content -->
                            </div>
                            <!-- /widget -->

                        </div>
                        <!-- /span -->

                        <div class="col-lg-3">

                            <div class="panel panel-default" id="InternetSpeed">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left"><i class="fa fa-exchange"></i> Internet Speed</h3>
                                    <a href="#refresh" class="js-refresh-speed pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->
                                <div class="panel-body text-center">
                                    <span class="lead">
                                        <span class="odometer" id="ispeed-rate"></span> Mbps
                                    </span>
                                </div>
                                <!-- /widget-content -->
                            </div>
                            <!-- /widget -->

                        </div><!-- /span -->
                    </div>
                    <!-- /row -->

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="panel panel-default" id="Processes">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left"><i class="fa fa-dashboard"></i> Processes</h3>
                                    <a href="#refresh" class="js-refresh-ps pull-right">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                                <!-- /widget-header -->
                                <table id="ps_dashboard" class="table table-hover table-condensed"></table>
                                <!-- /widget-content -->
                            </div>
                            <!-- /widget -->

                        </div>
                        <!-- /span -->
                    </div>
                    <!-- /row -->

                </div>

            </div>
            <!-- /container -->
        </div>
        <!-- /main-inner -->

        <div class="footer">
            <div class="footer-inner">

            </div>
            <!-- /footer-inner -->
        </div>
        <!-- /footer -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
        <script src="js/odometer.js"></script>
        <script src="js/dashboard.js"></script>

    </body>
</html>
