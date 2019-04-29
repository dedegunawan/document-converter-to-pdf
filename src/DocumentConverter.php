<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 4/29/19
 * Time: 8:41 PM
 */

namespace DedeGunawan\DocumentConverterToPdf;


use DedeGunawan\PdfConverterClient\Converter;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentConverter
{
    protected $template_processor;
    protected $converter;

    protected $document_file;
    protected $pdf_file;

    protected $api_key;
    protected $secret_key;
    protected $api_url="https://pdf-converter.cioray.tech/";

    /**
     * @return TemplateProcessor
     */
    public function getTemplateProcessor()
    {
        return $this->template_processor;
    }

    /**
     * @param TemplateProcessor $template_processor
     */
    public function setTemplateProcessor($template_processor)
    {
        $this->template_processor = $template_processor;
    }

    /**
     * @return Converter
     */
    public function getConverter()
    {
        return $this->converter;
    }

    /**
     * @return mixed
     */
    public function getDocumentFile()
    {
        return $this->document_file;
    }

    /**
     * @param mixed $document_file
     */
    public function setDocumentFile($document_file)
    {
        $this->document_file = $document_file;
    }

    /**
     * @return mixed
     */
    public function getPdfFile()
    {
        return $this->pdf_file;
    }

    /**
     * @param mixed $pdf_file
     */
    public function setPdfFile($pdf_file)
    {
        $this->pdf_file = $pdf_file;
    }

    /**
     * @param Converter $converter
     */
    public function setConverter($converter)
    {
        $this->converter = $converter;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param mixed $api_key
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * @param mixed $secret_key
     */
    public function setSecretKey($secret_key)
    {
        $this->secret_key = $secret_key;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * @param string $api_url
     */
    public function setApiUrl($api_url)
    {
        $this->api_url = $api_url;
    }



    public function init($document_file)
    {
        $api_key = $this->getApiKey();
        $secret_key = $this->getSecretKey();
        if (!$api_key || !$secret_key) throw new Exception("Api Key / Secret Key untuk konversi PDF tidak ditemukan");

        \DedeGunawan\PdfConverterClient\Converter::setApiUrl("https://pdf-converter.cioray.tech/");
        \DedeGunawan\PdfConverterClient\Converter::setApiKey($api_key);
        \DedeGunawan\PdfConverterClient\Converter::setSecretKey($secret_key);

        $this->setConverter(new Converter());
        $this->setDocumentFile($document_file);
        $this->setTemplateProcessor(new TemplateProcessor($this->getDocumentFile()));
    }

    public function setValue($key, $value) {
        $this->getTemplateProcessor()->setValue($key, $value);
    }

    public function setImageValue($key, $value, $limit = NULL) {
        $this->getTemplateProcessor()->setImageValue($key, $value, $limit);
    }

    public function convert() {
        $file = $this->getTemplateProcessor()->save();
        $converter = $this->getConverter();
        $converter->setFile($file);
        $converter->convert();
        $converter->showPdf();
    }


}