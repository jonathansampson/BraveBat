<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="{{ asset('/docs/css/style.css') }}" />
    <script src="{{ asset('/docs/js/all.js') }}"></script>


          <script>
        $(function() {
            setupLanguages(["bash","javascript","php","python"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="/docs/images/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/docs/images/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="bash">bash</a>
                                  <a href="#" data-language-name="javascript">javascript</a>
                                  <a href="#" data-language-name="php">php</a>
                                  <a href="#" data-language-name="python">python</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
                    <ul class="toc-footer">
                                  <li><a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a></li>
                            </ul>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>Info</h1>
<p>Welcome to the generated API reference.
<a href="{{ route("apidoc.json") }}">Get Postman Collection</a></p>
<!-- END_INFO -->
<h1>v1</h1>
<!-- START_d8afcf81b557268db12b389598122c72 -->
<h2>Website</h2>
<p>Check if a website is a verified Brave Browser Creator</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://bravebat.test/api/v1/website" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"url":"wikipedia.org"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://bravebat.test/api/v1/website',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {your-token}',
        ],
        'json' =&gt; [
            'url' =&gt; 'wikipedia.org',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "success": true,
    "data": {
        "link": "https:\/\/wikipedia.org",
        "alexa_ranking": 10,
        "screenshot": "https:\/\/bravebat-prod.s3.us-west-2.amazonaws.com\/website_screenshots\/wikipedia_org.png"
    }
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "success": false,
    "message": "Missing required field"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "success": false,
    "message": "Not found"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/website</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>url</code></td>
<td>string</td>
<td>required</td>
<td>The URL of the website.</td>
</tr>
</tbody>
</table>
<!-- END_d8afcf81b557268db12b389598122c72 -->
<!-- START_140d2e8c335ffa622d02919fc4b7a15c -->
<h2>YouTube</h2>
<p>Check if a YouTube channel is a verified Brave Browser Creator</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://bravebat.test/api/v1/youtube" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {your-token}" \
    -d '{"youtube_id":"UC2F_7pXTR8LNg3llt55ZMCQ"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://bravebat.test/api/v1/youtube',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {your-token}',
        ],
        'json' =&gt; [
            'youtube_id' =&gt; 'UC2F_7pXTR8LNg3llt55ZMCQ',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "success": true,
    "data": {
        "link": "https:\/\/www.youtube.com\/channel\/UCr_USjgn4PQhVpqOT6RcAtQ",
        "name": "Some name",
        "description": "Some description",
        "subscribers": 1000
    }
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "success": false,
    "message": "Missing required field"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "success": false,
    "message": "Not found"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/youtube</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>youtube_id</code></td>
<td>string</td>
<td>required</td>
<td>The YouTube ID (example: &quot;UCr_USjgn4PQhVpqOT6RcAtQ&quot;)</td>
</tr>
</tbody>
</table>
<!-- END_140d2e8c335ffa622d02919fc4b7a15c -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                                    <a href="#" data-language-name="php">php</a>
                                    <a href="#" data-language-name="python">python</a>
                              </div>
                </div>
    </div>
  </body>
</html>