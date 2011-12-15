<?php
	error_reporting(E_ALL);
	
	include_once("class/class.options.php");
	include_once("class/form/class.form.php");
	
	include_once("class/Smarty/libs/Smarty.class.php");
	
	$form = new form("text_from");
	
	include("class/form/element.php");
	
	$form->addElement(new element_textbox(_("Odometer"),"odometer",new elementOptions(array(
		"validation"	=> array(
			new validation_numeric(),
			new validation_required()
		),
		"description"	=> _("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula congue consequat.")
	))));
	

	/*$form->addElement(new element_select(_("Vehiculos"),"id_vehicle",array_index_values($vehicles,"id_vehicle","name_complete"),new elementOptions(array(
		"value"	=> 2	
	))));
	
	
	$form->addElement(new element_radio(_("Vehiculos"),"id_vehicle2",array_index_values($vehicles,"id_vehicle","name_complete"),new elementOptions(array(
		"value"	=> 2	
	))));
	
	*/
	
	$form->addElement(new element_textarea(_("Comenarios"),"Comments",new elementOptions(array(
		"value"	=> "Mis comentarios",
		"modifiers" => new modifier_striptags()
	))));
	
	$form->addElement(new element_password(_("Password"),"Pass",new elementOptions(array(
		"description"	=> "Add your password"	
	))));
	
	$form->addElement(new element_password(_("Password repeat"),"Pass_repeat",new elementOptions(array(
		"description"	=> "Add your password",
		"validation"	=> array(new validation_equal("Pass"))
	))));
	
	$form->addElement(new element_email(_("Email"),"email",new elementOptions(array(		
		//"validation"	=> new validation_equal("pass")
	))));
	
	$form->addElement(new element_email(_("Email"),"email2",new elementOptions(array(		
		"validation"	=> array(new validation_equal("email"))
	))));
	
	
	if ($form->isValid()) {
		$res=$form->getResults();
		echo "<h4>Results</h4>";
		print_r($res);
		
	} else {
		
		echo $form->render();
		
		//$objCSS->add("class/form/themes/default/form.css");
	
		
		
	}
	
	
?>