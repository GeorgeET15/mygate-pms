<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyModel;

class Report extends BaseController
{
    public function cashflow()
    {
        $propertyModel = new PropertyModel();
        $data = [
            'title'      => 'Cashflow Report',
            'properties' => $propertyModel->findAll()
        ];
        return view('admin/report/cashflow', $data);
    }

    public function graphical()
    {
        $propertyModel = new PropertyModel();
        $data = [
            'title'      => 'Graphical Report',
            'properties' => $propertyModel->findAll()
        ];
        return view('admin/report/graphical', $data);
    }
}
