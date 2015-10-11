﻿<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div style="{{filterdefinition.Multiple == true ? 'padding-top: 20px' : 'padding-top:0px'}}">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger" role="alert" ng-show="isErrorFiltering" style="padding-top:10px;">
                  <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ng-click="isErrorFiltering = false;errorMessageFiltering=''"></span>
                  <strong>Error:</strong>{{" " + errorMessageFiltering}}
            </div>
            <form class="form-horizontal" role="form">
                <div class="row" ng-show="filterdefinition.Multiple">
                    <strong>Filtered Data:</strong> <span ng-show="countFilteredCriteria == 0">None</span>
                </div>
                <!-- Filtered Data Container -->
                <div class="row" style="padding:10px 0px 0px 0px" ng-show="filterdefinition.Multiple">
                    <table>
                        <tr ng-repeat="data in filterdefinition.Source" ng-show="data.From != null">
                            <td style="width: 16px; height:16px; background-position-y: 5px; background-image: url('/subcontractor/images/delete.png'); background-size: 16px 14px; background-repeat: no-repeat;" ng-click="deleteFilteredData(data.Index)"></td>
                            <td style="padding-left: 20px;">{{data.Label}}</td>
                            <td style="padding: 0px 2px 0px 2px;">:</td>
                            <td style="padding-left: 20px;">{{(data.Type == 'Date' ? data.From + " - " + data.To : (data.Type == 'DropDown' || data.Type == 'Modal' ? data.To : data.From))}}</td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="form-group form-group-sm">
                        <!-- @*Criteria*@ -->
                        <div class="col-lg-3">
                            <select class="form-control"
                                    ng-click="setFilteredDataDefinition(criteriaIndex)"
                                    ng-model="criteriaIndex"
                                    ng-options="filter.Index as filter.Label for filter in filterdefinition.Source"></select>
                        </div>
                        <!-- @*Criteria input type*@ -->
                        <div class="col-lg-6">
                            <!-- @*Text field*@ -->
                            <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase ) == 'default' ? true : false">
                                <div class="col-md-12">
                                    <input id="searchValue"
                                           type="text"
                                           class="form-control"
                                           ng-model="searchValue" />
                                </div>
                            </div>
                            <!-- @*Modal*@ -->
                            <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase) == 'modal' ? true : false">
                                <div class="col-md-11">
                                    <input id="modal"
                                           type="text"
                                           class="form-control"
                                           ng-model="filteredData.Definition.To" />
                                   <!--  @*ng-click="showModalFilter()" />*@ -->
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-sm pull-right" title="Filter{{' ' + filteredData.Definition.Label}}" ng-click="showModalFilter()">
                                        <span class="glyphicons glyphicons-search" style="color:#4a89dc">
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <!-- @*Date*@ -->
                            <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase) == 'date' ? true : false">
                                <!-- @*From*@ -->
                                <div class="col-md-5">
                                    <div class='input-group date'>
                                        <input type='text'
                                               id='fromDate'
                                               placeholder="From"
                                               class="form-control"
                                               ng-model="fromDate" />
                                        <span class="input-group-addon" title="Close" style="padding:2px 10px 2px 10px;">
                                            <span class=" glyphicon glyphicon-remove-circle"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">_</div>
                                <!-- @*To*@ -->
                                <div class="col-md-5">
                                    <div class='input-group date'>
                                        <input type='text'
                                               id='toDate'
                                               placeholder="To"
                                               class="form-control"
                                               ng-model="toDate" />
                                        <span class="input-group-addon" title="Close" style="padding:2px 10px 2px 10px;">
                                            <span class=" glyphicon glyphicon-remove-circle"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- @*DropDown*@ -->
                            <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase) == 'dropdown' ? true : false">
                                <div class="col-md-12">
                                    <select class="form-control"
                                            ng-click="setSelectedDropDownData(dropDownValue)"
                                            ng-model="dropDownValue"
                                            ng-options="dd.Id as dd.Name for dd in filteredData.Definition.Values"></select>
                                </div>
                            </div>
                        </div>
                        <!-- @*Add Criteria/Search button*@ -->
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="{{filterdefinition.Multiple == true ? 'col-lg-8' : ''}}">
                                    <button class="btn btn-sm btn-primary" ng-click="addToFilteredList()" ng-show="filterdefinition.Multiple">Add Criteria</button>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-sm btn-primary"
                                            ng-click="search = true; submitFilteredData();"
                                            ng-disabled="(countFilteredCriteria > 0 || filterdefinition.Multiple == false ? false : true)">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#fromDate').datetimepicker({
                            format: 'MM/DD/YYYY',
                            sideBySide: false,
                            pickTime: false,
                            setDate: new Date(),
                            //minDate: moment()
                        })
                        $('#toDate').datetimepicker({
                            format: 'MM/DD/YYYY',
                            sideBySide: false,
                            pickTime: false,
                            setDate: new Date(),
                            //minDate: moment()
                        })
                    });
                </script>
            </form>
        </div>
    </div>
</div>