<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ApplicationInfoModel;
use App\Models\EmployerInfoModel;
use App\Models\RentalHistoryModel;
use App\Models\GivingAnswerModel;
use App\Models\RentFormOtherModel;
use App\Models\PropertyModel;

class Application extends BaseController
{
    protected $appModel;

    public function __construct()
    {
        $this->appModel = new ApplicationInfoModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Rental Applications',
            'apps'  => $this->appModel
                        ->select('p_appinfo.*, property.property_name as prop_name')
                        ->join('property', 'property.property_id = p_appinfo.property_name', 'left')
                        ->findAll()
        ];

        return view('admin/application/index', $data);
    }

    public function list()
    {
        return $this->index();
    }

    public function create()
    {
        $propertyModel = new PropertyModel();
        if ($this->request->is('post')) {
            $data = $this->request->getPost();
            
            // 1. Save App Info
            $appData = [
                'property_name'     => $data['property_name'],
                'movein_date'       => $data['movein_date'],
                'full_name'         => $data['full_name'],
                'phone_number'      => $data['phone_number'],
                'email'             => $data['email'],
                'ssn'               => $data['ssn'] ?? '',
                'dob'               => $data['dob'] ?? '',
                'application_date'  => date('Y-m-d'),
                'rent_status'       => 0
            ];
            $appinfo_id = $this->appModel->insert($appData);

            if ($appinfo_id) {
                // 2. Save Employer Info
                $empModel = new EmployerInfoModel();
                $empModel->insert([
                    'appinfo_id'     => $appinfo_id,
                    'emp_name'       => $data['emp_name'],
                    'job_type'       => $data['job_type'],
                    'emp_address'    => $data['emp_address'],
                    'position'       => $data['position'],
                    'monthly_income' => $data['monthly_income']
                ]);

                // 3. Save Rental History
                $histModel = new RentalHistoryModel();
                $histModel->insert([
                    'appinfo_id'     => $appinfo_id,
                    'cur_address'    => $data['cur_address'],
                    'cur_renamnt'    => $data['cur_renamnt'],
                    'curlname'       => $data['curlname'],
                    'cur_resleaving' => $data['cur_resleaving']
                ]);

                // 4. Save Answers
                $ansModel = new GivingAnswerModel();
                $ansModel->insert([
                    'appinfo_id'        => $appinfo_id,
                    'dec_bankrupcy'     => $data['dec_bankrupcy'],
                    'evicted_residence' => $data['evicted_residence'],
                    'con_felony'        => $data['con_felony'],
                    'parole'            => $data['parole']
                ]);

                // 5. Save Other (References)
                $otherModel = new RentFormOtherModel();
                $otherModel->insert([
                    'appinfo_id'        => $appinfo_id,
                    'ref1_name'         => $data['ref1_name'],
                    'ref1phone'         => $data['ref1phone'],
                    'ref1relation'      => $data['ref1relation'],
                    'emrcontactname'    => $data['emrcontactname'],
                    'emr_contactnumber' => $data['emr_contactnumber'],
                    'emr_contactrel'    => $data['emr_contactrel']
                ]);

                return redirect()->to('/admin/application')->with('success', 'Application submitted successfully.');
            }
        }

        return view('admin/application/create', [
            'title'      => 'Submit Application',
            'properties' => $propertyModel->findAll()
        ]);
    }
}
