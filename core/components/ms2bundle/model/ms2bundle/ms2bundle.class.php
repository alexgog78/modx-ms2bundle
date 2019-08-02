<?php

class ms2Bundle
{
    const PACKAGE = 'ms2bundle';

    const HANDLERS = [
        'mgr' => [],
        'default' => []
    ];

    /** @var modX */
    public $modx;

    /** @var array */
    public $config = [];

    /** @var array */
    public $initialized = [];

    /** @var pdoFetch */
    public $pdoTools;

    /** @var checkoutHandler */
    public $checkoutHandler;

    /** @var orderHandler */
    public $orderHandler;

    /** @var userHandler */
    public $userHandler;

    /**
     * ms2Bonus constructor.
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx = &$modx;

        $basePath = $this->modx->getOption(self::PACKAGE . '.core_path', $config, $this->modx->getOption('core_path') . 'components/' . self::PACKAGE . '/');
        $assetsUrl = $this->modx->getOption(self::PACKAGE . '.assets_url', $config, $this->modx->getOption('assets_url') . 'components/' . self::PACKAGE . '/');
        $this->config = array_merge([
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath . 'model/',
            'handlersPath' => $basePath . 'handlers/',
            'processorsPath' => $basePath . 'processors/',
            'templatesPath' => $basePath . 'elements/templates/',
            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'actionUrl' => $assetsUrl . 'action.php'
        ], $config);

        $this->modx->addPackage(self::PACKAGE, $this->config['modelPath']);
        $this->modx->lexicon->load(self::PACKAGE . ':default');

        if ($this->pdoTools = $this->modx->getService('pdoFetch')) {
            $this->pdoTools->setConfig($this->config);
        }
    }

    /**
     * @param string $ctx
     * @param array $scriptProperties
     * @return bool
     */
    public function initialize($ctx = 'web', $scriptProperties = [])
    {
        $this->config = array_merge($this->config, $scriptProperties);
        $this->config['ctx'] = $ctx;
        if ($this->initialized[$ctx]) {
            return true;
        }

        $this->addHandlers($ctx);
        switch ($ctx) {
            case 'mgr':
                $this->initializeBackend();
                break;
            default:
                $this->initializeFrontend();
                break;
        }

        $this->initialized[$ctx] = true;
    }

    /**
     * @param string $message
     * @param array $data
     * @param array $placeholders
     * @return array
     */
    public function success($message = '', $data = [], $placeholders = [])
    {
        return [
            'success' => true,
            'message' => $this->getLexiconTopic($message, $placeholders),
            'data' => $data
        ];
    }

    /**
     * @param string $message
     * @param array $data
     * @param array $placeholders
     * @return array
     */
    public function error($message = '', $data = [], $placeholders = [])
    {
        return [
            'success' => false,
            'message' => $this->getLexiconTopic($message, $placeholders),
            'data' => $data
        ];
    }

    /**
     * @param string $key
     * @param array $placeholders
     * @return string
     */
    public function getLexiconTopic($key = '', $placeholders = [])
    {
        return $this->modx->lexicon(self::PACKAGE . '.' . $key, $placeholders);
    }

    /**
     * @param string $ctx
     * @return bool
     */
    private function addHandlers($ctx = 'default')
    {
        $handlers = self::HANDLERS[$ctx] ?? self::HANDLERS['default'];
        foreach ($handlers as $className) {
            require_once $this->config['handlersPath'] . mb_strtolower($className) . '.class.php';
            $this->$className = new $className($this, $this->config);
            if (!($this->$className instanceof $className)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not initialize ' . $className . ' class');
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    private function initializeBackend()
    {
        //Add JS and CSS
        if ($this->modx->controller) {
            $this->modx->controller->addHtml('
                <script type="text/javascript">
                    ms2Extend = {};
                    ms2Extend.config = ' . $this->modx->toJSON($this->config) . ';
                </script>'
            );
        }
        return true;
    }

    /**
     * @return bool
     */
    private function initializeFrontend()
    {
        return true;
    }
}