<?php

declare(strict_types=1);

namespace App\YooKassa;

use YooKassa\Model\Payment\PaymentInterface;

abstract class BaseYooKassaHandler
{

    public function __construct(
        protected PaymentInterface $payment,
    ) {}

    public abstract function execute(): void;

}