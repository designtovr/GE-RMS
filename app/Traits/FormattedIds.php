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
		return $this->FormatId($id, FormatType::RC);
	}

	public function FormatRMAId($id)
	{
		return $this->FormatId($id, FormatType::RMA);
	}

	public function FormatPvId($id)
	{
		return $this->FormatId($id, FormatType::R);
	}
}

abstract class FormatType
{
	public const R = 'R';
    public const RC = 'RC';
    public const RMA = 'RMA';
}