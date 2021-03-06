<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: channel_response.proto

namespace Publishers_pb;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>publishers_pb.ChannelResponse</code>
 */
class ChannelResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string channel_identifier = 1;</code>
     */
    protected $channel_identifier = '';
    /**
     * Generated from protobuf field <code>repeated .publishers_pb.Wallet wallets = 2;</code>
     */
    private $wallets;
    /**
     * Generated from protobuf field <code>.publishers_pb.SiteBannerDetails site_banner_details = 3;</code>
     */
    protected $site_banner_details = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $channel_identifier
     *     @type \Publishers_pb\Wallet[]|\Google\Protobuf\Internal\RepeatedField $wallets
     *     @type \Publishers_pb\SiteBannerDetails $site_banner_details
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\ChannelResponse::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string channel_identifier = 1;</code>
     * @return string
     */
    public function getChannelIdentifier()
    {
        return $this->channel_identifier;
    }

    /**
     * Generated from protobuf field <code>string channel_identifier = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setChannelIdentifier($var)
    {
        GPBUtil::checkString($var, True);
        $this->channel_identifier = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .publishers_pb.Wallet wallets = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getWallets()
    {
        return $this->wallets;
    }

    /**
     * Generated from protobuf field <code>repeated .publishers_pb.Wallet wallets = 2;</code>
     * @param \Publishers_pb\Wallet[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setWallets($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Publishers_pb\Wallet::class);
        $this->wallets = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.publishers_pb.SiteBannerDetails site_banner_details = 3;</code>
     * @return \Publishers_pb\SiteBannerDetails
     */
    public function getSiteBannerDetails()
    {
        return isset($this->site_banner_details) ? $this->site_banner_details : null;
    }

    public function hasSiteBannerDetails()
    {
        return isset($this->site_banner_details);
    }

    public function clearSiteBannerDetails()
    {
        unset($this->site_banner_details);
    }

    /**
     * Generated from protobuf field <code>.publishers_pb.SiteBannerDetails site_banner_details = 3;</code>
     * @param \Publishers_pb\SiteBannerDetails $var
     * @return $this
     */
    public function setSiteBannerDetails($var)
    {
        GPBUtil::checkMessage($var, \Publishers_pb\SiteBannerDetails::class);
        $this->site_banner_details = $var;

        return $this;
    }

}

