<?php
/**
 * Judex: Validator
 * Copyright (c) NewClass (http://newclass.pl)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the file LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) NewClass (http://newclass.pl)
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


namespace Test\Judex;


use Judex\Result;
use Judex\Validator\PhoneNumberValidator;

/**
 * Class PhoneNumberValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class PhoneNumberValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateSuccess(){
        $validator=new PhoneNumberValidator();
        $resultMock=$this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate('123123123',$resultMock);

    }

    /**
     *
     */
    public function testValidateFail(){
        $errorMessage=['Value is not valid format phone number 000000000.'];
        $validator=new PhoneNumberValidator();

        $result=new Result();
        $validator->validate('12332112',$result);

        $this->assertEquals($errorMessage,$result->getErrors());

        $result=new Result();
        $validator->validate('text',$result);

        $this->assertEquals($errorMessage,$result->getErrors());

        $result=new Result();
        $validator->validate(null,$result);

        $this->assertEquals($errorMessage,$result->getErrors());

        $result=new Result();
        $validator->validate('',$result);

        $this->assertEquals($errorMessage,$result->getErrors());

    }

    /**
     *
     */
    public function testCustomMessage(){
        $validator=new PhoneNumberValidator(['message'=>'Custom message.']);
        $result=new Result();

        $validator->validate(null,$result);

        $this->assertEquals(['Custom message.'],$result->getErrors());
    }

}