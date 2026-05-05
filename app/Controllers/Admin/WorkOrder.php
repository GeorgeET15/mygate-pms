<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WorkOrderModel;
use App\Models\PropertyModel;

class WorkOrder extends BaseController
{
    protected $workOrderModel;

    public function __construct()
    {
        $this->workOrderModel = new WorkOrderModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Work Orders',
            'work_orders' => $this->workOrderModel
                                ->select('work_order.*, property.property_name')
                                ->join('property', 'property.property_id = work_order.PropertyId', 'left')
                                ->findAll()
        ];

        return view('admin/work_order/index', $data);
    }

    public function create()
    {
        $propertyModel = new PropertyModel();
        if ($this->request->is('post')) {
            if ($this->workOrderModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/workorder')->with('success', 'Created.');
            }
        }
        return view('admin/work_order/create', ['title' => 'Create', 'properties' => $propertyModel->findAll()]);
    }

    public function delete($id = null)
    {
        $this->workOrderModel->delete($id);
        return redirect()->to('/admin/workorder')->with('success', 'Deleted.');
    }
}
