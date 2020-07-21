<?php


namespace app\controller;

use think\exception\FileException;
use think\exception\ValidateException;
use think\facade\Filesystem;

class FileUpload
{
    public function upload($field)
    {
        $files = request()->file($field);
        $savePath = null;
        $fileName = null;
        $fileHash = null;
        $fileExt = null;

        try {
            // 限制文件大小为20M
            validate([$field => 'filesize:20480000'], [$field . '.filesize' => '文件不能大于20M'])->check([$field => $files]);
            $fileExt = $files->getOriginalExtension();
            $fileExt = strtolower($fileExt);
            $failExt = ['exe', 'sh'];
            if (in_array($fileExt, $failExt)) {
                return [false, '当前文件类型不允许上传'];
            }
            $path = 'to' . $fileExt; // 获取原始文件名后缀
            $fileName = $files->getOriginalName(); // 获取原始文件名
            $saveName = Filesystem::disk('public')->putFile($path, $files, 'md5');
            $savePath = 'storage/' . $saveName;
            $fileHash = [
                'md5' => $files->hash('md5'),
                'sha1' => $files->hash('sha1')
            ];
        } catch (ValidateException $e) {
            return [false, $e->getMessage()];
        } catch (FileException $e) {
            return [false, $e->getMessage()];
        }
        return [
            true,
            'savePath' => $savePath,
            'fileName' => $fileName,
            'fileExt' => $fileExt,
            'fileHash' => $fileHash
        ];
    }
}