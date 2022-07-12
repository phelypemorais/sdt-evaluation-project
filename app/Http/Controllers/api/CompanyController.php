<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    
        protected $company;
        
        public function __construct(Company $company)
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
    
        public function find(Request $request)
        {
             
             return response()->json($this->company->GetByIdCompanies($request),200);
        }
    
        public function update(StoreUpdateCompanyRequest $request)
        {
             $this->company->updateCompanies($request->id,$request->all());
    
             return response()->json([
                    'success' => 'Empresa atualizada com sucesso!'                
             ]);
        }
    
        public function destroy(Request $request)
        {
             $this->company->deleteCompanies($request->id);
             
             return response()->json([
                'success' => 'Empresa excluída com sucesso!'
             ]);
        }
    }

