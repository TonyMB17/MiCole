<?php
namespace App\Export;

use Maatwebsite\Excel\Concerns\FromArray;

class DataExport implements FromArray
{
	private $data;
	
	public function __construct($data)
	{
		$this->data=$data;
	}

	public function array(): array
	{
		return $this->data;
	}
}
?>