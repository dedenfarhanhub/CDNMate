# CDNMate

![CI](https://github.com/dedenfarhanhub/CDNMate/actions/workflows/ci.yml/badge.svg)
![Packagist Version](https://img.shields.io/packagist/v/partimate/cdnmate)
![Downloads](https://img.shields.io/packagist/dt/partimate/cdnmate)
![License](https://img.shields.io/github/license/dedenfarhanhub/CDNMate)

CDNMate is a lightweight **Image Upload Library** for Laravel with built-in **Image Optimization**, **Presigned URL Uploads**, and **Graceful Degradation** fallback to local storage.

---

## Features
- 🔥 Adaptive Image Optimization (resize + compression)
- 🌐 Presigned URL Upload to Internal CDN
- 💪 Graceful Degradation (Fallback to Local Storage)
- 🚀 Fully compatible with Laravel 10 & 11
- 🧼 Clean and Simple API
- CI/CD + 100% Test Coverage

---

## Installation

```bash
composer require partimate/cdnmate
```

CDNMate supports **Auto Discovery** for Laravel 10 & 11.

---

## Usage
### Simple Upload
```php
use CDNMate;

$imageUrl = CDNMate::upload($request->file('image'), 'profile-images', 90);
```

### Graceful Degradation (Fallback ke Local Storage)
#### CDNMate will automatically fallback to local storage if the CDN upload fails based on the configuration.
```php
$imageUrl = CDNMate::upload($request->file('image'), 'profile-images', 90);
```
#### Configuration:
```php
CDN_FALLBACK=true
```

---

## Configuration

Publish config file:
```bash
php artisan vendor:publish --tag=cdnmate
```

**config/cdnmate.php**
```php
return [
    'cdn_url' => env('CDN_URL', 'https://cdn.yourdomain.com/'),
    'fallback' => env('CDNMATE_FALLBACK', true),
    'image_quality' => 90,
    'cache_ttl' => 10,
];
```

---

## Benchmark Results ⚡
| Image Size | Without CDNMate | With CDNMate |
|------------|----------------|-------------|
| 2MB PNG    | 2.3s          | **0.9s**    |
| 5MB JPEG   | 3.8s          | **1.2s**    |
| 10MB JPEG  | 6.7s          | **2.1s**    |

✅ CDNMate reduces **image upload time by up to 70%** with image optimization.

---

## Why Use CDNMate?
| Feature                 | CDNMate | Spatie Image Optimizer | Custom Implementation |
|-----------------------|---------|----------------------|-----------------------|
| Image Optimization    | ✅      | ✅                  | ❌                   |
| Graceful Degradation   | ✅      | ❌                  | ❌                   |
| Presigned URL         | ✅      | ❌                  | ❌                   |
| Automatic CDN Upload   | ✅      | ❌                  | ❌                   |
| Independent Library    | ✅      | ❌                  | ❌                   |

---

## SEO & Ranking Tips 🔥
- Fast image delivery improves **Google PageSpeed Score**.
- Automatic optimization increases **Core Web Vitals**.
- Secure presigned URLs prevent **Hotlinking Abuse**.

---

## Contributing
Pull requests are welcome! 🔥

1. Fork the project
2. Create your feature branch
3. Submit a pull request

---

## License
This package is open-sourced software licensed under the [MIT license](LICENSE.md).

---

Happy Uploading 🚀 with **CDNMate**!

Part of the [PartiMate](https://github.com/dedenfarhanhub) Family ❤️

