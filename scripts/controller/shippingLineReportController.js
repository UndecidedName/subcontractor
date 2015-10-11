subconApp.controller("ShippingLineReportController", ShippingLineReportController);
function ShippingLineReportController($scope, $compile, $interval){
    $scope.shippingLineToggle = false;


    //====================================SHIPPING LINE REPORT FILTERING AND DATAGRID==========================
    //Load shippingLine datagrid for compiling
    $scope.loadShippingLineDataGrid = function () {
        $scope.initShippingLineDataGrid();
        $scope.compileShippingLineDataGrid();
    };

    //function that will be invoked during compiling datagrid to DOM
    $scope.compileShippingLineDataGrid = function () {
        var html = '<dir-data-grid2 datadefinition      = "shippingLineDataDefinition"' +
                                    'submitdefinition   = "shippingLineSubmitDefinition"' +
                                    'otheractions       = "shippingLineOtheractions(action)"' +
                                    'resetdata          = "shippingLineResetData()"' +
                                    'showformerror      = "shippingLineShowFormError(error)">' +
                    '</dir-data-grid2>';
        $content = angular.element(document.querySelector('#shippingLineContainer')).html(html);
        $compile($content)($scope);
    };

    //initialize shippingLine datagrid parameters
    $scope.initShippingLineDataGrid = function () {
        $scope.initializeShippingLineDataDefinition = function () {
            $scope.shippingLineDataDefinition = {
                "Header": ['Shipping Line', 'Vessel', 'Est. Date of Departure', 'Est. Date of Arrival', 'Departure', 'Arrival', 'Status', 'No.'],
                "Keys": ['ShippingLineName', 'VesselName', 'EDD', 'EDA', 'Departure', 'Arrival', 'STATUS'],
                "Type": ['ProperCase', 'ProperCase', 'DateTime', 'DateTime', 'DateTime', 'DateTime', 'StatusMaintenance'],
                "ColWidth": [200, 200, 200, 200, 150, 150, 150],
                "DataList": [],
                "RequiredFields": [],
                "CellTemplate": ["None"],
                "RowTemplate": "Default",
                "EnableScroll": true,
                "EnablePagination": false,
                "CurrentPage": 1, //By default
                "PageSize": 20, //Should be the same in back-end
                "DoPagination": false, //By default
                "Retrieve": false, //By default
                "DataItem": {},
                "DataTarget": "ShippingLineMenu",
                "DataTarget2": "ShippingLineMenu1",
                "ShowCreate": false,
                "ShowContextMenu": true,
                "ContextMenu": ["'Find'", "'Clear'"],
                "ContextMenuLabel": ["Find", "Clear"]
            }
        };

        $scope.initializeShippingLineSubmitDefinition = function () {
            $scope.shippingLineSubmitDefinition = {
                "Submit": false, //By default
                "APIUrl": '',
                "Type": 'Create', //By Default
                "DataItem": {},
                "Index": -1 //By Default
            }
        };

        $scope.shippingLineOtheractions = function (action) {
            switch (action) {
                case "Find":
                    //Animation effect in showing filter directive
                    var promise = $interval(function () {
                        if ($scope.shippingLineToggle == false) {
                            $("#shippingLineToggle").slideToggle(function () {
                                $scope.shippingLineToggle = true;
                            });
                        }
                        $interval.cancel(promise);
                        promise = undefined;
                    }, 200);
                    return true;
                case "Clear":
                    $scope.shippingLineDataDefinition.DataList = [];
                    //Required if pagination is enabled
                    if ($scope.shippingLineDataDefinition.EnablePagination == true) {
                        $scope.shippingLineDataDefinition.CurrentPage = 1;
                        $scope.shippingLineDataDefinition.DoPagination = true;
                    }
                    return true;
                default: return true;
            }
        };
        $scope.shippingLineResetData = function () {
            $scope.shippingLineItem = {};
        };

        $scope.shippingLineShowFormError = function (error) {
            $scope.shippingLineIsError = true;
            $scope.shippingLineErrorMessage = error;
        };

        $scope.initializeShippingLineDataDefinition();
        $scope.initializeShippingLineSubmitDefinition();
    };

    //Load filtering for compiling
    $scope.loadShippingLineFiltering = function () {
        $scope.initShippingLineFilteringParameters();
        $scope.initShippingLineFilteringContainter();
        $("#shippingLineToggle").slideToggle(function () { });
    };

    //initialize filtering parameters
    $scope.initShippingLineFilteringContainter = function () {
        html = '<dir-filtering  filterdefinition="shippingLineFilteringDefinition"' +
                                'filterlistener="shippingLineDataDefinition.Retrieve"' +
                                'otheractions="shippingLineOtherActionsFiltering(action)"' +
               '</dir-filtering>';
        $content = angular.element(document.querySelector('#shippingLineFilterContainter')).html(html);
        $compile($content)($scope);
    };

    //function that will be called during compiling of filtering to DOM
    $scope.initShippingLineFilteringParameters = function () {
        //Hide the filtering directive
        $scope.hideShippingLineToggle = function () {
            var promise = $interval(function () {
                $("#shippingLineToggle").slideToggle(function () {
                    $scope.shippingLineToggle = false;
                });
                $interval.cancel(promise);
                promise = undefined;
            }, 200)
        };
        $scope.initShippingLineFilteringDefinition = function () {
            $scope.shippingLineFilteringDefinition = {
                "Url": '',//Url for retrieve
                "DataList": [], //Contains the data retrieved based on the criteria
                "DataItem1": $scope.DataItem1, //Contains the parameter value index 0
                "Source": [
                            { "Index": 0, "Label": "Name", "Column": "ShippingLineName", "Values": [], "From": null, "To": null, "Type": "Default" },
                            { "Index": 1, "Label": "Vessel", "Column": "VesselName", "Values": [], "From": null, "To": null, "Type": "Default" },
                            { "Index": 2, "Label": "EDD", "Column": "EDD", "Values": [], "From": null, "To": null, "Type": "Date" },
                            { "Index": 3, "Label": "EDA", "Column": "EDA", "Values": [], "From": null, "To": null, "Type": "Date" },
                            { "Index": 4, "Label": "Departure", "Column": "Departure", "Values": [], "From": null, "To": null, "Type": "Date" },
                            { "Index": 5, "Label": "Arrival", "Column": "Arrival", "Values": [], "From": null, "To": null, "Type": "Date" },
                            { "Index": 6, "Label": "Status", "Column": "Status", "Values": [{ "Id": 1, "Name": "Active" },
                            																{ "Id": 0, "Name": "Inactive" }], "From": null, "To": null, "Type": "DropDown" },
                ],//Contains the Criteria definition
                "Multiple": true,
                "AutoLoad": false,
                "ClearData": false,
                "SetSourceToNull": false
            }
        };

        $scope.shippingLineOtherActionsFiltering = function (action) {
            switch (action) {
                //Initialize DataItem1 and DataItem2 for data filtering
                case 'PreFilterData':
                    $scope.shippingLineSource = $scope.shippingLineFilteringDefinition.Source;
                    //Optional in using this, can use switch if every source type has validation before filtering
                    for (var i = 0; i < $scope.shippingLineSource.length; i++) {
                		switch($scope.shippingLineSource[i].Column){
                			case "ShippingLineName":
                				$scope.shippingLineFilteringDefinition.DataItem1.ShippingLineName = $scope.shippingLineSource[i].From;
                				break;
                			case "VesselName":
                				$scope.shippingLineFilteringDefinition.DataItem1.VesselName = $scope.shippingLineSource[i].From;
                				break;
                			case "EDD":
                				$scope.shippingLineFilteringDefinition.DataItem1.EDDFrom = $scope.shippingLineSource[i].From;
                				$scope.shippingLineFilteringDefinition.DataItem1.EDDTo = $scope.shippingLineSource[i].To;
                				break;
                			case "EDA":
                				$scope.shippingLineFilteringDefinition.DataItem1.EDAFrom = $scope.shippingLineSource[i].From;
                				$scope.shippingLineFilteringDefinition.DataItem1.EDATo = $scope.shippingLineSource[i].To;
                				break;
            				case "Departure":
            					$scope.shippingLineFilteringDefinition.DataItem1.DepartureFrom = $scope.shippingLineSource[i].From;
            					$scope.shippingLineFilteringDefinition.DataItem1.DepartureTo = $scope.shippingLineSource[i].To;
                				break;
            				case "Arrival":
            					$scope.shippingLineFilteringDefinition.DataItem1.ArrivalFrom = $scope.shippingLineSource[i].From;
            					$scope.shippingLineFilteringDefinition.DataItem1.ArrivalTo = $scope.shippingLineSource[i].To;
                				break;
            				case "Status":
            					$scope.shippingLineFilteringDefinition.DataItem1.Status = $scope.shippingLineSource[i].From;
                				break;
                			default: break;
                		}
                    }

                   
                    if ($scope.shippingLineFilteringDefinition.ClearData)
                        $scope.shippingLineDataDefinition.DataList = [];

                    $scope.shippingLineFilteringDefinition.Url = '/subcontractor/Shipping_line_controller/getShippingLineList/' + $scope.shippingLineDataDefinition.DataList.length;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.ShippingLineName;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.VesselName;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.EDDFrom;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.EDAFrom;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.DepartureFrom;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.ArrivalFrom;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.EDDTo;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.EDATo;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.DepartureTo;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.ArrivalTo;
                    $scope.shippingLineFilteringDefinition.Url += '/' + $scope.shippingLineFilteringDefinition.DataItem1.Status;
                    return true;
                case 'PostFilterData':
                    /*Note: if pagination, initialize shippingLineDataDefinition DataList by copying the DataList of filterDefinition then 
                            set DoPagination to true
                      if scroll, initialize shippingLineDataDefinition DataList by pushing each value of filterDefinition DataList*/
                    //Required

                    $scope.shippingLineFilteringDefinition.DataList = $scope.shippingLineFilteringDefinition.DataList;
                    if ($scope.shippingLineDataDefinition.EnableScroll == true) {
                        for (var j = 0; j < $scope.shippingLineFilteringDefinition.DataList.length; j++)
                            $scope.shippingLineDataDefinition.DataList.push($scope.shippingLineFilteringDefinition.DataList[j]);
                    }

                    for(var i = 0; i < $scope.shippingLineDataDefinition.DataList.length; i++)
                        $scope.shippingLineDataDefinition.DataList[i].No = i + 1;
                            
                    if ($scope.shippingLineDataDefinition.EnablePagination == true) {
                        $scope.shippingLineDataDefinition.DataList = [];
                        $scope.shippingLineDataDefinition.DataList = $scope.shippingLineFilteringDefinition.DataList;
                        $scope.shippingLineDataDefinition.DoPagination = true;
                    }

                    if ($scope.shippingLineToggle == true)
                        $scope.hideShippingLineToggle();
                    return true;
                default: return true;
            }
        };

        $scope.initShippingLineDataItems = function () {
            $scope.shippingLineObj = {
	                					"ShippingLineName": null,
	                                    "VesselName": null,
	                                    "EDDFrom": null,
	                                    "EDAFrom": null,
	                                    "DepartureFrom": null,
	                                    "ArrivalFrom": null,
	                                    "EDDTo": null,
	                                    "EDATo": null,
	                                    "DepartureTo": null,
	                                    "ArrivalTo": null,
	                                    "Status": null
            						}
            $scope.shippingLineFilteringDefinition.DataItem1 = angular.copy($scope.shippingLineObj);
        };

        $scope.initShippingLineFilteringDefinition();
        $scope.initShippingLineDataItems();
    };
    //=====================================END OF SHIPPING LINE REPORT FILTERING AND DATAGRID===================

    $scope.loadShippingLineDataGrid();
    $scope.loadShippingLineFiltering();

}