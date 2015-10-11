subconApp.controller("TruckingReportController", TruckingReportController);
function TruckingReportController($scope, $compile, $interval){
    $scope.truckingToggle = false;


    //====================================TRUCKING REPORT FILTERING AND DATAGRID==========================
    //Load trucking datagrid for compiling
    $scope.loadTruckingDataGrid = function () {
        $scope.initTruckingDataGrid();
        $scope.compileTruckingDataGrid();
    };

    //function that will be invoked during compiling datagrid to DOM
    $scope.compileTruckingDataGrid = function () {
        var html = '<dir-data-grid2 datadefinition      = "truckingDataDefinition"' +
                                    'submitdefinition   = "truckingSubmitDefinition"' +
                                    'otheractions       = "truckingOtheractions(action)"' +
                                    'resetdata          = "truckingResetData()"' +
                                    'showformerror      = "truckingShowFormError(error)">' +
                    '</dir-data-grid2>';
        $content = angular.element(document.querySelector('#truckingContainer')).html(html);
        $compile($content)($scope);
    };

    //initialize trucking datagrid parameters
    $scope.initTruckingDataGrid = function () {
        $scope.initializeTruckingDataDefinition = function () {
            $scope.truckingDataDefinition = {
                "Header": ['Trucking', 'Truck', 'Trucking Status', 'Truck Status', 'No.'],
                "Keys": ['TruckingName', 'TruckName', 'TruckingStatus', 'TruckStatus'],
                "Type": ['ProperCase', 'ProperCase', 'StatusMaintenance', 'StatusMaintenance'],
                "ColWidth": [300,300,200,200],
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
                "DataTarget": "TruckingMenu",
                "DataTarget2": "TruckingMenu1",
                "ShowCreate": false,
                "ShowContextMenu": true,
                "ContextMenu": ["'Find'", "'Clear'"],
                "ContextMenuLabel": ["Find", "Clear"]
            }
        };

        $scope.initializeTruckingSubmitDefinition = function () {
            $scope.truckingSubmitDefinition = {
                "Submit": false, //By default
                "APIUrl": '',
                "Type": 'Create', //By Default
                "DataItem": {},
                "Index": -1 //By Default
            }
        };

        $scope.truckingOtheractions = function (action) {
            switch (action) {
                case "Find":
                    //Animation effect in showing filter directive
                    var promise = $interval(function () {
                        if ($scope.truckingToggle == false) {
                            $("#truckingToggle").slideToggle(function () {
                                $scope.truckingToggle = true;
                            });
                        }
                        $interval.cancel(promise);
                        promise = undefined;
                    }, 200);
                    return true;
                case "Clear":
                    $scope.truckingDataDefinition.DataList = [];
                    //Required if pagination is enabled
                    if ($scope.truckingDataDefinition.EnablePagination == true) {
                        $scope.truckingDataDefinition.CurrentPage = 1;
                        $scope.truckingDataDefinition.DoPagination = true;
                    }
                    return true;
                default: return true;
            }
        };
        $scope.truckingResetData = function () {
            $scope.truckingItem = {};
        };

        $scope.truckingShowFormError = function (error) {
            $scope.truckingIsError = true;
            $scope.truckingErrorMessage = error;
        };

        $scope.initializeTruckingDataDefinition();
        $scope.initializeTruckingSubmitDefinition();
    };

    //Load filtering for compiling
    $scope.loadTruckingFiltering = function () {
        $scope.initTruckingFilteringParameters();
        $scope.initTruckingFilteringContainter();
        $("#truckingToggle").slideToggle(function () { });
    };

    //initialize filtering parameters
    $scope.initTruckingFilteringContainter = function () {
        html = '<dir-filtering  filterdefinition="truckingFilteringDefinition"' +
                                'filterlistener="truckingDataDefinition.Retrieve"' +
                                'otheractions="truckingOtherActionsFiltering(action)"' +
               '</dir-filtering>';
        $content = angular.element(document.querySelector('#truckingFilterContainter')).html(html);
        $compile($content)($scope);
    };

    //function that will be called during compiling of filtering to DOM
    $scope.initTruckingFilteringParameters = function () {
        //Hide the filtering directive
        $scope.hideTruckingToggle = function () {
            var promise = $interval(function () {
                $("#truckingToggle").slideToggle(function () {
                    $scope.truckingToggle = false;
                });
                $interval.cancel(promise);
                promise = undefined;
            }, 200)
        };
        $scope.initTruckingFilteringDefinition = function () {
            $scope.truckingFilteringDefinition = {
                "Url": '',//Url for retrieve
                "DataList": [], //Contains the data retrieved based on the criteria
                "DataItem1": $scope.DataItem1, //Contains the parameter value index 0
                "Source": [
                            { "Index": 0, "Label": "Name", "Column": "TruckingName", "Values": [], "From": null, "To": null, "Type": "Default" },
                            { "Index": 1, "Label": "Truck", "Column": "TruckName", "Values": [], "From": null, "To": null, "Type": "Default" },
                            { "Index": 2, "Label": "Trucking Status", "Column": "TruckingStatus", "Values": [{ "Id": 1, "Name": "Active" },
                                                                                            { "Id": 0, "Name": "Inactive" }], "From": null, "To": null, "Type": "DropDown" },
                            { "Index": 3, "Label": "Truck Status", "Column": "TruckStatus", "Values": [{ "Id": 1, "Name": "Active" },
                                                                                            { "Id": 0, "Name": "Inactive" }], "From": null, "To": null, "Type": "DropDown" },
                ],//Contains the Criteria definition
                "Multiple": true,
                "AutoLoad": false,
                "ClearData": false,
                "SetSourceToNull": false
            }
        };

        $scope.truckingOtherActionsFiltering = function (action) {
            switch (action) {
                //Initialize DataItem1 and DataItem2 for data filtering
                case 'PreFilterData':
                    $scope.truckingSource = $scope.truckingFilteringDefinition.Source;
                    //Optional in using this, can use switch if every source type has validation before filtering
                    for (var i = 0; i < $scope.truckingSource.length; i++) {
                		switch($scope.truckingSource[i].Column){
                			case "TruckingName":
                				$scope.truckingFilteringDefinition.DataItem1.TruckingName = $scope.truckingSource[i].From;
                				break;
                			case "TruckName":
                				$scope.truckingFilteringDefinition.DataItem1.TruckName = $scope.truckingSource[i].From;
                				break;
                			case "TruckingStatus":
                				$scope.truckingFilteringDefinition.DataItem1.TruckingStatus = $scope.truckingSource[i].From;
                				break;
                			case "TruckStatus":
                				$scope.truckingFilteringDefinition.DataItem1.TruckStatus = $scope.truckingSource[i].From;
                				break;
                			default: break;
                		}
                    }

                   
                    if ($scope.truckingFilteringDefinition.ClearData)
                        $scope.truckingDataDefinition.DataList = [];

                    $scope.truckingFilteringDefinition.Url = '/subcontractor/Trucking_controller/getTruckingList/' + $scope.truckingDataDefinition.DataList.length;
                    $scope.truckingFilteringDefinition.Url += '/' + $scope.truckingFilteringDefinition.DataItem1.TruckingName;
                    $scope.truckingFilteringDefinition.Url += '/' + $scope.truckingFilteringDefinition.DataItem1.TruckName;
                    $scope.truckingFilteringDefinition.Url += '/' + $scope.truckingFilteringDefinition.DataItem1.TruckingStatus;
                    $scope.truckingFilteringDefinition.Url += '/' + $scope.truckingFilteringDefinition.DataItem1.TruckStatus;
                    return true;
                case 'PostFilterData':
                    /*Note: if pagination, initialize truckingDataDefinition DataList by copying the DataList of filterDefinition then 
                            set DoPagination to true
                      if scroll, initialize truckingDataDefinition DataList by pushing each value of filterDefinition DataList*/
                    //Required

                    $scope.truckingFilteringDefinition.DataList = $scope.truckingFilteringDefinition.DataList;
                    if ($scope.truckingDataDefinition.EnableScroll == true) {
                        for (var j = 0; j < $scope.truckingFilteringDefinition.DataList.length; j++)
                            $scope.truckingDataDefinition.DataList.push($scope.truckingFilteringDefinition.DataList[j]);
                    }

                    for(var i = 0; i < $scope.truckingDataDefinition.DataList.length; i++)
                        $scope.truckingDataDefinition.DataList[i].No = i + 1;
                            
                    if ($scope.truckingDataDefinition.EnablePagination == true) {
                        $scope.truckingDataDefinition.DataList = [];
                        $scope.truckingDataDefinition.DataList = $scope.truckingFilteringDefinition.DataList;
                        $scope.truckingDataDefinition.DoPagination = true;
                    }

                    if ($scope.truckingToggle == true)
                        $scope.hideTruckingToggle();
                    return true;
                default: return true;
            }
        };

        $scope.initTruckingDataItems = function () {
            $scope.truckingObj = {
	                					"TruckingName": null,
	                                    "TruckName": null,
                                        "TruckingStatus": null,
                                        "TruckStatus": null
            						}
            $scope.truckingFilteringDefinition.DataItem1 = angular.copy($scope.truckingObj);
        };

        $scope.initTruckingFilteringDefinition();
        $scope.initTruckingDataItems();
    };
    //=====================================END OF TRUCKING REPORT FILTERING AND DATAGRID===================

    $scope.loadTruckingDataGrid();
    $scope.loadTruckingFiltering();

}