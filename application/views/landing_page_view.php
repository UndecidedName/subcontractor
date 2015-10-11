<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html ng-app="SubConApplication">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>SubContractor Maintenance</title>
    <link href="/subcontractor/libs/css/bootstrap.min.css" rel="stylesheet">
    <link href="/subcontractor/libs/css/customize-table.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/subcontractor/libs/css/simple-sidebar.css" rel="stylesheet">
    <!-- ui-grId css-->
    <link href="/subcontractor/libs/uigrid/css/ui-grid.css" rel="stylesheet" />
    <!-- DatePicker -->
    <link href="/subcontractor/libs/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/subcontractor/libs/css/Site.css" rel="stylesheet">
</html>
<body>
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
        	<ul class="sidebar-nav">
				<li>
				    <a ui-sref="Trucking" style="font-size: 16px; cursor: pointer;">Trucking</a>
				</li>   
				<li>
				    <a ui-sref="ShippingLine" style="font-size: 16px; cursor: pointer;">Shipping Line</a>
				</li>
                <li>
                    <a ui-sref="TruckingReport" style="font-size: 16px; cursor: pointer;">Trucking Report</a>
                </li>   
                <li>
                    <a ui-sref="ShippingLineReport" style="font-size: 16px; cursor: pointer;">Shipping Line Report</a>
                </li>
        	</ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="text-center"><h3>Subcontractor Maintenance</h3></div>
            <div class="row">
                <div class="col-md-12 text-right">
                	<a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">
                		<span class="glyphicon glyphicon-align-justify"></span>
                	</a>
                </div>
            </div>
            <div class="row">
                <div id="spinnerTarget"></div>
                <div class="container-fluid">
                    <div ui-view></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</body>

<script src="/subcontractor/libs/js/jquery.js"></script>
<script src="/subcontractor/libs/js/bootstrap.min.js"></script>
<script src="/subcontractor/libs/moment/moment.js"></script>
<script src="/subcontractor/libs/js/bootstrap-datetimepicker.min.js"></script>
<script src="/subcontractor/libs/js/ajaxfileupload.js"></script>
<script src="/subcontractor/libs/js/spin.min.js"></script>
<script src="/subcontractor/libs/angular/angular.min.js"></script>
<script src="/subcontractor/libs/angular/angular-ui-router.min.js"></script>
<script src="/subcontractor/libs/angular/ng-context-menu.js"></script>
<script src="/subcontractor/libs/uigrid/js/csv.js"></script>
<script src="/subcontractor/libs/uigrid/js/pdfmake.js"></script>
<script src="/subcontractor/libs/uigrid/js/vfs_fonts.js"></script>
<script src="/subcontractor/libs/uigrid/js/ui-grid.js"></script>
<script src="/subcontractor/scripts/main/app.js"></script>
<script src="/subcontractor/scripts/filter/filter.js"></script>
<script src="/subcontractor/scripts/directive/dataGrid1.js"></script>
<script src="/subcontractor/scripts/directive/dataGrid2.js"></script>
<script src="/subcontractor/scripts/directive/dataFiltering.js"></script>
<script src="/subcontractor/scripts/directive/scrollableContainer.js"></script>
<script src="/subcontractor/scripts/controller/shippingLineController.js"></script>
<script src="/subcontractor/scripts/controller/truckingController.js"></script>
<script src="/subcontractor/scripts/controller/shippingLineReportController.js"></script>
<script src="/subcontractor/scripts/controller/truckingReportController.js"></script>