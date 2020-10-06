<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;

class GetCustomers extends Command
{
    
    protected $signature = 'get:customers';

    
    protected $description = 'Retrieves customer data from woocommerce store and stores relevant data in the database';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $key = env('WOO_API_KEY');
        $secret = env('WOO_API_SECRET');
        $url = 'https://aksel.frb.io/wp-json/wc/v3/customers';

        $request = Http::withBasicAuth($key, $secret)->get($url)->json();


        foreach ($request as $customers) {
            $customer = new Customer();
            $customer->id = $customers['id'];
            $customer->first_name = $customers['first_name'];
            $customer->last_name = $customers['last_name'];
            $customer->email = $customers['email'];
            $customer->phone = $customers['billing']['phone'];
            $customer->save();
        }
        
         $this->info('You have now retrieved and stored all the customers in your database successfully.');
    }
}
