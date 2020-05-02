<?php


namespace App\ApiModel;


class ClaimModel
{
    private $first_name ;
    private $last_name ;
    private $mail ;
    private $tel ;
    private $content ;
    private $image ;
    private $extension ;

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension): void
    {
        $this->extension = $extension;
    }
    private $encodedData ;


    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel): void
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
        $this->encodedData = base64_decode($image);
    }

    public function getEncodedData()
    {
        return $this->encodedData;
    }
}