<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BaseCurrency;
use App\Models\QuoteCurrency;
use GuzzleHttp\Client;
use League\CommonMark\Extension\SmartPunct\Quote;

class DashboardController extends Controller
{
    public function index()
    {
        $currencies = BaseCurrency::with([
            'quoteCurrency'
        ])
        ->orderBy('id', 'DESC')
        ->first();

        return view('pages.dashboard.index', compact('currencies'));
    }

    public function updatePrice()
    {
        $exchangeEndpoint = 'https://v6.exchangerate-api.com/v6/3e0bfc7a705a082aeca86db9/latest/USD';

        $client = new Client();
        $response = $client->get($exchangeEndpoint);

        $body = $response->getBody()->getContents();
        $body = json_decode($body, true);

        $base = $body['base_code'];
        $quote = $body['conversion_rates'];

        $isError = false;

        try {
            DB::beginTransaction();

            $baseCurrency = new BaseCurrency();
            $baseCurrency->fill([
                'currency' => $base
            ])->save();

            $idBaseCurrency = $baseCurrency->id;

            foreach($quote as $key => $val){
                $quoteCurrency = new QuoteCurrency();

                $dataQuote['base_currency_id'] = $idBaseCurrency;
                $dataQuote['currency'] = $key;
                $dataQuote['rate'] = $val;

                $quoteCurrency->fill($dataQuote)->save();
            }

            $message = 'Price refreshed successfully';

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            $isError = true;

            $err     = $e->errorInfo;

            $message =  $err[2];
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => $message,
            'redirect' => url('')
        ], 200)->withHeaders([
            'Content-Type' => 'application/json'
        ]);
    }
}
