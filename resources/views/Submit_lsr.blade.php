@extends('layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/datatables/tools/css/dataTables.tableTools.css'); ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('assets/css/custom.css'); ?>" />
<script type="text/javascript" src="<?php echo asset('assets/js/ng-form-plugin.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.js" ></script>
<script stype="text/javascript">
    var ngSubmit_lsrApp = angular.module('ngSubmit_lsrApp', [], function($interpolateProvider)
    {$interpolateProvider.startSymbol('<%'); $interpolateProvider.endSymbol('%>'); });
    ngSubmit_lsrApp.controller('ngSubmit_lsrAppcontroller', function($scope) {
    $scope.user = [];
    
    $('#Submit_lsr-form').Add({Type:'POST',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Submit_lsr', ModuleItemName:'Submit_lsrItem', NgAppName:'ngSubmit_lsrApp'});
    $('#Submit_lsr-form').Edit({Type:'GET',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Submit_lsr', ModuleItemName:'Submit_lsrItem', NgAppName:'ngSubmit_lsrApp'});
    $('#Submit_lsr-form').Delete({Type:'DELETE',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Submit_lsr', ModuleItemName:'Submit_lsrItem', NgAppName:'ngSubmit_lsrApp'});
    $('#Submit_lsr-form').Submit({Type:'POST',Headers:{'X-CSRF-TOKEN':'<?php echo csrf_token();?>'}, ModuleName:'Submit_lsr', ModuleItemName:'Submit_lsrItem', NgAppName:'ngSubmit_lsrApp'});
    });</script>
@stop
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Manage Submit_lsr</h3>
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
                       <div class="col-md-8 col-sm-8 col-xs-7"><h2>Submit_lsr's List</h2></div>
                       <div class="col-md-4 col-sm-4 col-xs-5">
                           <button class="btn btn-primary form-modal-button pull-right" data-toggle="modal" data-target=".form-modal">Add New Submit_lsr</button>
                       </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                        <table class="table table-striped responsive-utilities jambo_table dataTable" id="Submit_lsr-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all" class="flat"></th>
                                    <th>ID</th>
                                    <th>Nature Transport</th><th>Estimed Value</th><th>Tonnage</th><th>destination country</th><th>arrive country</th><th>city departure</th><th>City arrival</th><th>Transit</th><th>Transport Tariff</th><th>Date of Loanding</th><th>Pick-up Services</th><th>Service at delivery</th><th>Information</th>
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
                    <h4 class="modal-title" id="myLargeModalLabel">Submit_lsr
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </h4>
                </div>
                <div class="modal-body">
                    <form  ng-app="ngSubmit_lsrApp" ng-controller="ngSubmit_lsrAppcontroller" id="Submit_lsr-form" class="form-horizontal form-label-left" method="post" action='{!! route("Submit_lsrcreateorupdate") !!}' autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}" />
                        <div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="nat_transport"> Nature Transport <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.nat_transport" type="text" id="nat_transport" name="nat_transport" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="estimed_value"> Estimed Value <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.estimed_value" type="text" id="estimed_value" name="estimed_value" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="tonnage"> Tonnage <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.tonnage" type="text" id="tonnage" name="tonnage" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="go_destination"> destination country <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.go_destination" type="text" id="go_destination" name="go_destination" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="arrived_destination"> arrive country <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.arrived_destination" type="text" id="arrived_destination" name="arrived_destination" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="city_go"> city departure <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.city_go" type="text" id="city_go" name="city_go" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="city_arrival"> City arrival <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.city_arrival" type="text" id="city_arrival" name="city_arrival" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="transit"> Transit <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><select  class="form-control col-md-7 col-xs-12" id="transit" name="transit"><option ng-selected="Submit_lsrItem.transit=='In'" class="form-control col-md-7 col-xs-12" value="In" >In</option><option ng-selected="Submit_lsrItem.transit=='Not'" class="form-control col-md-7 col-xs-12" value="Not" >Not</option></select></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="transport_tariff"> Transport Tariff <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.transport_tariff" type="text" id="transport_tariff" name="transport_tariff" required="required" class="form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_loading"> Date of Loanding <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input ng-model="Submit_lsrItem.date_loading" type="text" id="date_loading" name="date_loading" required="required" class="datetimepicker form-control col-md-7 col-xs-12" ></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="pick_up_sevice"> Pick-up Services <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><select  class="form-control col-md-7 col-xs-12" id="pick_up_sevice" name="pick_up_sevice"><option ng-selected="Submit_lsrItem.pick_up_sevice=='Yes'" class="form-control col-md-7 col-xs-12" value="Yes" >Yes</option><option ng-selected="Submit_lsrItem.pick_up_sevice=='No'" class="form-control col-md-7 col-xs-12" value="No" >No</option></select></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="service_delivery"> Service at delivery <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><select  class="form-control col-md-7 col-xs-12" id="service_delivery" name="service_delivery"><option ng-selected="Submit_lsrItem.service_delivery=='Yes'" class="form-control col-md-7 col-xs-12" value="Yes" >Yes</option><option ng-selected="Submit_lsrItem.service_delivery=='No'" class="form-control col-md-7 col-xs-12" value="No" >No</option></select></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="notes"> Information <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><textarea ng-model="Submit_lsrItem.notes"  id="notes" name="notes" required="required" class="editor form-control col-md-7 col-xs-12" ></textarea></div></div>
                        <input ng-model='Submit_lsrItem.id' type="text" id="id" name="id" style="display: none" />
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
            var SelectedCheckboxes = function() { return $('input:checkbox:checked.Submit_lsr_record').map(function () { return this.value; }).get(); }
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}','X-Requested-With': 'XMLHttpRequest'}
            });
            ListTable = $('#Submit_lsr-table').DataTable({    
            dom: '<"row"<"col-sm-7 col-md-8"<"hidden-xs hidden-sm"l>B><"col-sm-5 col-md-4"f>><"row"<"col-sm-12 table-responsive"rt>><"row"<"col-sm-5"i><"col-sm-7"p>>',
                    processing: true,
                    serverSide: true,
                    ajax: { url:'{!! route("Submit_lsrlist") !!}' ,
                        headers: {'X-CSRF-TOKEN': '<?php echo csrf_token();?>'}
                    },
                    columns: [
                    {data: 'Select', name: 'Select',searchable:false,sortable:false},
                    {data: 'id', name: 'id'},
                    {data: 'nat_transport', name: 'nat_transport'},{data: 'estimed_value', name: 'estimed_value'},{data: 'tonnage', name: 'tonnage'},{data: 'go_destination', name: 'go_destination'},{data: 'arrived_destination', name: 'arrived_destination'},{data: 'city_go', name: 'city_go'},{data: 'city_arrival', name: 'city_arrival'},{data: 'transit', name: 'transit'},{data: 'transport_tariff', name: 'transport_tariff'},{data: 'date_loading', name: 'date_loading'},{data: 'pick_up_sevice', name: 'pick_up_sevice'},{data: 'service_delivery', name: 'service_delivery'},{data: 'notes', name: 'notes'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', 'searchable':false}
                    ],
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print','colvis',
                        {  text: 'Delete',
                           action: function ( e, dt, node, config ) {   
                                var TrashItem = confirm('Are Your sure you want to Delete this Item/s');
                                if (TrashItem) {ajaxAction("{!! route('Submit_lsrdeletemultiple') !!}",'DELETE');}
                        }
                        }
                    ],
                    order: [[1, 'asc']],
                    drawCallback:function(){$('.dataTable input').iCheck({checkboxClass: 'icheckbox_flat-green'});}
            });
            $('body').on('ifToggled','#check-all', function (event) {
                    if($(this).is(':checked')){$('input.Submit_lsr_record').iCheck('check'); } else	       { $('input.Submit_lsr_record').iCheck('uncheck');}
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