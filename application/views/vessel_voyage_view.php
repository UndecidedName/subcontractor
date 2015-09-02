<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!-- Vessel Voyage List -->
<div ng-show = "!showVoyage">
    <div id="VoyageDataGrid"></div>
</div>
<!-- End of Vessel Voyage List -->

<!-- Voyage Details -->
<div class="row" ng-show="showVoyage">
        <div class="col-lg-12">
                <ul class="nav nav-tabs">
                        <li ng-class="{active : selectedTabVoyage === tab}"
                            ng-click="setSelectedTabVoyage(tab)"
                            ng-repeat="tab in tabPagesVoyage">
                            <a href="{{modelhref}}" data-toggle="tab">{{tab}}</a>
                        </li>
                </ul>
                <div class="tabbable">
                        <div class="tab-content">
                                <!--General -->
                                <div class="{{selectedTabVoyage == tabPagesVoyage[0] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTabVoyage == tabPagesVoyage[0]">
                                        <br/>
                                        <div class = "alert alert-danger alert-sm" ng-show="isErrorVoyage">
                                               {{errorMessageVoyage}}
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
                        </div>
                        <div ng-show = "selectedTabVoyage == tabPages[0]" class="row">
                        <hr></hr>
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-default text-right" ng-click="closeVoyageForm()">Back</button>
                                        <button class="btn btn-primary text-right" ng-click="submitVoyage()">{{submitButtonTextVoyage}}</button>
                                </div>
                        </div>
                </div>
        </div>
</div>
<!--End of Voyage Details -->
