---
id: 2c1a5d14-8986-402e-9ccb-abb5a79f213c
origin: 4f5605b0-a174-4292-9baf-9a71c9d2abe1
title: 'Laravel’de `multipart/form-data` İsteklerini doğru JSON Veri Tipleri ile Doğrulama'
updated_by: b8f3533e-0fcf-42b9-a3d8-c8691deaf917
updated_at: 1766432479
og_generator_image: laravelde-multipartform-data-isteklerini-dogru-json-veri-tipleri-ile-dogrulama.jpg
content:
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Bu makale\_"
      -
        type: text
        marks:
          -
            type: italic
        text: 'Yunus Emre Deligöz'
      -
        type: text
        text: " ve\_"
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://medium.com/@oguzhan.karacabay'
              rel: noopener
              target: null
              title: null
          -
            type: underline
        text: 'Oğuzhan Karacabay'
      -
        type: text
        text: "\_tarafından yazılmıştır,\_"
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: /articles/validating-multipart-form-data-with-laravel-validation-rules-with-proper-json-data-types
              rel: null
              target: null
              title: null
          -
            type: underline
        text: İngilizce
      -
        type: text
        text: "\_dilinde de okunabilir, "
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: 'https://medium.com/tarfin/laravelde-multipart-form-data-i%CC%87steklerini-do%C4%9Fru-json-veri-tipleri-ile-do%C4%9Frulama-888284bad42'
              rel: null
              target: _blank
              title: null
        text: Medium
      -
        type: text
        text: ' üzerinde de okunabilir.'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Bir Frontend\_"
      -
        type: text
        marks:
          -
            type: code
        text: SPA
      -
        type: text
        text: "’dan Laravel Backend\_"
      -
        type: text
        marks:
          -
            type: code
        text: API
      -
        type: text
        text: "’nize hem dosya yüklemek hem de\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_veri göndermek istediğinizde\_"
      -
        type: text
        marks:
          -
            type: code
        text: multipart/form-data
      -
        type: text
        text: "\_şeklinde gönderirsiniz."
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Frontend Framework’lardan bağımsız olarak bunu yapmanın tipik bir örneği şöyle olabilir:'
  -
    type: set
    attrs:
      id: uMKugLIo
      values:
        type: code
        code: |-
          ```js
          postMultipartFormData(form) {
          	let formData = new FormData()

          	formData.append('file', form.file)
          	formData.append('id', form.id) // 1234
          	formData.append('reason_type', form.reason_type) // 3
          	formData.append('rate', form.rate) // 10.15
          	formData.append('fee', form.fee * 100) // 1000 * 100
          	formData.append('tax', form.tax * 100) // 190 * 100
          	formData.append('description', form.description)  // some description
          	formData.append('action_date', form.action_date) // 2022-01-07 17:52:06

          	return apiClient
          	  .post('/post/multipart-formdata', formData, {
          	    headers: {'Content-Type': 'multipart/form-data'}
          	  })
          	  .then(response => { return response })
          	  .catch(err => { throw err })
          }
          ```
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Frontend’ten gelen bu isteği Backend\_"
      -
        type: text
        marks:
          -
            type: code
        text: API
      -
        type: text
        text: "’de, iyi bir Laravel geliştiricisi olarak,\_"
      -
        type: text
        marks:
          -
            type: code
        text: Controller
      -
        type: text
        text: "'a uğramadan önce, bir\_"
      -
        type: text
        marks:
          -
            type: code
        text: Request
      -
        type: text
        text: "\_ile doğrulamak istersiniz."
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Laravel\_"
      -
        type: text
        marks:
          -
            type: code
        text: Controller
      -
        type: text
        text: '’u da aşağı yukarı şuna benzer.'
  -
    type: set
    attrs:
      id: SnzCcOU8
      values:
        type: code
        code: |-
          ```php
          <?php

          namespace App\Http\Controllers;

          use App\Http\Controllers\Controller;
          use App\Http\Requests\MultipartFormRequest;
          use App\Http\Resources\MultipartFormResource;

          class MultipartFormController extends Controller
          {
              public function store(MultipartFormRequest $request): MultipartFormResource
              {
                  $file = $request->file('file');
                  $path = '/your/path';
                  $filename = 'filename.xlsx';

                  // Save file to a local or remote file bucket
                  $file->storeAs($path, $filename, ['disk' => 's3-public']);

                  // Create a model with file url
                  $yourModel = YourModel::create(array_merge($request->validated(), [
                      'file_url' => $path . $filename,
                  ]));

                  // Return a resource with your newly generated model
                  return new MultipartFormResource($yourModel);
              }
          }
          ```
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Veriler ve yüklenecek dosya\_"
      -
        type: text
        marks:
          -
            type: code
        text: Controller
      -
        type: text
        text: "’a gelmeden önce şuna benzer bir\_"
      -
        type: text
        marks:
          -
            type: code
        text: Request
      -
        type: text
        text: "\_ile doğrulanır:"
  -
    type: set
    attrs:
      id: rztXvGmU
      values:
        type: code
        code: |-
          ```php
          <?php

          namespace App\Http\Requests;

          use App\Enums\PromissoryNoteReasonType;
          use BenSampo\Enum\Rules\EnumValue;
          use Illuminate\Foundation\Http\FormRequest;

          class MultipartFormRequest extends FormRequest
          {
              public function authorize(): bool
              {
                  return true;
              }

              public function rules(): array
              {
                  return [
                      'bank_id'                => ['bail', 'required', 'numeric', 'exists:banks,id'],
                      'promissory_note_reason' => ['bail', 'required', new EnumValue(PromissoryNoteReasonType::class)],
                      'interest_rate'          => ['bail', 'required', 'between:0,99.9999'],
                      'fixed_fee'              => ['bail', 'required', 'integer'],
                      'tax'                    => ['bail', 'required', 'integer'],
                      'description'            => ['bail', 'required', 'string'],
                      'action_date'            => ['bail', 'required', 'date'],
                      'file'                   => ['bail', 'required', 'file', 'mimes:xls,xlsx',
                      ],
                  ];
              }
          }
          ```
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Buraya kadar her şey mükemmel ilerledi fakat bu kodu çalıştırdığınızda, gönderdiğiniz verilerin doğrulamadan geçemediğini ve derinlemesine incelediğinizde Laravel\_"
      -
        type: text
        marks:
          -
            type: code
        text: API
      -
        type: text
        text: '’nize gelen verilerin beklediğimizden çok farklı olduğunu farkedeceksiniz:'
  -
    type: set
    attrs:
      id: nlLjVxDq
      values:
        type: image
        image: articles/validating-multipart-form-data-with-laravel-validation-rules-with-proper-json-data-types/1_Yf8rcRLy8drLI6jJnItvww.png
  -
    type: set
    attrs:
      id: MQ6xHJVT
      values:
        type: code
        code: |-
          ```php
          array:8 [▼
            "file" => "file-content"
            "id" => "123"
            "reason_type" => "3"
            "rate" => "10.15"
            "fee" => "10000"
            "tax" => "1900"
            "description" => "request description"
            "action_date" => "2020-10-07 17:52:06"
          ]
          ```
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Böylece\_"
      -
        type: text
        marks:
          -
            type: code
        text: multipart/formdata
      -
        type: text
        text: "’nın binary dosya gönderebilme yeteneğinin yanında, bütün veri tiplerini\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: '’lere çevirdiğini farkettiniz.'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Bu aşamadan sonra gelen verileri\_"
      -
        type: text
        marks:
          -
            type: code
        text: API
      -
        type: text
        text: "\_tarafında doğrulama kurallarınıza gelen verilerin\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: "\_olacağını varsayarak değiştirdikten sonra,\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: "\_tipindeki değerleri tam olarak doğrulamak için kendi\_"
      -
        type: text
        marks:
          -
            type: code
        text: 'parse jimnastiğinizi'
      -
        type: text
        text: "\_yapabilirsiniz."
  -
    type: heading
    attrs:
      textAlign: left
      level: 2
    content:
      -
        type: text
        text: 'Validation with proper JSON Data Types'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Eğer\_"
      -
        type: text
        marks:
          -
            type: code
        text: FormData
      -
        type: text
        text: "\_nesnesi sadece\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: "\_türünde veri gönderebiliyor ve dosya yüklemek için mutlaka\_"
      -
        type: text
        marks:
          -
            type: code
        text: FormData
      -
        type: text
        text: "\_nesnesi kullanmamız gerekiyorsa biz de öyle yaparız. Tabii ki öncesinde gönderilecek verilerin hepsini bir\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: "'e çevirerek."
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Frontend tarafında yüklemek istediğimiz dosyayı\_"
      -
        type: text
        marks:
          -
            type: code
        text: FormData
      -
        type: text
        text: '’ya ekledikten sonra '
      -
        type: text
        marks:
          -
            type: italic
        text: (I.)
      -
        type: text
        text: " tüm diğer tüm verileri\_"
      -
        type: text
        marks:
          -
            type: code
        text: stringify()
      -
        type: text
        text: "\_ile bir\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: '’e çeviriyoruz. '
      -
        type: text
        marks:
          -
            type: italic
        text: (II.)
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Böylece\_"
      -
        type: text
        marks:
          -
            type: code
        text: 'Backend API'
      -
        type: text
        text: "’sine göndermek üzere, elimizde sadece\_"
      -
        type: text
        marks:
          -
            type: code
        text: file
      -
        type: text
        text: "\_ve\_"
      -
        type: text
        marks:
          -
            type: code
        text: payload
      -
        type: text
        text: "\_verilerini içeren bir\_"
      -
        type: text
        marks:
          -
            type: code
        text: FormData
      -
        type: text
        text: "\_nesnesi olmuş oldu. "
      -
        type: text
        marks:
          -
            type: italic
        text: (III.)
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: code
        text: stringify()
      -
        type: text
        text: "\_fonksiyonu float tipindeki verileri\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: "’e doğru veri tipiyle aktaramadığı için\_"
      -
        type: text
        marks:
          -
            type: code
        text: parseFloat()
      -
        type: text
        text: "\_fonksiyonunu kullandık. "
      -
        type: text
        marks:
          -
            type: italic
        text: (IV.)
  -
    type: set
    attrs:
      id: YjeeQC32
      values:
        type: code
        code: |-
          ```php
          postMultipartFormData(form) {
            let formData = new FormData()

            formData.append('file', form.file) // I.

            let payload = JSON.stringify({
              id: form.id,
              reason_type: form.reason_type,
              rate: parseFloat(form.rate), // IV.
              fee: form.fee * 100,
              tax: form.tax * 100,
              description: form.description,
              action_date: form.action_date
            }); // II.

            formData.append('payload', payload) // III.

            return apiClient
                .post('/post/multipart-formdata', formData, {
                  headers: { 'Content-Type': 'multipart/form-data' }
                })
                .then(response => { return response })
                .catch(err => { throw err })
          }
          ```
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: "Backend\_"
      -
        type: text
        marks:
          -
            type: code
        text: API
      -
        type: text
        text: "\_tarafına gelen\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_"
      -
        type: text
        marks:
          -
            type: code
        text: string
      -
        type: text
        text: "'i doğrulama kurallarından geçirmeden hemen önce bir\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_"
      -
        type: text
        marks:
          -
            type: code
        text: Payload
      -
        type: text
        text: "'a çevirmemiz gerekiyor. Laravel’in\_"
      -
        type: text
        marks:
          -
            type: code
        text: Request
      -
        type: text
        text: "\_sınıflarındaki\_"
      -
        type: text
        marks:
          -
            type: code
        text: prepareForValidation()
      -
        type: text
        text: "\_metodu da tam da bu iş için var."
  -
    type: set
    attrs:
      id: m8gg6Ah0
      values:
        type: code
        code: |-
          ```php
            /**
             * Prepare the data for validation.
             *
             * @return void
             *             
             * @throws \JsonException
             */
            protected function prepareForValidation(): void
            {
                $this->merge(json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR));
            }
          ```
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        marks:
          -
            type: code
        text: prepareForValidation()
      -
        type: text
        text: "\_metodu içinde\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_"
      -
        type: text
        marks:
          -
            type: code
        text: String
      -
        type: text
        text: "’i\_"
      -
        type: text
        marks:
          -
            type: code
        text: json_decode()
      -
        type: text
        text: "\_fonksiyonunu kullanarak\_"
      -
        type: text
        marks:
          -
            type: code
        text: JSON
      -
        type: text
        text: "\_"
      -
        type: text
        marks:
          -
            type: code
        text: Payload
      -
        type: text
        text: "’a çevirdikten sonra yine Laravel\_"
      -
        type: text
        marks:
          -
            type: code
        text: Request
      -
        type: text
        text: "\_sınıflarının diğer bir metodu olan\_"
      -
        type: text
        marks:
          -
            type: code
        text: merge()
      -
        type: text
        text: "\_ile diğer\_"
      -
        type: text
        marks:
          -
            type: code
        text: Request
      -
        type: text
        text: "\_verileriyle birleştiriyoruz."
  -
    type: set
    attrs:
      id: ULa7GYnw
      values:
        type: image
        image: articles/validating-multipart-form-data-with-laravel-validation-rules-with-proper-json-data-types/1_f9keavpm6xzvwbyyubr1lg.png
  -
    type: set
    attrs:
      id: xBQZy0F6
      values:
        type: code
        code: |-
          ```php
          array:7 [▼
            "id" => 123
            "reason_type" => 3
            "rate" => 10.15
            "fee" => 10000
            "tax" => 1900
            "description" => "request description"
            "action_date" => "2020-10-07 17:52:06"
          ]
          ```
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: text
        text: 'Böylece verilerimiz uygun veri tiplerine cast edilerek doğrulama kurallarından geçebilmiş oldu. Ne doğrulama kurallarını değiştirmeye ne de ayrıca doğrulama jimnastiği yapmaya gerek kaldı.'
  -
    type: paragraph
    attrs:
      textAlign: left
    content:
      -
        type: hardBreak
---
