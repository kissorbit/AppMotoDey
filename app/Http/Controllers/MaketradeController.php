<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Maketrade;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class MaketradeController extends Controller
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
        return View('Maketrade');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Maketrade=Maketrade::query();
        $Maketrade=$Maketrade->with('choise_lsp');$Maketrade=$Maketrade->with('choise_lsr');
        return Datatables::of($Maketrade)->addColumn('Select', function($Maketrade) { return '<input class="flat Maketrade_record" name="Maketrade_record"  type="checkbox" value="'.$Maketrade->id.'" />';})
                ->addColumn('actions', function ($Maketrade) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Maketradeedit',$Maketrade->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Maketradedelete',$Maketrade->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                return $column;})->editColumn('doc_route',function($Maketrade){ return "<a  href='files/".$Maketrade->doc_route."' />$Maketrade->doc_route <i style=' margin-left:10px ' class='md-1 fa fa-download'></i> </a>";})->make(true);
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
                $Maketrade = Maketrade::where('id',$request['id'])->first();    
                $Maketrade->choise_lsp=$request["choise_lsp"];$Maketrade->choise_lsr=$request["choise_lsr"];$AttachmentPath=$this->Upload($request,"doc_route");$Maketrade->doc_route=$AttachmentPath;
                $Maketrade->save();
                return $this->Response->prepareResult(200,$Maketrade,[],'Maketrade Saved successfully ','ajax');
            else:
                $Maketrade=new Maketrade();    
                $Maketrade->choise_lsp=$request["choise_lsp"];$Maketrade->choise_lsr=$request["choise_lsr"];$AttachmentPath=$this->Upload($request,"doc_route");$Maketrade->doc_route=$AttachmentPath;
                $Maketrade->save();
                return $this->Response->prepareResult(200,$Maketrade,[],'Maketrade Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Maketrade Could not be  Saved');
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
                $data=Maketrade::where('id',$ID)->get();
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
                Maketrade::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Maketrade Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Maketrade Item Could be not deleted');
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
                Maketrade::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Maketrade Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Maketrade Item/s Could be not deleted');
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
