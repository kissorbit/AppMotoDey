@extends('layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
<script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
<script src="{{asset('assets/js/angular.js')}}" ></script>
<script stype="text/javascript">
    var ngSettingsApp = angular.module('ngSettingsApp', [], function($interpolateProvider)
    {$interpolateProvider.startSymbol('<%'); $interpolateProvider.endSymbol('%>'); });
    ngSettingsApp.controller('ngSettingsAppcontroller', function($scope) {
    $scope.SettingsItem =[];
    $scope.SettingsItem = {!! $data['Settings'] !!}[0];
    $scope.$apply();
    });</script>
@stop
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>@lang('general_settings.module_title')</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>@lang('general_settings.module_form_title')</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form  ng-app="ngSettingsApp" ng-controller="ngSettingsAppcontroller" id="Settings-form" class="form-horizontal form-label-left" method="post" action='{!! route("GeneralSettingscreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}" />
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="registration"> Registration <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="radio" name="registration"  @if(Config::get('sysconfig.registration')) checked @endif value="true" > <span>Enable</span> 
                            <input type="radio" name="registration" @if(!Config::get('sysconfig.registration')) checked @endif value="false" > <span>Disable</span> 
                        </div>
                        </div>
                        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="crudbuilder"> CRUD Builder <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="radio" name="crudbuilder"  @if(Config::get('sysconfig.crudbuilder')) checked @endif value="true" > <span>show</span> <input type="radio" name="crudbuilder" @if(!Config::get('sysconfig.crudbuilder')) checked @endif   value="false" > <span>hide</span> </div></div>
                        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="filemanager"> File Manager <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="radio" name="filemanager"  @if(Config::get('sysconfig.filemanager')) checked @endif value="true" > <span>show</span> <input type="radio" name="filemanager"   @if(!Config::get('sysconfig.filemanager')) checked @endif value="false" > <span>hide</span> </div></div>
                        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="direction"> Direction <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="radio" name="direction"  value="ltr" @if(Config::get('sysconfig.direction')=='ltr') checked @endif> <span>LTR</span> <input type="radio" name="direction"  value="rtl" @if(Config::get('sysconfig.direction')=='rtl') checked @endif > <span>RTL</span> </div></div>
                        <input ng-model='SettingsItem.id' type="text" id="id" name="id" style="display: none" />
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="reset" class="btn btn-primary cancel">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')

@stop