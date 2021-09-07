<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
<head>
<title> <?= $title ?></title>
</head>
<body>
<!-- <center> -->
<?php $this->load->view('crypto') ?>
<?php
    $working_key = $this->config->item('working_key');//Shared by CCAVENUES
    $access_code = $this->config->item('access_code');//Shared by CCAVENUES
    $merchant_data = '';
    $data['price'] = round($data['price'] * ( (100  - $discount) / 100));
    $data['amount'] = round($data['price'] * 1.18) + $data['extra'];
    $country = $this->main->check('countries', ['id' => $data['country']], 'name');
    $state = $this->main->check('states', ['id' => $data['state']], 'name');
    $city = $this->main->check('cities', ['id' => $data['city']], 'name');
    
    $post = [
                'tid' => (int)(microtime(true)*1000),
                'merchant_id' => $this->config->item('merchant_id'),
                'order_id' => time(),
                'amount' => $data['amount'].'.00',
                // 'amount' => '1.00',
                'currency' => 'INR',
                'redirect_url' => base_url('payment'),
                'cancel_url' => base_url('payment'),
                'language' => 'EN',
                'billing_name' => $data['name'],
                'billing_address' => $data['address'],
                'billing_city' => $city ? $city : 'City',
                'billing_state' => $state ? $state : 'State',
                'billing_zip' => '123456',
                'billing_country' => $country ? $country : 'India',
                'billing_tel' => $data['mobile'],
                'billing_email' => $data['email'],
                'delivery_name' => $data['name'],
                'delivery_address' => $data['address'],
                'delivery_city' => $city ? $city : 'City',
                'delivery_state' => $state ? $state : 'State',
                'delivery_zip' => '123456',
                'delivery_country' => $country ? $country : 'India',
                'delivery_tel' => $data['mobile'],
                'merchant_param1' => $this->session->temp_id,
                'merchant_param2' => '',
                'merchant_param3' => '',
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