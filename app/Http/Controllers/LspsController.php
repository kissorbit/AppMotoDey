<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lsps;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class LspsController extends Controller
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
        return View('Lsps');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Lsps=Lsps::query();
        
        return Datatables::of($Lsps)->addColumn('Select', function($Lsps) { return '<input class="flat Lsps_record" name="Lsps_record"  type="checkbox" value="'.$Lsps->id.'" />';})
                ->addColumn('actions', function ($Lsps) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Lspsedit',$Lsps->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Lspsdelete',$Lsps->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Lsps = Lsps::where('id',$request['id'])->first();    
                $Lsps->compagny_name_lsp=strip_tags($request["compagny_name_lsp"]);$Lsps->compagny_address_lsp=strip_tags($request["compagny_address_lsp"]);$Lsps->name_lsp=strip_tags($request["name_lsp"]);$Lsps->first_name_lsp=strip_tags($request["first_name_lsp"]);$Lsps->email_lsp=strip_tags($request["email_lsp"]);$Lsps->phone_lsp=strip_tags($request["phone_lsp"]);$Lsps->country_lsp=strip_tags($request["country_lsp"]);$Lsps->city_lsp=strip_tags($request["city_lsp"]);
                $Lsps->save();
                return $this->Response->prepareResult(200,$Lsps,[],'Lsps Saved successfully ','ajax');
            else:
                $Lsps=new Lsps();    
                $Lsps->compagny_name_lsp=strip_tags($request["compagny_name_lsp"]);$Lsps->compagny_address_lsp=strip_tags($request["compagny_address_lsp"]);$Lsps->name_lsp=strip_tags($request["name_lsp"]);$Lsps->first_name_lsp=strip_tags($request["first_name_lsp"]);$Lsps->email_lsp=strip_tags($request["email_lsp"]);$Lsps->phone_lsp=strip_tags($request["phone_lsp"]);$Lsps->country_lsp=strip_tags($request["country_lsp"]);$Lsps->city_lsp=strip_tags($request["city_lsp"]);
                $Lsps->save();
                return $this->Response->prepareResult(200,$Lsps,[],'Lsps Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Lsps Could not be  Saved');
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
                $data=Lsps::where('id',$ID)->get();
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
                Lsps::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Lsps Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Lsps Item Could be not deleted');
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
                Lsps::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Lsps Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Lsps Item/s Could be not deleted');
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
