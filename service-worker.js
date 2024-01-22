self.addEventListener('install', (event) => {
    event.waitUntil(
      caches.open('your-app-cache').then((cache) => {
        return cache.addAll([
          '/',
          '/index.php',
          '/manifest.json',
          '/icon.png',
        ]);
      })
    );
  });
  
  self.addEventListener('fetch', (event) => {
    event.respondWith(
      caches.match(event.request).then((response) => {
        return response || fetch(event.request);
      })
    );
  });
  