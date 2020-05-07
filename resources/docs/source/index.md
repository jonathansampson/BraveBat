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
    -d '{"github_id":"55092446"}'

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
    "github_id": "55092446"
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
            'github_id' => '55092446',
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
    "github_id": "55092446"
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
        "link": "https:\/\/github.com\/husonghua",
        "name": "Some name",
        "display_name": "Some display name",
        "description": "Some description",
        "followers": 1000,
        "repos": 10
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
    `github_id` | string |  required  | The GitHub ID (example: "55092446"). Notice this is not Github username that you might be familiar with.
    
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
    -d '{"twitch_id":"onboard001"}'

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
    "twitch_id": "onboard001"
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
            'twitch_id' => 'onboard001',
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
    "twitch_id": "onboard001"
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
        "link": "https:\/\/www.twitch.tv\/onboard001",
        "name": "Some name",
        "display_name": "Some display name",
        "description": "Some description",
        "followers": 1000,
        "views": 1000
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
    `twitch_id` | string |  required  | The Twitch ID (example: "onboard001")
    
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
        "link": "https:\/\/twitter.com\/bravebatinfo",
        "handle": "BraveBatInfo",
        "display_name": "BraveBatInfo",
        "description": "Some description: http:\/\/bravebat.info",
        "followers": 1000
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
## vimeo
Check if a Vimeo channel is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Vimeo
link, channel name, channel description, the number of channel followers and the number of videos.

> Example request:

```bash
curl -X POST \
    "http://bravebat.test/api/v1/vimeo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"vimeo_id":"105082085"}'

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
    "vimeo_id": "105082085"
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
            'vimeo_id' => '105082085',
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
    "vimeo_id": "105082085"
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
        "link": "https:\/\/vimeo.com\/user105082085",
        "name": "Some name",
        "display name": "Some display name",
        "description": "Some description",
        "followers": 1000,
        "videos": 10
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
    `vimeo_id` | string |  required  | The Vimeo ID (example: "105082085"). Notice this is not Vimeo username that you might be familiar with.
    
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


