<?php

namespace Kodify\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KodifyUserBundle extends Bundle
{
    public function getParent() {
        return ('FOSUserBundle');
    }
}
