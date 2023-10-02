<?php


namespace App\Http\Services\File;


class FileService extends FileToolsService
{


    public function moveToPublic($file)
    {
        $this->setFile($file);

        $this->provider();

        $result = $file->move(public_path($this->getFinalFileDirectory()),$this->getFinalFileName());

        return $result ? $this->getFileAddress() : false;
    }

    public function moveToStorage($file)
    {
        $this->setFile($file);

        $this->provider();

        $result = $file->move(storage_path($this->getFinalFileDirectory()),$this->getFinalFileName());

        return $result ? $this->getFileAddress() : false;
    }



    public function deleteFile($filePath,$storage=false)
    {
        if ($storage){
            if (file_exists(storage_path($filePath))) {
                unlink(storage_path($filePath));
                return true;
            }
        }else{
            if (file_exists($filePath)) {
                unlink($filePath);
                return true;
            }
        }

        return false;

    }

    public function deleteDirectoryAndFiles($directory)
    {
        if (!is_dir($directory)) {
            return false;
        }
        $files = glob($directory . DIRECTORY_SEPARATOR . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDirectoryAndFiles($file);
            } else {
                unlink($file);
            }
        }
        $result = rmdir($directory);
        return $result;
    }
}
