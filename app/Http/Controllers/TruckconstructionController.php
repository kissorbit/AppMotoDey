<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Truckconstruction;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class TruckconstructionController extends Controller
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
        return View('Truckconstruction');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Truckconstruction=Truckconstruction::query();
        
        return Datatables::of($Truckconstruction)->addColumn('Select', function($Truckconstruction) { return '<input class="flat Truckconstruction_record" name="Truckconstruction_record"  type="checkbox" value="'.$Truckconstruction->id.'" />';})
                ->addColumn('actions', function ($Truckconstruction) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Truckconstructionedit',$Truckconstruction->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Truckconstructiondelete',$Truckconstruction->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Truckconstruction = Truckconstruction::where('id',$request['id'])->first();    
                $Truckconstruction->type_truck=strip_tags($request["type_truck"]);
                $Truckconstruction->save();
                return $this->Response->prepareResult(200,$Truckconstruction,[],'Truckconstruction Saved successfully ','ajax');
            else:
                $Truckconstruction=new Truckconstruction();    
                $Truckconstruction->type_truck=strip_tags($request["type_truck"]);
                $Truckconstruction->save();
                return $this->Response->prepareResult(200,$Truckconstruction,[],'Truckconstruction Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Truckconstruction Could not be  Saved');
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
                $data=Truckconstruction::where('id',$ID)->get();
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
                Truckconstruction::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Truckconstruction Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Truckconstruction Item Could be not deleted');
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
                Truckconstruction::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Truckconstruction Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Truckconstruction Item/s Could be not deleted');
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
