<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Submitlsr;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class SubmitlsrController extends Controller
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
        return View('Submitlsr');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Submitlsr=Submitlsr::query();
        
        return Datatables::of($Submitlsr)->addColumn('Select', function($Submitlsr) { return '<input class="flat Submitlsr_record" name="Submitlsr_record"  type="checkbox" value="'.$Submitlsr->id.'" />';})
                ->addColumn('actions', function ($Submitlsr) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Submitlsredit',$Submitlsr->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Submitlsrdelete',$Submitlsr->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Submitlsr = Submitlsr::where('id',$request['id'])->first();    
                $Submitlsr->nat_transport=strip_tags($request["nat_transport"]);$Submitlsr->estimed_value=strip_tags($request["estimed_value"]);$Submitlsr->tonnage=strip_tags($request["tonnage"]);$Submitlsr->go_destination=strip_tags($request["go_destination"]);$Submitlsr->arrived_destination=strip_tags($request["arrived_destination"]);$Submitlsr->city_go=strip_tags($request["city_go"]);$Submitlsr->city_arrival=strip_tags($request["city_arrival"]);$Submitlsr->transit=strip_tags($request["transit"]);$Submitlsr->date_loading=strip_tags($request["date_loading"]);$Submitlsr->pick_up_sevice=strip_tags($request["pick_up_sevice"]);$Submitlsr->service_delivery=strip_tags($request["service_delivery"]);$Submitlsr->notes=$request["notes"];
                $Submitlsr->save();
                return $this->Response->prepareResult(200,$Submitlsr,[],'Submitlsr Saved successfully ','ajax');
            else:
                $Submitlsr=new Submitlsr();    
                $Submitlsr->nat_transport=strip_tags($request["nat_transport"]);$Submitlsr->estimed_value=strip_tags($request["estimed_value"]);$Submitlsr->tonnage=strip_tags($request["tonnage"]);$Submitlsr->go_destination=strip_tags($request["go_destination"]);$Submitlsr->arrived_destination=strip_tags($request["arrived_destination"]);$Submitlsr->city_go=strip_tags($request["city_go"]);$Submitlsr->city_arrival=strip_tags($request["city_arrival"]);$Submitlsr->transit=strip_tags($request["transit"]);$Submitlsr->date_loading=strip_tags($request["date_loading"]);$Submitlsr->pick_up_sevice=strip_tags($request["pick_up_sevice"]);$Submitlsr->service_delivery=strip_tags($request["service_delivery"]);$Submitlsr->notes=$request["notes"];
                $Submitlsr->save();
                return $this->Response->prepareResult(200,$Submitlsr,[],'Submitlsr Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Submitlsr Could not be  Saved');
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
                $data=Submitlsr::where('id',$ID)->get();
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
                Submitlsr::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Submitlsr Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Submitlsr Item Could be not deleted');
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
                Submitlsr::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Submitlsr Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Submitlsr Item/s Could be not deleted');
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
