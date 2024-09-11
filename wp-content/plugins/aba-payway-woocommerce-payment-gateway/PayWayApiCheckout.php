<?php
class aba_PAYWAY_AIM extends WC_Payment_Gateway {

	function __construct() {

        // global ID
		$this->id = "aba_payway_aim";

		// Show Title
		$this->method_title = __( "ABA PayWay Payment Gateway", 'aba-payway-aim' );

		// Show Description
		$this->method_description = __( "Payment Gateway By ABA Bank", 'aba-payway-aim' );

		// vertical tab title
		$this->title = __( "ABA PayWay Payment Gateway", 'aba-payway-aim' );

		$this->icon = null;

		$this->has_fields = false;

		// support default form with credit card
		//$this->supports = array( 'default_credit_card_form' );

		// setting defines
		$this->init_form_fields();
        $this->test_pi_url = $this->get_option('test_api_url');
		// load time variable setting
		$this->init_settings();

		// Turn these settings into variables we can use
		foreach ( $this->settings as $setting_key => $value ) {
			$this->$setting_key = $value;
		}

		// further check of SSL if you want
		//add_action( 'admin_notices', array( $this,	'do_ssl_check' ) );

		$mode_api = $this->get_option('environment');

		if($mode_api == 'yes'){
			if ( !defined('ABA_PAYWAY_API_URL') )
			define('ABA_PAYWAY_API_URL',$this->get_option('api_url'));
		}else{
			if ( !defined('ABA_PAYWAY_API_URL') )
			define('ABA_PAYWAY_API_URL',$this->get_option('test_pi_url'));
		}

		/*
		|--------------------------------------------------------------------------
		| ABA PayWay API KEY
		|--------------------------------------------------------------------------
		| API KEY that is generated and provided by PayWay must be required in your post form
		|
		*/
		if ( !defined('ABA_PAYWAY_API_KEY') )
			define('ABA_PAYWAY_API_KEY', $this->get_option('api_url'));

		/*
		|--------------------------------------------------------------------------
		| ABA PayWay Merchant ID
		|--------------------------------------------------------------------------
		| Merchant ID that is generated and provided by PayWay must be required in your post form
		|
		*/
        if ( !defined('ABA_PAYWAY_MERCHANT_ID') )
			define('ABA_PAYWAY_MERCHANT_ID', $this->get_option('maerchant_id'));

		// Save settings
		if ( is_admin() ) {
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		}
	}

	public function get_icon() {
		$get_size = $this->get_option('image_size');
		$payment_option = $this->get_option('payment_options');
		$bg_color = $this->get_option('bg_color');
		$aba_payway = $payment_option[0];
		$credit_debit = isset($payment_option[1])?$payment_option[1]:$payment_option[0];

		if( $get_size == 'small' ){
			$icon = "";

			if($credit_debit == 'credit_debit')
			{
			$icon  .= sprintf(
				'<img src="%s" alt="Master Card" class="img-1x"  style="margin-left: 2px;"/>',
				WC_HTTPS::force_https_url( plugins_url('/images/'.$bg_color.'/1x/credit_debit.png', __FILE__ ) )
			);
			}

			if($aba_payway == 'aba_apy')
			{
			$icon  .= sprintf(
				'<img src="%s" alt="ABA Pay" class="img-1x"/>',
				WC_HTTPS::force_https_url( plugins_url( '/images/'.$bg_color.'/1x/aba.png', __FILE__ ) )
			);
			}
		}elseif($get_size == 'medium'){
			$icon = "";

			if($credit_debit == 'credit_debit')
			{
			$icon  .= sprintf(
				'<img src="%s" alt="Master Card" class="img-2x"  style="margin-left: 3px;"/>',
				WC_HTTPS::force_https_url( plugins_url('/images/'.$bg_color.'/2x/credit_debit.png', __FILE__ ) )
			);
			 }
			if($aba_payway == 'aba_apy')
			{
			$icon  .= sprintf(
				'<img src="%s" alt="ABA Pay" class="img-2x"/>',
				WC_HTTPS::force_https_url( plugins_url( '/images/'.$bg_color.'/2x/aba.png', __FILE__ ) )
			);
			}

		}elseif($get_size == 'large'){
			$icon = "";

			if($credit_debit == 'credit_debit')
			{
			$icon  .= sprintf(
				'<img src="%s" alt="Master Card" class="img-3x" style="margin-left: 3px;"/>',
				WC_HTTPS::force_https_url( plugins_url('/images/'.$bg_color.'/3x/credit_debit.png', __FILE__ ) )
			);
			 }

			if($aba_payway == 'aba_apy')
			 {
			$icon  .= sprintf(
				'<img src="%s" alt="ABA Pay" class="img-3x"/>',
				WC_HTTPS::force_https_url( plugins_url( '/images/'.$bg_color.'/3x/aba.png', __FILE__ ) )
			);
			 }

		}
		$icon = '<span class="abay_payway_icon">'.$icon.'</span>';
		return apply_filters( 'woocommerce_gateway_icon', $icon, $this->id );
    }

	// administration fields for specific Gateway
	public function init_form_fields() {

		$this->form_fields = array(
			'enabled' => array(
				'title'		=> __( 'Enable / Disable', 'aba-payway-aim' ),
				'label'		=> __( 'Enable this payment gateway', 'aba-payway-aim' ),
				'type'		=> 'checkbox',
				'default'	=> 'no',
			),
			'title' => array(
				'title'		=> __( 'Payment Label', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( 'Payment title of checkout process.', 'aba-payway-aim' ),
				'default'	=> __( 'PayWay', 'aba-payway-aim' ),
			),
			'payment_options' => array(
				 'title' => 'Payment Methods',
				 'description' => false,
				 'type' => 'multiselect',
				 'default' => 'Default value for the option',
				 'class' => 'Class for the input',
				 'css' => 'min-width:150px;height:90px;',
				 'label' => 'Label', // checkbox only
				 'options' => array(
					  'abapay_khqr' => 'ABA KHQR',
					  'credit_debit' => 'Credit/Debit Card',
					  'wechat' => 'WeChat',
					  'alipay' => 'Alipay',
				 )
			),

			'bg_color' => array(
				'title' => 'Background Color',
				'description' => false,
				'type' => 'select',
				'std'     => 'small', // WooCommerce < 2.0
				'default' => 'small', // WooCommerce >= 2.0
				'class' => 'Class for the input',
				'css' => 'min-width:150px;',
				'label' => 'Label', // checkbox only
				'options' => array(
					'white' => 'White Background',
					'color' => 'Color Background',
				)
			),
			'description' => array(
				'title'		=> __( 'Description', 'aba-payway-aim' ),
				'type'		=> 'textarea',
				'desc_tip'	=> __( 'Payment title of checkout process.', 'aba-payway-aim' ),
				'default'	=> __( 'Successfully payment through PayWay.', 'aba-payway-aim' ),
				'css'		=> 'max-width:400px;'
			),
			'maerchant_id' => array(
				'title'		=> __( 'Merchant ID', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( 'Merchant id will be here.', 'aba-payway-aim' ),
				'default'	=> false,
			),
			'api_url' => array(
				'title'		=> __( 'Production API base URL', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( '', 'aba-payway-aim' ),
			),
			'test_api_url' => array(
				'title'		=> __( 'Sandbox API base URL', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( '', 'aba-payway-aim' ),
			),
			'api_endpoint' => array(
				'title'		=> __( 'Production API Endpoint', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( '', 'aba-payway-aim' ),
			),
			'api_endpoint_sandbox' => array(
				'title'		=> __( 'Sandbox API Endpoint', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( '', 'aba-payway-aim' ),
			),
			'api_key' => array(
				'title'		=> __( 'API Key', 'aba-payway-aim' ),
				'type'		=> 'password',
				'desc_tip'	=> __( '' ),
			),
			'environment' => array(
				'title'		=> __( 'Sandbox Mode', 'aba-payway-aim' ),
				'label'		=> __( 'Sandbox Mode', 'aba-payway-aim' ),
				'type'		=> 'checkbox',
				'description' => __( 'This is the test mode of gateway.', 'aba-payway-aim' ),
				'default'	=> 'no',
			),
			'production_js' => array(
				'title'		=> __( 'Production API JS URL', 'aba-payway-aim' ),
				'type'		=> 'text',
				'class'		=> 'production-css-js',
				'default' => 'https://checkout.payway.com.kh/plugins/checkout2-0.js',
				'desc_tip'	=> __( '', 'aba-payway-aim' ),
			),
			'sandbox_js' => array(
				'title'		=> __( 'Sandbox API JS URL', 'aba-payway-aim' ),
				'type'		=> 'text',
				'class'		=> 'sandbox-css-js',
				'default' => 'https://checkout.payway.com.kh/plugins/checkout2-0.js',
				'desc_tip'	=> __( '', 'aba-payway-aim' ),
			),
			'hide_close' => array(
				'title'    => __( 'Hide/Unhide Close Button', 'woocommerce' ),
				'description'    => __( '', 'woocommerce' ),
				'id'      => 'hide_close',
				'css'     => 'min-width:150px;',
				'std'     => 'small', // WooCommerce < 2.0
				'default' => 'small', // WooCommerce >= 2.0
				'type'    => 'select',
				'options' => array(
				  'hide_yes'        => __( 'Yes', 'woocommerce' ),
				  'hide_no'       => __( 'No', 'woocommerce' ),
				),
				'desc_tip' =>  true,
             ),
			'successful_redirection_url_web' => array(
				'title'		=> __( 'Continue Success URL for Web', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( 'The URL Host has to be registered in Merchant profile. Otherwise, PayWay will reject the request.', 'aba-payway-aim' ),
			),
			'successful_redirection_url_mobile' => array(
				'title'		=> __( 'Continue Success URL for Mobile', 'aba-payway-aim' ),
				'type'		=> 'text',
				'desc_tip'	=> __( 'The URL Host has to be registered in Merchant profile. Otherwise, PayWay will reject the request.', 'aba-payway-aim' ),
			),
            'pushback_url' => array(
                'title'		=> __( 'Pushback URL', 'aba-payway-aim' ),
                'type'		=> 'text',
                'default' => home_url("abapayway/pushback"),
                'desc_tip'	=> __( "The URL will be pushed by PayWay after the payment is completed. You may need to change to bellow URL if the default pushback URL is not working. ".home_url("?aba_payway_pushback=1"), 'aba-payway-aim' ),
            ),
            'dynamic_script' => array(
                'title'		=> __( 'Additional JS', 'aba-payway-aim' ),
                'type'		=> 'textarea',
                'desc_tip'	=> __( '', 'aba-payway-aim' ),
                'default'	=> __( '', 'aba-payway-aim' ),
                'css'		=> 'max-width:400px;min-height:200px;'
            ),
            'dynamic_css' => array(
                'title'		=> __( 'Additional CSS', 'aba-payway-aim' ),
                'type'		=> 'textarea',
                'desc_tip'	=> __( '', 'aba-payway-aim' ),
                'default'	=> __( '', 'aba-payway-aim' ),
                'css'		=> 'max-width:400px;min-height:200px;'
            ),
		);
	}



	// Response handled for payment gateway
	public function process_payment( $order_id ) {
		global $woocommerce;
		$order = new WC_Order( $order_id );
		//die(var_dump($_REQUEST));
		//Set transaction id in session
		if( $_SESSION['aba_transaction_id'] ) {
			update_post_meta( $order_id,'aba_transaction_id',$_SESSION['aba_transaction_id'] );
		}
		if( !empty($order_id) ) {
			$_SESSION['aba_order_id'] = $order_id;
		}

		if( isset($_POST['aba_choosen_method']) ){
            $_SESSION['aba_choosen_method'] = $_POST['aba_choosen_method'];
        }else{
            $_SESSION['aba_choosen_method'] = '';
        }

		// Mark as Pending payment (we're awaiting the payment)
		$order->update_status('Pending payment', __( 'Awaiting payment', 'woocommerce-other-payment-gateway' ));

        // Reduce stock levels
		wc_reduce_stock_levels( $order_id );
		if(isset($_POST[ $this->id.'-admin-note']) && trim($_POST[ $this->id.'-admin-note'])!=''){
			$order->add_order_note(esc_html($_POST[ $this->id.'-admin-note']),1);
		}

        $items_result = $order->get_items();
        $shipping_fee = $order->get_shipping_total();
        $discount = $order->get_discount_total();
        $amount = sprintf("%.2f", $order->get_total() - $shipping_fee);
        $shipping_fee = sprintf("%.2f", $shipping_fee);

        $key = 0;
        $item = array();
        $total_no_discount = $order->get_total() + $discount;
        foreach ($items_result as $order_item_id => $order_item) {
            $product = $order_item->get_product();
            $item[$key]['name'] = $order_item->get_name();
            $item[$key]['quantity'] = $order_item->get_quantity();
            $item[$key]['price'] = sprintf("%.2f", $product->get_price());
            if( $discount > 0 ){
                $item[$key]['discount'] =  (($product->get_price() * $order_item->get_quantity() * 100)/$total_no_discount) * $discount/100;
            }
            $key++;
        }
        $first_name = '';
        $last_name = '';
        $email = '';
        $phone = '';
        if( is_array($woocommerce->customer->billing) ){
            $first_name = $woocommerce->customer->billing['first_name'];
            $last_name = $woocommerce->customer->billing['last_name'];
            $email = $woocommerce->customer->billing['email'];
            $phone = $woocommerce->customer->billing['phone'];
        }
        $items = base64_encode(json_encode($item));
        $reqTime = date("YYYYmdHis");
        $shipping_fee = !empty($shipping_fee)?$shipping_fee:"";
        $hasConcat = aba_PAYWAY_AIM::getMerchantId() . $order_id . $amount . $items. $shipping_fee;
        $hash = aba_PAYWAY_AIM::getHash($order_id, $amount, $items, $shipping_fee);
        $returnUrl = base64_encode(aba_PAYWAY_AIM::getReturnURL($order_id));

		return array(
		  'result' => 'success',
		  "order_id" => $order_id,
		  "aba_hash" => $hash,
		  "aba_before_hash" => $hasConcat,
		  "items" => $items,
		  "amount" => $amount,
		  "shipping_fee" => $shipping_fee,
		  "return_url" => $returnUrl,
		);
	}

	public static function getApiUrl() {
		$myPluginGateway = new aba_PAYWAY_AIM();
		$mode_api = $myPluginGateway->get_option('environment');
		if($mode_api == 'yes')
		{
			$api_url = $myPluginGateway->get_option('test_api_url');
		}else{
			$api_url = $myPluginGateway->get_option('api_url');
		}
		return $api_url;
	}

	public static function getHash($transactionId, $amount, $items, $shipping) {
		$PluginGateway = new aba_PAYWAY_AIM();
		$hash = base64_encode(hash_hmac('sha512', $PluginGateway->get_option('maerchant_id') . $transactionId . $amount . $items . $shipping, $PluginGateway->get_option('api_key'), true));
		return $hash;
	}

	public static function getCheckTranHash($transactionId) {
		$PluginGateway = new aba_PAYWAY_AIM();
		$hash = base64_encode(hash_hmac('sha512', $PluginGateway->get_option('maerchant_id') . $transactionId, $PluginGateway->get_option('api_key'), true));
		return $hash;
	}

	public static function getApiKey() {
		$PluginGateway = new aba_PAYWAY_AIM();
		$api_key = $PluginGateway->get_option('api_key');
		return $api_key;
	}

	public static function getJssend() {
		$PluginGateway = new aba_PAYWAY_AIM();
		$mode_api = $PluginGateway->get_option('environment');
		if($mode_api == 'yes')
		{
			$payway_js = $PluginGateway->get_option('sandbox_js');
		}else{
			$payway_js = $PluginGateway->get_option('production_js');
		}
		return $payway_js;
	}

	public static function getHideclose() {
		$PluginGateway = new aba_PAYWAY_AIM();
		$hide_close = $PluginGateway->get_option('hide_close');
		if($hide_close == 'hide_yes')
		{
			$close_stat = 'hide-close=1';
		}else{
			$close_stat = 'hide-close=0';
		}
		return $close_stat;
	}

	public static function getEndpointApiUrl() {
		$myPluginGateway = new aba_PAYWAY_AIM();
		$mode_api = $myPluginGateway->get_option('environment');
		if($mode_api == 'yes')
		{
			$api_url_endpoint = $myPluginGateway->get_option('api_endpoint_sandbox');
		}else{
			$api_url_endpoint = $myPluginGateway->get_option('api_endpoint');
		}
		return $api_url_endpoint;
	}

	public static function checkTransaction( $tran_id ) {
		$myPluginGateway = new aba_PAYWAY_AIM();
		$url = aba_PAYWAY_AIM::getApiUrl().'/api/payment-gateway/v1/payments/check-transaction';
		$reqTime = date("YYYYmdHis");
		$merchantId = $myPluginGateway->get_option('maerchant_id');
		$hash = base64_encode(hash_hmac('sha512', $reqTime.$merchantId . $tran_id, aba_PAYWAY_AIM::getApiKey(), true));
		$postfields = array(
			'tran_id' => $tran_id,
			'hash' => $hash,
			'req_time' => $reqTime,
			'merchant_id' => $merchantId
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PROXY, null);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
		$result = curl_exec($ch);//Result Json
		$result = json_decode($result, true);
		$paymentStatus = isset($result['payment_status'])?$result['payment_status']:'';
		if(strtoupper($paymentStatus) == 'APPROVED'){
			return true;
		}else{
			return false;
		}
	}

	public static function getContinueSuccessUrl() {
        $PluginGateway = new aba_PAYWAY_AIM();
		$redirection_url = '';
		$is_mobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
		if( $is_mobile ){
			$redirection_url = $PluginGateway->get_option('successful_redirection_url_mobile');
		}else{
			$redirection_url = $PluginGateway->get_option('successful_redirection_url_web');
		}
		return $redirection_url;
	}

	public static function getReturnURL($tran_id){
	    $token = self::pwEncrypt(json_encode(["tran_id" => $tran_id, "time" => time()]), self::getApiKey());
        $url = aba_PAYWAY_AIM::getPushbackUrl();
        $parameters = array(
            'payway_token' => urlencode($token)
        );
        return add_query_arg($parameters, $url);
	}

	public static function getPaymentOption(){
        $PluginGateway = new aba_PAYWAY_AIM();
        $payment_option = $PluginGateway->get_option('payment_options');
        return implode(",", $payment_option);
    }

    public static function isEnabled(){
        $PluginGateway = new aba_PAYWAY_AIM();
        $enabled = $PluginGateway->get_option('enabled');
        return $enabled;
    }

    public static function getImageUrl( $file ) {
        $PluginGateway = new aba_PAYWAY_AIM();
        $bg_color = $PluginGateway->get_option('bg_color');
        $url = WC_HTTPS::force_https_url( plugins_url('/images/'.$bg_color.'/'.$file.'.svg?v=2', __FILE__ ));
        return $url;
    }

    public static function getBackgroundColor() {
        $PluginGateway = new aba_PAYWAY_AIM();
        $bg_color = $PluginGateway->get_option('bg_color');
        return $bg_color;
    }

    public static function getMerchantId() {
        $myPluginGateway = new aba_PAYWAY_AIM();
        return $myPluginGateway->get_option('maerchant_id');
	}

    public static function getDynamicScript() {
        $myPluginGateway = new aba_PAYWAY_AIM();
        return $myPluginGateway->get_option('dynamic_script');
    }

    public static function getDynamicCSS() {
        $myPluginGateway = new aba_PAYWAY_AIM();
        return $myPluginGateway->get_option('dynamic_css');
    }

    public static function getPushbackUrl() {
        $myPluginGateway = new aba_PAYWAY_AIM();
        $url = $myPluginGateway->get_option('pushback_url');
        if(empty($url)){
            $url = get_permalink(get_page_by_path('abapayway/pushback'));
        }
        return $url;
    }

    public static function pwEncrypt(
        $plainText,
        $password       = 'k54l434l3kf',
        $iv16char       = '5454365443ffdsfs',
        $method         = 'aes-256-cbc',
        $keyEncryptType = 0
    ) {
        $key = substr(hash_hmac('sha256', $password, $iv16char), 10, 42);
        if($keyEncryptType == 1){
            $key = substr(hash('sha256', $password, true), 0, 32);
        }
        return base64_encode(openssl_encrypt($plainText, $method, $key, OPENSSL_RAW_DATA, $iv16char));
    }

    /**
     * @param $plainText
     * @param string $password
     * @param string $iv16char
     * @param string $method
     * @param int $keyEncryptType
     * @return string
     */
    public static function pwDecrypt(
        $plainText,
        $password = 'k54l434l3kf',
        $iv16char = '5454365443ffdsfs',
        $method = 'aes-256-cbc',
        $keyEncryptType = 0
    ) {
        $key = substr(hash_hmac('sha256', $password, $iv16char), 10, 42);
        if($keyEncryptType == 1){
            $key = substr(hash('sha256', $password, true), 0, 32);
        }
        return openssl_decrypt(base64_decode($plainText), $method, $key, OPENSSL_RAW_DATA, $iv16char);
    }



}
