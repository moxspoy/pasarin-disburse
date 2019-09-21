<?php
/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 14:52
 * Github       : https://github.com/moxspoy
 */

class Disburse
{
    private $id_from_api;
    private $amount;
    private $status;
    private $timestamp;
    private $bank_code;
    private $account_number;
    private $beneficiary_name;
    private $remark;
    private $receipt;
    private $time_served;
    private $fee;

    /**
     * Disburse constructor.
     * @param $id_from_api
     * @param $amount
     * @param $status
     * @param $timestamp
     * @param $bank_code
     * @param $account_number
     * @param $beneficiary_name
     * @param $remark
     * @param $receipt
     * @param $time_served
     * @param $fee
     */
    public function __construct($id_from_api, $amount, $status, $timestamp, $bank_code, $account_number, $beneficiary_name, $remark, $receipt, $time_served, $fee)
    {
        $this->id_from_api = $id_from_api;
        $this->amount = $amount;
        $this->status = $status;
        $this->timestamp = $timestamp;
        $this->bank_code = $bank_code;
        $this->account_number = $account_number;
        $this->beneficiary_name = $beneficiary_name;
        $this->remark = $remark;
        $this->receipt = $receipt;
        $this->time_served = $time_served;
        $this->fee = $fee;
    }

    public function getIdFromApi()
    {
        return $this->id_from_api;
    }

    public function setIdFromApi($id_from_api): void
    {
        $this->id_from_api = $id_from_api;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getBankCode()
    {
        return $this->bank_code;
    }

    public function setBankCode($bank_code): void
    {
        $this->bank_code = $bank_code;
    }

    public function getAccountNumber()
    {
        return $this->account_number;
    }

    public function setAccountNumber($account_number): void
    {
        $this->account_number = $account_number;
    }

    public function getBeneficiaryName()
    {
        return $this->beneficiary_name;
    }

    public function setBeneficiaryName($beneficiary_name): void
    {
        $this->beneficiary_name = $beneficiary_name;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function setRemark($remark): void
    {
        $this->remark = $remark;
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

    public function setReceipt($receipt): void
    {
        $this->receipt = $receipt;
    }

    public function getTimeServed()
    {
        return $this->time_served;
    }

    public function setTimeServed($time_served): void
    {
        $this->time_served = $time_served;
    }

    public function getFee()
    {
        return $this->fee;
    }

    public function setFee($fee): void
    {
        $this->fee = $fee;
    }


}