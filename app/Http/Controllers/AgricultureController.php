<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Agriculture;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class AgricultureController extends Controller
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
        return View('Agriculture');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Agriculture=Agriculture::query();
        $Agriculture=$Agriculture->with('transportgoods');
        return Datatables::of($Agriculture)->addColumn('Select', function($Agriculture) { return '<input class="flat Agriculture_record" name="Agriculture_record"  type="checkbox" value="'.$Agriculture->id.'" />';})
                ->addColumn('actions', function ($Agriculture) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Agricultureedit',$Agriculture->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Agriculturedelete',$Agriculture->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Agriculture = Agriculture::where('id',$request['id'])->first();    
                $Agriculture->nature=strip_tags($request["nature"]);$Agriculture->desired_delivery=strip_tags($request["desired_delivery"]);$Agriculture->contact_user=strip_tags($request["contact_user"]);$Agriculture->transportgoods=$request["transportgoods"];$Agriculture->quantity=strip_tags($request["quantity"]);
                $Agriculture->save();
                return $this->Response->prepareResult(200,$Agriculture,[],'Agriculture Saved successfully ','ajax');
            else:
                $Agriculture=new Agriculture();    
                $Agriculture->nature=strip_tags($request["nature"]);$Agriculture->desired_delivery=strip_tags($request["desired_delivery"]);$Agriculture->contact_user=strip_tags($request["contact_user"]);$Agriculture->transportgoods=$request["transportgoods"];$Agriculture->quantity=strip_tags($request["quantity"]);
                $Agriculture->save();
                return $this->Response->prepareResult(200,$Agriculture,[],'Agriculture Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Agriculture Could not be  Saved');
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
                $data=Agriculture::where('id',$ID)->get();
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
                Agriculture::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Agriculture Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Agriculture Item Could be not deleted');
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
                Agriculture::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Agriculture Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Agriculture Item/s Could be not deleted');
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
