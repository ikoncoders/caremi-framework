<?php declare(strict_types=1);
namespace Caremi\Ash;

use Caremi\Utility\Yaml;
use Caremi\Utility\Convert;
use Caremi\Base\BaseApplication;
use Caremi\Ash\Traits\TemplateTraits;
use Caremi\Ash\Components\Uikit\UikitNavigationExtension;
use Caremi\Ash\Components\Uikit\UikitPaginationExtension;
use Caremi\Ash\Components\Bootstrap\BsNavigationExtension;
use Caremi\Ash\Components\Uikit\UikitCommanderBarExtension;
use Caremi\Ash\Exception\TemplateLocaleOutOfBoundException;
use Caremi\Ash\Components\Uikit\UikitFlashMessagesExtension;

class TemplateExtension
{

    /** @var trait - holds common function used across template extensions */
    use TemplateTraits;

    /** @var array */
    protected mixed $js = null;
    /** @var array */
    protected mixed $css = null;
    /** @var string */
    protected string $string;

    private array $ext = [];
    private array $extensions = [];
    private object $controller;

    /**
     * Return an array of all the template extension class with the const extension 
     * name as the key which represent the extension logic
     *
     * @return array
     */
    public function __construct(object $controller)
    {
        $this->controller = $controller;
        $this->extensions = [

            UikitNavigationExtension::NAME => UikitNavigationExtension::class,
            UikitPaginationExtension::NAME => UikitPaginationExtension::class,
            UikitCommanderBarExtension::NAME => UikitCommanderBarExtension::class,
            UikitFlashMessagesExtension::NAME => UikitFlashMessagesExtension::class,
            BsNavigationExtension::NAME => BsNavigationExtension::class

        ];
    }

    /**
     * Return a formated human readable date format
     *
     * @param mixed $time
     * @param boolean $short
     * @return string
     */
    public function formatDate(mixed $time, bool $short = false): string
    {
        return Convert::timeFormat($time, $short);
    }

    /**
     * Undocumented function
     *
     * @param string $string
     * @return string
     */
    public function locale(string $string): string
    {
        if (is_string($string)) {
            $locale = Yaml::file('locale')['en'];
            if (!in_array($string, array_keys($locale))) {
                throw new TemplateLocaleOutOfBoundException($string . ' is an invalid translation stirng.');
            }

            return $locale[$string];
        }
    }

    /**
     * Return a registered extension
     *
     * @param string $extensionName
     * @return void
     */
    public function templateExtension(string|null $extensionName, ?string $header = null, ?string $headerIcon = null): mixed
    {
        if (count($this->extensions) > 0) {
            if (in_array($extensionName, array_keys($this->extensions))) {
                foreach ($this->extensions as $name => $extension) {
                    if ($extensionName === $name) {
                        $ext = BaseApplication::diGet($extension);
                        if ($ext) {
                            return call_user_func_array([$ext, 'register'], [$this->controller, $header, $headerIcon]);
                        }
                    }
                }
            }
        }
    }
}
