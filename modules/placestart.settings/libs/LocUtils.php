<?php
  namespace Placestart;
  use Bitrix\Main\IO\Path;
  use Bitrix\Main\Localization\Loc;

  /**
   * Вспомогательный класс для локализации. Работает на основе Loc::getMessage, использует lang файлы.
   * Создает уникальный префикс для каждого файла, чтобы избежать возможного перезаписывания сообщений из одного файла другим файлом.
   * 
   * @property string $file Путь к файлу
   * @property string $prefix Префикс для названия сообщения
  */
  class LocUtils{
    private $file = '';
    private $prefix = '';
    public $test123 = '';

    /**
     * @param string $file_path Путь к файлу
     * @param bool $load
    */
    function __construct($file_path, $load = false){
      $this->file = Path::normalize($file_path);

      $this->setPrefix();

      if ($load)
        $this->load();
    }

    /**
     * Создает префикс
    */
    private function setPrefix(){
      $prefix_path = mb_substr($this->file, mb_stripos($this->file, 'local') + 6);
      $filename = Path::getName($prefix_path);

      $components_pos = mb_stripos($prefix_path, 'components');
      if ($components_pos !== false){
        $prefix_path = mb_substr($prefix_path, $components_pos + 11);
      }
      $prefix_path = mb_substr($prefix_path, 0, mb_stripos($prefix_path, $filename));

      $lang_pos = mb_stripos($prefix_path, 'lang');
      if ($lang_pos !== false){
        $prefix_path = mb_substr($prefix_path, 0 ,$lang_pos);
      }
      $prefix_path = trim($prefix_path, '/');

      $filename = mb_substr($filename, 0, mb_stripos($filename, '.php'));
      $prefix = mb_strtoupper(str_replace(['.','/', '-'], '_', $prefix_path));
      $prefix .= '_'.mb_strtoupper($filename);

      $this->prefix = $prefix;
    }
    
    private function load(){
      Loc::loadMessages($this->file);
    }

    /**
     * Создает массив сообщений, для передачу в $MESS.
     * Вызывать в lang файле.
     * 
     * Пример:
     * $loc = new LocUtils(__FILE__);
     * $MESS = $loc->createLoc([
     *   'ORDER_A_PROJECT' => 'Заказать проект',
     *   'FIND' => 'Найти',
     *   'SEARCH_PLACEHOLDER' => 'Что ищем?'
     * ]);
     * 
     * @param array<string, string> $mess Массив сообщений
     * @return array<string, string>
    */
    public function createLoc($mess){
      $new_mess = [];
      foreach ($mess as $key => $value){
        $new_mess[$this->prefix.'_'.$key] = $value;
      }
      return $new_mess;
    }

    /**
     * Возвращает сообщение перевода.
     * Вызывать в файле, для которого нужно получить перевод.
     * 
     * @link https://dev.1c-bitrix.ru/api_d7/bitrix/main/localization/loc/getmessage.php
     * 
     * @param string $code Код сообщения
     * @param ?array $replace Массив замены
     * @param ?string $language ID языка
    */
    public function getMessage($code, $replace = null, $language = null){
      $prefix = $this->prefix.'_'.$code;
      return Loc::getMessage($this->prefix.'_'.$code, $replace, $language);
    }
  }