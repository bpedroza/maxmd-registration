<?php

namespace Endeavors\MaxMD\Registration\Tests;

use Endeavors\MaxMD\Api\Auth\MaxMD;
use Endeavors\MaxMD\Registration\Person\Registration;

class AddressByUsernameTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        MaxMD::Login(env("MAXMD_APIUSERNAME"),env("MAXMD_APIPASSWORD"));

        parent::setUp();
    }
    
    /**
     * 
     */
    public function testGettingStatusOfProvisionedUser()
    {
        $provision = new Registration();
        // freddie was provisioned in an earlier test
        $provision->GetPatientAddressByUserName("healthendeavors.direct.eval.md", "freddie");

        $this->assertTrue($provision->Status() === "activated");

        $this->assertEquals($provision->DirectAddress(), "freddie@healthendeavors.direct.eval.md");
    }

    /**
     * 
     */
    public function testGettingStatusOfUnprovisionedUser()
    {
        $provision = new Registration();
        // freddies was not provisioned in an earlier test
        $provision->GetPatientAddressByUserName("healthendeavors.direct.eval.md", "freddies");

        $this->assertFalse($provision->Status());

        $this->assertNull($provision->DirectAddress());
    }

    /**
     * 
     */
    public function testGettingUsernameOfProvisionedUser()
    {
        $provision = new Registration();
        // freddie was provisioned in an earlier test
        $provision->GetPatientAddressByUserName("healthendeavors.direct.eval.md", "freddie");

        $this->assertEquals($provision->Username(), "freddie");

        $this->assertEquals($provision->DirectAddress(), "freddie@healthendeavors.direct.eval.md");
    }

    /**
     * 
     */
    public function testGettingUsernameOfUnprovisionedUser()
    {
        $provision = new Registration();
        // freddies was not provisioned in an earlier test
        $provision->GetPatientAddressByUserName("healthendeavors.direct.eval.md", "freddies");

        $this->assertNull($provision->Username());

        $this->assertNull($provision->DirectAddress());
    }
}