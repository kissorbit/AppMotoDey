<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Drivers;
use App\User;
use App\Model\Expense;

use Illuminate\Http\Request;
//use Illuminate\http\drivers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
}
public function index() {

    if (Auth::user()->user_type == "D") {
        $index['data'] = User::whereId(Auth::user()->id)->first();
        $index['bookings'] = Bookings::orderBy('id', 'desc')->where('driver_id', Auth::user()->id)->get();

        $index['total'] = Bookings::whereDriver_id(Auth::user()->id)->get()->count();
        // $index['vehicle'] = VehicleModel::where('driver_id', Auth::user()->id)->first();
        return view("drivers.profile", $index);

    } elseif (Auth::user()->user_type == "C") {

        $data['total_kms'] = IncomeModel::select(DB::raw('sum(mileage) as total_kms'))->where('user_id', Auth::id())->get();
        $data['income'] = IncomeModel::select(DB::raw('sum(amount) as income'))->where('user_id', Auth::id())->get();

        $data['time'] = 0;
        $data['travel_time'] = 0;
        $bookings = Bookings::where('customer_id', Auth::user()->id)->get();
        foreach ($bookings as $b) {
            if ($b->status == 1) {
                $data['time'] += $b->getMeta('waiting_time');
                $times = explode(" ", $b->getMeta('driving_time'));
                if (sizeof($times) == 2) {
                    if (starts_with($times[1], 'hour')) {
                        $data['travel_time'] += $times[0] * 60;
                    }

                    if (starts_with($times[1], 'min')) {
                        $data['travel_time'] += $times[0];
                    }
                    if (starts_with($times[1], 'day')) {
                        $data['travel_time'] += $times[0] * 24 * 60;
                    }
                }

                if (sizeof($times) == 4) {
                    if (starts_with($times[1], 'hour')) {
                        $data['travel_time'] += $times[0] * 60;
                    }

                    if (starts_with($times[1], 'day')) {
                        $data['travel_time'] += $times[0] * 24 * 60;
                    }

                    if (starts_with($times[3], 'hour')) {
                        $data['travel_time'] += $times[2] * 60;
                    }

                    if (starts_with($times[3], 'min')) {
                        $data['travel_time'] += $times[2];
                    }
                }

                if (sizeof($times) == 6) {
                    if (starts_with($times[1], 'day')) {
                        $data['travel_time'] += $times[0] * 24 * 60;
                    }

                    if (starts_with($times[3], 'hour')) {
                        $data['travel_time'] += $times[2] * 60;
                    }

                    if (starts_with($times[5], 'min')) {
                        $data['travel_time'] += $times[4];
                    }
                }
            }

        }
        return view('customers.home', $data);
    } else {
        if (isset($_GET['year'])) {
            $pass_year = $_GET['year'];
        } else {
            $pass_year = date("Y");
        }
        $years = DB::select(DB::raw("select distinct year(date) as years from income  union select distinct year(date) as years from expense order by years desc"));
        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {

            $y[date('Y')] = date('Y');

        }
        $index['year_select'] = $pass_year;
        $index['years'] = $y;
        $index['drivers'] = User::whereUser_type("D")->get()->count();
        
        $index['drivers_ages_group'] = DB::select("
            select 
                count(case when age < 20 then 1 else null end) as _20,
                count(case when age >= 20 and  age <= 29 then 1 else null end) as _20_29,
                count(case when age >= 30 and  age <= 30 then 1 else null end) as _30_39,
                count(case when age >= 40 and  age <= 49 then 1 else null end) as _40_49,
                count(case when age >= 50 and  age <= 59 then 1 else null end) as _50_59,
                count(case when age >= 60 then 1 else null end) as _60
                from (
                    select YEAR(now()) - YEAR(CONVERT(users_meta.value, DATE)) as age 
                    from `users` inner join `users_meta` on `users_meta`.`user_id` = `users`.`id` 
                    where `user_type` = 'D' and users_meta.key = 'birth_date' and `users`.`deleted_at` is null) a")[0];
        
        $tt = DB::select("
                select AVG(YEAR(now()) - YEAR(CONVERT(users_meta.value, DATE))) as age 
                    from `users` inner join `users_meta` on `users_meta`.`user_id` = `users`.`id` 
                    where `user_type` = 'D' and users_meta.key = 'birth_date' and `users`.`deleted_at` is null")[0];
        
        if(is_null($tt->age)){
            $index['drivers_ages'] = "0";
        }else{
            $index['drivers_ages'] = $tt->age;
        }
        
        $index['reviews'] = ReviewModel::all()->count();
        $index['customers'] = User::whereUser_type("C")->get()->count();
        $index['files'] = User::whereUser_type("C")->get()->count();
        $index['bonCommandes'] = User::whereUser_type("C")->get()->count();
        $index['users'] = User::whereUser_type("O")->get()->count();
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $index['vehicles'] = VehicleModel::all()->count();
            $index['bookings'] = Bookings::all()->count();
        } else {
            $index['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->count();
            $vehicle_ids = VehicleModel::where('group_id', Auth::user()->group_id)->pluck('id')->toArray();
            $index['bookings'] = Bookings::whereIn('vehicle_id', $vehicle_ids)->count();
        }

        $index['vendors'] = Vendor::all()->count();
        $index['clients'] = User::client()->get();
        $index['vehiclesItems'] = VehicleModel::get();
        
        // $index['parts'] = PartsModel::all()->count();
        $index['customers'] = User::whereUser_type("C")->get()->count();
        $index['files'] =   Files::count();
        $index['boncommandes'] = BonCommandesModel::count();
        $index['yearly_income'] = $this->yearly_income($pass_year);
        $index['yearly_expense'] = $this->yearly_expense($pass_year);

        $vv = array();
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $all_vehicles = VehicleModel::get();
        } else {
            $all_vehicles = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($all_vehicles as $key) {
            $vv[$key->id] = $key->make . "-" . $key->model . "-" . $key->license_plate;
            $vehicle_ids[] = $key->id;
        }
        $index['vehicle_name'] = $vv;
        $index['expenses'] = Expense::select('vehicle_id', DB::raw('sum(amount) as expense'))->whereIn('vehicle_id', $vehicle_ids)->whereYear('date', date('Y'))->whereMonth('date', date('n'))->groupBy('vehicle_id')->get();
        $index['income'] = IncomeModel::whereRaw('year(date) = ? and month(date)=?', [date("Y"), date("n")])->whereIn('vehicle_id', $vehicle_ids)->sum("amount");
        $index['expense'] = Expense::whereRaw('year(date) = ? and month(date)=?', [date("Y"), date("n")])->whereIn('vehicle_id', $vehicle_ids)->sum("amount");

        $exp = DB::select('select date,sum(amount) as tot from expense where deleted_at is null and vehicle_id in (' . join(",", $vehicle_ids) . ') group by date');
        $inc = DB::select('select date,sum(amount) as tot from income where deleted_at is null and vehicle_id in (' . join(",", $vehicle_ids) . ') group by date');
        $date1 = IncomeModel::pluck('date')->toArray();
        $date2 = Expense::pluck('date')->toArray();
        $all_dates = array_unique(array_merge($date1, $date2));

        $dates = array_count_values($all_dates);
        ksort($dates);
        $dates = array_slice($dates, -12, 12);
        $index['dates'] = $dates;
        $temp = array();
        foreach ($all_dates as $key) {
            $temp[$key] = 0;
        }
        $income2 = array();
        foreach ($inc as $income) {
            $income2[$income->date] = $income->tot;
        }
        $inc_data = array_merge($temp, $income2);
        ksort($inc_data);
        $index['incomes'] = implode(",", array_slice($inc_data, -12, 12));

        $expense2 = array();
        foreach ($exp as $e) {
            $expense2[$e->date] = $e->tot;
        }
        $expenses = array_merge($temp, $expense2);
        ksort($expenses);
        $index['expenses1'] = implode(",", array_slice($expenses, -12, 12));
        
        return view('home', $index);
    }

}
