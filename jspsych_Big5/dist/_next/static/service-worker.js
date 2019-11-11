self.__precacheManifest = [
  {
    "url": "/_next/static/chunks/commons.62ea1350ccf0615b5580.js",
    "revision": "b3c78733cef629d0a099"
  },
  {
    "url": "/_next/static/runtime/main-e93443d315dce50ad3bb.js",
    "revision": "e0c1e9fa854ed751998b"
  },
  {
    "url": "/_next/static/runtime/webpack-035ac2b14bde147cb4a8.js",
    "revision": "be4b6cc6d10632d2262c"
  },
  {
    "url": "/_next/static/zvao-Z5M_Ix5jr5JPldTg/pages/_app.js",
    "revision": "dbaf94aee7329ea45bfd"
  },
  {
    "url": "/_next/static/zvao-Z5M_Ix5jr5JPldTg/pages/_error.js",
    "revision": "06f675d750a7832f6abb"
  },
  {
    "url": "/_next/static/zvao-Z5M_Ix5jr5JPldTg/pages/compare.js",
    "revision": "c011acea0e10faf753ad"
  },
  {
    "url": "/_next/static/zvao-Z5M_Ix5jr5JPldTg/pages/index.js",
    "revision": "eeab5b9b137e4d455dac"
  },
  {
    "url": "/_next/static/zvao-Z5M_Ix5jr5JPldTg/pages/result.js",
    "revision": "8eaa332e053752447be7"
  }
];

/**
 * Welcome to your Workbox-powered service worker!
 *
 * You'll need to register this file in your web app and you should
 * disable HTTP caching for this file too.
 * See https://goo.gl/nhQhGp
 *
 * The rest of the code is auto-generated. Please don't update this file
 * directly; instead, make changes to your Workbox build configuration
 * and re-run your build process.
 * See https://goo.gl/2aRDsh
 */

importScripts("https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js");

importScripts(
  
);

self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});

/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [].concat(self.__precacheManifest || []);
workbox.precaching.precacheAndRoute(self.__precacheManifest, {});

workbox.routing.registerRoute(/^https?.*/, new workbox.strategies.NetworkFirst({ "cacheName":"https-calls","networkTimeoutSeconds":15, plugins: [new workbox.expiration.Plugin({ maxEntries: 150, maxAgeSeconds: 2592000, purgeOnQuotaError: false }), new workbox.cacheableResponse.Plugin({ statuses: [ 0, 200 ] })] }), 'GET');
