<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Data Table Content-->
<div context-menu="" data-target="{{datadefinition.DataTarget2}}">
    <div ui-grid="gridOptions" class="grid" ng-style="{ 'height': height }" ui-grid-edit ui-grid-auto-resize ui-grid-resize-columns ui-grid-move-columns ui-grid-exporter></div><br />
    <!--Pagination Buttons-->
    <div class="myTableContainter padding-left-10">
        <div class="myTableContent">
            <div class="myTableRow-no-border text-right">
                <div class="myTableCell-no-padding text-left small" ng-show="datadefinition.ShowCreate">
                    <button class="btn btn-primary btn-sm"
                            type="button"
                            ng-click="actionForm('Create')">
                        Create
                    </button>
                </div>
                <div class="btn-group btn-group-sm" ng-show="datadefinition.EnablePagination">
                    <div class="myTableCell-no-padding text-right small">
                        <button class="btn btn-primary btn-sm"
                                type="button"
                                ng-click="loadData((datadefinition.CurrentPage - 1))"
                                ng-disabled="!isPrevPage">
                            Previous
                        </button>
                    </div>
                    <div class="myTableCell-no-padding text-right small">
                        <button class="btn btn-default btn-sm"
                                type="button"
                                ng-disabled="true">
                            {{ datadefinition.CurrentPage }}
                        </button>
                    </div>
                    <div class="myTableCell-no-padding text-right small">
                        <button class="btn btn-primary btn-sm"
                                type="button"
                                ng-click="loadData((datadefinition.CurrentPage + 1))"
                                ng-disabled="!isNextPage">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div><br />
    <!--Context Menu-->
    <div ng-show="datadefinition.ShowContextMenu" class="dropdown position-fixed" id="{{datadefinition.DataTarget}}">
    </div>

    <!-- @*Context Menu if DataList is empty*@ -->
    <div ng-show="datadefinition.DataList.length == 0 && datadefinition.ShowContextMenu" class="dropdown position-fixed" id="{{datadefinition.DataTarget2}}">
        <ul class="dropdown-menu" role="menu">
            <li>
                <a class="pointer small" role="menuitem" tabindex="0" ng-click="otheractions({action: 'Find'})">Find</a>
            </li>
            <li>
                <a class="pointer small" role="menuitem" tabindex="1" ng-click="actionForm('Create')">Create</a>
            </li>
        </ul>
    </div>
</div>