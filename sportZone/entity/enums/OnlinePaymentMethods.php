<?php
namespace App\Enum;

enum EnumOnlinePaymentMethods: string
{
    case PAYPAL = 'paypal';
    case CARD = 'card';
}