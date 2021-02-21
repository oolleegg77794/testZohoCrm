<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use zcrmsdk\crm\crud\ZCRMJunctionRecord;
use zcrmsdk\crm\crud\ZCRMModule;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;
use zcrmsdk\oauth\ZohoOAuthClient;
use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\crud\ZCRMInventoryLineItem;
use zcrmsdk\crm\crud\ZCRMTax;

class ZohoController extends Controller
{
    public function index()
    {
        $this->auth();

        $deals = ZCRMModule::getInstance("Accounts");
        $dealsRecords = $deals->getRecords();
        $getAllDeals = $dealsRecords->getData();

        return view('index')->with("data",$getAllDeals);
    }

    public function getRecords()
    {
        $this->auth();

        $deals = ZCRMModule::getInstance("Deals");
        $dealsRecords = $deals->getRecords();
        $getAllDeals = $dealsRecords->getData();
        dd($getAllDeals);
    }

    public function createRecord(Request $request)
    {
        $this->auth();

        $dealsModule = ZCRMRestClient::getInstance()->getModuleInstance("Deals");
        $dealsRecord = ZCRMRecord::getInstance("Deals",null);

        $dealsRecord->setFieldValue("Deal_Name",$request->input('name'));
        $dealsRecord->setFieldValue("Account_Name",$request->input('account_name'));
        $dealsRecord->setFieldValue("Description",$request->input('description'));
        $dealsRecord->setFieldValue("Amount",$request->input('amount'));

        $info = $dealsModule->createRecords([$dealsRecord]);
        $entityId = $info->getData()[0]->getEntityId();

        $this->createTask($entityId, $request->input('se_module'));

    }

    private function auth()
    {
        $configuration = array(
            "client_id" => "1000.69R0VXMEQAEAMTQYDQRW88I97204LS",
            "client_secret" => "0c78fffe409da45f3a4a8472bd3cf25ca2c70859a0",
            "redirect_uri" => "http://test.zoho/saveLead",
            "currentUserEmail" => "only4kvideos@gmail.com",
            "db_port" => "3306",
            "db_username" => "root",
            "db_password" => "root",
            "host_address" => "localhost"
        );

        ZCRMRestClient::initialize($configuration);

        $oAuthClient = ZohoOAuth::getClientInstance();
        $refreshToken = "1000.cb6f7eddbe2ee44a7dca6697b87bd5a7.a9ee2cbb80bd05df0e1a2d58404cd545";
        $userIdentifier = "only4kvideos@gmail.com";
        $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$userIdentifier);

    }

    private function createTask($entityId, $se_module="Email")
    {
        $tasksModule = ZCRMRestClient::getInstance()->getModuleInstance("Tasks");
        $tasksRecord = ZCRMRecord::getInstance("Tasks",null);
        $tasksRecord->setFieldValue("Subject",$se_module);
        $tasksRecord->setFieldValue("What_Id",$entityId);
        $tasksRecord->setFieldValue("se_module","Deals");

        $tasksModule->createRecords([$tasksRecord]);
    }


}




