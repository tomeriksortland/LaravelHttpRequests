<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        $ApiKey = env('WOO_API_KEY');
        $ApiSecret = env('WOO_API_SECRET');
        $url = 'https://aksel.frb.io/wp-json/wc/v3/orders';
        $collectionOfOrders = new Collection();

        $response = Http::withBasicAuth($ApiKey, $ApiSecret)->get($url, [
            'per_page' => 2
        ]);

        $totalAmountOfPages = $this->getTotalAmountOfPages($response);
        $addOrdersToCollection = $this->addAllOrdersToCollection(
            $totalAmountOfPages,
            $collectionOfOrders,
            $url,
            $ApiKey,
            $ApiSecret
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


    static function addAllOrdersToCollection($totalAmountOfPages, $collectionOfOrders, $url, $ApiKey, $ApiSecret)
    {

        for ($i = 1; $i <= $totalAmountOfPages; $i++) {
            $page = Http::withBasicAuth($ApiKey, $ApiSecret)->get($url, [
                'per_page' => 2,
                'page' => $i,
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
