<?php

$BillToBill_CMD = [
        "ACK" => pack("c*", 0x02, 0x03, 0x06, 0x00, 0xC2, 0x82),
        "Reset" => pack("c*", 0x02, 0x03, 0x06, 0x30, 0x41, 0xB3),
        "GetStatus" => pack("c*", 0x02, 0x03, 0x06, 0x31, 0xC8, 0xA2),
        "SetSecurity" => pack("c*", 0x02, 0x03, 0x06, 0x32, 0x53, 0x90),
        "Poll" => pack("c*", 0x02, 0x03, 0x06, 0x33, 0xDA, 0x81),
        "EnableBillTypes" => pack("c*", 0x02, 0x03, 0x0C, 0x34, 0xFF, 0xFF, 0xFF, 0x00, 0x00, 0x00, 0xB5, 0xC1),
        "EnableBillTypesEscrow" => pack("c*", 0x02, 0x03, 0x0C, 0x34, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFE, 0xF7),
        "DisableBillTypes" => pack("c*", 0x02, 0x03, 0x0C, 0x34, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x17, 0x0C),
        "Stack" => pack("c*", 0x02, 0x03, 0x06, 0x35, 0xEC, 0xE4),
        "Return" => pack("c*", 0x02, 0x03, 0x06, 0x36, 0x77, 0xD6),
        "Identification" => pack("c*", 0x02, 0x03, 0x06, 0x37, 0xFE, 0xC7),
        "Hold" => pack("c*", 0x02, 0x03, 0x06, 0x38, 0x09, 0x3F),
        "CassetteStatus" => pack("c*", 0x02, 0x03, 0x06, 0x3B, 0x92, 0x0D),
        "Dispense" => pack("c*", 0x02, 0x03, 0x06, 0x3C, 0x2D, 0x79),
        "Unload" => pack("c*", 0x02, 0x03, 0x06, 0x3D, 0xA4, 0x68),
        "EscrowCassetteStatus" => pack("c*", 0x02, 0x03, 0x06, 0x3E, 0x3F, 0x5A),
        "EscrowCassetteUnload" => pack("c*", 0x02, 0x03, 0x06, 0x3F, 0xB6, 0x4B),
        "SetCassetteType" => pack("c*", 0x02, 0x03, 0x06, 0x40, 0xC6, 0xC0),
        "GetBillTable" => pack("c*", 0x02, 0x03, 0x06, 0x41, 0x4F, 0xD1),
        "Download" => pack("c*", 0x02, 0x03, 0x06, 0x50, 0x47, 0xD0)
];

$BillToBill_Code = [
        0x10 => "Power Up",
        0x11 => "Power Bill",
        0x12 => "Power?",
        0x13 => "Initialize",
        0x14 => "Idling",
        0x15 => "Accepting",
        0x17 => "Stacking",
        0x18 => "Returning",
        0x19 => "Unit Disabled",
        0x1A => "Holding",
        0x1B => "Device Busy",
        0x1C => "Rejecting",
        0x1D => "Dispensing",
        0x1E => "Unloading",
        0x1F => "Custom returning",
        0x20 => "Recycling unloading",
        0x21 => "Setting cassette type",
        0x25 => "Dispensed",
        0x26 => "Unloaded",
        0x27 => "Custom bills returned",
        0x28 => "Recycling cassette unloaded",
        0x29 => "Set cassette type",
        0x30 => "Invalid command",
        0x41 => "Drop Cassette Full",
        0x42 => "Drop Cassette out of position",
        0x43 => "Bill Validator Jammed",
        0x44 => "Cassette Jammed",
        0x45 => "Cheated",
        0x46 => "Pause",
        0x47 => "Generic Failure codes",
        0x48 => "Bill-to-Bill unit Jammed",
        0x80 => "Escrow position",
        0x81 => "Bill stacked",
        0x82 => "Bill returned"
];

$BillToBill_ExtendedCode = [];

$BillToBill_ExtendedCode[0x1C] = [
        0x60 => "Rejecting due to Insertion",
        0x61 => "Rejecting due to Magnetic",
        0x62 => "Rejecting due to bill - Remaining in the head",
        0x63 => "Rejecting due to Multiplying",
        0x64 => "Rejecting due to Conveying",
        0x65 => "Rejecting due to Identification1",
        0x66 => "Rejecting due to Verification",
        0x67 => "Rejecting due to Optic",
        0x68 => "Rejecting due to Inhibit",
        0x69 => "Rejecting due to Capacity",
        0x6A => "Rejecting due to Operation",
        0x6C => "Rejecting due to Length"
];

$BillToBill_ExtendedCode[0x47] = [
        0x50 => "Stack Motor Failure",
        0x51 => "Transport Motor Speed Failure",
        0x52 => "Transport Motor Failure",
        0x53 => "Aligning Motor Failure",
        0x54 => "Initial Box Status Failure",
        0x55 => "Optic Canal Failure",
        0x56 => "Magnetic Canal Failure",
        0x57 => "Cassette 1 Motor Failure",
        0x58 => "Cassette 2 Motor Failure",
        0x59 => "Cassette 3 Motor Failure",
        0x5A => "Bill-to-Bill unit Transport Motor Failure",
        0x5B => "Switch Motor 1 Failure",
        0x5C => "Switch Motor 2 Failure",
        0x5D => "Dispenser Motor 1 Failure",
        0x5E => "Dispenser Motor 2 Failure",
        0x5F => "Capacitance Canal Failure",
        0x9B => "Новая ошибка"
];

$BillToBill_ExtendedCode[0x48] = [
        0x70 => "Bill Jammed in Cassette 1",
        0x71 => "Bill Jammed in Cassette 2",
        0x72 => "Bill Jammed in Cassette 3",
        0x73 => "Bill Jammed in Transport Path",
        0x74 => "Bill Jammed in Switch",
        0x75 => "Bill Jammed in Dispenser"
];

$BillToBill_ExtendedCode[0x81] = [
        0x00 => "100",
        0x01 => "200",
        0x02 => "500",
        0x03 => "1000",
        0x04 => "2000",
        0x05 => "5000"
];

global $BillToBill_CMD, $BillToBill_Code, $BillToBill_ExtendedCode;
