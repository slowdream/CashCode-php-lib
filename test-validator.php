<?php

//stty 9600 cs8 -parity -parenb -cstopb -istrip -ixon -crtscts clocal -F /dev/ttyS2


// https://habrahabr.ru/conversations/ThreeDHead/
require_once("consts.php");

set_time_limit(5);

$data = array("result"=>0, "result_text"=>"", "error"=>0, "error_text"=>"");

$ValidatorHandle = null;

function ValidatorOpen()
{
	global $ValidatorHandle;
	return $ValidatorHandle = fopen("/dev/ttyS0", "r+");
}

function ValidatorClose()
{
	global $ValidatorHandle;
	if ($ValidatorHandle) {fclose($ValidatorHandle);}
}

function ValidatorSendACK()
{
	global $ValidatorHandle, $BillToBill_CMD;
	if ($ValidatorHandle) {fwrite($ValidatorHandle, $BillToBill_CMD["ACK"]);}
}

function ErrorHandler($errno, $errstr, $errfile, $errline)
{
	$data["error_text"] = $errstr;
	return false;
}

function ExecuteCommand($Command, &$CommandResult, $Waiting = true)
{
	$CommandResult = null;
	global $ValidatorHandle;
	if ($ValidatorHandle)
	{
		fwrite($ValidatorHandle, $Command);
		if (!$Waiting) {
			return;
		}
		$result = null;
		$cur_time = time();
		$expire_time = mktime(date("H", $cur_time), date("i", $cur_time), date("s", $cur_time) + 5, date("m", $cur_time), date("d", $cur_time), date("Y", $cur_time));
		while (time() < $expire_time)
		{
			$result .= fread($ValidatorHandle, 255);
			if (($result) && (ord($result[2]) > 0) && (strlen($result) >= ord($result[2])))
			{
				$CommandResult = $result;
				break;
			}
			else
			{usleep(50 * 1000);}
		}
	}
	if ($CommandResult)
	{return true;}
	else
	{return false;}
}

set_error_handler("ErrorHandler", E_ALL & ~E_NOTICE);

$Repeat = true;
while ($Repeat) {
	$Repeat = false;
	if (ValidatorOpen())
	{
		echo "Reset...";
		if (((ExecuteCommand($BillToBill_CMD["Reset"], $CommandResult)) && (ord($CommandResult[3]) == 0)) ||
			((ExecuteCommand($BillToBill_CMD["Reset"], $CommandResult)) && (ord($CommandResult[3]) == 0)))
		{
			echo "ok\n";
			echo "Enable Bill Types...";
			if ((ExecuteCommand($BillToBill_CMD["EnableBillTypes"], $CommandResult)) && (ord($CommandResult[3]) == 0))
			{
				echo "ok\n";
				$LastCode = null;
				while (!$Repeat)
				{
					if (ExecuteCommand($BillToBill_CMD["Poll"], $CommandResult))
					{
						ValidatorSendACK();
						$Code = ord($CommandResult[3]);

						if ($Code != 0)
						{
							if ($Code == $LastCode)
							{echo ".";}                              
							else
							{
								$LastCode = $Code;
								$ExtendedCode = ord($CommandResult[4]);
								echo "\n".dechex($Code)."H ".$BillToBill_Code[$Code];
								if ($BillToBill_ExtendedCode[$Code][$ExtendedCode] != "") {
									echo " [".$BillToBill_ExtendedCode[$Code][$ExtendedCode]."]";
								}
								switch ($Code)
								{
									case 0x43:
									case 0x44:
									case 0x47:
									case 0x48:
										$Repeat = true;
										break;
									case 0x80:
										ExecuteCommand($BillToBill_CMD["Stack"], $CommandResult);
										break;
									case 0x81:
										echo " *BILLING MONEY* [$ExtendedCode]";
									break;
								}
							}
						}
					}
					usleep(300 * 1000);
				}
			}
			else
			{echo "Failed to set bill types!";}
		}
		else
		{echo "Failed to reset!";}
		echo "\n";
		ValidatorClose();
	}
	else
	{echo "ERROR: Validator is not opened!";}
	if ($Repeat) {sleep(1);}
}
