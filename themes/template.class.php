<?php

class Template {

    private $temp = null;
    private $params = array();
	
    public function _setParams($key, $value) {
        @$this->params[$key] .= $value;
    }

    private function _filterParams($str) {
        foreach($this->params as $key => $value) {
            $str = str_ireplace('{'.$key.'}', $value, $str);
        }
        return $str;
    }

    public function _getTemplateFile($templateStyle, $file) {		
        ob_start();
        require_once($templateStyle . '/' .$file.'.tpl');
        $this->temp .= ob_get_contents();
        ob_end_clean();
        $this->outputPage();
    }

    public function outputPage() {
        echo @$this->_filterParams($this->temp);
        unset($this->temp);
    }

    public function getOutputPage($templateStyle, $file) {
        $fileContents = file_get_contents($templateStyle . '/' .$file.'.tpl', true);
        return @$this->_filterParams($fileContents);
    }

}