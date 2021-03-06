<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 4/29/19
 * Time: 8:40 PM
 */

require_once '../vendor/autoload.php';

try {
    $document_converter = new \DedeGunawan\DocumentConverterToPdf\DocumentConverter();
    $document_converter->setApiKey('api_key');
    $document_converter->setSecretKey('secret_key');

    $document_converter->init('test.docx');
    $document_converter->setValue('nama_lengkap', 'Dede Gunawan');
    $document_converter->convert();
} catch (Exception $exception) {
    var_dump($exception);die();
}