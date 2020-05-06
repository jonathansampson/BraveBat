---
title: API Reference

language_tabs:
- bash
- javascript
- php
- python

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://bravebat.test/docs/collection.json)

<!-- END_INFO -->

#v1


APIs for verified Brave Browser Creator: v1
<!-- START_b50edf1f398c9f51b23264b7e24bb7ed -->
## Get a website

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/website" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"url":"wikipedia.org"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/website"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {your-token}",
};

let body = {
    "url": "wikipedia.org"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://bravebat.test/api/website',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {your-token}',
        ],
        'json' => [
            'url' => 'wikipedia.org',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://bravebat.test/api/website'
payload = {
    "url": "wikipedia.org"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {your-token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (200):

```json
{
    "success": true,
    "data": {
        "link": "https:\/\/wikipedia.org",
        "alexa_ranking": 10,
        "screenshot": "https:\/\/bravebat-prod.s3.us-west-2.amazonaws.com\/website_screenshots\/wikipedia_org.png"
    }
}
```
> Example response (422):

```json
{
    "success": false,
    "message": "Missing required field"
}
```
> Example response (404):

```json
{
    "success": false,
    "message": "Not found"
}
```

### HTTP Request
`POST api/website`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `url` | string |  required  | The URL of the website.
    
<!-- END_b50edf1f398c9f51b23264b7e24bb7ed -->


