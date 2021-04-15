addEventListener('fetch', (event) => {
  event.respondWith(handleRequest(event.request))
})

async function handleRequest(request) {
  const resp = await fetch('https://ads-serve.brave.com/v7/catalog')
  return resp
}
