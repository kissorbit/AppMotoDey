<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lsrs;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class LsrsController extends Controller
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
        return View('Lsrs');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Lsrs=Lsrs::query();
        
        return Datatables::of($Lsrs)->addColumn('Select', function($Lsrs) { return '<input class="flat Lsrs_record" name="Lsrs_record"  type="checkbox" value="'.$Lsrs->id.'" />';})
                ->addColumn('actions', function ($Lsrs) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Lsrsedit',$Lsrs->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Lsrsdelete',$Lsrs->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Lsrs = Lsrs::where('id',$request['id'])->first();    
                $Lsrs->compagny_name=strip_tags($request["compagny_name"]);$Lsrs->email=strip_tags($request["email"]);$Lsrs->phone_co=strip_tags($request["phone_co"]);$Lsrs->compagny_address=strip_tags($request["compagny_address"]);$Lsrs->country=strip_tags($request["country"]);$Lsrs->city=strip_tags($request["city"]);
                $Lsrs->save();
                return $this->Response->prepareResult(200,$Lsrs,[],'Lsrs Saved successfully ','ajax');
            else:
                $Lsrs=new Lsrs();    
                $Lsrs->compagny_name=strip_tags($request["compagny_name"]);$Lsrs->email=strip_tags($request["email"]);$Lsrs->phone_co=strip_tags($request["phone_co"]);$Lsrs->compagny_address=strip_tags($request["compagny_address"]);$Lsrs->country=strip_tags($request["country"]);$Lsrs->city=strip_tags($request["city"]);
                $Lsrs->save();
                return $this->Response->prepareResult(200,$Lsrs,[],'Lsrs Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Lsrs Could not be  Saved');
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
                $data=Lsrs::where('id',$ID)->get();
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
                Lsrs::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Lsrs Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Lsrs Item Could be not deleted');
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
                Lsrs::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Lsrs Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Lsrs Item/s Could be not deleted');
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
