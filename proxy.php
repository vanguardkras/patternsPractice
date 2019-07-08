<?php

interface Downloader
{
    public function download(string $url): string;
}

class SimpleDownloader implements Downloader
{
    public function download(string $url): string 
    {
        return file_get_contents($url);
    }
}

class CacheDownloader implements Downloader
{    
    public function download(string $url): string 
    {
        $list = file_get_contents('./cache/list.txt');
        $list = json_decode($list, TRUE);
        $check = 0;
        $file_name = '';
        if (isset($list)) {
            foreach ($list as $l) {
                if ($l['url'] == $url) {
                    $check = 1;
                    $file_name = $l['name'];
                }
            }
        }
        if ($check) {
            return file_get_contents('./cache/'.$file_name);
        } else {
            $new = [];
            $new['name'] = uniqid();
            $new['url'] = $url;
            $list = file_get_contents('./cache/list.txt');
            $list = json_decode($list);
            $list[] = $new;
            $list = json_encode($list);
            file_put_contents('./cache/list.txt', $list );
            $simple = new SimpleDownloader;
            $res = $simple->download($url);
            file_put_contents('./cache/'.$new['name'], $res);
            return $res;
        }
    }
}

$a = new CacheDownloader;
echo $a->download('http://www.vk.com');