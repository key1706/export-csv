<?php
/**
 * @author TruongHV1
 */

namespace Controller;

class BaseController {
    /**
     * Template path
     * @var string
     */
    protected $template = null;

    /**
     * Model name
     * @var string
     */
    protected $model = null;

    /**
     * Instance Controller
     * @param string $modelName
     * @throws Exception
     */
    public function __construct($modelName = "") {
        if (!$this->template) {
            //default
            $this->template = "Wellcome.php";
        }

        $modelPath = ROOT . "/Model/" . $modelName. ".php";

        if(!empty($modelName) && file_exists($modelPath)){
            $useModel = 'Model\\' . $modelName;

            $this->model = new $useModel();
        }
    }

    /**
     * Default show index page
     * @return string
     */
    public function indexAction() {
        return $this->render();
    }

    /**
     * Render data
     * @param array $data
     * @return string
     */
    protected function render(array $data = array()){
        if(!file_exists(ROOT . "/View/" . $this->template)){
            throw new \Exception("Error view file!");
        }

        ob_start();
        include (ROOT . "/View/" . $this->template);
        $content = ob_get_clean();

        return $content;
    }
}