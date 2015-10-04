<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--Data Table Content-->
<div ui-grid="gridOptions" class="grid" ng-style="{ 'height': height }"  ui-grid-auto-resize ui-grid-resize-columns ui-grid-move-columns ui-grid-exporter></div><br />
<!--Pagination Buttons-->
<div class="myTableContainter padding-left-10">
    <div class="myTableContent">
        <div class="myTableRow-no-border text-right">
            <div class="myTableCell-no-padding text-left small">
                <button class="btn btn-primary btn-sm"
                        type="button"
                        ng-click="actionForm('Create')">
                    Create
                </button>
            </div>
            <!--
            <div class="btn-group btn-group-sm">
                <div class="myTableCell-no-padding text-right small">
                    <button class="btn btn-primary btn-sm"
                            type="button"
                            ng-click="loadData(currentPage = (currentPage - 1))"
                            ng-disabled="!isPrevPage">
                        Previous
                    </button>
                </div>
                <div class="myTableCell-no-padding text-right small">
                    <button class="btn btn-default btn-sm"
                            type="button"
                            ng-disabled="true">
                        {{ currentPage }}
                    </button>
                </div>
                <div class="myTableCell-no-padding text-right small">
                    <button class="btn btn-primary btn-sm"
                            type="button"
                            ng-click="loadData(currentPage = (currentPage + 1))"
                            ng-disabled="!isNextPage">
                        Next
                    </button>
                </div>
            </div>
            -->
        </div>
    </div>
</div><br />
<!--Context Menu-->
<div class="dropdown position-fixed" id="{{datadefinition.DataTarget}}">    
</div>
