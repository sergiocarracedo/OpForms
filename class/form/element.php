<?php
/**
 * Clase base de Elemento de formulario
 * 
 *
 * @author Sergio Carracedo Martinez <info@sergiocarracedo.es>
 * @version 1.0
 * @package OpForm
 */



/**
 * Clase con las opciones de configuración del elemento  
 */
class elementOptions extends options {		
	public $description;
	public $validation=array();
	public $modifiers=array();
	public $value;
	public $attributes=array();
}


/**
 * Clase abstracta Elemento
 */
abstract class element {
	protected $reservedAttributes=array("class");
	protected $prefix="form_";
	protected $errors=array();
	protected $label;
	protected $name;
	protected $options;
	protected $description;
	protected $validation = array();
	protected $modifiers = array();
	protected $defaultValue;
	protected $attributes = array();
	protected $id;
	protected $template="input.tpl";
	protected $formMethod="post";
	
	
	/**
     * Constructor
     * @param string $label Etiqueta del elemento 
     * @param string $name Nombre del campo, debe ser único
     * @param elementOptions $properties Opciones de configuracion del elemento
     */	
	public function __construct($label, $name, elementOptions $properties = null) {
		$this->label=$label;
		$this->name=$name;
		
		if (!isset($properties)) {
			$properties = new elementOptions;
		}
		
		if (!is_array($properties->validation)) {
			$properties->validation = array($properties->validation);
		}
		
		if (!is_array($properties->modifiers)) {
			$properties->modifiers = array($properties->modifiers);
		}
		
		if (!is_array($properties->attributes)) {
			$properties->attributes = array($properties->attributes);
		}
		
		$this->description = $properties->description;
		$this->validation = array_merge($this->validation,$properties->validation);
		$this->modifiers = array_merge($this->modifiers,$properties->modifiers);
		$this->defaultValue = $properties->value;			
		$this->attributes = array_merge($this->attributes,$properties->attributes);
		
		$this->setPrefix($this->prefix);
		
		$this->attributes["id"]=$this->getId();
		
		$this->configure();
	}
	
	/**
     * Método que permite a las clases heredadas añadir opciones propias del tipo de elemento     
     */	
	protected function configure() {}
	
	
	/**
     * Permite establecer el prefijo que se aplica a los nombre de las variables HTML del formulario
     * @param string $prefix Prefijo de las variables HTML      
     */	
	public function setPrefix($prefix) {
		$this->prefix=$prefix;
		$this->id=$this->prefix.$this->name;
	}
	
	
	/**
     * Obtiene el nombre de la variable (con o sin prefijo)
     * @param Boolean $usePrefix Si es Verdadero devuelve el nombre de la varaible con prefijo     
     * @return string Nombre de la variable
     */	
	public function getName($usePrefix=false) {
		if ($usePrefix) {			
			return $this->prefix.$this->name;	
		} else {
			return $this->name;	
		}
	}
	
	/**
     * Obtiene la etiqueta del elemento
     * @return string Etiqueta del elemento
     */	
	public function getLabel() {
		return $this->label;			
	}
	
	
	/**
     * Revuelve el id del elemento
     * @return string Id del elemento     
     */	
	public function getId() {
		return $this->id;			
	}
	
	/**
     * Obtiene la errores (si los hay) que se han producido al validar el elemento
     * @return array Mensajes de error
     */	
	public function getErrors() {
		return $this->errors;
	}
	
	
	/**
     * Obtiene los mensajes de error en una sola cadena separada por saltos de linea
     * @return string Errores
     */	
	public function getErrorString() {
		return implode("<br />",$this->getErrors());
	}
	
	/**
     * Comprueba si el valor del elemento es correcto según los validadores
     * @return Boolean Etiqueta del elemento
     */	
	public function isValid(&$elements=null) {
		$valid = true;
		$value = $this->getValue($this->formMethod);							
		if(!empty($this->validation)) {
			$element = $this->name;

			foreach($this->validation as $validation) {					
				$validation->setFormElements($elements);
				
				if(!$validation->isValid($value)) {						
					$this->errors[] = str_replace("%element%", $element, $validation->getMessage());	
					$this->attributes["class"].=' error ';					
					$valid = false;
				}	
			}
		}
		
		return $valid;
	}
	
	/**
     * Indica a la clase el método a través del cual va a recibir el resultado de enviar el formulario
     * @param string Método (POST o GET)
     */	
	public function setMethod($method) {
		$this->formMethod=$method;
	}
	
	/**
     * Establece el valor inicial de elemento, el valor enviado por el formulario tiene prioridad sobre este valor
     * @param mixed Valor
     */	
	public function setValue($value) {			
		if (!is_array($value)) {
			$value= array($value);
		}
		$this->defaultValue = $value;
	}
	
	/**
     * Recuperar el valor de elemento enviado por el formulario en bruto (sin modificar)
     * @return mixed Valor del elemento
     */	
	public function getRawValue() {			
		if ($this->formMethod=="post") {
			$value=isset($_POST[$this->getName(true)]) ? $_POST[$this->getName(true)] : $this->defaultValue;
		} else {
			$value=isset($_GET[$this->getName(true)]) ? $_GET[$this->getName(true)] : $this->defaultValue;
		}
		
		return $value;
	}
	
	/**
     * Obtiene el valor del elemento enviado por el formulario despues de pasar los modificadores
     * @return mixed Valor del campo
     */	
	public function getValue() {			
		$value=$this->getRawValue();
		
		foreach ($this->modifiers as $modifier) {
			$value=$modifier->getModifiedValue($value);
		}
		
		return $value;
	}
	
	
	/**
     * Elimina las comillas simple/dobles de la cadena
     * @param string  cadena a limpiar
     * @return strng Cadena sin comillas
     */	
	/*This method prevents double/single quotes in html attributes from breaking the markup.*/
	protected function filter($str) {
		return htmlentities($str, ENT_QUOTES);
	}
	
	/*This method is used by the Form class and all Element classes to return a string of html
	attributes.  There is an ignore parameter that allows special attributes from being included.*/
	
	/**
     * Devuelve la cadena de los attributos HTML
     * @param mixed Cadena o Array con los attributos a ignorar en la creacion de la cadena
     * @return string Cadena con los atributos HTML
     */	
	public function getAttributes($ignore = "") {
        $string = "";
        
        if(!is_array($ignore)) {
            $ignore = array($ignore);
        }
       
        
        $attributes = array_diff(array_keys($this->attributes), $ignore);
        $attributes = array_diff($attributes,$this->reservedAttributes);
                
        
        foreach($attributes as $attribute) {
            $string .= ' ' . $attribute . '="' . $this->filter($this->attributes[$attribute]) . '"';
        }
        
        $result= array(
        	"render" => $string	        	
        );
        
        foreach ($this->attributes as $attribute_key => $attribute_value) {	        	
        	$result[$attribute_key]=$this->filter($attribute_value);
        }
        
        return $result;	                
    }
	
	
    /**
     * Devuelve en un array los datos necesarios por la clase FORM (metodo RENDER) para poder crear el campo
     * @return Array Variables
     */		
	public function prepare() {					
		$element=array(
			"template"		=> $this->template,
			"name" 			=> $this->getName(true),
			"id" 			=> $this->getName(),
			"value" 		=> $this->getRawValue(),
			"attributes"	=> $this->getAttributes(),
			"label"			=> $this->label,
			"description"	=> $this->description,
			"errorString"	=> $this->getErrorString(),
			"type"			=> str_replace("element_","",get_class($this))
		);
		
		return $element;
	}
	
}
	
?>	