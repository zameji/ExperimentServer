self.__precacheManifest = [
  {
    "url": "/_next/static/OqL6UkiXdTcIuvDgGbrA1/pages/_app.js",
    "revision": "ed7bed4b79cb55bfc891"
  },
  {
    "url": "/_next/static/OqL6UkiXdTcIuvDgGbrA1/pages/_error.js",
    "revision": "c10ce66e1d5ac1495fd5"
  },
  {
    "url": "/_next/static/OqL6UkiXdTcIuvDgGbrA1/pages/compare.js",
    "revision": "99cae9eb5596a98f7c48"
  },
  {
    "url": "/_next/static/OqL6UkiXdTcIuvDgGbrA1/pages/index.js",
    "revision": "120772ab63ebc3c83d65"
  },
  {
    "url": "/_next/static/OqL6UkiXdTcIuvDgGbrA1/pages/result.js",
    "revision": "27f32c948fc2d1ddf13a"
  },
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
