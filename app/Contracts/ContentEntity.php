<?php

namespace App\Contracts;

use DateTime;

interface ContentEntity
{
    public function getCreatedAt(): ?string;
    public function getCreaterName(): string;
    public function getUpdatedAt(): ?string;
    public function getUpdaterName(): string;
   
}
