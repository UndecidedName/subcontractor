subconApp.controller("ShippingLineController", ShippingLineController);
function ShippingLineController($filter, $rootScope, $scope, $http, $compile, $interval)
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
        $content = angular.element(document.querySelector('#ShippingLineDataGrid')).html(html);
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
                                    "ContextMenu": ["'Load'", "'Create'", "'Edit'", "'Delete'", "'View'"],
                                    "ContextMenuLabel": ['Reload', 'Create', 'Edit', 'Delete', 'View']
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
            var element = document.getElementById("attachmentGrid");
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
                    $scope.loadAttachment();
                    return true;
                case 'PostViewAction':
                    $scope.loadVoyage();
                    $scope.loadAttachment();
                    return true;
                case 'PostDeleteAction':
                    $scope.loadVoyage();
                    $scope.loadAttachment();
                    return true;
                case 'PreSave':
                    delete $scope.dataDefinitionVessel.DataItem.Id;
                    $scope.dataDefinitionVessel.DataItem.ShippingLineId = $scope.dataDefinition.DataItem.Id;
                    return true;
                case 'PostSave':
                    $scope.selectedTabVessel = $scope.tabPagesVessel[1];
					$scope.loadVoyage();
                    $scope.loadAttachment();
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
                                    "ContextMenu": ["'Load'", "'Create'", "'Edit'", "'Delete'", "'View'"],
                                    "ContextMenuLabel": ['Reload', 'Create', 'Edit', 'Delete', 'View']
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
                    $scope.dataDefinitionVoyage.EstimatedDeparture  = $filter('date')(document.getElementById('ed').value, "yyyy-MM-dd HH:mm:ss");
                    $scope.dataDefinitionVoyage.EstimatedArrival    = $filter('date')(document.getElementById('ea').value, "yyyy-MM-dd HH:mm:ss");
                    $scope.dataDefinitionVoyage.Arrival             = $filter('date')(document.getElementById('arrival').value, "yyyy-MM-dd HH:mm:ss");
                    $scope.dataDefinitionVoyage.Departure           = $filter('date')(document.getElementById('departure').value, "yyyy-MM-dd HH:mm:ss");
                    
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
                                    "RequiredFields": [],
                                    "DataList": [],
                                    "APIUrl": ['/subcontractor/attachment/ /' + $scope.dataDefinitionVessel.DataItem.Id,//get
                                               '/subcontractor/attachment' //CUD
                                    ],
                                    "DataItem": {},
                                    "DataTarget": "DataTableAttachment",
                                    "ViewOnly": false,
                                    "ContextMenu": ["'Load'", "'Create'", "'Delete'", "'View'"],
                                    "ContextMenuLabel": ['Reload', 'Upload', 'Delete Attachment', 'Open Attachment']
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
                        $scope.dataDefinitionAttachment.DataItem.ReferenceId    = $scope.dataDefinitionVessel.DataItem.Id;
                        $scope.dataDefinitionAttachment.DataItem.Type           = "S";
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
                        url             : '/subcontractor/attachment/upload/shippingline', 
                        secureuri       : false,
                        fileElementId   : 'attachment',
                        dataType: 'JSON',
                        success : function (data)
                        {
                        }
                    });
                    return true;
                case 'PostViewAction':
                    var win = window.open("attachment/display/" + $scope.dataDefinitionAttachment.DataItem.FileName + "/S", '_blank');
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
    $scope.loadShippingLine(); 
}