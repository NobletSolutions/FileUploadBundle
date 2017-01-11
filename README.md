File Upload Bundle
==================

A simple bundle to handle file uploads and url generation.


Install
-------

Via Composer

```sh
$ composer require ns/file-upload-bundle
```


Configuration
-------------

### Define a configuration

Configurations are defined as services. For each naming / file location define
a tagged service. You can choose any of the provided file namers, or implement your own. 
Only one of the second or third parameters are required, however both can be used as well. 

```
# services.yml
ns_file.applicant_uploads:
  class: NS\FileUploadBundle\Handler\Config
  arguments: [ "@ns_file.namer.default", "applicant-uploads", "@ns_file.directory_namer.hash" ]
  tags:
    - { name: ns_file.config, config_name: applicant }
```

Given the above configuration. A file uploaded using this configuration would be stored
in web/uploads/applicant-uploads/HASH/ClientOriginalName_RANDSTR.ext 

You are free to implement your own file and/or directory namers. Simply implement the
 NS\FileUploadBundle\Namer\FileNamerInterface or NS\FileUploadBundle\Namer\DirectoryNamerInterface.
 
The bundle comes with the following file naming strategies.


#### OriginalNamer

This stores the uploaded file using the name provided by the client when uploaded. Service id 
**@ns_file.namer.client_original**


#### OriginalRandomNamer

Similar to the OriginalNamer, this will keep the original filename, but inserts random characters
and numbers after the name but before the file extension. This is the **default** file namer. 
Service id **@ns_file.namer.original_random**


#### RandomNamer

This renames the file to a random string but keeps the original file extension. Service id 
**@ns_file.namer.random**


#### UniqueHashNamer

This performs a sha1 hash of the original client name and uses that plus the original file
extension. Service id **@ns_file.namer.unique_hash**

Usage
------

When handling a file upload. Simply request the upload handler service. Pass it the instance
of the UploadedFile, the configuration and optionally any additional data that the directory 
namer will use.

#### Upload Handling

```php
    // $applicantEmailAddress = 'user@example.com';
    // instanceof UploadedFile with clientOriginalName 'funny-cat-image.jpg'
    $sourceFile = $form['somefile']->getData();
    $handler = $this->get('ns_file.upload_handler');
    
    $destinationFile = $handler->upload('applicant', $sourceFile, $applicantEmailAddress);
```

Based on our example configuration above will take the source file and place it in
web/uploads/applicant-uploads/63a710569261a24b3766275b7000ce8d7b32e2f7/funny-cat-image_xx12xa.jpg.
It will then return a File instance for this. You can save the filename however you'd like.


#### Downloads / Twig

There is a twig helper which will allow the generation of download urls for any given file.

```twig
    <a href="{{ file_path('applicant', 'funny-cat-image_xx12xa.jpg', 'user@example.com') }}">Download</a>
```

Provides a link to this file.

License
-------

MIT, see LICENSE.
