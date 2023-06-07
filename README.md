## Quiz App with Laravel

Bu proje Laravel ve MySql kullanılarak geliştirdiğim Quizzers uygulamasıdır.


## Kullanılan Paketler

<ul>
    <li>laravel/jetstream</li>
    <li>bootstrap</li>
    <li>herkod/laravel-tr</li>
    <li>alpinejs</li>
    <li>tailwindcss</li>
    <li>axios</li>
</ul>

## Kurulum

İlk olarak aşağıdaki komutu kopyalanız. Ardından terminal ekranını açarak, projenin kurulmasını istediğiniz bir alana gelerek yapıştırıp çalıştırınız.

```
git clone https://github.com/harundogdu/quiz.git
```

Klonlama işleminin ardından backend işlemleri için terminal ekranına projenin adını yazarak, aşağıda bulunan kodu yapıştırıp çalıştırınız.

```
cd quiz && composer update && npm install && npm run dev
```

Bu işleminin ardından, ana dizinde bulunan  `.env.example` dosyasını kendinize göre konfigure ederek, dosyayı `.env` haline getiriniz. Daha sonra benzersiz bir kod için ve veritabanı işlemleri için terminal ekranına aşağıda bulunan kodu yapıştırıp çalıştırınız.

```
php artisan key:generate && php artisan migrate
```

## Çalıştırma

Projeyi çalıştırmak için ilgili klasörlere gelip, aşağıdaki komutu yazmanız yeterli olacaktır.
```
php artisan serve
```

## Daha fazlası

Daha fazlası ve aklınıza takılan herhangi bir soru için için bana kişisel [web sitem](https://harundogdu.dev/) üzerinden ulaşabilir, "Pull Request" isteklerinde bulunabilirsiniz.
