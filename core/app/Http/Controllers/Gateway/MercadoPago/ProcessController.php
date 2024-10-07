<?php

namespace App\Http\Controllers\Gateway\MercadoPago;

use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Deposit;
use Session;

class ProcessController extends Controller
{
	public static function process($deposit)
    {
        $general = GeneralSetting::first();
    	$gatewayCurrency = $deposit->gateway_currency();
    	$alias = $deposit->gateway->alias;
    	$gatewayAcc = json_decode($gatewayCurrency->gateway_parameter);
        $curl = curl_init();
        $preferenceData = [
            'items' => [
                [
                    'id' => $deposit->trx,
                    'title' => 'Deposit',
                    'description' => 'Deposit from '.@auth()->user()->email ?? json_decode($general->anonymous)->email,
                    'quantity' => 1,
                    'currency_id' => $gatewayCurrency->currency,
                    'unit_price' => $deposit->final_amo
                ]
            ],
            'payer' => [
                'email' => @auth()->user()->email ?? json_decode($general->anonymous)->email,
            ],
            'back_urls' => [
                'success' => route(gatewayRedirectUrl(true)),
                'pending' => '',
                'failure' => route(gatewayRedirectUrl()),
            ],
            'notification_url' =>  route('ipn.'.$alias),
            'auto_return' =>  'approved',
        ];
        $httpHeader = [
            "Content-Type: application/json",
        ];
        $url = "https://api.mercadopago.com/checkout/preferences?access_token=" . $gatewayAcc->access_token;
        $opts = [
            CURLOPT_URL             => $url,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_POSTFIELDS      => json_encode($preferenceData, true),
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTPHEADER      => $httpHeader
        ];
        curl_setopt_array($curl, $opts);
        $response = curl_exec($curl);
        $result = json_decode($response,true);
        $err = curl_error($curl);
        curl_close($curl);

        if (@$result['init_point']) {

            $send['redirect'] = true;
            $send['redirect_url'] = $result['init_point'];
        } else {
            $send['error'] = true;
            $send['message'] = 'Some problem occured with api.';
        }

        $send['view'] = '';
        return json_encode($send);
    }

    public function ipn(Request $request)
    {
        $track = Session::get('Track');
        $deposit = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $gatewayCurrency = $deposit->gateway_currency();
    	$gatewayAcc = json_decode($gatewayCurrency->gateway_parameter);
        $cancelUrl = route(gatewayRedirectUrl());
        $paymentUrl = "https://api.mercadopago.com/v1/payments/" . $request['data']['id'] . "?access_token=" . $gatewayAcc->access_token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paymentUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $paymentData = curl_exec($ch);
        curl_close($ch);


        $payment = json_decode($paymentData, true);
        if ($payment['status'] == 'approved') {
            PaymentController::userDataUpdate($deposit->trx);
            $notify[] = ['success', 'Payment captured successfully.'];
            return redirect()->route(gatewayRedirectUrl(true))->withNotify($notify);
        }
        $notify[] = ['success', 'Unable to process'];
        return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
    }
} 