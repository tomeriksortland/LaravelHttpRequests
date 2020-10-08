<?php

namespace App\Console\Commands;

use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
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
        $url = 'https://aksel.frb.io/wp-json/wc/v3/';
        $endpoint = 'orders';
        $collectionOfOrders = new Collection();


        $client = new Client([
            'base_uri' => $url,
        ]);

        $response = $client->get($endpoint, [
            'auth' => [
                $key,
                $secret
            ],
            'query' => [
                'per_page' => 2,
            ]
        ]);


        $totalAmountOfPages = $this->getTotalAmountOfPages($response);
        $addOrdersToCollection = $this->addAllOrdersToCollection(
            $client,
            $totalAmountOfPages,
            $collectionOfOrders,
            $endpoint,
            $key,
            $secret
        );
        $this->addCollectionOfOrdersToLocalDB($addOrdersToCollection);

        $this->info('You have now retrieved and stored all the orders in your database successfully.');
    }



    static function getTotalAmountOfPages($response)
    {
        $headers = $response->getHeaders();
        foreach ($headers as $name => $header) {
            if ($name == 'X-WP-TotalPages') {
                foreach ($header as $value) {
                    $totalPages = $value;
                }
            }
        }
        return $totalPages;
    }


    static function addAllOrdersToCollection($client, $totalAmountOfPages, $collectionOfOrders, $endpoint, $key, $secret)
    {

        for ($i = 1; $i <= $totalAmountOfPages; $i++) {
            $page = $client->get($endpoint, [
                'auth' => [
                    $key,
                    $secret
                ],
                'query' => [
                    'per_page' => 2,
                    'page' => $i,
                ]
            ]);

            $collectionOfOrders = $collectionOfOrders->merge(json_decode($page->getBody()));
        }

        return $collectionOfOrders;
    }


    static function addCollectionOfOrdersToLocalDB($collectionOfOrders)
    {
        foreach ($collectionOfOrders as $order) {
            Order::firstOrCreate([
                'id' => $order->id,
                'total_price' => $order->total,
                'tax_amount' => $order->total_tax,
                'created_at' => $order->date_created_gmt,
                'updated_at' => $order->date_modified_gmt
            ]);
        }
    }
}
