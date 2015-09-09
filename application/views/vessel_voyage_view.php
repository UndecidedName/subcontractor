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
            <div class="col-lg-6">
              <form class="form-horizontal" role="form">
                <div class="form-group form-group-sm">
                    <label class="col-md-4 control-label small">Estimated Departure</label>
                    <div class="col-md-6">
                        <div class='input-group date'>
                            <input type='text'
                                   id='ed'
                                   class="form-control"
                                   ng-model="dataDefinitionVoyage.DataItem.EstimatedDeparture"
                                   ng-disabled="dataDefinitionVoyage.ViewOnly" />
                            <span class="input-group-addon" title="Close" style="padding:2px 10px 2px 10px;">
                                <span class=" glyphicon glyphicon-remove-circle"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label class="col-md-4 control-label small">Estimated Arrival</label>
                    <div class="col-md-6">
                        <div class='input-group date'>
                            <input type='text'
                                   id='ea'
                                   class="form-control"
                                   ng-model="dataDefinitionVoyage.DataItem.EstimatedArrival"
                                   ng-disabled="dataDefinitionVoyage.ViewOnly" />
                            <span class="input-group-addon" title="Close" style="padding:2px 10px 2px 10px;">
                                <span class=" glyphicon glyphicon-remove-circle"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="checkbox-custom">
                        <label for="isActive"
                               class="col-md-4 control-label small" style="padding-right: 20px;">Is Active?</label>
                        <input id="isActive"
                               type="checkbox"
                               style="width: 45px;"
                               ng-model="dataDefinitionVessel.DataItem.StatusHolder"
                               ng-disabled="dataDefinitionVoyage.ViewOnly">
                    </div>
                </div>
              </form>
            </div>
            <div class="col-lg-6">
              <form class="form-horizontal" role="form">
                <div class="form-group form-group-sm">
                      <label class="col-md-4 control-label small">Departure</label>
                      <div class="col-md-6">
                          <div class='input-group date'>
                              <input type='text'
                                     id='departure'
                                     class="form-control"
                                     ng-model="dataDefinitionVoyage.DataItem.Departure"
                                     ng-disabled="dataDefinitionVoyage.ViewOnly" />
                              <span class="input-group-addon" title="Close" style="padding:2px 10px 2px 10px;">
                                  <span class=" glyphicon glyphicon-remove-circle"></span>
                              </span>
                          </div>
                      </div>
                </div>
                <div class="form-group form-group-sm">
                      <label class="col-md-4 control-label small">Arrival</label>
                      <div class="col-md-6">
                          <div class='input-group date'>
                              <input type='text'
                                     id='arrival'
                                     class="form-control"
                                     ng-model="dataDefinitionVoyage.DataItem.Arrival"
                                     ng-disabled="dataDefinitionVoyage.ViewOnly" />
                              <span class="input-group-addon" title="Close" style="padding:2px 10px 2px 10px;">
                                  <span class=" glyphicon glyphicon-remove-circle"></span>
                              </span>
                          </div>
                      </div>
                </div>
              </form>
            </div>
          </div>
          <script type="text/javascript">
            $(function () {
              $('#ed').datetimepicker({
                  format: 'YYYY-MM-DD HH:mm:ss',
                  sideBySide: true,
                  //minDate: moment()
              })
               $('#ea').datetimepicker({
                  format: 'YYYY-MM-DD HH:mm:ss',
                  sideBySide: true,
                  //minDate: moment()
              })
               $('#departure').datetimepicker({
                  format: 'YYYY-MM-DD HH:mm:ss',
                  sideBySide: true,
                  //minDate: moment()
              })
               $('#arrival').datetimepicker({
                  format: 'YYYY-MM-DD HH:mm:ss',
                  sideBySide: true,
                  //minDate: moment()
              })
            });
          </script>
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
