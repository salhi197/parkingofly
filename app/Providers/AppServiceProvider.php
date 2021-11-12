<?php



namespace App\Providers;



use DB;

use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\Product;
use App\Traduction;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Schema\Builder; // Import Builder where defaultStringLength method is defined



class AppServiceProvider extends ServiceProvider

{

    public function register()
    {

    }




    public function boot()
    {
        // $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        // $notifications = Product::whereDate('date_premption', '>=', $request['date_debut']);
        Builder::defaultStringLength(191); // Update defaultStringLength

    }

}

