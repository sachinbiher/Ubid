<?php

use Illuminate\Support\Str;

if (! function_exists('__asset')) {
    function __asset($path, $secure = null) {
        return asset('/'.'assets'.'/'. trim($path, '/'), $secure);
    }
}

if (!function_exists('__setDatatableCurrPage')) {
    function __setDatatableCurrPage($for, $length=10, $page=1){

        Session::put('category_perpage', Session::get('category_perpage', 10));
        Session::put('category_page', Session::get('category_page', 1));

        Session::put('subcategory_data_perpage', Session::get('subcategory_data_perpage', 10));
        Session::put('subcategory_data_page', Session::get('subcategory_data_page', 1));

        Session::put('customer_data_perpage', Session::get('customer_data_perpage', 10));
        Session::put('customer_data_page', Session::get('customer_data_page', 1));

        Session::put('tickets_perpage', Session::get('tickets_perpage', 10));
        Session::put('tickets_page', Session::get('tickets_page', 1));

        Session::put('partner_data_perpage', Session::get('partner_data_perpage', 10));
        Session::put('partner_data_page', Session::get('partner_data_page', 1));

        Session::put('subscription_perpage', Session::get('subscription_perpage', 10));
        Session::put('subscription_page', Session::get('subscription_page', 1));

        Session::put('subscriber_perpage', Session::get('subscriber_perpage', 10));
        Session::put('subscriber_page', Session::get('subscriber_page', 1));

        switch ($for) {
            case 'category':
                Session::put('category_perpage', $length);
                Session::put('subcategory_data_page', $page);
                break;

            case 'subcategory':
                Session::put('subcategory_data_perpage', $length);
                Session::put('subcategory_data_page', $page);
                break;

            case 'customer':
                Session::put('customer_data_perpage', $length);
                Session::put('customer_data_page', $page);
                break;

            case 'ticket':
                Session::put('tickets_perpage', $length);
                Session::put('tickets_page', $page);
                break;

            case 'partner':
                Session::put('partner_data_perpage', $length);
                Session::put('partner_data_page', $page);
                break;

            case 'subscription':
                Session::put('subscription_data_perpage', $length);
                Session::put('subscription_data_page', $page);
                break;

            case 'subscriber':
                Session::put('subscriber_data_perpage', $length);
                Session::put('subscriber_data_page', $page);
                break;

            default:
                # code...
                break;
        }
    }
}

if (!function_exists('__setFlashMessage')) {
    function __setFlashMessage($data=[])
    {
        Session::flash('toast', $data['toast']?:0);
        Session::flash('title', $data['title']?:'');
        Session::flash('message', $data['message']?:'');
        Session::flash('status', $data['status']?:'success');
    }
}

if (!function_exists('__generateOtp')) {
    function __generateOtp($length = 4)
    {
        $random = str_shuffle('0123456789');
        return substr($random, 0, $length);
    }
}

if (!function_exists('__generateNewVendorId')) {
    function __generateNewVendorId() // Product id, uniqueId
    {
        $vendorCount = DB::table('vendors')->count();
        $vendorNewId = $vendorCount+1;
        $serial = sprintf('V%04d',$vendorNewId);
        return $serial;
    }
}

if (!function_exists('__generateNewCustomerId')) {
    function __generateNewCustomerId()
    {
        $custCount = DB::table('customers')->count();
        $serial = sprintf('%04d',$custCount+1);
        return $serial;
    }
}

if (!function_exists('__generateNewTicketId')) {
    function __generateNewTicketId() // Product id, uniqueId
    {
        $ticketCount = DB::table('tickets')->max('ticket_id');
        $serial = ($ticketCount)?$ticketCount+1:100000;
        return $serial;
    }
}