subconApp.controller("ShippingLineController", ShippingLineController);
function ShippingLineController($rootScope, $scope, $http, $compile)
{
    $scope.modelhref    = '#/shippingline';

    $scope.loadShippingLine = function()
    {
        $scope.loadShippingLineDataGrid();
        $scope.initShippingLineParameters();
    }
    //Compile Shipping Line Data Grid
    $scope.loadShippingLineDataGrid = function()
    {
        var html = '', $content;
        html = '<dir-data-grid1 actioncreate="actionCreate"' +
                    'actionmode="actionMode"' +
                    'datadefinition="dataDefinition"' +
                    'submitbuttontext="submitButtonText"' +
                    'submitbuttonlistener="submitButtonListener"' +
                    'closecontainer="closeForm()"' + 
                    'opencontainer="showForm()"' +
                    'otheractions="otherActions(action)"' +
                    'resetdata="resetDataItem()"' +
                    'showformerror="showFormError(error)">' +
                '</dir-data-grid1>'
        $content = angular.element(document.querySelector('#ShippiLineDataGrid')).html(html);
        $compile($content)($scope);
    };
    $scope.initShippingLineParameters = function()
    {
        $scope.tabPages     = ['Information', 'Vessel'];
        $scope.selectedTab  = "Information";
        $scope.show         = false;

         //-------------------------dirDataGrid1 for Shipping Line Paramaters-------------------------
        $scope.submitButtonText = "";
        $scope.submitButtonListener = false;
        $scope.isError = false;
        $scope.errorMessage = "";
        $scope.actionCreate = false; //default to false
        $scope.actionMode = "Create";//default to Create
        $scope.dataDefinition = {
                                    "Header": ['Name', 'Address', 'Status', 'No.'],
                                    "Keys": ['Name', 'Address', 'Status'],
                                    "Type": ['String', 'String', 'Maintenance'],
                                    "RequiredFields": ['Name-Name'],
                                    "DataList": [],
                                    "APIUrl": ['/subcontractor/shippingline/',//get
                                                '/subcontractor/shippingline' //CUD
                                    ],
                                    "DataItem": {},
                                    "DataTarget": "DataTableShippingLine",
                                    "ViewOnly": false,
                                    "ContextMenu": [],
                                    "ContextMenuLabel": []
                                };

        $scope.setSelectedTab = function (tab) {
            if($scope.dataDefinition.DataItem.Id != null)
            {
                $scope.selectedTab = tab; 
            }
        };

        $scope.showForm = function()
        {
            $scope.show = true;
        }

        $scope.closeForm = function()
        {
            $scope.show = false;
            $scope.isError = false;
            $scope.errorMessage = "";
            var element = document.getElementById("vesselGrid");
            if (element != null) {
                element.parentNode.removeChild(element);
            }
        }
        $scope.otherActions = function (action) {
            switch (action) {
                case 'PreSubmit':
                    if($scope.dataDefinition.DataItem.StatusHolder == true)
                        $scope.dataDefinition.DataItem.Status = 1;
                    else
                        $scope.dataDefinition.DataItem.Status = 0;
                    return true;
                case 'PostEditAction':
                    $scope.loadVessel();
                    return true;
                case 'PostViewAction':
                    $scope.loadVessel();
                    return true;
                case 'PostDeleteAction':
                    $scope.loadVessel();
                    return true;
                case 'PostAction':
                    if($scope.dataDefinition.DataItem.Status == 1)
                        $scope.dataDefinition.DataItem.StatusHolder = true;
                    else
                        $scope.dataDefinition.DataItem.StatusHolder = false;
                    return true;
                case 'PreSave':
                    delete $scope.dataDefinition.DataItem.Id;
                    return true;
                case 'PostSave':
                    $scope.setSelectedTab($scope.tabPages[1]);
                    $scope.loadVessel();
                    return true;
                case 'PostUpdate':
                    $scope.setSelectedTab($scope.tabPages[1]);
                    return true;
                default:
                    return true;
                    
            }
        };
        $scope.resetDataItem = function () {
            $scope.dataDefinition.DataItem = {
                "Id": null,
                "Name": null,
                "Address": null,
                "Status": 1
            }
        };
        $scope.showFormError = function (message) {
            $scope.isError = true;
            $scope.errorMessage = message;
        };
        //-------------------------End of dirDataGrid1 Shipping Line Parameters-------------------
        //----------Functions that are related to dirDataGrid1-----------------------
        $scope.submit = function () {
                $scope.submitButtonListener = true;
        };

        $scope.actionForm = function () {
            $scope.actionCreate = true;
        };
        //---------------------------------End----------------------------------------
    };
  
    $scope.loadVessel = function()
    {
        $scope.loadVesselDataGrid();
        $scope.initVesselParameters();
    };
    //Compile Vessel DataGrid
    $scope.loadVesselDataGrid = function()
    {
        var html = '', $content;
        html = '<div id="vesselGrid"><dir-data-grid1 actioncreate="actionCreateVessel"' +
                    'actionmode="actionModeVessel"' +
                    'datadefinition="dataDefinitionVessel"' +
                    'submitbuttontext="submitButtonTextVessel"' +
                    'submitbuttonlistener="submitButtonListenerVessel"' +
                    'closecontainer="closeVesselForm()"' + 
                    'opencontainer="showVesselForm()"' +
                    'otheractions="otherActionsVessel(action)"' +
                    'resetdata="resetVesselItem()"' +
                    'showformerror="showFormErrorVessel(error)">' +
                '</dir-data-grid1></div>'
        $content = angular.element(document.querySelector('#VesselDataGrid')).html(html);
        $compile($content)($scope);
    }

    $scope.initVesselParameters = function()
    {
        //-------------------------dirDataGrid1 for Vessel Paramaters-------------------------
        $scope.tabPagesVessel     = ['Information', 'Voyage', 'Attachments'];
        $scope.selectedTabVessel  = "Information";
        $scope.showVessel   = false;

        $scope.submitButtonTextVessel = "";
        $scope.submitButtonListenerVessel = false;
        $scope.isErrorVessel = false;
        $scope.errorMessageVessel = "";
        $scope.actionCreateVessel = false; //default to false
        $scope.actionModeVessel = "Create";//default to Create
        $scope.dataDefinitionVessel = {
                                    "Header": ['Name', 'Description', 'Status', 'No.'],
                                    "Keys": ['Name', 'Description', 'Status'],
                                    "Type": ['String', 'String', 'Maintenance'],
                                    "RequiredFields": ['Name-Name'],
                                    "DataList": [],
                                    "APIUrl": ['/subcontractor/vessel/ /' + $scope.dataDefinition.DataItem.Id,//get
                                                '/subcontractor/vessel' //CUD
                                    ],
                                    "DataItem": {},
                                    "DataTarget": "DataTableVessel",
                                    "ViewOnly": false,
                                    "ContextMenu": [],
                                    "ContextMenuLabel": []
                                };

        $scope.setSelectedTabVessel = function (tab) {
            if($scope.dataDefinitionVessel.DataItem.Id != null)
            {
                $scope.selectedTabVessel = tab; 
            }
        };

        $scope.showVesselForm = function()
        {
            $scope.showVessel = true;
        }

        $scope.closeVesselForm = function()
        {
            $scope.showVessel = false;
            $scope.isErrorVessel = false;
            $scope.errorMessageVessel = "";
            var element = document.getElementById("voyageGrid");
            if (element != null) {
                element.parentNode.removeChild(element);
            }
        }
        $scope.otherActionsVessel = function (action) {
            switch (action) {
                case 'PreSubmit':
                    if($scope.dataDefinitionVessel.DataItem.StatusHolder == true)
                        $scope.dataDefinitionVessel.DataItem.Status = 1;
                    else
                        $scope.dataDefinitionVessel.DataItem.Status = 0;
                    return true;
                case 'PostAction':
                    if($scope.dataDefinitionVessel.DataItem.Status == 1)
                        $scope.dataDefinitionVessel.DataItem.StatusHolder = true;
                    else
                        $scope.dataDefinitionVessel.DataItem.StatusHolder = false;
                    return true;
				case 'PostEditAction':
                    $scope.loadVoyage();
                    return true;
                case 'PostViewAction':
                    $scope.loadVoyage();
                    return true;
                case 'PostDeleteAction':
                    $scope.loadVoyage();
                    return true;
                case 'PreSave':
                    delete $scope.dataDefinitionVessel.DataItem.Id;
                    $scope.dataDefinitionVessel.DataItem.ShippingLineId = $scope.dataDefinition.DataItem.Id;
                    return true;
                case 'PostSave':
                    $scope.selectedTabVessel = $scope.tabPagesVessel[1];
					$scope.loadVoyage();
                    return true;
                case 'PostUpdate':
                    $scope.selectedTabVessel = $scope.tabPagesVessel[1];
                    return true;
                default:
                    return true;
                    
            }
        };
        $scope.resetVesselItem = function () {
            $scope.dataDefinitionVessel.DataItem = {
                "Id": null,
                "ShippingLineId": null,
                "Name": null,
                "Description": null,
                "Status": 1
            }
        };
        $scope.showFormErrorVessel = function (message) {
            $scope.isErrorVessel = true;
            $scope.errorMessageVessel = message;
        };
        //-------------------------End of dirDataGrid1 Vessel Parameters-------------------

        //----------Functions that are related to dirDataGrid1-----------------------

        $scope.submitVessel = function () {
            $scope.submitButtonListenerVessel = true;
        };

        $scope.actionFormVessel = function () {
            $scope.actionCreateVessel = true;
        };
        //---------------------------------End----------------------------------------
    };

	$scope.loadVoyage = function()
    {
        $scope.loadVoyageDataGrid();
        $scope.initVoyageParameters();
    };
    //Compile Voyage DataGrid
    $scope.loadVoyageDataGrid = function()
    {
        var html = '', $content;
        html = '<div id="voyageGrid"><dir-data-grid1 actioncreate="actionCreateVoyage"' +
                    'actionmode="actionModeVoyage"' +
                    'datadefinition="dataDefinitionVoyage"' +
                    'submitbuttontext="submitButtonTextVoyage"' +
                    'submitbuttonlistener="submitButtonListenerVoyage"' +
                    'closecontainer="closeVoyageForm()"' + 
                    'opencontainer="showVoyageForm()"' +
                    'otheractions="otherActionsVoyage(action)"' +
                    'resetdata="resetVoyageItem()"' +
                    'showformerror="showFormErrorVoyage(error)">' +
                '</dir-data-grid1></div>'
        $content = angular.element(document.querySelector('#VoyageDataGrid')).html(html);
        $compile($content)($scope);
    }

    $scope.initVoyageParameters = function()
    {
        //-------------------------dirDataGrid1 for Voyage Paramaters-------------------------
        $scope.tabPagesVoyage     	= ['Information'];
        $scope.selectedTabVoyage  	= "Information";
        $scope.showVoyage   		= false;

        $scope.submitButtonTextVoyage = "";
        $scope.submitButtonListenerVoyage = false;
        $scope.isErrorVoyage = false;
        $scope.errorMessageVoyage = "";
        $scope.actionCreateVoyage = false; //default to false
        $scope.actionModeVoyage = "Create";//default to Create
        $scope.dataDefinitionVoyage = {
                                    "Header": ['Estimated Departure', 'Estimated Arrival', 'Departure', 'Arrival', 'Status', 'No.'],
                                    "Keys": ['EstimatedDeparture', 'EstimatedArrival', 'Departure', 'Arrival', 'Status'],
                                    "Type": ['DateTime', 'DateTime', 'DateTime', 'DateTime', 'Maintenance'],
                                    "RequiredFields": ['EstimatedDeparture-Estimated Departure', 'EstimatedArrival-Estimated Arrival', 'Departure-Departure', 'Arrival-Arrival'],
                                    "DataList": [],
                                    "APIUrl": ['/subcontractor/vesselvoyage/ /' + $scope.dataDefinitionVessel.DataItem.Id,//get
                                                '/subcontractor/vesselvoyage' //CUD
                                    ],
                                    "DataItem": {},
                                    "DataTarget": "DataTableVoyage",
                                    "ViewOnly": false,
                                    "ContextMenu": [],
                                    "ContextMenuLabel": []
                                };

        $scope.setSelectedTabVoyage = function (tab) {
            if($scope.dataDefinitionVoyage.DataItem.Id != null)
            {
                $scope.selectedTabVoyage = tab; 
            }
        };

        $scope.showVoyageForm = function()
        {
            $scope.showVoyage = true;
        }

        $scope.closeVoyageForm = function()
        {
            $scope.showVoyage = false;
            $scope.isErrorVoyage = false;
            $scope.errorMessageVoyage = "";
        }
        $scope.otherActionsVoyage = function (action) {
            switch (action) {
                case 'PreSubmit':
                    if($scope.dataDefinitionVoyage.DataItem.StatusHolder == true)
                        $scope.dataDefinitionVoyage.DataItem.Status = 1;
                    else
                        $scope.dataDefinitionVoyage.DataItem.Status = 0;
                    return true;
                case 'PostAction':
                    if($scope.dataDefinitionVoyage.DataItem.Status == 1)
                        $scope.dataDefinitionVoyage.DataItem.StatusHolder = true;
                    else
                        $scope.dataDefinitionVoyage.DataItem.StatusHolder = false;
                    return true;
                case 'PreSave':
                    delete $scope.dataDefinitionVoyage.DataItem.Id;
                    $scope.dataDefinitionVoyage.DataItem.VesselId = $scope.dataDefinitionVessel.DataItem.Id;
                    return true;
                case 'PostSave':
                    $scope.showVoyage = false;
                    return true;
                case 'PostUpdate':
                    $scope.showVoyage = false;
                    return true;
                default:
                    return true;
                    
            }
        };
        $scope.resetVoyageItem = function () {
            $scope.dataDefinitionVoyage.DataItem = {
                "Id": null,
                "VesselId": null,
                "EstimatedDeparture": null,
                "EstimatedArrival": null,
				"Departure": null,
                "Arrival": null,
                "Status": 1
            }
        };
        $scope.showFormErrorVoyage = function (message) {
            $scope.isErrorVoyage = true;
            $scope.errorMessageVoyage = message;
        };
        //-------------------------End of dirDataGrid1 Voyage Parameters-------------------

        //----------Functions that are related to dirDataGrid1-----------------------

        $scope.submitVoyage = function () {
            $scope.submitButtonListenerVoyage = true;
        };

        $scope.actionFormVoyage = function () {
            $scope.actionCreateVoyage = true;
        };
        //---------------------------------End----------------------------------------
    };
	
    $rootScope.manipulateDOM();
    $scope.loadShippingLine(); 
}