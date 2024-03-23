<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Payment; // If using a model
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Permohonan;

// use App\Models\Permohonan;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
        // $response = Http::post('https://www.billplz.com/api/v3/bills');
        // $response = Http::withHeaders([
        //     'Authorization' => 'Basic fa194639-1759-44b2-bd2a-5dccf1359633:',
        //     'Accept' => 'application/json',
        // ])->post('https://www.billplz-sandbox.com/api/v3/bills');
        // $posts = $response->json();
        // var_dump($posts);

        $client = new Client();
        // dd(env("BILLPLZ_API_KEY"));
        $response = $client->post(env("BILLPLZ_URL"), [
            'auth' => [env("BILLPLZ_API_KEY"), ''], // API Key
            'form_params' => [
                'collection_id' => env("BILLPLZ_COLLECTION_ID"),
                'description' => 'Perlepasan Efluen',
                'email' => 'azwardev@gmail.com',
                'name' => 'Azwar',
                'amount' => 15000,
                'redirect_url' => 'http://127.0.0.1:8000/',
                'callback_url' => 'https://fdd7-2001-d08-da-37c7-1c88-e394-41d8-4d47.ngrok-free.app/api/payment/callback',
            ]
        ]);
        // $response = $client->post('https://www.billplz-sandbox.com/api/v3/bills', [
        //     'auth' => [env('BILLPLZ_API_KEY', "default") . ''], // API Key
        //     'form_params' => [
        //         'collection_id' => env('BILLPLZ_COLLECTION_ID', "default"),
        //         'description' => 'Perlepasan Efluen',
        //         'email' => "azwardev@gmail.com",
        //         'name' => "azwar",
        //         'amount' => 200,
        //         'redirect_url' => 'http://127.0.0.1:8000/',
        //         'callback_url' => env('BILLPLZ_URL') . '/api/payment/callback',
        //     ]
        // ]);



        $body = $response->getBody();
        $contents = $body->getContents();
        $decoded_data = json_decode($contents, true);

        // dd($decoded_data['url']);
        return redirect($decoded_data['url']);
        // return json_decode($contents); // You can return or process the response as needed

    }

    public function callback(Request $request)
    {


        $bodyContent = $request->getContent();
        parse_str($bodyContent, $data);
        // LOG::info($data['id']);
        LOG::info($data['x_signature']);
        $request_x_signature = $data['x_signature'];
        // $data = [
        //     'id' => $data['id'],
        //     'collection_id' => '7txtpx6x',
        //     'paid' => $data['paid'],
        //     'state' => $data['state'],
        //     'amount' => $data['amount'],
        //     'paid_amount' => $data['paid_amount'],
        //     'due_at' => $data['due_at'],
        //     'email' => $data['email'],
        //     'mobile' => '',
        //     'name' => $data['name'],
        //     'url' => $data['url'],
        //     'paid_at' => $data['paid_at'],
        //     // 'x_signature' => $data['x_signature']
        // ];
        $sourceStrings = [
            'amount' . $data['amount'],
            'collection_id' . "7txtpx6x",
            'due_at' . $data['due_at'],
            'email' . $data['email'],
            'id' . $data['id'],
            'mobile' . '',
            'name' . $data['name'],
            'paid_amount' . $data['paid_amount'],
            'paid_at' . $data['paid_at'],
            'paid' . $data['paid'],
            'state' . $data['state'],
            'url' . $data['url'],

        ];

        LOG::info(implode(', ', $sourceStrings));
        $combinedSource = implode('|', $sourceStrings);

        $sharedKey = env('BILLPLZ_X_SIGNATURE', '');
        $xSignature = hash_hmac('sha256', $combinedSource, $sharedKey);
        LOG::info($xSignature);
        LOG::info($request_x_signature);

        if ($xSignature === $request_x_signature) {
            // IF MATCH WILL PROCEED SAVE TO DATABASE
            // return Redirect::to(url()->current());

            Log::info($bodyContent);
            $bill_id = $data['id'];
            Log::info($bill_id);

            $data = [
                'id' => $data['id'],
                'collection_id' => '7txtpx6x',
                'paid' => $data['paid'],
                'state' => $data['state'],
                'amount' => $data['amount'],
                'paid_amount' => $data['paid_amount'],
                'due_at' => $data['due_at'],
                'email' => $data['email'],
                'mobile' => '',
                'name' => $data['name'],
                'url' => $data['url'],
                'paid_at' => $data['paid_at'],
                'x_signature' => $data['x_signature']
            ];

            $jsonString = json_encode($data);
            $payment = Payment::create([
                'bill_id' => $bill_id,
                'bill_collection' => $jsonString,
            ]);
            Log::info($payment['id']);

            $payment_callback = DB::table('payment_callback')->where('bill_id', $data['id'])->first();

            $permohonan = Permohonan::find($payment_callback->permohonan_id);
            $permohonan->payment_id = $payment['id'];
            $permohonan->save();


        } else {
            // dd("Unauthorized");
            Log::info("X Signature Not Match");
            // return 
        }



    }

    public function test(Request $request)
    {

        // dd("test");
        $payment_callback = DB::table('payment_callback')->where('bill_id', 'xruyii7d')->first();
        // dd($payment_callback->permohonan_id);

        $permohonan = Permohonan::find($payment_callback->permohonan_id);
        $permohonan->payment_id = 1;
        $permohonan->save();

    }


}