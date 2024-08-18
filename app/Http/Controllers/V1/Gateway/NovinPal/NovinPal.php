<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-08-18 21:52:23 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-08-18 22:35:18
 */

namespace App\Http\Controllers\V1\Gateway\NovinPal;

use GuzzleHttp\Client;
use Shetabit\Multipay\Abstracts\Driver;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Contracts\ReceiptInterface;
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Receipt;
use Shetabit\Multipay\RedirectionForm;
use Shetabit\Multipay\Request;

class NovinPal extends Driver
{
    /**
     * NovinPal Client.
     *
     * @var object
     */
    protected $client;

    /**
     * Invoice
     *
     * @var Invoice
     */
    protected $invoice;

    /**
     * Driver settings
     *
     * @var object
     */
    protected $settings;

    /**
     * NovinPal constructor.
     * Construct the class with the relevant settings.
     *
     * @param Invoice $invoice
     * @param $settings
     */
    public function __construct(Invoice $invoice, $settings)
    {
        $this->invoice($invoice);
        $this->settings = (object) $settings;
        $this->client = new Client();
    }

    /**
     * Purchase Invoice.
     *
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function purchase()
    {
        $details = $this->invoice->getDetails();

        $amount = $this->invoice->getAmount() * ($this->settings->currency == 'T' ? 10 : 1); // convert to rial

        $orderId = crc32($this->invoice->getUuid()).time();
        if (!empty($details['orderId'])) {
            $orderId = $details['orderId'];
        } elseif (!empty($details['order_id'])) {
            $orderId = $details['order_id'];
        }
        
        $data = array(
            "api_key"=> $this->settings->mode === "normal" ? $this->settings->merchantId : "sandbox", //required
            "return_url"=> $this->settings->callbackUrl, //required
            "amount"=> $amount, //required
            "order_id"=>$orderId, //required
        );

        // Pass current $data array to add existing optional details
        $data = $this->checkOptionalDetails($data);

        $response = $this->client->request(
            'POST',
            $this->settings->apiPurchaseUrl,
            ["json" => $data, "http_errors" => false]
        );

        $body = json_decode($response->getBody()->getContents(), false);
        
        if ($body->status != 1) {
            // some error has happened
            throw new PurchaseFailedException($body->errorDescription);
        }

        $this->invoice->transactionId($body->refId);

        // return the transaction's id
        return $this->invoice->getTransactionId();
    }

    /**
     * Pay the Invoice
     *
     * @return RedirectionForm
     */
    public function pay() : RedirectionForm
    {
        $payUrl = $this->settings->apiPaymentUrl.$this->invoice->getTransactionId();

        return $this->redirectWithForm($payUrl);
    }

    /**
     * Verify payment
     *
     * @return mixed|void
     *
     * @throws InvalidPaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function verify() : ReceiptInterface
    {
        $successFlag = Request::input('success');
        $status = Request::input('code');
        $orderId = Request::input('InvoiceID');
        $transactionId = $this->invoice->getTransactionId() ?? Request::input('refId');

        if ($successFlag != 1) {
            $this->notVerified($this->translateStatus($status), $status);
        }

        //start verfication
        $data = array(
            "api_key"=> $this->settings->mode === "normal" ? $this->settings->merchantId : "sandbox", //required
            "ref_id" => $transactionId, //required
        );

        $response = $this->client->request(
            'POST',
            $this->settings->apiVerificationUrl,
            ["json" => $data, "http_errors" => false]
        );

        $body = json_decode($response->getBody()->getContents(), false);

        if ($body->status != 100) {
            $this->notVerified($body->errorDescription, $body->errorCode);
        }

        /*
            for more info:
            var_dump($body);
        */

        return $this->createReceipt($body->refNumber);
    }

    /**
     * Generate the payment's receipt
     *
     * @param $referenceId
     *
     * @return Receipt
     */
    protected function createReceipt($referenceId)
    {
        $receipt = new Receipt('NovinPal', $referenceId);

        return $receipt;
    }

    private function translateStatus($status)
    {
        $translations = [
            '100' => 'تراکنش موفقیت آمیز بود',
            '109' => 'تراکنش ناموفق بود',
            '104' => 'خطای PSP',
            '107' => 'PSP یافت نشد',
            '108' => 'خطای سرور',
            '114' => 'متد ارسال شده اشتباه است',
            '115' => 'ترمینال تأیید نشده است',
            '116' => 'ترمینال غیرفعال است',
            '117' => 'ترمینال رد شده است',
            '118' => 'ترمینال تعلیق شده است',
            '119' => 'ترمینالی تعریف نشده است',
            '120' => 'حساب کاربری پذیرنده به حالت تعلیق درآمده است',
            '121' => 'حساب کاربری پذیرنده تأیید نشده است',
            '122' => 'حساب کاربری پذیرنده یافت نشد',
        ];

        $unknownError = 'خطای ناشناخته ای رخ داده است.';

        return array_key_exists($status, $translations) ? $translations[$status] : $unknownError;
    }

    /**
     * Trigger an exception
     *
     * @param $message
     * @throws InvalidPaymentException
     */
    private function notVerified($message, $code = 0)
    {
        if (empty($message)) {
            throw new InvalidPaymentException('خطای ناشناخته ای رخ داده است.', $code);
        } else {
            throw new InvalidPaymentException($message, $code);
        }
    }

    /**
     * Retrieve data from details using its name.
     *
     * @return string
     */
    private function extractDetails($name)
    {
        $detail = null;
        if (!empty($this->invoice->getDetails()[$name])) {
            $detail = $this->invoice->getDetails()[$name];
        } elseif (!empty($this->settings->$name)) {
            $detail = $this->settings->$name;
        }

        return $detail;
    }

    /**
     * Checks optional parameters existence (except orderId) and
     * adds them to the given $data array and returns new array
     * with optional parameters for api call.
     *
     * To avoid errors and have a cleaner api call log, `null`
     * parameters are not sent.
     *
     * To add new parameter support in the future, all that
     * is needed is to add parameter name to $optionalParameters
     * array.
     *
     * @param $data
     *
     * @return array
     */
    private function checkOptionalDetails($data)
    {
        $optionalParameters = [
            'mobile',
            'description',
            'allowedCards',
            'feeMode',
            'percentMode',
            'multiplexingInfos'
        ];

        foreach ($optionalParameters as $parameter) {
            if (!is_null($this->extractDetails($parameter))) {
                $parameterArray = array(
                    $parameter => $this->extractDetails($parameter)
                );
                $data = array_merge($data, $parameterArray);
            }
        }

        return $data;
    }
}
