---
id: 74055f0c-a86e-4259-87e6-c0533385810d
origin: 74073b60-3161-4bee-ba0a-5141d240ec60
title: "Laravel Tinker'da Job Dispatch Etmek"
subtitle: "Laravel Tinker neden job'ları dispatch etmiyor?"
updated_by: b8f3533e-0fcf-42b9-a3d8-c8691deaf917
updated_at: 1766432713
og_generator_image: laravel-tinker-da-job-dispatch-etmek.jpg
content:
  -
    type: set
    attrs:
      id: vpwhZOiD
      values:
        type: image
        image: articles/dispatch-jobs-in-laravel-tinker-aka-why-tinker-does-not-dispatch-jobs/laravel-tinker-dispatch.png
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Bu makale '
      -
        type: text
        marks:
          -
            type: italic
        text: 'Yunus Emre Deligöz'
      -
        type: text
        text: ' ve '
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://medium.com/@tkaratug'
              rel: null
              target: _blank
              title: null
        text: 'Turan Karatuğ'
      -
        type: text
        text: ' tarafından yazılmıştır. '
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: /articles/dispatch-jobs-in-laravel-tinker
              rel: null
              target: null
              title: null
        text: İngilizce
      -
        type: text
        text: ' dilinde ve ayrıca '
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://deligoez.medium.com/laravel-tinkerda-job-dispatch-etmek-veya-laravel-tinker-neden-job-lar%C4%B1-dispatch-etmiyor-3e01e1937613'
              rel: null
              target: _blank
              title: null
        text: Medium
      -
        type: text
        text: ' üzerinde okunabilir. '
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Uzun Lafın Kısası'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Dispatch komutundan hemen sonra, sadece, '
      -
        type: text
        marks:
          -
            type: code
        text: ;1
      -
        type: text
        text: ' eklemeniz yeterli.'
  -
    type: codeBlock
    attrs:
      language: php
    content:
      -
        type: text
        text: 'SendEmailJob::dispatch();1;'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: "Laravel Tinker üzerinden Job'ları Dispatch Etmek"
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://laravel.com/docs/9.x/artisan#tinker'
              rel: null
              target: _blank
              title: null
        text: 'Laravel Artisan Tinker'
      -
        type: text
        text: " üzerinde kuyruğa bir Job göndermek istiyorsanız, Tinker'ı açıp şöyle yazarsınız:"
  -
    type: codeBlock
    attrs:
      language: php
    content:
      -
        type: text
        text: 'SendEmailJob::dispatch();'
  -
    type: set
    attrs:
      id: CXaExIkN
      values:
        type: image
        image: articles/dispatch-jobs-in-laravel-tinker-aka-why-tinker-does-not-dispatch-jobs/cleanshot-2022-08-26-at-00.14.48@2x.png
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Ve Job'un aslında kuyruğa gönderilmediğini farkedersiniz. Komutu yeniden çalıştırırsanız aynı yanıtı görürsünüz ancak Job kuyruğa yalnızca bir kez gönderilmiştir."
  -
    type: set
    attrs:
      id: dH9hrQYC
      values:
        type: image
        image: articles/dispatch-jobs-in-laravel-tinker-aka-why-tinker-does-not-dispatch-jobs/cleanshot-2022-08-26-at-00.15.16@2x.png
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: "Laravel Tinker Job'u neden ilk seferde dispatch etmedi?"
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Buradaki sorun Laravel Tinker'in oluşturulan "
      -
        type: text
        marks:
          -
            type: code
        text: PendingDispatch
      -
        type: text
        text: ' nesnelerini kullanıcının sonraki komutlarda kullanması için bellekte tutmasıdır. '
      -
        type: text
        marks:
          -
            type: code
        text: PendingDispatch
      -
        type: text
        text: ' nesnesi yok edildiğinde Job dispatch edilir.'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Bu konudaki '
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://github.com/laravel/tinker/issues/28'
              rel: null
              target: _blank
              title: null
        text: tartışmalar
      -
        type: text
        text: ' için '
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://github.com/laravel/tinker'
              rel: null
              target: _blank
              title: null
        text: "Laravel Tinker Repo'suna"
      -
        type: text
        text: ' göz atabilirsiniz.'
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: Çözüm
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Bu problemi en doğru şekilde çözmek için Job'u Laravel'in "
      -
        type: text
        marks:
          -
            type: code
        text: Dispatcher
      -
        type: text
        text: ' sınıfı üzerinden gönderebilirsiniz:'
  -
    type: codeBlock
    attrs:
      language: php
    content:
      -
        type: text
        text: |-
          app(\Illuminate\Contracts\Bus\Dispatcher::class)
            ->dispatch(new SendEmailJob());
  -
    type: set
    attrs:
      id: TXjAnk4R
      values:
        type: image
        image: articles/dispatch-jobs-in-laravel-tinker-aka-why-tinker-does-not-dispatch-jobs/cleanshot-2022-08-26-at-00.09.55@2x.png
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Hızlıca çözmek içinse:'
  -
    type: codeBlock
    attrs:
      language: php
    content:
      -
        type: text
        text: 'SendEmailJob::dispatch();1'
  -
    type: set
    attrs:
      id: LvtP6iy7
      values:
        type: image
        image: articles/dispatch-jobs-in-laravel-tinker-aka-why-tinker-does-not-dispatch-jobs/cleanshot-2022-08-26-at-00.10.53@2x.png
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Komutun sonuna '
      -
        type: text
        marks:
          -
            type: code
        text: ;1
      -
        type: text
        text: ' eklediğinizde, Tinker '
      -
        type: text
        marks:
          -
            type: code
        text: PendingDispatch
      -
        type: text
        text: " nesnelerini bellekte tutmayacak ve bu da Job'ların hemen dispatch edilmesini sağlayacaktır."
---
