<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!-- Truck List -->
<div ng-show = "!showTruck">
    <div id="TruckDataGrid"></div>
</div>
<!-- End of Truck List -->

<!--Truck Details -->
<div class="row" ng-show="showTruck">
        <div class="col-lg-12">
                <ul class="nav nav-tabs">
                        <li ng-class="{active : selectedTabTruck === tab}"
                            ng-click="setSelectedTabTruck(tab)"
                            ng-repeat="tab in tabPagesTruck">
                            <a href="{{modelhref}}" data-toggle="tab">{{tab}}</a>
                        </li>
                </ul>
                <div class="tabbable">
                        <div class="tab-content">
                                <!--General -->
                                <div class="{{selectedTabTruck == tabPagesTruck[0] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTabTruck == tabPagesTruck[0]">
                                        <br/>
                                        <div class = "alert alert-danger alert-sm" ng-show="isErrorTruck">
                                               {{errorMessageTruck}}
                                        </div>
                                        <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="form-horizontal" role="form">
                                                        <div class="form-group form-group-sm">
                                                            <label class="col-md-1 control-label small">Name</label>
                                                            <div class="col-md-4">
                                                                <input type="text"
                                                                       class="form-control"
                                                                       placeholder=""
                                                                       ng-model="dataDefinitionTruck.DataItem.Name"
                                                                       ng-disabled="dataDefinitionTruck.ViewOnly"
                                                                       pattern=".{0,255}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group-sm">
                                                            <label class="col-md-1 control-label small">Type</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control"
                                                                        placeholder=""
                                                                        ng-model="dataDefinitionTruck.DataItem.Type"
                                                                        ng-disabled="dataDefinitionTruck.ViewOnly"
                                                                        ng-options="item.Id as item.Name for item in truckType"></select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group-sm">
                                                            <label class="col-md-1 control-label small">Description</label>
                                                            <div class="col-md-9">
                                                                <input type="text"
                                                                       class="form-control"
                                                                       placeholder=""
                                                                       ng-model="dataDefinitionTruck.DataItem.Description"
                                                                       ng-disabled="dataDefinitionTruck.ViewOnly"
                                                                       pattern=".{0,255}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="checkbox-custom">
                                                                <label for="isActive"
                                                                       class="small" style="padding-right: 20px;">Is Active?</label>
                                                                <input id="isActive"
                                                                       type="checkbox"
                                                                       ng-model="dataDefinitionTruck.DataItem.StatusHolder"
                                                                       ng-disabled="dataDefinitionTruck.ViewOnly">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                        </div>
                                </div>
                                <!--End of General -->

                                <!-- Truck Attachment-->
                                <div class="{{selectedTabTruck == tabPagesTruck[1] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTabTruck == tabPagesTruck[1]">
                                	<br/>
                                    <div ng-include="'/subcontractor/attachment/view'"></div>
                                </div>
                                <!--End of Truck Attachment-->
                        </div>
						<div ng-show = "selectedTabTruck == tabPagesTruck[0]" class="row">
							<hr></hr>
							<div class="row">
									<div class="col-md-12 text-right">
											<button class="btn btn-default text-right" ng-click="closeTruckForm()">Back</button>
											<button class="btn btn-primary text-right" ng-click="submitTruck()">{{submitButtonTextTruck}}</button>
									</div>
							</div>
						</div>
                </div>
        </div>
</div>
<!--End of Truck Details -->
