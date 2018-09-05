<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of download
 *
 * @author Sharma Anshuman
 */
class Home extends CI_Controller{
    

    function index()
    {
        //DB
        $this->load->model('Vegetable');
        $data['eCoupons'] = $this->Vegetable->getLastTenEntries();

        //Page
        $data['pageTitle'] = 'Home';

        //View
        $this->load->view('include/navbar',$data);
        $this->load->view('home',$data);
        $this->load->view('include/footer');
    }

    function myaccount()
    {
        //DB
        $this->load->model('userinfo');
        if($this->userinfo->getUserInfo("ashu123","ashu123")){
            if(1){
                //Page
                $data['pageTitle'] = 'Welcome  MyAccount';
                //View
                $this->load->view('include/navbar',$data);
                $this->load->view('myaccount');
                $this->load->view('include/footer');
            }
        }else{
            //Page
            $data['pageTitle'] = 'MyAccount';
            //View
            $this->load->view('include/navbar',$data);
            $this->load->view('myaccount');
            $this->load->view('include/footer');
        }

    }

    function cart(){
        //Page
        $data['pageTitle'] = 'My Cart';

        //View
        $this->load->view('include/navbar');
        $this->load->view('cart',$data);
        $this->load->view('include/footer');

    }

    function search()
    {
        //Page
        $data['pageTitle'] = 'Search';
        $data['search_token'] =  $this->input->post('search_token');

        //DB
        $this->load->model('coupons_m');
        $searchResult = $this->coupons_m->searchCoupons($this->input->post('search_token'));
        if($searchResult != False)
            $data['searchResult'] = $searchResult ;
        else
            $data['error'] = " ' <b>".$this->input->post('search_token')."</b> ' related coupon not found";

        //View
        $this->load->view('include/navbar');
        $this->load->view('search_v',$data);
        $this->load->view('include/footer');
    }

    function showCoupon($couponID){

        //Page
        $data['pageTitle'] = "Coupon Code";

        //DB
        $this->load->model('coupons_m');
        $couponCodeData = $this->coupons_m->showCoupon($couponID);
        if($couponCodeData != False)
            $data['couponCode'] = $couponCodeData;
        else
            $data['error'] = " ' <b>".$couponCodeData."</b> ' related coupon code not found";


        //View
        $this->load->view('include/navbar',$data);
        $this->load->view('showcoupon_v',$data);
        $this->load->view('include/footer');

    }
}
