<?php
declare(strict_types=1);
require __DIR__.'/admin/lib/render.php';
try {
  $path=ltrim(rawurldecode(parse_url($_SERVER['REQUEST_URI']??'/',PHP_URL_PATH)?:'/'),'/');if($path==='')$path='index.html';if(!str_contains(basename($path),'.'))$path.='.html';
  if($path==='sitemap.xml'){header('Content-Type: application/xml; charset=utf-8');echo Norda\sitemap();exit;}
  if(!preg_match('~^(?:[a-z0-9-]+/)?[a-z0-9.-]+\.html$~D',$path)||str_contains($path,'..')){http_response_code(404);exit;}
  [$html,$status]=Norda\render($path);http_response_code($status);header('Content-Type: text/html; charset=utf-8');header('X-Content-Type-Options: nosniff');echo $html;
} catch(Throwable $e){error_log('Norda render failure: '.get_class($e));http_response_code(503);header('Content-Type: text/plain; charset=utf-8');echo 'Səhifə müvəqqəti əlçatan deyil. Bir qədər sonra yenidən yoxlayın.';}
