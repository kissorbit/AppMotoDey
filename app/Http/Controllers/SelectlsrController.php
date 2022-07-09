<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Selectlsr;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class SelectlsrController extends Controller
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
        return View('Selectlsr');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Selectlsr=Selectlsr::query();
        $Selectlsr=$Selectlsr->with('select');
        return Datatables::of($Selectlsr)->addColumn('Select', function($Selectlsr) { return '<input class="flat Selectlsr_record" name="Selectlsr_record"  type="checkbox" value="'.$Selectlsr->id.'" />';})
                ->addColumn('actions', function ($Selectlsr) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Selectlsredit',$Selectlsr->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Selectlsrdelete',$Selectlsr->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Selectlsr = Selectlsr::where('id',$request['id'])->first();    
                $Selectlsr->select=$request["select"];$Selectlsr->nature_material=strip_tags($request["nature_material"]);
                $Selectlsr->save();
                return $this->Response->prepareResult(200,$Selectlsr,[],'Selectlsr Saved successfully ','ajax');
            else:
                $Selectlsr=new Selectlsr();    
                $Selectlsr->select=$request["select"];$Selectlsr->nature_material=strip_tags($request["nature_material"]);
                $Selectlsr->save();
                return $this->Response->prepareResult(200,$Selectlsr,[],'Selectlsr Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Selectlsr Could not be  Saved');
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
                $data=Selectlsr::where('id',$ID)->get();
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
                Selectlsr::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Selectlsr Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Selectlsr Item Could be not deleted');
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
                Selectlsr::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Selectlsr Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Selectlsr Item/s Could be not deleted');
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
