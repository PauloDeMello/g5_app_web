
// Based off of https://github.com/pwa-builder/PWABuilder/blob/main/docs/sw.js

/*
  Welcome to our basic Service Worker! This Service Worker offers a basic offline experience
  while also being easily customizeable. You can add in your own code to implement the capabilities
  listed below, or change anything else you would like.


  Need an introduction to Service Workers? Check our docs here: https://docs.pwabuilder.com/#/home/sw-intro
  Want to learn more about how our Service Worker generation works? Check our docs here: https://docs.pwabuilder.com/#/studio/existing-app?id=add-a-service-worker

  Did you know that Service Workers offer many more capabilities than just offline? 
    - Background Sync: https://microsoft.github.io/win-student-devs/#/30DaysOfPWA/advanced-capabilities/06
    - Periodic Background Sync: https://web.dev/periodic-background-sync/
    - Push Notifications: https://microsoft.github.io/win-student-devs/#/30DaysOfPWA/advanced-capabilities/07?id=push-notifications-on-the-web
    - Badges: https://microsoft.github.io/win-student-devs/#/30DaysOfPWA/advanced-capabilities/07?id=application-badges
*/

const HOSTNAME_WHITELIST = [
    self.location.hostname,
    'fonts.gstatic.com',
    'fonts.googleapis.com',
    'cdn.jsdelivr.net'
]

// The Util Function to hack URLs of intercepted requests
const getFixedUrl = (req) => {
    var now = Date.now()
    var url = new URL(req.url)

    // 1. fixed http URL
    // Just keep syncing with location.protocol
    // fetch(httpURL) belongs to active mixed content.
    // And fetch(httpRequest) is not supported yet.
    url.protocol = self.location.protocol

    // 2. add query for caching-busting.
    // Github Pages served with Cache-Control: max-age=600
    // max-age on mutable content is error-prone, with SW life of bugs can even extend.
    // Until cache mode of Fetch API landed, we have to workaround cache-busting with query string.
    // Cache-Control-Bug: https://bugs.chromium.org/p/chromium/issues/detail?id=453190
    if (url.hostname === self.location.hostname) {
        url.search += (url.search ? '&' : '?') + 'cache-bust=' + now
    }
    return url.href
}

/**
 *  @Lifecycle Activate
 *  New one activated when old isnt being used.
 *
 *  waitUntil(): activating ====> activated
 */
self.addEventListener('activate', event => {
    event.waitUntil(self.clients.claim())
})


const precachedResources = ["/Views/offline.html", "/Views/templates/header.php", "/Views/templates/footer.php", "/images/g5-logo.webp", "/images/g5-logo-crop.webp"];
//, "/css/general.css"
async function precache() {
    const cache = await caches.open("pwa-cache");
    return cache.addAll(precachedResources);
}

self.addEventListener("install", (event) => {
    event.waitUntil(precache());
});


/**
 *  @Functional Fetch
 *  All network requests are being intercepted here.
 *
 *  void respondWith(Promise<Response> r)
 */
self.addEventListener('fetch', event => {

    // Skip some of cross-origin requests, like those for Google Analytics.
    if (event.request.url.indexOf('/login') !== -1 || event.request.url.indexOf('/logout') !== -1) {
        event.respondWith(fetch(event.request)
            .catch(function () {
                // Delete cookies and cache
                console.log("here");
                document.cookie = `ci_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/${window.location.hostname};`;
                caches.delete("pwa-cache");
                return caches.match('/Views/offline.html');
            }),
        );
    }

    event.respondWith(fetch(event.request));
    return;

    if (HOSTNAME_WHITELIST.indexOf(new URL(event.request.url).hostname) > -1) {


        //Stale while revalidate method 
        event.respondWith(caches.open("pwa-cache").then((cache) => {
            return cache.match(event.request).then((cachedResponse) => {
                const fetchedResponse = fetch(event.request).then((networkResponse) => {
                    cache.put(event.request, networkResponse.clone());

                    return networkResponse;
                });

                return cachedResponse || fetchedResponse;
            });
        }));
    }
})