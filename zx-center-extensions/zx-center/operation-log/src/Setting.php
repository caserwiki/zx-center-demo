<?php

namespace Zx\Admin\OperationLog;

use Zx\Admin\Extend\Setting as Form;
use Zx\Admin\OperationLog\Models\OperationLog;
use Zx\Admin\Support\Helper;

class Setting extends Form
{
    public function title()
    {
        return $this->trans('log.title');
    }

    protected function formatInput(array $input)
    {
        $input['except'] = Helper::array($input['except']);
        $input['allowed_methods'] = Helper::array($input['allowed_methods']);

        return $input;
    }

    public function form()
    {
        $this->tags('except');
        $this->multipleSelect('allowed_methods')
            ->options(array_combine(OperationLog::$methods, OperationLog::$methods));
        $this->tags('secret_fields');
    }
}
