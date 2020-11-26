<?php

namespace Totaa\TotaaBfo\Traits;

use Totaa\TotaaBfo\Models\BfoInfo;

trait HasBfoInfos
{
  public function bfo_info()
  {
    return $this->belongsTo(BfoInfo::class, 'info_mnv', 'mnv');
  }
}
