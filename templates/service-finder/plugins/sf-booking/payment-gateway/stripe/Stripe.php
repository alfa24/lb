<?php

// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Stripe needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Stripe needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('Stripe needs the Multibyte String PHP extension.');
}

// Stripe singleton
require(plugin_dir_path(__FILE__) . 'Stripe/Stripe.php');

// Utilities
require(plugin_dir_path(__FILE__) . 'Stripe/Util.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Util/Set.php');

// Errors
require(plugin_dir_path(__FILE__) . 'Stripe/Error.php');
require(plugin_dir_path(__FILE__) . 'Stripe/ApiError.php');
require(plugin_dir_path(__FILE__) . 'Stripe/ApiConnectionError.php');
require(plugin_dir_path(__FILE__) . 'Stripe/AuthenticationError.php');
require(plugin_dir_path(__FILE__) . 'Stripe/CardError.php');
require(plugin_dir_path(__FILE__) . 'Stripe/InvalidRequestError.php');
require(plugin_dir_path(__FILE__) . 'Stripe/RateLimitError.php');

// Plumbing
require(plugin_dir_path(__FILE__) . 'Stripe/Object.php');
require(plugin_dir_path(__FILE__) . 'Stripe/ApiRequestor.php');
require(plugin_dir_path(__FILE__) . 'Stripe/ApiResource.php');
require(plugin_dir_path(__FILE__) . 'Stripe/SingletonApiResource.php');
require(plugin_dir_path(__FILE__) . 'Stripe/AttachedObject.php');
require(plugin_dir_path(__FILE__) . 'Stripe/List.php');

// Stripe API Resources
require(plugin_dir_path(__FILE__) . 'Stripe/Account.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Card.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Balance.php');
require(plugin_dir_path(__FILE__) . 'Stripe/BalanceTransaction.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Charge.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Customer.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Invoice.php');
require(plugin_dir_path(__FILE__) . 'Stripe/InvoiceItem.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Plan.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Subscription.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Token.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Coupon.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Event.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Transfer.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Recipient.php');
require(plugin_dir_path(__FILE__) . 'Stripe/Refund.php');
require(plugin_dir_path(__FILE__) . 'Stripe/ApplicationFee.php');
require(plugin_dir_path(__FILE__) . 'Stripe/ApplicationFeeRefund.php');
