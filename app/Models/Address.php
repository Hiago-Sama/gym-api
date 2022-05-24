<?php

declare(strict_types=1);

namespace App\Models;

class Address extends BaseModel
{
    protected $primaryKey = "uid_address";
    protected $table = 'address';

    protected $fillable = [
        "zip_code",
        "street",
        "city",
        "district",
        "number",
        "uf"
    ];

    public function people()
    {
        return $this->belongsTo(People::class, 'uid_address');
    }

    public function academyTraining()
    {
        return $this->belongsTo(AcademyTraining::class, 'uid_address');
    }
}
