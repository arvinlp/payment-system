<?php
/*
 * @Author: arvinlp 
 * @Date: 2022-04-17 16:40:56 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-10-07 17:03:50
 */
namespace App\Http\Controllers\V1;

use IPPanel\Client;
use IPPanel\Errors\Error;

class SMSController{

    private $sms;
    private $apiKey = '=';
    private $number = '+98100020400';

    public function __construct($apiKey=null,$number='+98100020400'){
        $this->apiKey = env('VIRA_SMS_API_KEY','=');
        $this->number = env('VIRA_SMS_NUMBER','+98100020400');
        if($apiKey) $this->apiKey = $apiKey;
        if($number) $this->number = $number;
    }

    public function getCredit(){
        $client = new Client($this->apiKey);
        $credit = $client->getCredit();
        return $credit;
    }

    public function sendToMany($recipients = null, $message = null){

        try{
            if($recipients == null) return false;
            if($message == null) return false;
            $client = new Client($this->apiKey);
            $bulkID = $client->send(
                $this->number,
                $recipients,
                $message,
                ''
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function sendPassword(float $recipient, $name = "کاربر", $code = null){
        try{
            if($recipient == null) return false;
            if($code == null) return false;
            if($name == null) "کاربر";
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
                "code" => "{$code}",
            ];
            
            $bulkID = $client->sendPattern(
                "x0tpqx98qawrfzy",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function verifyCode(float $recipient, $name = "کاربر", $code = null){
        try{
            if($recipient == null) return false;
            if($code == null) return false;
            if($name == null) "کاربر";
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
                "code" => "{$code}",
            ];
            
            $bulkID = $client->sendPattern(
                "x0tpqx98qawrfzy",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function expireSub(float $recipient, $name = "کاربر", $day = null){
        try{
            if($recipient == null) return false;
            if($day == null) return false;
            if($name == null) "کاربر";
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
                "day" => "{$day}",
            ];
            
            $bulkID = $client->sendPattern(
                "6p5jgi2ptirjwwk",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function verifyCodeByAnother(float $recipient, $name = "کاربر", $number = null, $code = null){
        try{
            if($recipient == null) return false;
            if($code == null) return false;
            if($name == null) "کاربر";
            if($number == null) return false;
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
                "code" => "{$code}",
                "number" => "{$number}",
            ];
            
            $bulkID = $client->sendPattern(
                "zzejnf0y3ipgr1i",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function wallet(float $recipient, $name = "کاربر", $amount = null){
        try{
            if($recipient == null) return false;
            if($amount == null) return false;
            if($name == null) "کاربر";
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
                "amount" => "{$amount}",
            ];
            
            $bulkID = $client->sendPattern(
                "okqgxlwx3mx3eor",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function payment(float $recipient, $name = "کاربر"){
        try{
            if($recipient == null) return false;
            if($name == null) "کاربر";
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
            ];
            
            $bulkID = $client->sendPattern(
                "okqgxlwx3mx3eor",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function sendNotification(float $recipient, $name = "کاربر"){
        try{
            if($recipient == null) return false;
            if($name == null) "کاربر";
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
            ];
            
            $bulkID = $client->sendPattern(
                "zob7mgqxgc9pisc",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }

    public function alertService(float $recipient, $name = "کاربر"){
        try{
            if($recipient == null) return false;
            if($name == null) return false;
            $client = new Client($this->apiKey);
            $patternValues = [
                "name" => "{$name}",
            ];
            
            $bulkID = $client->sendPattern(
                "6p5jgi2ptirjwwk",
                $this->number,
                "+98{$recipient}",
                $patternValues
            );
            return $bulkID;
        } catch (Error $e) {
            return $e;
        }
    }
}
