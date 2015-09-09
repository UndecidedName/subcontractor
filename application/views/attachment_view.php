<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!-- Attachment List -->
<div ng-show = "!showAttachment">
    <div id="AttachmentDataGrid"></div>
</div>
<!-- End of Attachment List -->

<!--Attachment Details -->
<div class="row" ng-show="showAttachment">
  <div class="col-lg-12">
    <ul class="nav nav-tabs">
      <li ng-class="{active : selectedTabAttachment === tab}"
          ng-click="setSelectedTabAttachment(tab)"
          ng-repeat="tab in tabPagesAttachment">
          <a href="{{modelhref}}" data-toggle="tab">{{tab}}</a>
      </li>
    </ul>
    <div class="tabbable">
      <div class="tab-content">
        <!--General -->
        <div class="{{selectedTabAttachment == tabPagesAttachment[0] ? 'tab-pane active' : 'tab-pane active'}}" ng-show = "selectedTabAttachment == tabPagesAttachment[0]">
          <br/>
          <div class = "alert alert-danger alert-sm" ng-show="isErrorAttachment">
                 {{errorMessageAttachment}}
          </div>
          <div class="row">
              <div class="col-md-12 text-right" ng-show="!dataDefinitionAttachment.ViewOnly">
                <input type="file" name="attachment" id="attachment" size="20"/>
              </div>
              <div class="col-md-12 text-left" ng-show="dataDefinitionAttachment.ViewOnly">
                File Name: <label>{{dataDefinitionAttachment.DataItem.FileName}}</label><br>
                File Type: <label>{{(dataDefinitionAttachment.DataItem.Type == 'T' ? "Truck" : "Vessel")}}</label>
              </div>
          </div>
        </div>
        <!--End of General -->
      </div>
			<div ng-show = "selectedTabAttachment == tabPagesAttachment[0]" class="row">
				<hr></hr>
				<div class="row">
						<div class="col-md-12 text-right">
								<button class="btn btn-default text-right" ng-click="closeAttachmentForm()">Back</button>
								<button class="btn btn-primary text-right" ng-click="submitAttachment()">{{submitButtonTextAttachment}}</button>
						</div>
				</div>
			</div>
    </div>
  </div>
</div>
<!--End of Attachment Details -->
