@extends('layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
<script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.js" ></script>
<script stype="text/javascript">
    var ngDriversApp = angular.module('ngDriversApp', [], function($interpolateProvider)
    {$interpolateProvider.startSymbol('<%'); $interpolateProvider.endSymbol('%>'); });
    ngDriversApp.controller('ngDriversAppcontroller', function($scope) {
    $scope.user = [];
    
    $('#Drivers-form').Add({Type:'POST',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Drivers', ModuleItemName:'DriversItem', NgAppName:'ngDriversApp'});
    $('#Drivers-form').Edit({Type:'GET',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Drivers', ModuleItemName:'DriversItem', NgAppName:'ngDriversApp'});
    $('#Drivers-form').Delete({Type:'DELETE',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Drivers', ModuleItemName:'DriversItem', NgAppName:'ngDriversApp'});
    $('#Drivers-form').Submit({Type:'POST',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Drivers', ModuleItemName:'DriversItem', NgAppName:'ngDriversApp'});
    });</script>
@stop
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Manage Drivers</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                       <div class="col-md-8 col-sm-8 col-xs-7"><h2>Drivers's List</h2></div>
                       <div class="col-md-4 col-sm-4 col-xs-5">
                           <button class="btn btn-primary form-modal-button pull-right" data-toggle="modal" data-target=".form-modal">Add New Drivers</button>
                       </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                        <table class="table table-striped responsive-utilities jambo_table dataTable" id="Drivers-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all" class="flat"></th>
                                    <th>ID</th>
                                    <th>Name</th><th>N° phone</th><th>N° permit</th><th>Permit Category</th><th>Expiry Date</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Form modal -->
    <div class="modal fade form-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Drivers
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </h4>
                </div>
                <div class="modal-body">
                    <form  ng-app="ngDriversApp" ng-controller="ngDriversAppcontroller" id="Drivers-form" class="form-horizontal form-label-left" method="post" action='{!! route("Driverscreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}" />
                        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="DriversItem.name" type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="numb_phone"> N° phone <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="DriversItem.numb_phone" type="text" id="numb_phone" name="numb_phone" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="numb_premit"> N° permit <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="DriversItem.numb_premit" type="text" id="numb_premit" name="numb_premit" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_permit"> Permit Category <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="DriversItem.cat_permit" type="text" id="cat_permit" name="cat_permit" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="expiry_date"> Expiry Date <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="DriversItem.expiry_date" type="text" id="expiry_date" name="expiry_date" required="required" class="form-control col-md-7 col-xs-12" ></div></div>
                        <input ng-model='DriversItem.id' type="text" id="id" name="id" style="display: none" />
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
<script type="text/javascript">
            var ListTable;
            $(document).ready(function() {
            var ajaxAction=function(url,action){ $.ajax({url:url,type:action,data:{'_token':"{{ csrf_token()}}" ,'selected_rows':SelectedCheckboxes() },success:function(){ ListTable.ajax.reload(); }}); }
            var SelectedCheckboxes = function() { return $('input:checkbox:checked.Drivers_record').map(function () { return this.value; }).get(); }
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}','X-Requested-With': 'XMLHttpRequest'}
            });
            ListTable = $('#Drivers-table').DataTable({    
            dom: '<"row"<"col-sm-7 col-md-8"<"hidden-xs hidden-sm"l>B><"col-sm-5 col-md-4"f>><"row"<"col-sm-12 table-responsive"rt>><"row"<"col-sm-5"i><"col-sm-7"p>>',
                    processing: true,
                    serverSide: true,
                    ajax: { url:'{!! route("Driverslist") !!}' ,
                        headers: {'X-CSRF-TOKEN': '<?php echo csrf_token();?>'}
                    },
                    columns: [
                    {data: 'Select', name: 'Select',searchable:false,sortable:false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},{data: 'numb_phone', name: 'numb_phone'},{data: 'numb_premit', name: 'numb_premit'},{data: 'cat_permit', name: 'cat_permit'},{data: 'expiry_date', name: 'expiry_date'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', 'searchable':false}
                    ],
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print','colvis',
                        {  text: 'Delete',
                           action: function ( e, dt, node, config ) {   
                                var TrashItem = confirm('Are Your sure you want to Delete this Item/s');
                                if (TrashItem) {ajaxAction("{!! route('Driversdeletemultiple') !!}",'DELETE');}
                        }
                        }
                    ],
                    order: [[1, 'asc']],
                    drawCallback:function(){$('.dataTable input').iCheck({checkboxClass: 'icheckbox_flat-green'});}
            });
            $('body').on('ifToggled','#check-all', function (event) {
                    if($(this).is(':checked')){$('input.Drivers_record').iCheck('check'); } else	       { $('input.Drivers_record').iCheck('uncheck');}
            });
            });</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script>
@stop