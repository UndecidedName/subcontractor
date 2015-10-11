<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
        <h4 style= "padding-left:15px;">Trucking Report</div>
</div>

<!-- Trucking Report List -->
<div style="padding:0px 10px 0px 10px">
    <div class="text-right toggle-hide" ng-click="hideTruckingToggle()" ng-show="truckingToggle">Hide</div>
    <div id="truckingToggle">
        <div id="truckingFilterContainter" style="padding-left:15px;"></div>
    </div><br>
    <div id="truckingContainer"></div>
</div>