<?php

namespace App\Http\Services\Image;

class ImageToolsService
{
    protected $image;
    protected $exclusiveDirectory;
    protected $imageDirectory;
    protected $imageName;
    protected $imageFormat;
    protected $finalImageDirectory;
    protected $finalImageName;

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setExclusiveDirectory($exclusiveDirectory)
    {
        $this->exclusiveDirectory = trim($exclusiveDirectory, '\/');
    }

    public function getExclusiveDirectory()
    {
        return $this->exclusiveDirectory;
    }

    public function setImageDirectory($imageDirectory)
    {
        $this->imageDirectory = trim($imageDirectory, '\/');
    }

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setCurrentImageName()
    {
        //$_FILES['image']['name'];
        return !empty($this->image) ? $this->setImageName(pathinfo($this->image->getClientOriginalName, PATHINFO_FILENAME)) : false;
    }

    public function setImageFormat($imageFormat)
    {
        $this->imageFormat = $imageFormat;
    }

    public function getImageFormat()
    {
        return $this->imageFormat;
    }

    public function setFinalImageDirectory($finalImageDirectory)
    {
        $this->finalImageDirectory = $finalImageDirectory;
    }

    public function getFinalImageDirectory()
    {
        return $this->finalImageDirectory;
    }

    public function setFinalImageName($finalImageName)
    {
        $this->finalImageName = $finalImageName;
    }

    public function getFinalImageName()
    {
        return $this->finalImageName;
    }

    protected function checkDirectory($imageDirectory)
    {
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0777, true);
        }
    }

    protected function getImageAddress()
    {
        return $this->finalImageDirectory . DIRECTORY_SEPARATOR . $this->finalImageName;
    }

    protected function provider()
    {
        $this->getImageDirectory() ?? $this->setImageDirectory(str_replace('/', DIRECTORY_SEPARATOR, date('Y/m/d')));
        $this->getImageName() ?? $this->setImageName(time());
        $this->getImageFormat() ?? $this->setImageFormat($this->image->extension());

        $finalImageDirectory = empty($this->getExclusiveDirectory()) ? $this->getImageDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getImageDirectory();

        $this->setFinalImageDirectory($finalImageDirectory);

        $this->setFinalImageName($this->getImageName() . '.' . $this->getImageFormat());

        $this->checkDirectory($this->getFinalImageDirectory());
    }


}
