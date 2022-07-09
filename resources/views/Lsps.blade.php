@extends('layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
<script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.js" ></script>
<script stype="text/javascript">
    var ngLspsApp = angular.module('ngLspsApp', [], function($interpolateProvider)
    {$interpolateProvider.startSymbol('<%'); $interpolateProvider.endSymbol('%>'); });
    ngLspsApp.controller('ngLspsAppcontroller', function($scope) {
    $scope.user = [];
    
    $('#Lsps-form').Add({Type:'POST',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Lsps', ModuleItemName:'LspsItem', NgAppName:'ngLspsApp'});
    $('#Lsps-form').Edit({Type:'GET',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Lsps', ModuleItemName:'LspsItem', NgAppName:'ngLspsApp'});
    $('#Lsps-form').Delete({Type:'DELETE',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Lsps', ModuleItemName:'LspsItem', NgAppName:'ngLspsApp'});
    $('#Lsps-form').Submit({Type:'POST',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Lsps', ModuleItemName:'LspsItem', NgAppName:'ngLspsApp'});
    });</script>
@stop
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Manage LSP's</h3>
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
                       <div class="col-md-8 col-sm-8 col-xs-7"><h2>LSP's List</h2></div>
                       <div class="col-md-4 col-sm-4 col-xs-5">
                           <button class="btn btn-primary form-modal-button pull-right" data-toggle="modal" data-target=".form-modal">Add New LSP's</button>
                       </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                        <table class="table table-striped responsive-utilities jambo_table dataTable" id="Lsps-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all" class="flat"></th>
                                    <th>ID</th>
                                    <th>Company name Lsp</th><th>Company addresse LSP</th><th>Name LSP</th><th>First Name LSP</th><th>Email LSP</th><th>Phone LSP</th><th>Country LSP</th><th>City / Town</th>
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
                    <h4 class="modal-title" id="myLargeModalLabel">Lsps
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </h4>
                </div>
                <div class="modal-body">
                    <form  ng-app="ngLspsApp" ng-controller="ngLspsAppcontroller" id="Lsps-form" class="form-horizontal form-label-left" method="post" action='{!! route("Lspscreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}" />
                        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="compagny_name_lsp"> Company name Lsp <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.compagny_name_lsp" type="text" id="compagny_name_lsp" name="compagny_name_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="compagny_address_lsp"> Company addresse LSP <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.compagny_address_lsp" type="text" id="compagny_address_lsp" name="compagny_address_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_lsp"> Name LSP <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.name_lsp" type="text" id="name_lsp" name="name_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name_lsp"> First Name LSP <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.first_name_lsp" type="text" id="first_name_lsp" name="first_name_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_lsp"> Email LSP <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.email_lsp" type="text" id="email_lsp" name="email_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_lsp"> Phone LSP <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.phone_lsp" type="text" id="phone_lsp" name="phone_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="country_lsp"> Country LSP <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.country_lsp" type="text" id="country_lsp" name="country_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="city_lsp"> City LSP <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="LspsItem.city_lsp" type="text" id="city_lsp" name="city_lsp" required="required" class="form-control col-md-7 col-xs-12" ></div></div>
                        <input ng-model='LspsItem.id' type="text" id="id" name="id" style="display: none" />
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
            var SelectedCheckboxes = function() { return $('input:checkbox:checked.Lsps_record').map(function () { return this.value; }).get(); }
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}','X-Requested-With': 'XMLHttpRequest'}
            });
            ListTable = $('#Lsps-table').DataTable({    
            dom: '<"row"<"col-sm-7 col-md-8"<"hidden-xs hidden-sm"l>B><"col-sm-5 col-md-4"f>><"row"<"col-sm-12 table-responsive"rt>><"row"<"col-sm-5"i><"col-sm-7"p>>',
                    processing: true,
                    serverSide: true,
                    ajax: { url:'{!! route("Lspslist") !!}' ,
                        headers: {'X-CSRF-TOKEN': '<?php echo csrf_token();?>'}
                    },
                    columns: [
                    {data: 'Select', name: 'Select',searchable:false,sortable:false},
                    {data: 'id', name: 'id'},
                    {data: 'compagny_name_lsp', name: 'compagny_name_lsp'},{data: 'compagny_address_lsp', name: 'compagny_address_lsp'},{data: 'name_lsp', name: 'name_lsp'},{data: 'first_name_lsp', name: 'first_name_lsp'},{data: 'email_lsp', name: 'email_lsp'},{data: 'phone_lsp', name: 'phone_lsp'},{data: 'country_lsp', name: 'country_lsp'},{data: 'city_lsp', name: 'city_lsp'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', 'searchable':false}
                    ],
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print','colvis',
                        {  text: 'Delete',
                           action: function ( e, dt, node, config ) {   
                                var TrashItem = confirm('Are Your sure you want to Delete this Item/s');
                                if (TrashItem) {ajaxAction("{!! route('Lspsdeletemultiple') !!}",'DELETE');}
                        }
                        }
                    ],
                    order: [[1, 'asc']],
                    drawCallback:function(){$('.dataTable input').iCheck({checkboxClass: 'icheckbox_flat-green'});}
            });
            $('body').on('ifToggled','#check-all', function (event) {
                    if($(this).is(':checked')){$('input.Lsps_record').iCheck('check'); } else	       { $('input.Lsps_record').iCheck('uncheck');}
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