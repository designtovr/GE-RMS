<?php 

namespace App\Traits;

trait Formattedids 
{
	private function FormatId($id, $type)
	{
		return $type.str_pad($id, 6, 0, STR_PAD_LEFT);
	}

	public function FormatReceiptId($id)
	{
		return FormatType::RC.str_pad($id, 5, 0, STR_PAD_LEFT);
	}

	public function FormatRMAId($id)
	{
		return $id;
	}

	public function FormatPvId($id)
	{
		return FormatType::R.str_pad($id, 5, 0, STR_PAD_LEFT);
	}
}

abstract class FormatType
{
	public const R = 'R';
    public const RC = 'RC';
    public const RMA = 'RMA';
}