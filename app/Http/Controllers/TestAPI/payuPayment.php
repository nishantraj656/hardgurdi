<?php
namespace App\Http\Controllers\TestAPI;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB;

class payuPayment extends Controller 
{
    public $successStatus = 200;

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
    */ 
    // function makeHash(Request $request){
    //     $key = $request->key;
    //     $txnid = $request->txnid;
    //     $amount = $request->amount;
    //     $productinfo = $request->productinfo;
    //     $firstname = $request->firstname;
    //     $email = $request->email;
    //     $salt = "XXXXXX"; //Please change the value with the live salt for production environment
        
    //     $payhash_str = $key . '|' . $this->checkNull($txnid) . '|' . $this->checkNull($amount) . '|' . $this->checkNull($productinfo) . '|' . $this->checkNull($firstname) . '|' . $this->checkNull($email) . '|||||||||||' . $salt;
        
    //     $hash = strtolower(hash('sha512', $payhash_str));
    //     return $hash;
    // }
     
    function checkNull($value)
    {
        if ($value == null) {
            return '';
        } else {
            return $value;
        }
    }

        //open payment gateway for paying
    function openPaymentGateway($purchaseType_HD1,$productID_HD2,$userID_HD3){
        

        // findign user information
        $users_data = DB::table('users')
        ->select('name', 'email','phoneno')
        ->where('id', '=', $userID_HD3)
        ->first();
        if ($users_data == null) {
            echo "Invalid User";
            return;
        }
        // findign product information
        $product_data = null ;

        if ($purchaseType_HD1 ==  'package') {
            $product_data = DB::table('package_tab')
                ->select('subcat_name as productinfo', 'package_price as amount')
                ->where('package_id', '=', $productID_HD2)
                ->first();
        }else if($purchaseType_HD1 == 'test'){
            $product_data = DB::table('test_info_tab')
                ->select('test_name as productinfo', 'test_price as amount')
                ->where('test_info_id', '=', $productID_HD2)
                ->first();
        }else{
            echo "Somthing goes wrong";
            return;
        }
        
        if ($product_data == null) {
            echo "Invalid Product";
            return;
        }

        $firstname = $users_data->name;
        $email = $users_data->email;
        $phoneno = $users_data->phoneno;
        $productinfo = $product_data->productinfo;
        $amount = $product_data->amount;

        $txnid =  substr($purchaseType_HD1, 0,4)."-".$productID_HD2."-".$userID_HD3."-".time();


        // making entry in payment table 
        DB::table('payment_tab')->insert([
            'product_id' => $productID_HD2,
            'user_id' => $userID_HD3,
            'transaction_id' => $txnid,
            'product_type' => $purchaseType_HD1,
            'amount' => $amount,
        ]);


        // echo "$purchaseType_HD1-$productID_HD2-$userID_HD3";
        // echo "_________________________";
        // echo "$email-$phoneno-$firstname";
        // echo "_________________________";
        // echo "$productinfo-$amount";
        // echo "_________________________";
        // echo "$txnid";

        // return;
       




        $MERCHANT_KEY = env('MERCHANT_KEY', 'ds24jgkM');
        $SALT = env('SALT', 's5P8PrWezj');

            
        // $MERCHANT_KEY = "QrJSX8h2";
        // $SALT = "J3G8tzrUnt";
        // Merchant Key and Salt as provided by Payu.

        // $PAYU_BASE_URL = "https://sandboxsecure.payu.in";       // For Sandbox Mode
        $PAYU_BASE_URL = "https://secure.payu.in";            // For Production Mode





         //initilizing post aaray to sending request to the payment gateway

        $_POST['surl'] = url('/')."/payment_success";
        $_POST['furl'] = url('/')."/payment_failed";
        $_POST['key'] = env("MERCHANT_KEY",$MERCHANT_KEY);
        $_POST['service_provider'] = env("PAYMENT_GATEWAY_PROVIDER","payu");


        $_POST['firstname'] = $firstname;
        $_POST['email'] = $email;
        $_POST['phone'] = $phoneno;
        
        $_POST['amount'] = $amount;
        $_POST['productinfo'] = $productinfo;
        $_POST['txnid'] = $txnid;
        












        

        $action = '';
        // $geting data form post and pusheing to posted named variable 
        $posted = array();
        if(!empty($_POST)) {
            //print_r($_POST);
          foreach($_POST as $key => $value) {    
            $posted[$key] = $value; 
            
          }
        }

        $formError = 0;

        // if transaction id is empty 
        if(empty($posted['txnid'])) {
          // Generate random transaction id
          $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        } else {
          $txnid = $posted['txnid'];
        }


        /* making hash */ 
        $hash = '';
        // Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if(empty($posted['hash']) && sizeof($posted) > 0) {
          if(
                  empty($posted['key'])
                  || empty($posted['txnid'])
                  || empty($posted['amount'])
                  || empty($posted['firstname'])
                  || empty($posted['email'])
                  || empty($posted['phone'])
                  || empty($posted['productinfo'])
                  || empty($posted['surl'])
                  || empty($posted['furl'])
                  || empty($posted['service_provider'])
          ) {
            $formError = 1;
          } else {
            //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));


            // extracting hashed detailes form $hasvarseq and pushin into anothe array name $hasstring 
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';  
            foreach($hashVarsSeq as $hash_var) {
              $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
              $hash_string .= '|';
            }

            $hash_string .= $SALT;


            $hash = strtolower(hash('sha512', $hash_string));
            $action = $PAYU_BASE_URL . '/_payment';
          }

        }




        /* ending making hash */

        if($formError == 1){
            echo "Form Submitation Error";
        }else{
            return view('payment.PayGo',[
                                                "PAYU_BASE_URL"=>$action,
                                                "MERCHANT_KEY"=>$MERCHANT_KEY,
                                                "hash"=>$hash,
                                                'txnid'=>$txnid,
                                                'firstname'=>$_POST['firstname'],
                                                'amount'=>$_POST['amount'],
                                                'email'=>$_POST['email'],
                                                'phone'=>$_POST['phone'],
                                                'productinfo'=>$_POST['productinfo'] ,
                                                'surl'=>$_POST['surl'],
                                                'furl'=>$_POST['furl']
                                            ]
                        );
        }


    }




    function payment_success_fail(){

        $status=$_POST["status"];


        $unmappedstatus=$_POST["unmappedstatus"];
        $txnid=$_POST["txnid"];
        $mode=$_POST["mode"];

        $field9=$_POST["field9"];
        $payuMoneyId=$_POST["payuMoneyId"];

        $t=time();
        $paymentTime = date("Y-m-d  H:i:s",$t);

        $cardnum = "";
        if (isset($_POST["cardnum"])) {
            $cardnum  = $_POST["cardnum"];
        }


        // to show
        $amount=$_POST["amount"];
        $productinfo=$_POST["productinfo"];
        
        // echo("$status.$unmappedstatus.$txnid.$mode.$field9.$payuMoneyId.$paymentTime.$cardnum");
        // return;
        // status success vv dd 
        // unmappedstatus userCancelled vv
        // txnid vv
        //cardnum

        // addedon2019-03-26 20:38:11 vv
        // field9:Cancelled by user vv
        // mode:CC  vv


        //$firstname=$_POST["firstname"];
        //$posted_hash=$_POST["hash"];
        ////$mobile=$_POST['mobile'];
        //$email=$_POST["email"];

        // /* inserting success data in database */
 
        if($status == "success"){
            DB::table('payment_tab')
                ->where('transaction_id', $txnid)
                ->update([
                    'payment_status' => 'success',
                    'unmappedstatus' => $unmappedstatus,
                    'mode' => $mode,
                    'field9' => $field9,
                    'gatewayId' => $payuMoneyId,
                    'paymentTime' => $paymentTime,
                    'cardnum' => $cardnum
                ]);

                $txnid_arr = explode('-',$txnid );
                // making purchsed test entry in test purchesed table
                if ($txnid_arr[0] == 'pack') {
                    $arrOfTest =  DB::table('test_info_tab')
                        ->select('test_info_id','expDate')
                        ->where('package_id', $txnid_arr[1])
                        ->get();

                    foreach ($arrOfTest as $key => $value) {
                        DB::table('purchased_test_tab')->insert([
                            'test_info_id' => $value->test_info_id,
                            'user_id' => $txnid_arr[2],
                            'transaction_id' => $txnid
                        ]);
                    }


                }else if ($txnid_arr[0] == 'test') {
                    DB::table('purchased_test_tab')->insert([
                            'test_info_id' => $txnid_arr[1],
                            'user_id' => $txnid_arr[2],
                            'transaction_id' => $txnid
                    ]);
                }
        }elseif ($status == "failure") {
            DB::table('payment_tab')
                ->where('transaction_id', $txnid)
                ->update([
                    'payment_status' => 'failure',
                    'unmappedstatus' => $unmappedstatus,
                    'mode' => $mode,
                    'field9' => $field9,
                    'gatewayId' => $payuMoneyId,
                    'paymentTime' => $paymentTime,
                    'cardnum' => $cardnum
                ]);
        }
        


        //5123456789012346
        // 05/20
        // 123
        // var_dump($_POST);

        if ($status == "success") {
            return view('payment.payment_success',['status'=>$status,'amount'=>$amount,'productinfo'=>$productinfo,'payment_id'=>$payuMoneyId,'mode'=>$mode]);

        }else if($status == "failure"){
            return view('payment.payment_failed',['status'=>$status,'amount'=>$amount,'productinfo'=>$productinfo,'payment_id'=>$payuMoneyId,'mode'=>$mode]);
        }
        
    }
} 


