<?php

namespace Nebumix\rtValidationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Null;
use Symfony\Component\Validator\Constraints\Type;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Constraints\Email;

use Symfony\Component\Validator\Constraints\Range;

use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\IdenticalTo;
use Symfony\Component\Validator\Constraints\NotIdenticalTo;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Time;



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

	protected function BlankAction($name, $value, $nameForm)
	{
	    $itemConstraint = new Blank($this->container->getParameter($nameForm)[$name]['Blank']);

	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function NotNullAction($name, $value, $nameForm)
	{
	    $itemConstraint = new NotNull($this->container->getParameter($nameForm)[$name]['NotNull']);

	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function NullAction($name, $value, $nameForm)
	{
	    $itemConstraint = new Null($this->container->getParameter($nameForm)[$name]['Null']);

	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function TypeAction($name, $value, $nameForm)
	{
	    $itemConstraint = new Type($this->container->getParameter($nameForm)[$name]['Type']);

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

	protected function UrlAction($name, $value, $nameForm)
	{
		$itemConstraint = new Url($this->container->getParameter($nameForm)[$name]['Url']);
			    
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

	protected function IpAction($name, $value, $nameForm)
	{
		$itemConstraint = new Ip($this->container->getParameter($nameForm)[$name]['Ip']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}		

	protected function UuidAction($name, $value, $nameForm)
	{
		$itemConstraint = new Uuid($this->container->getParameter($nameForm)[$name]['Uuid']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function EmailAction($name, $value, $nameForm)
	{
		$itemConstraint = new Email($this->container->getParameter($nameForm)[$name]['Email']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function RangeAction($name, $value, $nameForm)
	{
		$itemConstraint = new Range($this->container->getParameter($nameForm)[$name]['Range']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}
	
	protected function EqualToAction($name, $value, $nameForm)
	{
		$itemConstraint = new EqualTo($this->container->getParameter($nameForm)[$name]['EqualTo']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}
	
	protected function NotEqualToAction($name, $value, $nameForm)
	{
		$itemConstraint = new NotEqualTo($this->container->getParameter($nameForm)[$name]['NotEqualTo']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function IdenticalToAction($name, $value, $nameForm)
	{
		$itemConstraint = new IdenticalTo($this->container->getParameter($nameForm)[$name]['IdenticalTo']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function NotIdenticalToAction($name, $value, $nameForm)
	{
		$itemConstraint = new NotIdenticalTo($this->container->getParameter($nameForm)[$name]['NotIdenticalTo']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}
	
	protected function LessThanAction($name, $value, $nameForm)
	{
		$itemConstraint = new LessThan($this->container->getParameter($nameForm)[$name]['LessThan']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}
	
	protected function LessThanOrEqualAction($name, $value, $nameForm)
	{
		$itemConstraint = new LessThanOrEqual($this->container->getParameter($nameForm)[$name]['LessThanOrEqual']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}
	
	protected function GreaterThanAction($name, $value, $nameForm)
	{
		$itemConstraint = new GreaterThan($this->container->getParameter($nameForm)[$name]['GreaterThan']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}

	protected function GreaterThanOrEqualAction($name, $value, $nameForm)
	{
		$itemConstraint = new GreaterThanOrEqual($this->container->getParameter($nameForm)[$name]['GreaterThanOrEqual']);
			    
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
	
	protected function DateTimeAction($name, $value, $nameForm)
	{
		$itemConstraint = new DateTime($this->container->getParameter($nameForm)[$name]['DateTime']);
			    
	    $errorList = $this->get('validator')->validateValue(
	        $value,
	        $itemConstraint
	    );

		return $errorList;
	}
	
	protected function TimeAction($name, $value, $nameForm)
	{
		$itemConstraint = new Time($this->container->getParameter($nameForm)[$name]['Time']);
			    
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

		
}
