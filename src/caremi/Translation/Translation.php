<?php declare(strict_types=1);

namespace Caremi\Translation;

use Caremi\Translation\TranslationInterface;
use Caremi\Utility\Yaml;
use Caremi\Session\SessionTrait;

class Translation implements TranslationInterface
{

    use SessionTrait;

    private static $instance = null;

    /** @var array - Hold the translation strings */
    private $message;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $defaultLocale = Yaml::file('app')['settings']['default_locale'];
        $translation = $this->localeParser() ? $this->localeParser() : $defaultLocale;
        $localePath = APP_ROOT . "/Resources/translations/php";
        $locale = "{$localePath}/{$translation}/{$translation}.yml";
        $localeDefault = "{$localePath}/{$defaultLocale}/{$defaultLocale}.yml";
        var_dump(Yaml::file($localeDefault));

        if (
            file_exists($locale) && 
            is_readable($locale)) {
                return Yaml::file($locale);
        } else {
            return Yaml::file($localeDefault);
        }
        SessionTrait::sessionFromGlobal()->set('session_locale', $defaultLocale);
        $this->message = $message;
    }

    public function __get($name)
    {
        if (array_key_exists($name, (array)$this->message)) {
            return $this->message[$name];
        } else {
            return null;
        }
    }

    public function localeParser()
    {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }

}
