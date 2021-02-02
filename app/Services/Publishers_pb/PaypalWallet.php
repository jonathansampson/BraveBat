<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: channel_response.proto

namespace Publishers_pb;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>publishers_pb.PaypalWallet</code>
 */
class PaypalWallet extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.publishers_pb.PaypalWalletState wallet_state = 1;</code>
     */
    protected $wallet_state = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $wallet_state
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\ChannelResponse::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.publishers_pb.PaypalWalletState wallet_state = 1;</code>
     * @return int
     */
    public function getWalletState()
    {
        return $this->wallet_state;
    }

    /**
     * Generated from protobuf field <code>.publishers_pb.PaypalWalletState wallet_state = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setWalletState($var)
    {
        GPBUtil::checkEnum($var, \Publishers_pb\PaypalWalletState::class);
        $this->wallet_state = $var;

        return $this;
    }

}

