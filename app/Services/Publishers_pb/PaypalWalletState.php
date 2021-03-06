<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: channel_response.proto

namespace Publishers_pb;

use UnexpectedValueException;

/**
 * Protobuf type <code>publishers_pb.PaypalWalletState</code>
 */
class PaypalWalletState
{
    /**
     * Generated from protobuf enum <code>PAYPAL_ACCOUNT_NO_KYC = 0;</code>
     */
    const PAYPAL_ACCOUNT_NO_KYC = 0;
    /**
     * Generated from protobuf enum <code>PAYPAL_ACCOUNT_KYC = 1;</code>
     */
    const PAYPAL_ACCOUNT_KYC = 1;

    private static $valueToName = [
        self::PAYPAL_ACCOUNT_NO_KYC => 'PAYPAL_ACCOUNT_NO_KYC',
        self::PAYPAL_ACCOUNT_KYC => 'PAYPAL_ACCOUNT_KYC',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

