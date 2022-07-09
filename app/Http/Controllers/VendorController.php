<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vendor;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class VendorController extends Controller
{
    
    public $Now;
    public $Response;
    public function __construct(){
        parent::__construct();
        $this->Now=date('Y-m-d H:i:s');
        $this->Response=new ResponseController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('Vendor');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Vendor=Vendor::query();
        
        return Datatables::of($Vendor)->addColumn('Select', function($Vendor) { return '<input class="flat Vendor_record" name="Vendor_record"  type="checkbox" value="'.$Vendor->id.'" />';})
                ->addColumn('actions', function ($Vendor) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Vendoredit',$Vendor->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Vendordelete',$Vendor->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                return $column;})->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateOrUpdate(Request $request)
    {
        try {
            if($request['id'] !=''):
                $Vendor = Vendor::where('id',$request['id'])->first();    
                $Vendor->name_entreprise=strip_tags($request["name_entreprise"]);$Vendor->type_entreprise=strip_tags($request["type_entreprise"]);$Vendor->email_entreprise=strip_tags($request["email_entreprise"]);$Vendor->numb_entreprise=strip_tags($request["numb_entreprise"]);
                $Vendor->save();
                return $this->Response->prepareResult(200,$Vendor,[],'Vendor Saved successfully ','ajax');
            else:
                $Vendor=new Vendor();    
                $Vendor->name_entreprise=strip_tags($request["name_entreprise"]);$Vendor->type_entreprise=strip_tags($request["type_entreprise"]);$Vendor->email_entreprise=strip_tags($request["email_entreprise"]);$Vendor->numb_entreprise=strip_tags($request["numb_entreprise"]);
                $Vendor->save();
                return $this->Response->prepareResult(200,$Vendor,[],'Vendor Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Vendor Could not be  Saved');
        }

        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\Response
     */
    public function edit($ID)
    {
        try {
                $data=Vendor::where('id',$ID)->get();
                return $this->Response->prepareResult(200,$data,[],null,'ajax');
            } catch (\Exception $exc) {
                 return $this->Response->prepareResult(400,[],null,'ajax','Could not get This item');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\Response
     */
    public function Delete($ID)
    {
        try {
                Vendor::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Vendor Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Vendor Item Could be not deleted');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ID
     * @return \Illuminate\Http\Response
     */
    public function DeleteMultiple(Request $request)
    {
        try {
                Vendor::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Vendor Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Vendor Item/s Could be not deleted');
    }
    
    /**
     * Upload Attachment Or Image
     */
    protected function Upload(Request $request,$FieldName)
    {
        $path='';
        $Image = $request->file($FieldName);
        if($Image):
            $Extension = $Image->getClientOriginalExtension();
            $path = $Image->getFilename() . '.' . $Extension;
            Storage::disk('files_folder')->put($path, File::get($request->file($FieldName)));
        endif;
        return $path;
    }
}
