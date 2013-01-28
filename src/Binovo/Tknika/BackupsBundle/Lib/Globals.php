<?php

namespace Binovo\Tknika\BackupsBundle\Lib;

class Globals
{
    protected static $uploadDir;
    protected static $backupDir;

    public static function setUploadDir($dir)
    {
        self::$uploadDir = $dir;
    }

    public static function getUploadDir()
    {
        return self::$uploadDir;
    }

    public static function setBackupDir($dir)
    {
        self::$backupDir = $dir;
    }

    public static function getBackupDir()
    {
        return self::$backupDir;
    }

    public static function getSnapshotRoot($idClient, $idJob = null)
    {
        if (!isset($idJob)) {

            return sprintf('%s/%04d', Globals::getBackupDir(), $idClient);
        } else {

            return sprintf('%s/%04d/%04d', Globals::getBackupDir(), $idClient, $idJob);
        }
    }

    public static function delTree($dir)
    {
        $allOk = true;
        if (!file_exists($dir)) {
            return true;
        }
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") {
                        $allOk = $allOk && Globals::delTree($dir."/".$object);
                    } else {
                        $allOk = $allOk && unlink($dir."/".$object);
                    }
                }
            }
            reset($objects);
            $allOk = $allOk && rmdir($dir);
        } else {
            $allOk = $allOk && unlink($dir);
        }
        return $allOk;
    }
}