<?php

namespace Nebumix\rtValidationBundle\Controller;

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
use Symfony\Component\Validator\Constraints\CardScheme;
use Symfony\Component\Validator\Constraints\Currency;
use Symfony\Component\Validator\Constraints\Luhn;
use Symfony\Component\Validator\Constraints\Iban;
use Symfony\Component\Validator\Constraints\Isbn;
use Symfony\Component\Validator\Constraints\Issn;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAware;

class CheckController extends ContainerAware
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function checkFieldAction(Request $request)
    {
        $value  = $request->request->get('item');
        $name  = $request->request->get('name');
        $nameForm  = $request->request->get('nameForm');

        if (!isset($this->container->getParameter($nameForm)[$name])) {
            return new Response('Error, You have wrong variable names in the configuration file or in the javascript function.');
        }

        foreach ($this->container->getParameter($nameForm)[$name] as $key => $val) {
            $name_function = $key."Action";
            $error = $this->$name_function($name, $value, $nameForm);
            if (count($error) > 0) {
                return new Response($error[0]->getMessage());
            }
        }

        return new Response('1');
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function NotBlankAction($name, $value, $nameForm)
    {
        $itemConstraint = new NotBlank($this->container->getParameter($nameForm)[$name]['NotBlank']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function BlankAction($name, $value, $nameForm)
    {
        $itemConstraint = new Blank($this->container->getParameter($nameForm)[$name]['Blank']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function NotNullAction($name, $value, $nameForm)
    {
        $itemConstraint = new NotNull($this->container->getParameter($nameForm)[$name]['NotNull']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function NullAction($name, $value, $nameForm)
    {
        $itemConstraint = new Null($this->container->getParameter($nameForm)[$name]['Null']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function TypeAction($name, $value, $nameForm)
    {
        $itemConstraint = new Type($this->container->getParameter($nameForm)[$name]['Type']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function LengthAction($name, $value, $nameForm)
    {
        $itemConstraint = new Length($this->container->getParameter($nameForm)[$name]['Length']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function UrlAction($name, $value, $nameForm)
    {
        $itemConstraint = new Url($this->container->getParameter($nameForm)[$name]['Url']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function RegexAction($name, $value, $nameForm)
    {
        $itemConstraint = new Regex($this->container->getParameter($nameForm)[$name]['Regex']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function IpAction($name, $value, $nameForm)
    {
        $itemConstraint = new Ip($this->container->getParameter($nameForm)[$name]['Ip']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function UuidAction($name, $value, $nameForm)
    {
        $itemConstraint = new Uuid($this->container->getParameter($nameForm)[$name]['Uuid']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function EmailAction($name, $value, $nameForm)
    {
        $itemConstraint = new Email($this->container->getParameter($nameForm)[$name]['Email']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function RangeAction($name, $value, $nameForm)
    {
        $itemConstraint = new Range($this->container->getParameter($nameForm)[$name]['Range']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function EqualToAction($name, $value, $nameForm)
    {
        $itemConstraint = new EqualTo($this->container->getParameter($nameForm)[$name]['EqualTo']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function NotEqualToAction($name, $value, $nameForm)
    {
        $itemConstraint = new NotEqualTo($this->container->getParameter($nameForm)[$name]['NotEqualTo']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function IdenticalToAction($name, $value, $nameForm)
    {
        $itemConstraint = new IdenticalTo($this->container->getParameter($nameForm)[$name]['IdenticalTo']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function NotIdenticalToAction($name, $value, $nameForm)
    {
        $itemConstraint = new NotIdenticalTo($this->container->getParameter($nameForm)[$name]['NotIdenticalTo']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function LessThanAction($name, $value, $nameForm)
    {
        $itemConstraint = new LessThan($this->container->getParameter($nameForm)[$name]['LessThan']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function LessThanOrEqualAction($name, $value, $nameForm)
    {
        $itemConstraint = new LessThanOrEqual($this->container->getParameter($nameForm)[$name]['LessThanOrEqual']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function GreaterThanAction($name, $value, $nameForm)
    {
        $itemConstraint = new GreaterThan($this->container->getParameter($nameForm)[$name]['GreaterThan']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function GreaterThanOrEqualAction($name, $value, $nameForm)
    {
        $itemConstraint = new GreaterThanOrEqual($this->container->getParameter($nameForm)[$name]['GreaterThanOrEqual']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function DateAction($name, $value, $nameForm)
    {
        $itemConstraint = new Date($this->container->getParameter($nameForm)[$name]['Date']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function DateTimeAction($name, $value, $nameForm)
    {
        $itemConstraint = new DateTime($this->container->getParameter($nameForm)[$name]['DateTime']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function TimeAction($name, $value, $nameForm)
    {
        $itemConstraint = new Time($this->container->getParameter($nameForm)[$name]['Time']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function CardSchemeAction($name, $value, $nameForm)
    {
        $itemConstraint = new CardScheme($this->container->getParameter($nameForm)[$name]['CardScheme']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function CurrencyAction($name, $value, $nameForm)
    {
        $itemConstraint = new Currency($this->container->getParameter($nameForm)[$name]['Currency']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function LuhnAction($name, $value, $nameForm)
    {
        $itemConstraint = new Luhn($this->container->getParameter($nameForm)[$name]['Luhn']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function IbanAction($name, $value, $nameForm)
    {
        $itemConstraint = new Iban($this->container->getParameter($nameForm)[$name]['Iban']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function IsbnAction($name, $value, $nameForm)
    {
        $itemConstraint = new Isbn($this->container->getParameter($nameForm)[$name]['Isbn']);

        $errorList = $this->container->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }

    /**
     * @param $name
     * @param $value
     * @param $nameForm
     *
     * @return mixed
     */
    protected function IssnAction($name, $value, $nameForm)
    {
        $itemConstraint = new Issn($this->container->getParameter($nameForm)[$name]['Issn']);

        $errorList = $this->get('validator')->validateValue(
            $value,
            $itemConstraint
        );

        return $errorList;
    }
}
