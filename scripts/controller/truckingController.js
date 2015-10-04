subconApp.controller("TruckingController", TruckingController);
function TruckingController($filter, $rootScope, $scope, $http, $compile, $interval){
	$scope.modelhref    = '#/trucking';

	$scope.truckType = [{"Id": "1", "Name": "Small Trucks"},
						{"Id": "2", "Name": "Light Trucks"},
						{"Id": "3", "Name": "Medium Trucks"},
						{"Id": "4", "Name": "Heave Trucks"},
						{"Id": "5", "Name": "Very Heavy Trucks"},
						{"Id": "6", "Name": "Very Heavy Transporters"},
					   ]

    $scope.loadTrucking = function()
    {
        $scope.loadTruckingDataGrid();
        $scope.initTruckingParameters();
    }
    //Compile Trucking Data Grid
    $scope.loadTruckingDataGrid = function()
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
        $content = angular.element(document.querySelector('#TruckingDataGrid')).html(html);
        $compile($content)($scope);
    };
    $scope.initTruckingParameters = function()
    {
        $scope.tabPages     = ['Information', 'Truck'];
        $scope.selectedTab  = "Information";
        $scope.show         = false;

         //-------------------------dirDataGrid1 for Trucking Paramaters-------------------------
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
                                    "APIUrl": ['/subcontractor/trucking/',//get
                                                '/subcontractor/trucking' //CUD
                                    ],
                                    "DataItem": {},
                                    "DataTarget": "DataTableTrucking",
                                    "ViewOnly": false,
                                    "ContextMenu": ["'Load'", "'Create'", "'Edit'", "'Delete'", "'View'"],
                                    "ContextMenuLabel": ['Reload', 'Create', 'Edit', 'Delete', 'View']
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
            var element = document.getElementById("truckGrid");
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
                    $scope.loadTruck();
                    return true;
                case 'PostViewAction':
                    $scope.loadTruck();
                    return true;
                case 'PostDeleteAction':
                    $scope.loadTruck();
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
                    $scope.loadTruck();
                    return true;
                case 'PostUpdate':
                    $scope.show = false;
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
        //-------------------------End of dirDataGrid1 Trucking Parameters-------------------
        //----------Functions that are related to dirDataGrid1-----------------------
        $scope.submit = function () {
                $scope.submitButtonListener = true;
        };

        $scope.actionForm = function () {
            $scope.actionCreate = true;
        };
        //---------------------------------End----------------------------------------
    };

    $scope.loadTruck = function()
    {
        $scope.loadTruckDataGrid();
        $scope.initTruckParameters();
    };
    //Compile Truck DataGrid
    $scope.loadTruckDataGrid = function()
    {
        var html = '', $content;
        html = '<div id="truckGrid"><dir-data-grid1 actioncreate="actionCreateTruck"' +
                    'actionmode="actionModeTruck"' +
                    'datadefinition="dataDefinitionTruck"' +
                    'submitbuttontext="submitButtonTextTruck"' +
                    'submitbuttonlistener="submitButtonListenerTruck"' +
                    'closecontainer="closeTruckForm()"' + 
                    'opencontainer="showTruckForm()"' +
                    'otheractions="otherActionsTruck(action)"' +
                    'resetdata="resetTruckItem()"' +
                    'showformerror="showFormErrorTruck(error)">' +
                '</dir-data-grid1></div>'
        $content = angular.element(document.querySelector('#TruckDataGrid')).html(html);
        $compile($content)($scope);
    }

    $scope.initTruckParameters = function()
    {
        //-------------------------dirDataGrid1 for Truck Paramaters-------------------------
        $scope.tabPagesTruck     = ['Information', 'Attachments'];
        $scope.selectedTabTruck  = "Information";
        $scope.showTruck   = false;

        $scope.submitButtonTextTruck = "";
        $scope.submitButtonListenerTruck = false;
        $scope.isErrorTruck = false;
        $scope.errorMessageTruck = "";
        $scope.actionCreateTruck = false; //default to false
        $scope.actionModeTruck = "Create";//default to Create
        $scope.dataDefinitionTruck = {
                                    "Header": ['Name', 'Type', 'Description', 'Status', 'No.'],
                                    "Keys": ['Name', 'Type', 'Description', 'Status'],
                                    "Type": ['String', 'TruckType', 'String', 'Maintenance'],
                                    "RequiredFields": ['Name-Name', "Type-Type"],
                                    "DataList": [],
                                    "APIUrl": ['/subcontractor/truck/ /' + $scope.dataDefinition.DataItem.Id,//get
                                                '/subcontractor/truck' //CUD
                                    ],
                                    "DataItem": {},
                                    "DataTarget": "DataTableTruck",
                                    "ViewOnly": false,
                                    "ContextMenu": ["'Load'", "'Create'", "'Edit'", "'Delete'", "'View'"],
                                    "ContextMenuLabel": ['Reload', 'Create', 'Edit', 'Delete', 'View']
                                };

        $scope.setSelectedTabTruck = function (tab) {
            if($scope.dataDefinitionTruck.DataItem.Id != null)
            {
                $scope.selectedTabTruck = tab; 
            }
        };

        $scope.showTruckForm = function()
        {
            $scope.showTruck = true;
        }

        $scope.closeTruckForm = function()
        {
            $scope.showTruck = false;
            $scope.isErrorTruck = false;
            $scope.errorMessageTruck = "";
            var element = document.getElementById("attachmentGrid");
            if (element != null) {
                element.parentNode.removeChild(element);
            }
        }
        $scope.otherActionsTruck = function (action) {
            switch (action) {
            	case 'PostLoadAction':
            		return true;
                case 'PreSubmit':
                    if($scope.dataDefinitionTruck.DataItem.StatusHolder == true)
                        $scope.dataDefinitionTruck.DataItem.Status = 1;
                    else
                        $scope.dataDefinitionTruck.DataItem.Status = 0;
                    return true;
                case 'PostAction':
                    if($scope.dataDefinitionTruck.DataItem.Status == 1)
                        $scope.dataDefinitionTruck.DataItem.StatusHolder = true;
                    else
                        $scope.dataDefinitionTruck.DataItem.StatusHolder = false;
                    return true;
				case 'PostEditAction':
                    $scope.loadAttachment();
                    return true;
                case 'PostViewAction':
                    $scope.loadAttachment();
                    return true;
                case 'PostDeleteAction':
                    $scope.loadAttachment();
                    return true;
                case 'PreSave':
                    delete $scope.dataDefinitionTruck.DataItem.Id;
                    $scope.dataDefinitionTruck.DataItem.TruckingId = $scope.dataDefinition.DataItem.Id;
                    return true;
                case 'PostSave':
                    $scope.selectedTabTruck = $scope.tabPagesTruck[1];
                    $scope.loadAttachment();
                    return true;
                case 'PostUpdate':
                    $scope.showTruck = false;
                    return true;
                default:
                    return true;
                    
            }
        };
        $scope.resetTruckItem = function () {
            $scope.dataDefinitionTruck.DataItem = {
                "Id": null,
                "Type": null,
                "TruckingId": null,
                "Name": null,
                "Description": null,
                "Status": 1
            }
        };
        $scope.showFormErrorTruck = function (message) {
            $scope.isErrorTruck = true;
            $scope.errorMessageTruck = message;
        };
        //-------------------------End of dirDataGrid1 Truck Parameters-------------------

        //----------Functions that are related to dirDataGrid1-----------------------

        $scope.submitTruck = function () {
            $scope.submitButtonListenerTruck = true;
        };

        $scope.actionFormTruck = function () {
            $scope.actionCreateTruck = true;
        };
        //---------------------------------End----------------------------------------
    };

    $scope.loadAttachment = function()
    {
        $scope.loadAttachmentDataGrid();
        $scope.initAttachmentParameters();
    };
    //Compile Attachment DataGrid
    $scope.loadAttachmentDataGrid = function()
    {
        var html = '', $content;
        html = '<div id="attachmentGrid"><dir-data-grid1 actioncreate="actionCreateAttachment"' +
                    'actionmode="actionModeAttachment"' +
                    'datadefinition="dataDefinitionAttachment"' +
                    'submitbuttontext="submitButtonTextAttachment"' +
                    'submitbuttonlistener="submitButtonListenerAttachment"' +
                    'closecontainer="closeAttachmentForm()"' + 
                    'opencontainer="showAttachmentForm()"' +
                    'otheractions="otherActionsAttachment(action)"' +
                    'resetdata="resetAttachmentItem()"' +
                    'showformerror="showFormErrorAttachment(error)">' +
                '</dir-data-grid1></div>';
        $content = angular.element(document.querySelector('#AttachmentDataGrid')).html(html);
        $compile($content)($scope);
    }

    $scope.initAttachmentParameters = function()
    {
        //-------------------------dirDataGrid1 for Attachment Paramaters-------------------------
        $scope.tabPagesAttachment     = ['Information'];
        $scope.selectedTabAttachment  = "Information";
        $scope.showAttachment   = false;

        $scope.submitButtonTextAttachment = "";
        $scope.submitButtonListenerAttachment = false;
        $scope.isErrorAttachment = false;
        $scope.errorMessageAttachment = "";
        $scope.actionCreateAttachment = false; //default to false
        $scope.actionModeAttachment = "Create";//default to Create
        $scope.dataDefinitionAttachment = {
                                    "Header": ['File Name', 'No.'],
                                    "Keys": ['FileName'],
                                    "Type": ['String'],
                                    //"RequiredFields": ['FileName-File Name'],
                                    "RequiredFields": [],
                                    "DataList": [],
                                    "APIUrl": ['/subcontractor/attachment/ /' + $scope.dataDefinitionTruck.DataItem.Id,//get
                                               '/subcontractor/attachment' //CUD
                                    ],
                                    "DataItem": {},
                                    "DataTarget": "DataTableAttachment",
                                    "ViewOnly": false,
                                    "ContextMenu": ["'Load'", "'Create'", "'Delete'", "'View'"],
                                    "ContextMenuLabel": ['Reload', 'New Attachment', 'Delete Attachment', 'Open Attachment']
                                };

        $scope.setSelectedTabAttachment = function (tab) {
            if($scope.dataDefinitionAttachment.DataItem.Id != null)
            {
                $scope.selectedTabAttachment = tab; 
            }
        };

        $scope.showAttachmentForm = function()
        {
            $scope.showAttachment = true;
        };

        $scope.closeAttachmentForm = function()
        {
            $scope.showAttachment = false;
            $scope.isErrorAttachment = false;
            $scope.errorMessageAttachment = "";
        };

        $scope.otherActionsAttachment = function (action) {
            switch (action) {
                case 'PreSave':
                    var attachment = document.getElementById('attachment').files[0];
                    if(angular.isDefined(attachment))
                    {
                        $scope.dataDefinitionAttachment.DataItem.FileName       = attachment.name;
                        $scope.dataDefinitionAttachment.DataItem.ReferenceId    = $scope.dataDefinitionTruck.DataItem.Id;
                        $scope.dataDefinitionAttachment.DataItem.Type           = "T";
                    }
                    else
                    {
                        $scope.isErrorAttachment = true;
                        $scope.errorMessageAttachment = "Attachment is required.";  
                    }
                    return true;
                case 'PostSave':
                    $scope.showAttachment = false;
                    $.ajaxFileUpload({
                        url             : '/subcontractor/attachment/upload/trucking', 
                        secureuri       : false,
                        fileElementId   : 'attachment',
                        dataType: 'JSON',
                        success : function (data)
                        {

                        },
                        error : function(error, status)
                        {
                            $scope.isErrorAttachment = true;
                            $scope.errorMessageAttachment = status; 
                        }
                    });
                    return true;
                case 'PostViewAction':
                    var win = window.open("attachment/display/" + $scope.dataDefinitionAttachment.DataItem.FileName + "/T", '_blank');
                    win.focus();
                    $scope.closeAttachmentForm();
                    return true;
                default:
                    return true;
            }
        };
        $scope.resetAttachmentItem = function () {
            $scope.dataDefinitionAttachment.DataItem = {
                "Id": null,
                "ReferenceId": null,
                "Type": null,
                "FileName": null,
                "FilePath": null
            }
        };
        $scope.showFormErrorAttachment = function (message) {
            $scope.isErrorAttachment = true;
            $scope.errorMessageAttachment = message;
        };
        //-------------------------End of dirDataGrid1 Attachment Parameters-------------------

        //----------Functions that are related to dirDataGrid1-----------------------

        $scope.submitAttachment = function () {
            $scope.submitButtonListenerAttachment = true;
        };

        $scope.actionFormAttachment = function () {
            $scope.actionCreateAttachment = true;
        };
        //---------------------------------End----------------------------------------
    };

    $rootScope.manipulateDOM();
    $scope.loadTrucking(); 
}