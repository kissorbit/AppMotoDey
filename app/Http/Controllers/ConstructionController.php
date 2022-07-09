<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Construction;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class ConstructionController extends Controller
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
        return View('Construction');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Construction=Construction::query();
        $Construction=$Construction->with('trucks_location');
        return Datatables::of($Construction)->addColumn('Select', function($Construction) { return '<input class="flat Construction_record" name="Construction_record"  type="checkbox" value="'.$Construction->id.'" />';})
                ->addColumn('actions', function ($Construction) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Constructionedit',$Construction->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Constructiondelete',$Construction->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Construction = Construction::where('id',$request['id'])->first();    
                $Construction->company_location=strip_tags($request["company_location"]);$Construction->trucks_location=$request["trucks_location"];$Construction->rental_location=strip_tags($request["rental_location"]);$Construction->rental_date=strip_tags($request["rental_date"]);
                $Construction->save();
                return $this->Response->prepareResult(200,$Construction,[],'Construction Saved successfully ','ajax');
            else:
                $Construction=new Construction();    
                $Construction->company_location=strip_tags($request["company_location"]);$Construction->trucks_location=$request["trucks_location"];$Construction->rental_location=strip_tags($request["rental_location"]);$Construction->rental_date=strip_tags($request["rental_date"]);
                $Construction->save();
                return $this->Response->prepareResult(200,$Construction,[],'Construction Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Construction Could not be  Saved');
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
                $data=Construction::where('id',$ID)->get();
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
                Construction::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Construction Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Construction Item Could be not deleted');
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
                Construction::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Construction Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Construction Item/s Could be not deleted');
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
