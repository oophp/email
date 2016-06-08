<?php

namespace OOPHP\Email;

interface HeaderInterface
{
    public function getName();

    public function getValue();

    public function __toString();
}
