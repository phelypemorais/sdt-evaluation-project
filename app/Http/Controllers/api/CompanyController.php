<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Contracts\CompanyModelInterface as Model;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompanyRequest;


//use App\Http\Requests\StoreUpdateCompanyRequest;



class CompanyController extends Controller
{
        protected $company;

        public function __construct(Model $company)
        {
            $this->company = $company;

        }

        public function index()
        {

            return response()->json($this->company->getAllCompanies(), 200);

        }

        public function create(StoreUpdateCompanyRequest $request)
        {

            $this->company->createCompanies($request->all());
            return response()
            ->json([
                'success' => 'Empresa criada com sucesso!'
            ]);
        }

        public function find(string $id)
        {

             return response()->json($this->company->GetByIdCompanies($id),200);
        }

        public function update(string $id , StoreUpdateCompanyRequest $request)
        {
             $this->company->updateCompanies($id , $request->all());

             return response()->json([
                    'success' => 'Empresa atualizada com sucesso!'
             ]);
        }

        public function destroy(String $id)
        {
             $this->company->deleteCompanies($id);

             return response()->json([
                'success' => 'Empresa excluída com sucesso!'
             ]);
        }
    }

