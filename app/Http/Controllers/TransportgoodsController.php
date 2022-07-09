<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transportgoods;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class TransportgoodsController extends Controller
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
        return View('Transportgoods');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Transportgoods=Transportgoods::query();
        
        return Datatables::of($Transportgoods)->addColumn('Select', function($Transportgoods) { return '<input class="flat Transportgoods_record" name="Transportgoods_record"  type="checkbox" value="'.$Transportgoods->id.'" />';})
                ->addColumn('actions', function ($Transportgoods) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Transportgoodsedit',$Transportgoods->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Transportgoodsdelete',$Transportgoods->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Transportgoods = Transportgoods::where('id',$request['id'])->first();    
                $Transportgoods->transportgoods=strip_tags($request["transportgoods"]);
                $Transportgoods->save();
                return $this->Response->prepareResult(200,$Transportgoods,[],'Transportgoods Saved successfully ','ajax');
            else:
                $Transportgoods=new Transportgoods();    
                $Transportgoods->transportgoods=strip_tags($request["transportgoods"]);
                $Transportgoods->save();
                return $this->Response->prepareResult(200,$Transportgoods,[],'Transportgoods Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Transportgoods Could not be  Saved');
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
                $data=Transportgoods::where('id',$ID)->get();
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
                Transportgoods::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Transportgoods Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Transportgoods Item Could be not deleted');
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
                Transportgoods::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Transportgoods Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Transportgoods Item/s Could be not deleted');
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
