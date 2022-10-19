const staticCacheName = 'site-static-v1';
const assets = [
  'Chat/chat.php',
  'Chat/scripts/chat.js',
  'Chat/scripts/auth.js',
  'Chat/styles/ui.css',
  //'/assets/images/background-home.jpg',
  'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',
  "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css",
  "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
  "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js",
];
// install event
self.addEventListener('install', evt => {
  evt.waitUntil(
    caches.open(staticCacheName).then((cache) => {
      console.log('caching shell assets');
      cache.addAll(assets);
    })
  );
});
// activate event
self.addEventListener('activate', evt => {
  evt.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(keys
        .filter(key => key !== staticCacheName)
        .map(key => caches.delete(key))
      );
    })
  );
});
// fetch event
self.addEventListener('fetch', evt => {
  evt.respondWith(
    caches.match(evt.request).then(cacheRes => {
      return cacheRes || fetch(evt.request);
    })
  );
});

