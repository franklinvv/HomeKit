<?php

declare(strict_types=1);

include_once __DIR__ . '/HomeKitBaseTest.php';

class HomeKitSpeakerTest extends HomeKitBaseTest
{
    public function testAccessory(): void
    {
        $bridgeID = IPS_CreateInstance($this->bridgeModuleID);

        $mid = IPS_CreateVariable(0 /* Boolean */);

        IPS_SetVariableCustomAction($mid, 10001); //Any valid ID will do

        $vid = IPS_CreateVariable(1 /* Integer */);

        //Currently stubs do not provide default profiles
        if (!IPS_VariableProfileExists('~Intensity.100')) {
            IPS_CreateVariableProfile('~Intensity.100', 1 /* Integer */);
            IPS_SetVariableProfileValues('~Intensity.100', 0, 100, 1);
        }

        IPS_SetVariableCustomProfile($vid, '~Intensity.100'); //Any valid profile will do
        IPS_SetVariableCustomAction($vid, 10001); //Any valid ID will do

        IPS_SetProperty($bridgeID, 'AccessorySpeaker', json_encode([
            [
                'ID'         => 2,
                'Name'       => 'Test Speaker',
                'MuteID'     => $mid,
                'VolumeID'   => $vid
            ]
        ]));
        IPS_ApplyChanges($bridgeID);

        $bridgeInterface = IPS\InstanceManager::getInstanceInterface($bridgeID);

        $base = json_decode(file_get_contents(__DIR__ . '/exports/None.json'), true);
        $accessory = json_decode(file_get_contents(__DIR__ . '/exports/Speaker.json'), true);

        //Check if the generated content matches our test file
        $this->assertEquals(array_merge($base, $accessory), $bridgeInterface->DebugAccessories());
    }

    public function testAccessoryBroken(): void
    {
        $bridgeID = IPS_CreateInstance($this->bridgeModuleID);

        $mid = IPS_CreateVariable(0 /* Boolean */);

        $vid = IPS_CreateVariable(1 /* Integer */);

        IPS_SetProperty($bridgeID, 'AccessorySpeaker', json_encode([
            [
                'ID'         => 2,
                'Name'       => 'Test Speaker',
                'MuteID'     => $mid, /* The profile/action is missing */
                'VolumeID'   => $vid /* The profile/action is missing */
            ],
        ]));
        IPS_ApplyChanges($bridgeID);

        $bridgeInterface = IPS\InstanceManager::getInstanceInterface($bridgeID);

        //Check if the generated content matches our test file
        $this->assertEquals(json_decode(file_get_contents(__DIR__ . '/exports/None.json'), true), $bridgeInterface->DebugAccessories());
    }
}
