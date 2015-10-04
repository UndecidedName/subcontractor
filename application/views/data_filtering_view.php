<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div style="padding-top: 20px">
    <fieldset class="scheduler-border">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger alert-sm" ng-show="isErrorFiltering" style="padding-top:10px;">
                    <i class="fa fa-remove pr10"></i>
                    <strong>ERROR!</strong>{{" " + errorMessageFiltering}}
                </div>
                <form class="form-horizontal" role="form">
                    <div class="row">
                        <strong>Filtered Data:</strong> <span ng-show="countFilteredCriteria == 0">None</span>
                    </div>
                    <div class="row" style="padding:10px 0px 0px 0px">
                        <table>
                            <tr ng-repeat="data in filterdefinition.Source" ng-show="data.From != null">
                                <td style="width: 16px; height:16px; background-position-y: 5px; background-image: url('/images/delete.png'); background-size: 16px 14px; background-repeat: no-repeat;" ng-click="deleteFilteredData(data.Index)"></td>
                                <td style="padding-left: 20px;">{{data.Label}}</td>
                                <td style="padding: 0px 2px 0px 2px;">:</td>
                                <td style="padding-left: 20px;">{{(data.Type == 'Date' ? data.From + " - " + data.To : (data.Type == 'DropDown' || data.Type == 'Modal' ? data.To : data.From))}}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group form-group-sm">
                            <div class="col-lg-3">
                                <select class="form-control"
                                        ng-click="setFilteredDataDefinition(criteriaIndex)"
                                        ng-model="criteriaIndex"
                                        ng-options="filter.Index as filter.Label for filter in filterdefinition.Source | filter: { From: null}"></select>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase ) == 'default' && filteredData.Definition.From == null ? true : false">
                                    <div class="col-md-12">
                                        <input id="searchValue"
                                               type="text"
                                               class="form-control"
                                               ng-model="searchValue" />
                                    </div>
                                </div>
                                <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase) == 'modal' && filteredData.Definition.From == null ? true : false">
                                    <div class="col-md-11">
                                        <input id="modal"
                                               type="text"
                                               class="form-control"
                                               ng-model="filteredData.Definition.To" />
                                    </div>
                                    <div class="col-md-1" ng-click="showModalFilter()">
                                        <span class="glyphicon glyphicon glyphicon-search" style="font-size: 20px; padding-top:5px;"></span>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase) == 'date' && filteredData.Definition.From == null ? true : false">
                                    <div class="col-md-6">
                                        <div class='input-group date'>
                                            <input type='text'
                                                   id='fromDate'
                                                   placeholder="From"
                                                   class="form-control"
                                                   ng-model="fromDate" />
                                            <span class="input-group-addon" title="Close" style="padding:2px 0 2px 10px;">
                                                <span class=" glyphicon glyphicon-remove-circle"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class='input-group date'>
                                            <input type='text'
                                                   id='toDate'
                                                   placeholder="To"
                                                   class="form-control"
                                                   ng-model="toDate" />
                                            <span class="input-group-addon" title="Close" style="padding:2px 0 2px 10px;">
                                                <span class=" glyphicon glyphicon-remove-circle"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm" ng-show="(filteredData.Definition.Type | lowercase) == 'dropdown' && filteredData.Definition.From == null ? true : false">
                                    <div class="col-md-12">
                                        <select class="form-control"
                                                ng-click="setSelectedDropDownData(dropDownValue)"
                                                ng-model="dropDownValue"
                                                ng-options="dd.Id as dd.Name for dd in filteredData.Definition.Values"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <button class="btn btn-sm btn-primary" ng-click="addToFilteredList()">Add Criteria</button>
                                    </div>
                                    <div class="col-lg-4">
                                        <button class="btn btn-sm btn-success"
                                                ng-click="search = true; submitFilteredData();"
                                                ng-disabled="(countFilteredCriteria > 0 ? false : true)">
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
    </fieldset>
</div>