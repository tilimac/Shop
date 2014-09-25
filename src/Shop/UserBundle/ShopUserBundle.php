<?php

namespace Shop\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ShopUserBundle extends Bundle {
    public function getParent() {
        return 'FOSUserBundle';
    }
}
