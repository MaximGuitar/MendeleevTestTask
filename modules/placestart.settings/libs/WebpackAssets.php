<?php
  namespace Placestart;

  Class WebpackAssets{
    private $assets = [];
    private $prefix = '';

    function __construct(string $manifest_path, string $path_prefix = ''){
      $file = file_get_contents($manifest_path);
      if (!$file){
        throw new \Exception('Не удалось прочитать манифест');
      }

      $assets = json_decode($file, true);
      if (!$assets){
        throw new \Exception('Не удалось декодировать json');
      }
      
      $this->assets = $assets;
      $this->prefix = $path_prefix;
    }

    public function get(string $key){
      if (!isset($this->assets[$key]))
        return false;
        
      return $this->prefix . $this->assets[$key];
    }
  }
?>