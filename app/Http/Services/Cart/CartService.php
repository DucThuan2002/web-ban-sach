<?php

namespace App\Http\Services\Cart;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\Customer;
use App\Helpers\Helper;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

Class CartService
{
    public function create($num_product, $product_id)
    {
        $num = $num_product;
        $id = $product_id;
        
        if($num <= 0 || $id < 0) {
            session()->flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }

        $carts = session()->get('carts');

        if (is_null($carts)) {
            session()->put('carts', [
                $id => $num
            ]);

            return  true;
        }
        else {
            $exists = Arr::exists($carts, $id);

            if ($exists) {
                $numNew = $carts[$id] + $num;
                $carts[$id] = $numNew;
                session()->put('carts', $carts);
                return true;
            } 
        }

        $carts[$id] = $num;
        session()->put('carts', $carts);
        return true;    
    }

    public function getProduct() 
    {
        $carts = session()->get('carts');
        if (is_null($carts)) {
            return [];
        }

        $productID = array_keys($carts);

        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productID)
            ->get();
    }

    public function update($request)
    {
        session()->put('carts', $request->input('num_product'));
        return true;
    }

    public function delete($id)
    {
        $carts = session()->get('carts');
        dd($carts);
        unset($carts[$id]);
        session()->put('carts', $carts);
        return true;
    }

    public function addCart($request)
    {
        try {
            DB::beginTransaction();
            $carts = session()->get('carts');

            if (is_null($carts)) {
                return false;
            }

            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            $this->getInfProduct($carts, $customer->id);
            DB::commit();
            session()->flash('success', 'Đặt hàng thành công');
            session()->forget('carts');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Đặt hàng không thành công');
            return false;
        }

        return true;
    }

    public function getInfProduct($carts, $customer_id)
    {
        $productID = array_keys($carts);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productID)
            ->get();

        $data = [];
        foreach ($products as $key => $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty' => $carts[$product->id],
                'price' => Helper::price($product->price, $product->price_sale)
            ];  
        }

        Cart::insert($data);
        return true;
    }

    public function getCustomer()
    {
        return Customer::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return  $customer->carts()->with([
                    'products' => function($query) {
                        $query->select('id', 'name', 'thumb');
                    }
                ])->get();
    }

    public function momoPayment(Request $request)
    {

        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";


        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";
        $orderId = time() ."";
        $returnUrl = "http://localhost/shop/carts";
        $notifyurl = "http://localhost/shop/carts";
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";
        $requestId = time()."";
        $requestType = "payWithMoMoATM";
        $extraData = "";
        //before sign HMAC SHA256 signature
        $rawHashArr =  array(
                        'partnerCode' => $partnerCode,
                        'accessKey' => $accessKey,
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'bankCode' => $bankCode,
                        'returnUrl' => $returnUrl,
                        'notifyUrl' => $notifyurl,
                        'extraData' => $extraData,
                        'requestType' => $requestType
                        );
        // echo $serectkey;die;
        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderId."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data =  array('partnerCode' => $partnerCode,
                        'accessKey' => $accessKey,
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'returnUrl' => $returnUrl,
                        'bankCode' => $bankCode,
                        'notifyUrl' => $notifyurl,
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature);
        $result = Helper::execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result,true);  // decode json
        
        error_log( print_r( $jsonResult, true ) );
        echo "<a href='" . htmlspecialchars($jsonResult['payUrl'], ENT_QUOTES, 'UTF-8') . "'>Click here</a>";
    }
}
 