<?php
/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 14:52
 * Github       : https://github.com/moxspoy
 */

class Disburse
{
    private $id;
    private $amount;
    private $status;
    private $timestamp;
    private $bank_code;
    private $beneficiary_name;
    private $remark;
    private $receipt;
    private $time_served;
    private $fee;

    /**
     * Disburse constructor.
     * @param $id
     * @param $amount
     * @param $status
     * @param $timestamp
     * @param $bank_code
     * @param $beneficiary_name
     * @param $remark
     * @param $receipt
     * @param $time_served
     * @param $fee
     */
    public function __construct($id, $amount, $status, $timestamp, $bank_code, $beneficiary_name, $remark, $receipt, $time_served, $fee)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->status = $status;
        $this->timestamp = $timestamp;
        $this->bank_code = $bank_code;
        $this->beneficiary_name = $beneficiary_name;
        $this->remark = $remark;
        $this->receipt = $receipt;
        $this->time_served = $time_served;
        $this->fee = $fee;
    }

    /* Getter method */
    public function getId()
    {
        return $this->id;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    public function getBankCode()
    {
        return $this->bank_code;
    }
    public function getBeneficiaryName()
    {
        return $this->beneficiary_name;
    }
    public function getRemark()
    {
        return $this->remark;
    }
    public function getReceipt()
    {
        return $this->receipt;
    }
    public function getTimeServed()
    {
        return $this->time_served;
    }
    public function getFee()
    {
        return $this->fee;
    }

    /* Setter Method */
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }
    public function setStatus($status): void
    {
        $this->status = $status;
    }
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }
    public function setBankCode($bank_code): void
    {
        $this->bank_code = $bank_code;
    }
    public function setBeneficiaryName($beneficiary_name): void
    {
        $this->beneficiary_name = $beneficiary_name;
    }
    public function setRemark($remark): void
    {
        $this->remark = $remark;
    }
    public function setReceipt($receipt): void
    {
        $this->receipt = $receipt;
    }
    public function setTimeServed($time_served): void
    {
        $this->time_served = $time_served;
    }
    public function setFee($fee): void
    {
        $this->fee = $fee;
    }
}