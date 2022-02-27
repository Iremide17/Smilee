<?php

namespace App\Contracts;

interface UpdatesVendorProfileInformation
{
    public function update($vendor, array $input);
}
