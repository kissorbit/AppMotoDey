<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Submitlsp;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class SubmitlspController extends Controller
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
        return View('Submitlsp');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Submitlsp=Submitlsp::query();
        
        return Datatables::of($Submitlsp)->addColumn('Select', function($Submitlsp) { return '<input class="flat Submitlsp_record" name="Submitlsp_record"  type="checkbox" value="'.$Submitlsp->id.'" />';})
                ->addColumn('actions', function ($Submitlsp) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Submitlspedit',$Submitlsp->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Submitlspdelete',$Submitlsp->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                return $column;})->editColumn('tax',function($Submitlsp){ return "<a  href='files/".$Submitlsp->tax."' />$Submitlsp->tax <i style=' margin-left:10px ' class='md-1 fa fa-download'></i> </a>";})->make(true);
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
                $Submitlsp = Submitlsp::where('id',$request['id'])->first();    
                $Submitlsp->number_trucks=strip_tags($request["number_trucks"]);$Submitlsp->type_trucks=strip_tags($request["type_trucks"]);$AttachmentPath=$this->Upload($request,"tax");$Submitlsp->tax=$AttachmentPath;
                $Submitlsp->save();
                return $this->Response->prepareResult(200,$Submitlsp,[],'Submitlsp Saved successfully ','ajax');
            else:
                $Submitlsp=new Submitlsp();    
                $Submitlsp->number_trucks=strip_tags($request["number_trucks"]);$Submitlsp->type_trucks=strip_tags($request["type_trucks"]);$AttachmentPath=$this->Upload($request,"tax");$Submitlsp->tax=$AttachmentPath;
                $Submitlsp->save();
                return $this->Response->prepareResult(200,$Submitlsp,[],'Submitlsp Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Submitlsp Could not be  Saved');
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
                $data=Submitlsp::where('id',$ID)->get();
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
                Submitlsp::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Submitlsp Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Submitlsp Item Could be not deleted');
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
                Submitlsp::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Submitlsp Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Submitlsp Item/s Could be not deleted');
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
