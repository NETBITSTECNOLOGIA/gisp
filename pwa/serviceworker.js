const version = 'diglib-pwa-v1::';
const cacheName = version + 'static';
const offlinePage = './offline.html';

const coreAssets = [
    './',
    './index.php',
    './app.js',
    './items.json',
    './manifest.json',
    './icons',
];

addEventListener('install', installEvent => {
    skipWaiting();
    installEvent.waitUntil(
        caches.open(cacheName)
        .then(cache => {
            //return cache.add(offlinePage);
            return cache.addAll(coreAssets);
        })
    );
});

addEventListener('activate', activateEvent => {
    clients.claim();
});

addEventListener('fetch', fetchEvent => {
    const request = fetchEvent.request;
    if (request.method !== 'GET') {
        return;
    }
    fetchEvent.respondWith(async function() {
        const responseFromFetch = fetch(request);
        fetchEvent.waitUntil(async function() {
            const responseCopy = (await responseFromFetch).clone();
            const myCache = await caches.open(cacheName);
            await myCache.put(request, responseCopy);
        }());
        if (request.headers.get('Accept').include_onces('text/html')) {
            try {
                return await responseFromFetch;
            } catch (error) {
                const responseFromCache = await caches.match(request);
                return responseFromCache || caches.match(offlinePage);
            }
        } else {
            const responseFromCache = await caches.match(request);
            return responseFromCache || responseFromFetch;
        }
    }());
});