<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
<head>
<title> <?= $title ?></title>
</head>
<body>
<center>
<?php $this->load->view('crypto') ?>
<?php
    $working_key = $this->config->item('working_key');//Shared by CCAVENUES
    $access_code = $this->config->item('access_code');//Shared by CCAVENUES
    $merchant_data = '';
    
    $post = [
                'tid' => (int)(microtime(true)*1000),
                'merchant_id' => $this->config->item('merchant_id'),
                'order_id' => time(),
                'amount' => round($data['amount']).'.00',
                // 'amount' => '1.00',
                'currency' => 'INR',
                'redirect_url' => base_url('payment-test'),
                'cancel_url' => base_url('payment-test'),
                'language' => 'EN',
                'billing_name' => $this->user['name'],
                'billing_address' => $this->user['address'],
                'billing_city' => 'Ahmedabad',
                'billing_state' => 'Gujarat',
                'billing_zip' => '123456',
                'billing_country' => 'India',
                'billing_tel' => $this->user['mobile'],
                'billing_email' => $this->user['email'],
                'delivery_name' => $this->user['name'],
                'delivery_address' => $this->user['address'],
                'delivery_city' => 'Ahmedabad',
                'delivery_state' => 'Gujarat',
                'delivery_zip' => '123456',
                'delivery_country' => 'India',
                'delivery_tel' => $this->user['mobile'],
                'merchant_param1' => d_id($data['exam_id']),
                'merchant_param2' => d_id($data['exam_langs']),
                'merchant_param3' => $this->user_id,
                'merchant_param4' => '',
                'merchant_param5' => '',
                'promo_code' => '',
                'customer_identifier' => '',
                'integration_type' => 'iframe_normal'
    ];
    
    foreach ($post as $key => $value){
        $merchant_data.=$key.'='.$value.'&';
    }
    $encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
    // $production_url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
    $production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;

?>
<iframe src="<?php echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>

<script type="text/javascript" src="js/jquery-1.12.4.main.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
             window.addEventListener('message', function(e) {
                 $("#paymentFrame").css("height",e.data['newHeight']+'px');      
             }, false);
        });
</script>
</center>
</body>
</html>