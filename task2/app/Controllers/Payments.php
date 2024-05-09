<?php

namespace App\Controllers;
use \Stripe\StripeClient;
use App\Models\Product;

class Payments extends BaseController
{
    private $stripe;
    private $stripeSecret;
    private $stripePublic;

    public function __construct() {
        $this->stripeSecret = getenv('STRIPE_SECRET');
        $this->stripePublic = getenv('STRIPE_PUBLIC');
        $this->stripe = new StripeClient($this->stripeSecret);
    }

    /**
     * renders the main payment page
     */
    public function index() {
        return view('payment', [ 'key'=>$this->stripePublic, 'product'=>$this->getProduct(1) ]);
    }

    public function process() {
        // helper(['form']);
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'stripeToken' => 'required',
            'amount' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('payment', [ 'key'=>$this->stripePublic, 'message'=>'Missing information', 'product' => $this->getProduct(1) ]);
        }
        else {
            $token = $this->request->getVar('stripeToken');
            $amount = $this->request->getVar('amount');

            try {
                $charge = $this->stripe->charges->create([
                    'amount' => $amount * 100, // amount in cents
                    'currency' => 'usd',
                    'source' => $token,
                    'description' => 'ABC',
                ]);
                return view('payment_success', [ 'charge'=>$charge ]);
            } catch (\Stripe\Exception\CardException $e) {
                $error = $e->getError()->message;
                return view('payment', [ 'key'=>$this->stripePublic, 'message'=>$error, 'product' => $this->getProduct(1) ]);
            } catch ( \Stripe\Exception\InvalidRequestException $e ) {
                return view('payment', [ 'key'=>$this->stripePublic, 'message'=>'Payment session has already been taken', 'product' => $this->getProduct(1) ]);
            }

        }
    }

    /**
     * retrieves an specific product information or empty array
     */
    protected function getProduct($id) {
        $productModel = new Product();
        $product = $productModel->find($id);
        if ( !is_null($product) ) {
            return $product;
        }
        return [ 'description' => 'default', 'amount' => 0 ];
    }
}
