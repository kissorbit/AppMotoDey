<?php
namespace App\Http\Controllers;

use App\User;
Use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

Class AdminController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function DashBoard()
    {        
        $UsersCount=User::count();
        $UsersCountLasWeekPercentage=$UsersCount*(User::where('created_at','>=',  date('Y-m-d',strtotime(date('Y-m-d').'-1 month')) )->count())/100;
        return view('dashboard',array('UsersCount'=>$UsersCount,'UsersCountLasWeekPercentage'=>$UsersCountLasWeekPercentage));
    }

    public function FileManage()
    {
        return view('filemanage');
    }
}

?>
