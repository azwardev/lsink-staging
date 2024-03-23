<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomePage extends Controller
{
  public function index(Request $request)
  {
    if($request->has('billplz')){
      $billplz_id = $request->all()['billplz']['id'];
      $billplz_paid = $request->all()['billplz']['paid'];
      $billplz_paid_at = $request->all()['billplz']['paid_at'];
      $billplz_request_x_signature = $request->all()['billplz']['x_signature'];
  
  
      $sourceStrings = [
        'billplzid' . $billplz_id,
        'billplzpaid_at' . $billplz_paid_at,
        'billplzpaid' . $billplz_paid,
      ];
   
      $combinedSource = implode('|', $sourceStrings);
  
      $sharedKey = env('BILLPLZ_X_SIGNATURE','');
      $xSignature = hash_hmac('sha256', $combinedSource, $sharedKey);
      $queryParams = $request->query();


      if ($xSignature == $billplz_request_x_signature) {
        unset($queryParams['param_to_clear']);
        $newUrl = url()->current().'?'.http_build_query($queryParams);
        return Redirect::to(url()->current());
  
       
      } else {
        dd("Unauthorized");
        // return 
      }


      
    }
    return view('content.pages.pages-home');

  
    // dd($xSignature);


   
  }
}
