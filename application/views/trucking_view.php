<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div class="row">
        <h4 style= "padding-left:15px;">Trucking</div>
</div>

<!-- Trucking List -->
<div ng-show = "!show">
    <div id="TruckingDataGrid"></div>
</div>
<!-- End of Trucking List -->

<!--Trucking Details -->
<div class="row" ng-show="show">
        <div class="col-lg-12">
                <ul class="nav nav-tabs">
                        <li ng-class="{active : selectedTab === tab}"
                            ng-click="setSelectedTab(tab)"
                            ng-repeat="tab in tabPages">
                            <a href="{{modelhref}}" data-toggle="tab">{{tab}}</a>
                        </li>
                </ul>
                <div class="tabbable">
                        <div class="tab-content">
                                <!--General -->
                                <div class="{{selectedTab == tabPages[0] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTab == tabPages[0]">
                                        <br/>
                                        <div class = "alert alert-danger alert-sm" ng-show="isError">
                                               {{errorMessage}}
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
                                                                       ng-model="dataDefinition.DataItem.Name"
                                                                       ng-disabled="dataDefinition.ViewOnly"
                                                                       pattern=".{0,255}"
                                                                       ng-change="initializeHeaderName()">
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group-sm">
                                                            <label class="col-md-1 control-label small">Address</label>
                                                            <div class="col-md-9">
                                                                <input type="text"
                                                                       class="form-control"
                                                                       placeholder=""
                                                                       ng-model="dataDefinition.DataItem.Address"
                                                                       ng-disabled="dataDefinition.ViewOnly"
                                                                       pattern=".{0,255}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="checkbox-custom">
                                                                <label for="isActive"
                                                                       class="small" style="padding-right: 20px;">Is Active?</label>
                                                                <input id="isActive"
                                                                       type="checkbox"
                                                                       ng-model="dataDefinition.DataItem.StatusHolder"
                                                                       ng-disabled="dataDefinition.ViewOnly">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                        </div>
                                </div>
                                <!--End of General -->

                                <!-- Truck Information-->
                                <div class="{{selectedTab == tabPages[1] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTab == tabPages[1]">
                                    <br/>
                                    <div ng-include="'/subcontractor/truck/view'"></div>
                                </div>
                                <!-- End of Trucking Information-->
                        </div>
                        <div ng-show = "selectedTab == tabPages[0]" class="row">
							<hr></hr>
							<div class="col-md-12 text-right">
									<button class="btn btn-default text-right" ng-click="closeForm()">Back</button>
									<button class="btn btn-primary text-right" ng-click="submit()">{{submitButtonText}}</button>
							</div>
                        </div>
                </div>
        </div>
</div>
<!--End of Trucking Details -->
