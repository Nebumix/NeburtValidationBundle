<?php

namespace Nebumix\rtValidationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\Iban;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

class CheckController extends Controller
{
	public function checkFieldAction(Request $request)
	{
		$value  = $request->request->get('item');
		$name  = $request->request->get('name');
		$nameForm  = $request->request->get('nameForm');

		foreach($this->container->getParameter($nameForm)[$name] as $key => $val){
			$name_function = $key."Action";
			$error = $this->$name_function($name, $value, $nameForm);
			if( count($error) > 0 ){
				return new Response($error[0]->getMessage());
			}
		}

		return new Response('1');
	}	

	protected function NotBlankAction($name, $value, $nameForm)
	{
	    $itemConstraint = new NotBlank($this->container->getParameter($nameForm)[$name]['NotBlank']);

	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function RegexAction($name, $value, $nameForm)
	{
		$itemConstraint = new Regex($this->container->getParameter($nameForm)[$name]['Regex']);
	    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function LengthAction($name, $value, $nameForm)
	{
		$itemConstraint = new Length($this->container->getParameter($nameForm)[$name]['Length']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}	

	protected function IpAction($name, $value, $nameForm)
	{
		$itemConstraint = new Ip($this->container->getParameter($nameForm)[$name]['Ip']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}		

	protected function IbanAction($name, $value, $nameForm)
	{
		$itemConstraint = new Iban($this->container->getParameter($nameForm)[$name]['Iban']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}			

	protected function DateAction($name, $value, $nameForm)
	{
		$itemConstraint = new Date($this->container->getParameter($nameForm)[$name]['Date']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}		
}