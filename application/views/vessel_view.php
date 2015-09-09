<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!-- Vessel List -->
<div ng-show = "!showVessel">
    <div id="VesselDataGrid"></div>
</div>
<!-- End of Vessel List -->

<!--Vessel Details -->
<div class="row" ng-show="showVessel">
        <div class="col-lg-12">
                <ul class="nav nav-tabs">
                        <li ng-class="{active : selectedTabVessel === tab}"
                            ng-click="setSelectedTabVessel(tab)"
                            ng-repeat="tab in tabPagesVessel">
                            <a href="{{modelhref}}" data-toggle="tab">{{tab}}</a>
                        </li>
                </ul>
                <div class="tabbable">
                        <div class="tab-content">
                                <!--General -->
                                <div class="{{selectedTabVessel == tabPagesVessel[0] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTabVessel == tabPagesVessel[0]">
                                        <br/>
                                        <div class = "alert alert-danger alert-sm" ng-show="isErrorVessel">
                                               {{errorMessageVessel}}
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
                                                                       ng-model="dataDefinitionVessel.DataItem.Name"
                                                                       ng-disabled="dataDefinitionVessel.ViewOnly"
                                                                       pattern=".{0,255}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group-sm">
                                                            <label class="col-md-1 control-label small">Description</label>
                                                            <div class="col-md-9">
                                                                <input type="text"
                                                                       class="form-control"
                                                                       placeholder=""
                                                                       ng-model="dataDefinitionVessel.DataItem.Description"
                                                                       ng-disabled="dataDefinitionVessel.ViewOnly"
                                                                       pattern=".{0,255}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="checkbox-custom">
                                                                <label for="isActive"
                                                                       class="small" style="padding-right: 20px;">Is Active?</label>
                                                                <input id="isActive"
                                                                       type="checkbox"
                                                                       ng-model="dataDefinitionVessel.DataItem.StatusHolder"
                                                                       ng-disabled="dataDefinitionVessel.ViewOnly">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                        </div>
                                </div>
                                <!--End of General -->

                                <!-- Vessel Voyage-->
                                <div class="{{selectedTabVessel == tabPagesVessel[1] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTabVessel == tabPagesVessel[1]">
                                	<br/>
                                    <div ng-include="'/subcontractor/vesselvoyage/view'"></div>
                                </div>
                                <!--End of Vessel Voyage-->

                                <!-- Vessel Attachment-->
                                <div class="{{selectedTabVessel == tabPagesVessel[2] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTabVessel == tabPagesVessel[2]">
                                	<br/>
                                    <div ng-include="'/subcontractor/attachment/view'"></div>
                                </div>
                                <!--End of Vessel Attachment-->
                        </div>
						<div ng-show = "selectedTabVessel == tabPagesVessel[0]" class="row">
							<hr></hr>
							<div class="row">
									<div class="col-md-12 text-right">
											<button class="btn btn-default text-right" ng-click="closeVesselForm()">Back</button>
											<button class="btn btn-primary text-right" ng-click="submitVessel()">{{submitButtonTextVessel}}</button>
									</div>
							</div>
						</div>
                </div>
        </div>
</div>
<!--End of Vessel Details -->
