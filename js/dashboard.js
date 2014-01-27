/* global define */
(function (window, $) {
    'use strict';

    var dashboard = {};

    /*******************************
            Abstracted Functions
    *******************************/

    // If dataTable with proved ID (tableId)
    // exists, destroy it. Obliterate it.
    // Leave no evidence.
    dashboard.destroyDataTable = function (tableId) {
        var table = $('#' + tableId);

        if ($.fn.DataTable.fnIsDataTable(table[0])) {
            table.hide().dataTable().fnClearTable();
            table.dataTable().fnDestroy();
        }
    };

    /*******************************
            Data Call Functions
    *******************************/

    dashboard.getPs = function () {
        $.get('sh/ps.php', function (data) {

            dashboard.destroyDataTable('ps_dashboard');

            $('#ps_dashboard').dataTable({
                'aaData': data,
                'aoColumns': [
                    { 'sTitle':'USER','mDataProp':null },
                    { 'sTitle':'PID','mDataProp':null },
                    { 'sTitle':'%CPU','mDataProp':null },
                    { 'sTitle':'%MEM','mDataProp':null },
                    { 'sTitle':'VSZ','mDataProp':null },
                    { 'sTitle':'RSS','mDataProp':null },
                    { 'sTitle':'TTY','mDataProp':null },
                    { 'sTitle':'STAT','mDataProp':null },
                    { 'sTitle':'START','mDataProp':null },
                    { 'sTitle':'TIME','mDataProp':null },
                    { 'sTitle':'COMMAND','mDataProp':null }
                ],
                'bPaginate': true,
                'sPaginationType': 'full_numbers',
                'bFilter': false,
                'bAutoWidth': false,
                'bInfo': false
            }).fadeIn();
        }, 'json');
    };

    dashboard.getUsers = function () {

        $.get( 'sh/users.php', function( data ) {

            dashboard.destroyDataTable('users_dashboard');

            $('#users_dashboard').dataTable({
                'aaData': data,
                'aoColumns': [
                    { 'sTitle':'Type','mDataProp':null },
                    { 'sTitle':'User','mDataProp':null },
                    { 'sTitle':'Home','mDataProp':null }
                ],
                'aaSorting': [[ 0, 'desc' ]],
                'iDisplayLength': 5,
                'bPaginate': true,
                'sPaginationType': 'full_numbers',
                'bFilter': false,
                'bAutoWidth': false,
                'bInfo': false
            }).fadeIn();

        }, 'json' );

        $('select[name="users_dashboard_length"]').val('5');
    };

    dashboard.getRam = function () {
        $.get('sh/mem.php', function (data) {
            var ramTotal = data[1],
                ramUsed = parseInt((data[2]/ramTotal)*100),
                ramFree = parseInt((data[3]/ramTotal)*100);

            $('#ram-total').text(ramTotal);
            $('#ram-used').text(data[2]);
            $('#ram-free').text(data[3]);

            $('#ram-free-per').text(ramFree);
            $('#ram-used-per').text(ramUsed);
        }, 'json');
    };

    dashboard.getDf = function () {

        $.get( 'sh/df.php', function( data ) {
            var table = $('#df_dashboard'),
                ex = document.getElementById('df_dashboard');

            if ($.fn.DataTable.fnIsDataTable(ex)) {
                table.hide().dataTable().fnClearTable();
                table.dataTable().fnDestroy();
            }

            table.dataTable({
                'aaData': data,
                'aoColumns': [
                    { 'sTitle':'Filesystem','mDataProp':null },
                    { 'sTitle':'Size','mDataProp':null },
                    { 'sTitle':'Used','mDataProp':null },
                    { 'sTitle':'%Avail','mDataProp':null },
                    { 'sTitle':'Use%','mDataProp':null },
                    { 'sTitle':'Mounted','mDataProp':null }
                ],
                'bPaginate': false,
                'bFilter': false,
                'bAutoWidth': true,
                'bInfo': false
            }).fadeIn();

        }, 'json');
    };

    dashboard.getWhereIs = function () {

        $.get('sh/whereis.php', function (data) {

            var table = $('#whereis_dashboard');

            var ex = document.getElementById('whereis_dashboard');
            if ( $.fn.DataTable.fnIsDataTable( ex ) ) {
                table.hide().dataTable().fnClearTable();
                table.dataTable( ).fnDestroy();
            }

            table.dataTable({
                'aaData': data,
                'aoColumns': [
                    { 'sTitle':'Software','mDataProp':null },
                    { 'sTitle':'Installation','mDataProp':null }
                ],
                'bPaginate': false,
                'bFilter': false,
                'aaSorting': [[ 1, 'desc' ]],
                'bAutoWidth': false,
                'bInfo': false
            }).fadeIn();

        }, 'json');
    };

    dashboard.getOsInfo = function () {
        $.get('sh/os.php', function (data) {
            $.each(data, function (key, value) {
                $('#os-' + key).text(value || 'unknown');
            });
        }, 'json');
    };

    dashboard.getIp = function () {
        $.get('sh/ip.php', function (data) {

            dashboard.destroyDataTable('ip_dashboard');

            $('#ip_dashboard').dataTable({
                'aaData': data,
                'aoColumns': [
                    { 'sTitle':'Interface','mDataProp':null },
                    { 'sTitle':'IP','mDataProp':null }
                ],
                'bPaginate': false,
                'bFilter': false,
                'bAutoWidth': true,
                'bInfo': false
            }).fadeIn();

        }, 'json');
    };

    var ispeedMbps;
    dashboard.getIspeedExecute = function () {
        var imageAddr = 'https://www.google.com/images/srpr/logo11w.png' + '?n=' + Math.random()+'5'+Math.random(),
            startTime,
            endTime,
            downloadSize = 112230.4,
            download = new Image();

        startTime = Date.now();
        download.src = imageAddr;

        download.onload = function () {
            endTime = Date.now();
            var duration = (endTime - startTime) / 1000,
                bitsLoaded = downloadSize * 8,
                speedBps = (bitsLoaded / duration).toFixed(2),
                speedKbps = (speedBps / 1024).toFixed(2),
                speedMbps = (speedKbps / 1024).toFixed(0);

            ispeedMbps = speedMbps;
            return speedMbps;
        };
    };

    dashboard.getIspeed = function () {
        setTimeout(function(){
            dashboard.getIspeedExecute();
        },700);

        setTimeout(function(){
            $('#ispeed-rate').text(ispeedMbps);
        },1000);
    };
    /*
        Function that calls all the other functions which refresh
        each individual widget
    */
    dashboard.refreshAll = function () {
        dashboard.getOsInfo();
        dashboard.getRam();
        dashboard.getDf();
        dashboard.getUsers();
        dashboard.getWhereIs();
        dashboard.getIp();
        dashboard.getIspeed();
        dashboard.getPs();
    };

    $(document)
        .ready(function () {
            dashboard.refreshAll();
        })
        .on('click', '.js-refresh-os', dashboard.getOsInfo)
        .on('click', '.js-refresh-ram', dashboard.getRam)
        .on('click', '.js-refresh-df', dashboard.getDf)
        .on('click', '.js-refresh-users', dashboard.getUsers)
        .on('click', '.js-refresh-whereis', dashboard.getWhereIs)
        .on('click', '.js-refresh-ip', dashboard.getIp)
        .on('click', '.js-refresh-speed', dashboard.getIspeed)
        .on('click', '.js-refresh-ps', dashboard.getPs);

    if (typeof define === 'function' && define.amd) {
        define(['jquery'], dashboard);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = dashboard;
    } else {
        window.dashboard = dashboard;
    }

})(window, window.jQuery);
