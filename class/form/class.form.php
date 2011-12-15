<?php
/**
 * OpForm
 * 
 * OpForm permite crear formularios de forma sencilla, potente, robusto, seguro, y extensible
 *
 * @author Sergio Carracedo Martinez <info@sergiocarracedo.es>
 * @version 1.0
 * @package OpForm
 */



/**
 * Autoload
 * Carga las clases del paquete OpForm  
 * @param string $class nombre de la clase a cargar
 */

function form_autoload($class) {
	$file = dirname(__FILE__) . "/" . str_replace("_", DIRECTORY_SEPARATOR, $class) . ".php";
	if(is_file($file)) {
		include_once $file;
	}
}
spl_autoload_register("form_autoload");



/**
 * Clase principal Form
 * Gestionar el funcionamiento del formulario y permite configurar su funcionamiento
 * @package OpForm 
 */
class form  {
	private $elements = array();
	protected $theme_path="";
	protected $attributes= array();
	private $action="";
	private $method="post";
	private $enctype="multipart/form-data";
	protected $name = null;
	protected $sign = null;
	
	
	/**
     * Constructor
     * @param string $name Nombre del formulario, si no se especifica se crea uno mediante un hash en base a los elementos del formulario 
     */	
	public function __construct($name=null) {			
		$this->name = $name;
		$this->setTheme(dirname(__FILE__)."/themes/default");						
	}
	
	
	/**
     * Establece el tema a utilizar para la creación del formulario
     * @param string $theme_path ruta el tema     
     */
	public function setTheme($theme_path) {
		if (is_dir($theme_path)) {
			$this->theme_path=$theme_path;			
		} else {
			throw Exception("Invalid Theme Path: ".$theme_path);
		}
	}
	
	
	/**
     * Recupera el nombre del formulario
     * @return string Nombre del formulario
     */
	protected function getName() {
		if (!isset($this->name)) {
			$this->name="form_".$this->getSign();
		}
		
		return $this->name;
	}
	
	/**
     * Recupera la firma (sha1) del formulario
     * @return string Firma del formulario
     */
	protected function getSign() {
		if (!isset($this->sign)) {
			$this->sign=sha1(serialize($this->elements));
		}
		
		return $this->sign;
	}
	
	/**
     * Devuelve un Array de los ficheros CSS usados por la clase
     * @return array Ruta a los ficheros CSS
     */
	public function getCSSFiles() {
		$file=$this->theme_path."/form.css";			
		return array($file);
	}
	
	/* TO-DO */
	/**
     * Devuelve un Array de los ficheros JS usados por la clase
     * @return array Ruta a los ficheros JS
     */
	public function getJSFiles() {			
		return array();
	}
	
	
	
	/**
     * Añade un elemento al formulario
     * @param Element $element Objeto Elemento
     */
	public function addElement($element) {
		
		$name = $element->getName();
		
		if (isset($this->elements[$name])) {
			throw new Exception("Element $name already exists.");
		}
		
		$element->setMethod($this->method);
		$this->elements[$name]=$element;
	}

	
	
	/**
     * Comprueba si el formulario se envió. Para hacerlo se usa un campo Hidden. 
     * @return Boolean Verdadero si el formulario fue enviado
     */
	protected function wasSent() {
		$method=strtolower($this->method);
		
		if ($method=="post") {
			$value=isset($_POST[$this->getName()]) ? $_POST[$this->getName()] : null;
		} else {
			$value=isset($_GET[$this->getName()]) ? $_GET[$this->getName()] : null;
		}
		
		if ((isset($value)) && ($value==$this->getSign())) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	/**
     * Comprueba si el formulario esta correctamente completado y todos los valores de los elementos son válidos
     * @return Boolean Verdadero si el formulario es válido
     */
	public function isValid() {			
		$valid = true;
		
		if ($this->wasSent()) {
			foreach($this->elements as $element) {		
				if (!$element->isValid(&$this->elements)) {
					$valid=false;
				}
			}
		} else {
			$valid = false;
		}
		
		return $valid;
	}
	
	/**
     * Recupera los resultados finales procesados del formulario
     * @return Array Elementos
     */
	public function getResults() {
		$method=strtolower($this->method);
		
		$result=array();
		
		foreach($this->elements as $element) {				
			$result[$element->getName()]=$element->getValue($method);
		}
		
		return $result;
	}
	
			
	/**
     * Elimina las comillas dobles y simples
     * @param string $str
     * @return string Cadena filtrada
     */
	protected function filter($str) {
		return htmlentities($str, ENT_QUOTES);
	}

	
	/**
     * Elimina las comillas dobles y simples
     * @param string $str
     * @return string Cadena filtrada
     */
	public function getAttributes($ignore = "") {
        $string = "";
        if(!is_array($ignore)) {
            $ignore = array($ignore);
        }
        $attributes = array_diff(array_keys($this->attributes), $ignore);
        foreach($attributes as $attribute)
            $string .= ' ' . $attribute . '="' . $this->filter($this->attributes[$attribute]) . '"';
        return $string;
    }
	
    
    /**
     * Devuelve un array de los objetos de la clase Elements
     * @return Array Objeto Clase Elements
     */
	protected function getElements() {
		return $this->elements;
	}
	
	 /**
     * Crea la salida XHTML del formulario. Usa como motor de plantillas Smarty
     * @param Boolean $print Si es Verdadero imprime el formulario directamente
     * @return string xhtml del formulario
     */
	public function render($print = false) {
		$smarty = new Smarty();
		$smarty->template_dir=$this->theme_path;
		$smarty->compile_dir="cache/t";
		
		//Form
		$form=array(
			"action" 	=> $this->action,
			"method"	=> $this->method,
			"enctype"	=> $this->enctype,
			"name"		=> $this->getName(),
			"sign"		=> $this->getSign()
		);
		
		
		$elementsObj = $this->getElements();
		$elements=array();
		
		foreach($elementsObj as $element) {
			$elements[]=$element->prepare();
		}

		$smarty->assign(array(
			"elements"		=> $elements,
			"form"			=> $form
		));
		
		
		$html=$smarty->fetch("form.tpl");
		
		if ($print) {
			echo $html;
		} 
		
		return $html;
		
	}
	
	
}
?>