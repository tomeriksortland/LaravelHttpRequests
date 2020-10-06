<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves order data from woocommerce store and stores relevant data in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $key = env('WOO_API_KEY');
        $secret = env('WOO_API_SECRET');
        $url = 'https://aksel.frb.io/wp-json/wc/v3/orders';

        $request = Http::withBasicAuth($key, $secret)->get($url)->json();


        foreach ($request as $orders) {
            $order = new Order();
            $order->id = $orders['id'];
            $order->total_price = $orders['total'];
            $order->tax_amount = $orders['total_tax'];
            $order->save();
        }
        
         $this->info('You have now retrieved and stored all the orders in your database successfully.');
    }
}
