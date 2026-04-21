<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
  	function send_payment_via_paypal_h($paypal_status,$payment_send_account,$custom,$item_name,$amount,$currency_code,$return_url,$cancel_url,$notify_url){
		$querystring='';
		$querystring .= "?business=".urlencode($payment_send_account)."&";
		$querystring .= "custom=".urlencode(stripslashes($custom))."&";
		$querystring .= "cmd=".urlencode(stripslashes('_xclick'))."&";	
		$querystring .= "no_note=".urlencode(stripslashes('1'))."&";
		$querystring .= "item_name=".urlencode($item_name)."&";
		$querystring .= "amount=".urlencode($amount)."&";	
		$querystring .= "rm=".urlencode(stripslashes('2'))."&";
		$querystring .= "currency_code=".urlencode(stripslashes($currency_code))."&";
	 
		//Append paypal return addresses
		$querystring .= "return=".urlencode(stripslashes($return_url))."&";
		$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
		$querystring .= "notify_url=".urlencode($notify_url);
		if(isset($paypal_status) && $paypal_status=='paypal'){		
			header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);	
		}else{	
			header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);		
		}
		exit();	
	}
	
	function paypal_payment_received_successfully_h($payment_table_name,$first_column_name,$first_column_value,$second_column_name,$second_column_value){	
		$CI = & get_instance();
		$txn_id = trim($_POST['txn_id']);
		
		$query_transaction = $CI->db->get_where("$payment_table_name", array('txn_id' =>$txn_id));
		$transaction_cnt=$query_transaction->num_rows();
		
		if($transaction_cnt==0){		
			
			$txn_type = trim($_POST['txn_type']);
			$payment_status = trim($_POST['payment_status']);
			$payer_status = trim($_POST['payer_status']);
			
			if($payment_status=='Completed' && $payer_status=='VERIFIED'){
			
				$payer_email = trim($_POST['payer_email']);
				$payer_id = trim($_POST['payer_id']);
				$payer_first_name = trim($_POST['first_name']); 	
				$payer_last_name = trim($_POST['last_name']);
				$mc_currency = trim($_POST['mc_currency']);
				$payment_gross = trim($_POST['payment_gross']);				
				$payment_type = trim($_POST['payment_type']);
				$payment_date = trim($_POST['payment_date']);
				$business = trim($_POST['business']);
				$pay_date = strtotime(date("Y-m-d"));
				$pay_time = strtotime(date("h:i A"));
				$ip_address = $_SERVER['REMOTE_ADDR'];
				
				$payment_transactions=array("$first_column_name"=>$first_column_value,"txn_id"=>$txn_id,"txn_type"=>$txn_type,"payer_email"=>$payer_email,"payer_id"=>$payer_id,"payer_status"=>$payer_status,"payer_first_name"=>$payer_first_name,"payer_last_name"=>$payer_last_name,"mc_currency"=>$mc_currency,"payment_gross"=>$payment_gross,"payment_status"=>$payment_status,"payment_type"=>$payment_type,"payment_date"=>$payment_date,"business"=>$business,"pay_date"=>$pay_date,"pay_time"=>$pay_time,"ip_address"=>$ip_address);		
				$CI->db->insert($payment_table_name,$payment_transactions);
				$transaction_id = $CI->db->insert_id();
				
				if(isset($second_column_name) && $second_column_name!='' && isset($second_column_value) && $second_column_value!=''){
					$update_second_column_data=array("$second_column_name"=>$second_column_value);		
					$CI->db->where('id',$transaction_id); 
					$CI->db->update($payment_table_name,$update_second_column_data);
				}
				
				return $transaction_id;
			
			}else{
				return 'payment_pending';
			}
		
		}else{
			return 'already_have_transaction';
		}
	}