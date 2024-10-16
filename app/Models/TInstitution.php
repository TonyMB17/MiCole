<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\TDistrict;
use App\Models\TWater;
use App\Models\TInstitutionTUser;

class TInstitution extends Model
{
	protected $table='tinstitution';
	protected $primaryKey='idInstitution';
	protected $keyType='string';
	public $incrementing=false;
	public $timestamps=true;

	public function tDistrict()
	{
		return $this->belongsTo(TDistrict::class, 'idDistrict');
	}

	public function tInstitutionTUser()
	{
		return $this->hasMany(TInstitutionTUser::class, 'idInstitution');
	}

	public function tWater()
	{
		return $this->hasMany(TWater::class, 'idInstitution');
	}
}
?>