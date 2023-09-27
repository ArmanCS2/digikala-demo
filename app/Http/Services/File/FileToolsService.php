<?php

namespace App\Http\Services\File;

class FileToolsService
{
    protected $file;
    protected $exclusiveDirectory;
    protected $fileDirectory;
    protected $fileName;
    protected $fileFormat;
    protected $finalFileDirectory;
    protected $finalFileName;
    protected $fileSize;

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function setExclusiveDirectory($exclusiveDirectory)
    {
        $this->exclusiveDirectory = trim($exclusiveDirectory, '\/');
    }

    public function getExclusiveDirectory()
    {
        return $this->exclusiveDirectory;
    }

    public function setFileDirectory($fileDirectory)
    {
        $this->fileDirectory = trim($fileDirectory, '\/');
    }

    public function getFileDirectory()
    {
        return $this->fileDirectory;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileSize($file)
    {
        $this->fileSize = $file->getSize();
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }

    public function setCurrentFileName()
    {
        //$_FILES['file']['name'];
        return !empty($this->file) ? $this->setFileName(pathinfo($this->file->getClientOriginalName, PATHINFO_FILENAME)) : false;
    }

    public function setFileFormat($fileFormat)
    {
        $this->fileFormat = $fileFormat;
    }

    public function getFileFormat()
    {
        return $this->fileFormat;
    }

    public function setFinalFileDirectory($finalFileDirectory)
    {
        $this->finalFileDirectory = $finalFileDirectory;
    }

    public function getFinalFileDirectory()
    {
        return $this->finalFileDirectory;
    }

    public function setFinalFileName($finalFileName)
    {
        $this->finalFileName = $finalFileName;
    }

    public function getFinalFileName()
    {
        return $this->finalFileName;
    }

    protected function checkDirectory($fileDirectory)
    {
        if (!file_exists($fileDirectory)) {
            mkdir($fileDirectory, 0777, true);
        }
    }

    protected function getFileAddress()
    {
        return $this->finalFileDirectory . DIRECTORY_SEPARATOR . $this->finalFileName;
    }

    protected function provider()
    {
        $this->getFileDirectory() ?? $this->setFileDirectory(str_replace('/', DIRECTORY_SEPARATOR, date('Y/m/d')));
        $this->getFileName() ?? $this->setFileName(time());
        $this->setFileFormat(pathinfo($this->file->getClientOriginalName(),PATHINFO_EXTENSION));

        $finalImageDirectory = empty($this->getExclusiveDirectory()) ? $this->getFileDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getFileDirectory();

        $this->setFinalFileDirectory($finalImageDirectory);

        $this->setFinalFileName($this->getFileName() . '.' . $this->getFileFormat());

        $this->checkDirectory($this->getFinalFileDirectory());
    }


}
