<?php

namespace App\Services;

use App\Models\Ads\AdsCampaign;
use App\Models\Ads\AdsGeo;
use App\Models\Ads\AdsOs;
use App\Models\Ads\AdsSegment;
use DateTime;

class BraveCatalogService
{
    protected $data;

    public function __construct()
    {
        $this->getData();
    }

    public function getData()
    {
        $data = file_get_contents(config("bravebat.catelog_page.v7"));
        if ($data) {
            file_put_contents(public_path('brave_catalog.txt'), $data);
            $this->data = json_decode($data, true);
        } else {
            $data = file_get_contents(public_path('brave_catalog.txt'));
            $this->data = json_decode($data, true);
        }
    }

    // (new App\Services\BraveCatalogService)->handle();
    public function handle()
    {
        foreach ($this->getCampaignsData() as $campaignData) {
            $this->processCampaignData($campaignData);
        }
    }

    public function getCampaignsData()
    {
        return $this->data['campaigns'];
    }

    public function processCampaignData($campaignData)
    {
        $adsCampaign = AdsCampaign::updateOrCreate(
            ['brave_id' => $campaignData['campaignId']],
            [
                'ptr' => $campaignData['ptr'],
                'end_at' => new DateTime($campaignData['endAt']),
                'start_at' => new DateTime($campaignData['startAt']),
                'daily_cap' => $campaignData['dailyCap'],
                'priority' => $campaignData['priority'],
                'advertiser_id' => $campaignData['advertiserId'],
                'response' => json_encode($campaignData),
            ]
        );

        foreach ($campaignData['geoTargets'] as $geoData) {
            $this->processGeoData($geoData, $adsCampaign);
        }

        foreach ($campaignData['creativeSets'] as $setData) {
            $this->processSetData($setData, $adsCampaign);
        }

    }

    public function processGeoData($geoData, $adsCampaign)
    {
        $adsGeo = AdsGeo::where('code', $geoData['code'])->first();
        if ($adsGeo) {
            $adsGeo->update(['name' => $geoData['name']]);
        } else {
            $adsGeo = AdsGeo::create([
                'name' => $geoData['name'],
                'code' => $geoData['code'],
            ]);
        }
        $adsCampaign->adsGeos()->syncWithoutDetaching($adsGeo);
    }

    public function processSetData($setData, $adsCampaign)
    {
        $adsSet = $adsCampaign->adsSets()->updateOrCreate([
            'brave_id' => $setData['creativeSetId'],
        ], [
            'value' => $setData['value'],
            'per_day' => $setData['perDay'],
            'per_week' => $setData['perWeek'],
            'per_month' => $setData['perMonth'],
            'total_max' => $setData['totalMax'],
        ]);

        foreach ($setData['oses'] as $osData) {
            $this->processOsData($osData, $adsSet);
        }

        foreach ($setData['segments'] as $segmentData) {
            $this->processSegmentData($segmentData, $adsSet);
        }

        foreach ($setData['creatives'] as $creativeData) {
            $this->processCreativeData($creativeData, $adsSet);
        }
    }

    public function processOsData($osData, $adsSet)
    {
        $adsOs = AdsOs::where('code', $osData['code'])->first();
        if ($adsOs) {
            $adsOs->update(['name' => $osData['name']]);
        } else {
            $adsOs = AdsOs::create([
                'name' => $osData['name'],
                'code' => $osData['code'],
            ]);
        }
        $adsSet->adsOses()->syncWithoutDetaching($adsOs);
    }

    public function processSegmentData($segmentData, $adsSet)
    {
        $adsSegment = AdsSegment::where('code', $segmentData['code'])->first();
        if ($adsSegment) {
            $adsSegment->update(['name' => $segmentData['name']]);
        } else {
            $adsSegment = AdsSegment::create([
                'name' => $segmentData['name'],
                'code' => $segmentData['code'],
            ]);
        }
        $adsSet->adsSegments()->syncWithoutDetaching($adsSegment);
    }

    public function processCreativeData($creativeData, $adsSet)
    {
        $adsCreative = $adsSet->adsCreatives()->updateOrCreate([
            'brave_id' => $creativeData['creativeInstanceId'],
        ], [
            'type' => $creativeData['type']['code'],
            'name' => $creativeData['type']['name'],
            'version' => $creativeData['type']['version'],
            'platform' => $creativeData['type']['platform'],
        ]);
        if ($adsCreative->name === 'notification') {
            $adsCreative->update([
                'notification_body' => $creativeData['payload']['body'],
                'notification_title' => $creativeData['payload']['title'],
                'notification_target_url' => $creativeData['payload']['targetUrl'],
            ]);
        }

        if ($adsCreative->name === 'new_tab_page') {
            $adsCreative->update([
                'page_logo_alt' => $creativeData['payload']['logo']['alt'],
                'page_image_url' => $creativeData['payload']['logo']['imageUrl'],
                'page_company_name' => $creativeData['payload']['logo']['companyName'],
                'page_destination_url' => $creativeData['payload']['logo']['destinationUrl'],
            ]);
        }
    }

}
