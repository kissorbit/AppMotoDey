<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Fournisseur;
use Validator;
use Datatables;
use Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ResponseController;

class FournisseurController extends Controller
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
        return View('Fournisseur');
    }
    
    /**
     * 
     * @return type 
     */
    public function All()
    {
        $Fournisseur=Fournisseur::query();
        $Fournisseur=$Fournisseur->with('name_drivers');
        return Datatables::of($Fournisseur)->addColumn('Select', function($Fournisseur) { return '<input class="flat Fournisseur_record" name="Fournisseur_record"  type="checkbox" value="'.$Fournisseur->id.'" />';})
                ->addColumn('actions', function ($Fournisseur) {
                $column='<a href="javascript:void(0)"  data-url="'.route('Fournisseuredit',$Fournisseur->id).'" class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $column.='<a href="javascript:void(0)" data-url="'.route('Fournisseurdelete',$Fournisseur->id).'" class="delete btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                $Fournisseur = Fournisseur::where('id',$request['id'])->first();    
                $Fournisseur->name_entreprise=strip_tags($request["name_entreprise"]);$Fournisseur->nature_material=strip_tags($request["nature_material"]);$Fournisseur->qte=strip_tags($request["qte"]);$Fournisseur->quality=strip_tags($request["quality"]);$Fournisseur->destination_go=strip_tags($request["destination_go"]);$Fournisseur->destination_arrive=strip_tags($request["destination_arrive"]);$Fournisseur->name_drivers=$request["name_drivers"];
                $Fournisseur->save();
                return $this->Response->prepareResult(200,$Fournisseur,[],'Fournisseur Saved successfully ','ajax');
            else:
                $Fournisseur=new Fournisseur();    
                $Fournisseur->name_entreprise=strip_tags($request["name_entreprise"]);$Fournisseur->nature_material=strip_tags($request["nature_material"]);$Fournisseur->qte=strip_tags($request["qte"]);$Fournisseur->quality=strip_tags($request["quality"]);$Fournisseur->destination_go=strip_tags($request["destination_go"]);$Fournisseur->destination_arrive=strip_tags($request["destination_arrive"]);$Fournisseur->name_drivers=$request["name_drivers"];
                $Fournisseur->save();
                return $this->Response->prepareResult(200,$Fournisseur,[],'Fournisseur Created successfully ','ajax');
            endif;
        } catch (Exception $exc) {
                return $this->Response->prepareResult(400,null,[],null,'ajax','Fournisseur Could not be  Saved');
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
                $data=Fournisseur::where('id',$ID)->get();
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
                Fournisseur::where('id',$ID)->delete();
                return  $this->Response->prepareResult(200,[],'Fournisseur Item deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Fournisseur Item Could be not deleted');
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
                Fournisseur::whereIn('id',$request->selected_rows)->delete();
                return  $this->Response->prepareResult(200,[],'Fournisseur Item/s deleted Successfully','ajax');
            } catch (\Exception $exc) {
        }        return $this->Response->prepareResult(400,[],null,'ajax','Fournisseur Item/s Could be not deleted');
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
