<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
        <h4 style= "padding-left:15px;">Shipping Line Report</div>
</div>

<!-- Shipping Line Report List -->
<div style="padding:0px 10px 0px 10px">
    <div class="text-right toggle-hide" ng-click="hideShippingLineToggle()" ng-show="shippingLineToggle">Hide</div>
    <div id="shippingLineToggle">
        <div id="shippingLineFilterContainter" style="padding-left:15px;"></div>
    </div><br>
    <div id="shippingLineContainer"></div>
</div>