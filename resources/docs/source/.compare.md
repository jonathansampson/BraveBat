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
This is an **unofficial** API for Brave Browser verified creators. We are a fan of Brave Browser and BAT. The source data comes from https://publishers-distro.basicattentiontoken.org/api/v3/public/channels (big file alert!), which we sync our data with daily. We also use other third-party API data to enrich the data. 

To use this API, you need to register an account with us [here](/register). If you have an account already, please log in [here](/login) and get an API token. This API requires an API token and is free to use, but we reserve the right to rate-limit your usage if you excessively use the API (currently at 60 API calls per minute). You are required to make a backlink to https://bravebat.info in your app or service with an anchor text to the effect of "Powered by BraveBat", "Data from BraveBat", etc. 

The API is currrently on V1. There are currently a few limitations:
1. The Reddit endpoint currently only returns true/false answer without additional datapoints. 
2. The YouTube endpoint currently does not have additional datapoints for all verified creators. 

Be Brave and thank you!

#v1


<!-- START_aa2d7691006b34558d15f286a5f83862 -->
## GitHub
Check if a GitHub account is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Github
link, use name, display name, description, the number of followers and the number of repos.

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/github" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"github_id":"241138"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/v1/github"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {your-token}",
};

let body = {
    "github_id": "241138"
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
    'http://bravebat.test/api/v1/github',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {your-token}',
        ],
        'json' => [
            'github_id' => '241138',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://bravebat.test/api/v1/github'
payload = {
    "github_id": "241138"
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
        "link": "https:\/\/github.com\/karpathy",
        "name": "karpathy",
        "display_name": "Andrej",
        "description": "I like to train Deep Neural Nets on large datasets.",
        "followers": 24815,
        "repos": 35
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
`POST api/v1/github`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `github_id` | string |  required  | The GitHub ID (example: "241138"). Notice this is not Github username that you might be familiar with.
    
<!-- END_aa2d7691006b34558d15f286a5f83862 -->

<!-- START_123cf704e3da78df2154667bcf7671fb -->
## Reddit
Check if a Reddit account is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the
confirmation. No additional data points are returned currently.

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/reddit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"reddit_id":"2lsiek42"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/v1/reddit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {your-token}",
};

let body = {
    "reddit_id": "2lsiek42"
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
    'http://bravebat.test/api/v1/reddit',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {your-token}',
        ],
        'json' => [
            'reddit_id' => '2lsiek42',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://bravebat.test/api/v1/reddit'
payload = {
    "reddit_id": "2lsiek42"
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
    "success": true
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
`POST api/v1/reddit`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `reddit_id` | string |  required  | The Reddit ID (example: "2lsiek42"). Notice this is not Reddit username that you might be familiar with.
    
<!-- END_123cf704e3da78df2154667bcf7671fb -->

<!-- START_b6c5e6fe85836c0502e9fe6470d1a756 -->
## Twitch
Check if a Twitch channel is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Twitch
link, name, display name, description, the number of followers and the number of views.

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/twitch" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"twitch_id":"zerator"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/v1/twitch"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {your-token}",
};

let body = {
    "twitch_id": "zerator"
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
    'http://bravebat.test/api/v1/twitch',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {your-token}',
        ],
        'json' => [
            'twitch_id' => 'zerator',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://bravebat.test/api/v1/twitch'
payload = {
    "twitch_id": "zerator"
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
        "link": "https:\/\/www.twitch.tv\/zerator",
        "name": "zerator",
        "display_name": "ZeratoR",
        "description": "Créateur de contenu vidéo \/  French Streamer and Videomaker \/ Everything is on : http:\/\/www.ZeratoR.com",
        "followers": 808737,
        "views": 83595247
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
`POST api/v1/twitch`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `twitch_id` | string |  required  | The Twitch ID (example: "zerator")
    
<!-- END_b6c5e6fe85836c0502e9fe6470d1a756 -->

<!-- START_2e028dc962dcba4b1098c2a606262c08 -->
## Twitter
Check if a Twitter account is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Twitter
link, handle, display name, description and the number of followers.

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/twitter" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"twitter_id":"3488129179"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/v1/twitter"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {your-token}",
};

let body = {
    "twitter_id": "3488129179"
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
    'http://bravebat.test/api/v1/twitter',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {your-token}',
        ],
        'json' => [
            'twitter_id' => '3488129179',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://bravebat.test/api/v1/twitter'
payload = {
    "twitter_id": "3488129179"
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
        "link": "https:\/\/twitter.com\/FreakyTheory",
        "handle": "FreakyTheory",
        "display_name": "Motivation",
        "description": "Stop Doubting & Start Living a Wealthy Life.We Don't own any of the pictures!",
        "followers": 3702201
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
`POST api/v1/twitter`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `twitter_id` | string |  required  | The Twitter ID (example: "3488129179"). Notice this is not Twitter handle that you might be familiar with.
    
<!-- END_2e028dc962dcba4b1098c2a606262c08 -->

<!-- START_96d46fceead83342585edaee1eace471 -->
## Vimeo
Check if a Vimeo channel is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Vimeo
link, channel name, channel description, the number of channel followers and the number of videos.

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/vimeo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"vimeo_id":"1512484"}'

```

```javascript
const url = new URL(
    "http://bravebat.test/api/v1/vimeo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {your-token}",
};

let body = {
    "vimeo_id": "1512484"
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
    'http://bravebat.test/api/v1/vimeo',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {your-token}',
        ],
        'json' => [
            'vimeo_id' => '1512484',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://bravebat.test/api/v1/vimeo'
payload = {
    "vimeo_id": "1512484"
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
        "link": "https:\/\/vimeo.com\/visiophone",
        "name": "visiophone",
        "display name": "visiophone",
        "description": null,
        "followers": 1702,
        "videos": 133
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
`POST api/v1/vimeo`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `vimeo_id` | string |  required  | The Vimeo ID (example: "1512484"). Notice this is not Vimeo username that you might be familiar with.
    
<!-- END_96d46fceead83342585edaee1eace471 -->

<!-- START_d8afcf81b557268db12b389598122c72 -->
## Website
Check if a website is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the URL link,
alexa ranking and screenshot.

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
Check if a YouTube channel is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the YouTube
channel link, channel name, channel description and the number of channel subscribers.

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/youtube" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"youtube_id":"UCaUKfGWDNnZ5wWCogMshVrQ"}'

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
    "youtube_id": "UCaUKfGWDNnZ5wWCogMshVrQ"
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
            'youtube_id' => 'UCaUKfGWDNnZ5wWCogMshVrQ',
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
    "youtube_id": "UCaUKfGWDNnZ5wWCogMshVrQ"
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
        "link": "https:\/\/www.youtube.com\/channel\/UCaUKfGWDNnZ5wWCogMshVrQ",
        "name": "Yao Cabrera",
        "description": "Los limites estan solo en tu cabeza..",
        "subscribers": 6890000
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
    `youtube_id` | string |  required  | The YouTube ID (example: "UCaUKfGWDNnZ5wWCogMshVrQ")
    
<!-- END_140d2e8c335ffa622d02919fc4b7a15c -->


