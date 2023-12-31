<?php declare(strict_types=1);
namespace Caremi\Base;

use Caremi\Utility\Yaml;
use Caremi\Auth\Authorized;
use Caremi\Base\BaseRedirect;
use Caremi\Session\Flash\Flash;
use Caremi\Http\ResponseHandler;
use Caremi\Session\SessionTrait;
use Caremi\Ash\TemplateExtension;
use Caremi\Middleware\Middleware;
use Caremi\Session\Flash\FlashType;
use Caremi\Base\Exception\BaseLogicException;
use Caremi\Base\Traits\ControllerCastingTrait;

// use MagmaCore\Base\Traits\TableSettingsTrait;



class BaseController extends AbstractBaseController
{

    use SessionTrait;
    use ControllerCastingTrait;

    /** @var array */
    protected array $routeParams;
    /** @var object */
    protected Object $templateEngine;
    /** @var */
    protected object $template;
    /** @var array */
    protected array $callBeforeMiddlewares = [];
    /** @var array */
    protected array $callAfterMiddlewares = [];

    /**
     * Main class constructor
     *
     * @param array $routeParams
     */
    public function __construct(array $routeParams)
    {
        parent::__construct($routeParams);
        $this->routeParams = $routeParams;
        $this->templateEngine = new BaseView();

        $this->diContainer(Yaml::file('providers'));
        $this->registerSubscribedServices();
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param $name
     * @param $arguments
     * @throws BaseException
     * @return void
     */
    public function __call($name, $argument)
    {
        if (is_string($name) && $name !== '') {
            $method = $name . 'Action';
            if (method_exists($this, $method)) {
                if ($this->before() !== false) {
                    call_user_func_array([$this, $method], $argument);
                    $this->after();
                }
            } else {
                throw new \BadMethodCallException("Method {$method} does not exists.");
            }
        } else {
            throw new \Exception();
        }
    }

    /**
     * Returns an array of middlewares for the current object which will
     * execute before the action is called. Middlewares are also resolved
     * via the container object. So you can also type hint any dependency
     * you need within your middleware constructor. Note constructor arguments
     * cannot be resolved only other objects
     *
     * @return array
     */
    protected function callBeforeMiddlewares(): array
    {
        return $this->callBeforeMiddlewares;
    }

    /**
     * Returns an array of middlewares for the current object which will
     * execute before the action is called. Middlewares are also resolved
     * via the container object. So you can also type hint any dependency
     * you need within your middleware constructor. Note constructor arguments
     * cannot be resolved only other objects
     *
     * @return array
     */
    protected function callAfterMiddlewares(): array
    {
        return $this->callAfterMiddlewares;
    }

    /**
     * Before method. Call before controller action method
     * @return void
     */
    protected function before()
    {
        $object = new self($this->routeParams);
        (new Middleware())->middlewares($this->callBeforeMiddlewares())
            ->middleware($object, function ($object) {
                return $object;
            });
    }

    /**
     * After method. Call after controller action method
     * 
     * @return void
     */
    protected function after()
    {
        $object = new self($this->routeParams);
        (new Middleware())->middlewares($this->callAfterMiddlewares())
            ->middleware($object, function ($object) {
                return $object;
            });
    }


    /**
     * Render a template response using Twig templating engine
     *
     * @param string $template - the rendering template
     * @param array $context - template data context
     * @return Response
     * @throws LoaderError
     * @throws BaseLogicException
     */
    public function view(string $template, array $context = [])
    {
        if (null === $this->templateEngine) {
            throw new BaseLogicException(
                'You can not use the render method if the build in template engine is not available.'
            );
        }
        $templateContext = array_merge(
            ['current_user' => Authorized::grantedUser()],
            ['func' => new TemplateExtension($this)],
            ['app' => Yaml::file('app')],
            ['menu' => Yaml::file('menu')],
            ['routes' => (isset($this->routeParams) ? $this->routeParams : [])]
        );

        $response = (new ResponseHandler(
            $this->templateEngine->ashRender($template, array_merge($context, $templateContext))
        ))->handler();
        if ($response) {
            return $response;
        }
    }

    public function getRoutes(): array
    {
        return $this->routeParams;
    }

    /**
     * Alias of view() method
     *
     * @param string $template - the rendering template
     * @param array $context - template data context
     * @return Response
     * @throws LoaderError
     * @throws BaseLogicException
     */
    public function render(string $template, array $context = [])
    {
        return $this->view($template, $context);
    }

    /**
     * @inheritdoc
     *
     * @param string $url
     * @param boolean $replace
     * @param integer $responseCode
     * @return void
     */
    public function redirect(string $url, bool $replace = true, int $responseCode = 303)
    {
        $this->redirect = new BaseRedirect(
            $url,
            $this->routeParams,
            $replace,
            $responseCode
        );

        if ($this->redirect) {
            $this->redirect->redirect();
        }
    }

    public function onSelf()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            return $_SERVER['REQUEST_URI'];
        }
    }

    public function getSiteUrl(?string $path = null): string
    {
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            ($path !== null) ? $path : $_SERVER['REQUEST_URI']
        );
    }

    /**
     * Conbination method which encapsulate the flashing and redirecting all within
     * a single method. Use the relevant arguments to customized the output
     *
     * @param boolean $action
     * @param string|null $redirect
     * @param string $message
     * @param string $type
     * @return void
     */
    public function flashAndRedirect(bool $action, ?string $redirect = null, string $message, string $type = FlashType::SUCCESS): void
    {
        if (is_bool($action)) {
            $this->flashMessage($message, $type);
            $this->redirect(($redirect === null) ? $this->onSelf() : $redirect);
        }
    }

    /**
     * Returns the session based flash message
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public function flashMessage(string $message, string $type = FlashType::SUCCESS)
    {
        $flash = (new Flash(SessionTrait::sessionFromGlobal()))->add($message, $type);
        if ($flash) {
            return $flash;
        }
    }

    /**
     * Returns the session based flash message type warning as string
     *
     * @return string
     */
    public function flashWarning(): string
    {
        return FlashType::WARNING;
    }

    /**
     * Returns the session based flash message type success as string
     *
     * @return string
     */
    public function flashSuccess(): string
    {
        return FlashType::SUCCESS;
    }

    /**
     * Returns the session based flash message type danger as string
     *
     * @return string
     */
    public function flashDanger(): string
    {
        return FlashType::DANGER;
    }

    /**
     * Returns the session based flash message type info as string
     *
     * @return string
     */
    public function flashInfo(): string
    {
        return FlashType::INFO;
    }

    /**
     * Returns a translation string to convert to default or choosen locale
     *
     * @param string $locale
     * @return string
     */
    public function locale(?string $locale = null): ?string
    {
        /*if (null !== $locale)
            return Translation::getInstance()->$locale;*/
        return $locale;
    }

    /**
     * Returns the session object for use throughout any controller. Can be used 
     * to called any of the methods defined with the session class
     *
     * @return Object
     */
    public function getSession(): Object
    {
        return SessionTrait::sessionFromGlobal();
    }
}
