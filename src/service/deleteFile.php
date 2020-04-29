<?php


namespace App\service;


use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class deleteFile
{
    private $filesystem ;
    private $symLink;
    //$this->getParameter('upload_file').'/'.$service->getImage()
    public function __construct(string  $symLink)
    {
        $this->filesystem = new Filesystem() ;
        $this->symLink = $symLink ;

    }
//    private function Execute (){
//        try {
//            $this->filesystem->mkdir(sys_get_temp_dir().'/'.random_int(0, 1000));
//        } catch (IOExceptionInterface $exception) {
//            echo "An error occurred while creating your directory at ".$exception->getPath();
//        }
//    }
    public function done()
    {
            $this->filesystem->remove([$this->symLink]);
    }
}