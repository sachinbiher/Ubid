<?php
namespace App\Services;

class MessageService
{

    private $AUTH_KEY  ='365998ACHbm55imj0611df6e4P1';
    private $FLOW_ID  =null;
    private $SENDER_ID  ='UBIDIN';
    private $BAS_URL ='https://control.msg91.com/api/v5/flow/';
    private $MOBILE_NUMBERS=null;
    private $MESSAGE=array();


    public function message($flow_id,array $message)
    {
        $this->FLOW_ID=$flow_id;
        $this->MESSAGE=$message;
        return  $this;
    }


    public function mobileNumber(array $mobile_numbers, int $country_code=null)
    {
        //dd($mobile_numbers);
        if ($country_code===null) {
            $this->MOBILE_NUMBERS=implode(',',$mobile_numbers);
        }else{
            $number_list ='';
            $length=count($mobile_numbers);

            if($length){
                foreach ($mobile_numbers as $index=> $mobile) {
                    if($index==0){
                        $number_list .=$country_code.$mobile;
                    }else{
                        $number_list .=','.$country_code.$mobile;
                    }
                }
            }

            $this->MOBILE_NUMBERS=$number_list;
        }
        return $this;
    }

    private function generateMessage()
    {
        $params=$this->MESSAGE;
        $params['mobiles'] = $this->MOBILE_NUMBERS;
        $var = $params['OTP'];
        $mobiles = $params['mobiles'];
        $recipients=$params;
        $postData = array(
            "sender" => $this->SENDER_ID,
            "flow_id" => $this->FLOW_ID,
            "mobiles" => $mobiles,
            "var" => $var
        );
        return json_encode($postData);
    }


    public function send()
    {
        $postDataJson=self::generateMessage();
        //dd($postDataJson);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->BAS_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postDataJson,
            CURLOPT_HTTPHEADER => array(
                "authkey: ".$this->AUTH_KEY,
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        if ($err) {
            dd($err);
            echo "cURL Error #:" . $err;
            return false;
        } else {
            return true;
        }
    }


}


