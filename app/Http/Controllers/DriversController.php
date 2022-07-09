<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Drivers;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class DriversController extends Controller
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
        return View('Drivers');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Drivers=Drivers::query();
        
        return Datatables::of($Drivers)->addColumn('Select', function($Drivers) { return '<input class="flat Drivers_record" name="Drivers_record"  type="checkbox" value="'.$Drivers->id.'" />';})
                ->addColumn('actions', function ($Drivers) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Driversedit',$Drivers->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Driversdelete',$Drivers->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Drivers = Drivers::where('id',$request['id'])->first();    
                $Drivers->name=strip_tags($request["name"]);$Drivers->numb_phone=strip_tags($request["numb_phone"]);$Drivers->numb_premit=strip_tags($request["numb_premit"]);$Drivers->cat_permit=strip_tags($request["cat_permit"]);$Drivers->expiry_date=strip_tags($request["expiry_date"]);
                $Drivers->save();
                return $this->Response->prepareResult(200,$Drivers,[],'Drivers Saved successfully ','ajax');
            else:
                $Drivers=new Drivers();    
                $Drivers->name=strip_tags($request["name"]);$Drivers->numb_phone=strip_tags($request["numb_phone"]);$Drivers->numb_premit=strip_tags($request["numb_premit"]);$Drivers->cat_permit=strip_tags($request["cat_permit"]);$Drivers->expiry_date=strip_tags($request["expiry_date"]);
                $Drivers->save();
                return $this->Response->prepareResult(200,$Drivers,[],'Drivers Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Drivers Could not be  Saved');
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
                $data=Drivers::where('id',$ID)->get();
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
                Drivers::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Drivers Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Drivers Item Could be not deleted');
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
                Drivers::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Drivers Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Drivers Item/s Could be not deleted');
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
