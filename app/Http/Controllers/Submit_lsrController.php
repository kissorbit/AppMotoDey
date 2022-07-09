<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Submit_lsr;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class Submit_lsrController extends Controller
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
        return View('Submit_lsr');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Submit_lsr=Submit_lsr::query();
        
        return Datatables::of($Submit_lsr)->addColumn('Select', function($Submit_lsr) { return '<input class="flat Submit_lsr_record" name="Submit_lsr_record"  type="checkbox" value="'.$Submit_lsr->id.'" />';})
                ->addColumn('actions', function ($Submit_lsr) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Submit_lsredit',$Submit_lsr->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Submit_lsrdelete',$Submit_lsr->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Submit_lsr = Submit_lsr::where('id',$request['id'])->first();    
                $Submit_lsr->nat_transport=strip_tags($request["nat_transport"]);$Submit_lsr->estimed_value=strip_tags($request["estimed_value"]);$Submit_lsr->tonnage=strip_tags($request["tonnage"]);$Submit_lsr->go_destination=strip_tags($request["go_destination"]);$Submit_lsr->arrived_destination=strip_tags($request["arrived_destination"]);$Submit_lsr->city_go=strip_tags($request["city_go"]);$Submit_lsr->city_arrival=strip_tags($request["city_arrival"]);$Submit_lsr->transit=strip_tags($request["transit"]);$Submit_lsr->transport_tariff=strip_tags($request["transport_tariff"]);$Submit_lsr->date_loading=strip_tags($request["date_loading"]);$Submit_lsr->pick_up_sevice=strip_tags($request["pick_up_sevice"]);$Submit_lsr->service_delivery=strip_tags($request["service_delivery"]);$Submit_lsr->notes=$request["notes"];
                $Submit_lsr->save();
                return $this->Response->prepareResult(200,$Submit_lsr,[],'Submit_lsr Saved successfully ','ajax');
            else:
                $Submit_lsr=new Submit_lsr();    
                $Submit_lsr->nat_transport=strip_tags($request["nat_transport"]);$Submit_lsr->estimed_value=strip_tags($request["estimed_value"]);$Submit_lsr->tonnage=strip_tags($request["tonnage"]);$Submit_lsr->go_destination=strip_tags($request["go_destination"]);$Submit_lsr->arrived_destination=strip_tags($request["arrived_destination"]);$Submit_lsr->city_go=strip_tags($request["city_go"]);$Submit_lsr->city_arrival=strip_tags($request["city_arrival"]);$Submit_lsr->transit=strip_tags($request["transit"]);$Submit_lsr->transport_tariff=strip_tags($request["transport_tariff"]);$Submit_lsr->date_loading=strip_tags($request["date_loading"]);$Submit_lsr->pick_up_sevice=strip_tags($request["pick_up_sevice"]);$Submit_lsr->service_delivery=strip_tags($request["service_delivery"]);$Submit_lsr->notes=$request["notes"];
                $Submit_lsr->save();
                return $this->Response->prepareResult(200,$Submit_lsr,[],'Submit_lsr Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Submit_lsr Could not be  Saved');
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
                $data=Submit_lsr::where('id',$ID)->get();
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
                Submit_lsr::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Submit_lsr Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Submit_lsr Item Could be not deleted');
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
                Submit_lsr::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Submit_lsr Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Submit_lsr Item/s Could be not deleted');
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
