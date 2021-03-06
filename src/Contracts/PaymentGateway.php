<?php

namespace Ptuchik\Billing\Contracts;

use Omnipay\Common\Message\ResponseInterface;
use Ptuchik\Billing\Models\Order;

/**
 * Interface PaymentGateway
 * @package Ptuchik\Billing\Contracts
 */
interface PaymentGateway
{
    /**
     * PaymentGateway constructor.
     *
     * @param \Ptuchik\Billing\Contracts\Billable $user
     * @param array                               $config
     */
    public function __construct(Billable $user, array $config = []);

    /**
     * Create payment profile
     * @return mixed
     */
    public function createPaymentProfile();

    /**
     * Find customer by profile
     * @return mixed
     */
    public function findCustomer();

    /**
     * Create payment method
     *
     * @param string                             $nonce
     * @param \Ptuchik\Billing\Models\Order|null $order
     *
     * @return mixed
     */
    public function createPaymentMethod(string $nonce, Order $order = null);

    /**
     * Get payment methods
     * @return array
     */
    public function getPaymentMethods() : array;

    /**
     * Set default payment method
     *
     * @param string $token
     *
     * @return mixed
     */
    public function setDefaultPaymentMethod(string $token);

    /**
     * Parse payment method
     *
     * @param $paymentData
     *
     * @return mixed
     */
    public function parsePaymentMethod($paymentData);

    /**
     * Delete payment method
     *
     * @param string $token
     *
     * @return mixed
     */
    public function deletePaymentMethod(string $token);

    /**
     * Get payment token
     * @return mixed
     */
    public function getPaymentToken();

    /**
     * Purchase
     *
     * @param                                    $amount
     * @param string|null                        $descriptor
     * @param \Ptuchik\Billing\Models\Order|null $order
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function purchase($amount, string $descriptor = null, Order $order = null) : ResponseInterface;

    /**
     * Void transaction
     *
     * @param string $reference
     *
     * @return mixed
     */
    public function void(string $reference);

    /**
     * Refund transaction
     *
     * @param string $reference
     *
     * @return mixed
     */
    public function refund(string $reference);

}