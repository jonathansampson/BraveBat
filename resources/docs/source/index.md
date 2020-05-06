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


<!-- START_d8afcf81b557268db12b389598122c72 -->
## Website
Check if a website is a verified Brave Browser Creator

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/website" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"url":"wikipedia.org"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/v1/website"
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
    'http://bravebat.test/api/v1/website',
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

url = 'http://bravebat.test/api/v1/website'
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
`POST api/v1/website`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `url` | string |  required  | The URL of the website.
    
<!-- END_d8afcf81b557268db12b389598122c72 -->

<!-- START_140d2e8c335ffa622d02919fc4b7a15c -->
## YouTube
Check if a YouTube channel is a verified Brave Browser Creator

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/youtube" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"youtube_id":"UC2F_7pXTR8LNg3llt55ZMCQ"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/v1/youtube"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {your-token}",
};

let body = {
    "youtube_id": "UC2F_7pXTR8LNg3llt55ZMCQ"
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
    'http://bravebat.test/api/v1/youtube',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {your-token}',
        ],
        'json' => [
            'youtube_id' => 'UC2F_7pXTR8LNg3llt55ZMCQ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://bravebat.test/api/v1/youtube'
payload = {
    "youtube_id": "UC2F_7pXTR8LNg3llt55ZMCQ"
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
        "link": "https:\/\/www.youtube.com\/channel\/UCr_USjgn4PQhVpqOT6RcAtQ",
        "name": "Some name",
        "description": "Some description",
        "subscribers": 1000
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
`POST api/v1/youtube`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `youtube_id` | string |  required  | The YouTube ID (example: "UCr_USjgn4PQhVpqOT6RcAtQ")
    
<!-- END_140d2e8c335ffa622d02919fc4b7a15c -->


