<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;

class CompanyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::simplePaginate(10);

        // $companies = Company::all();

        // collect($paginated_companies->items())->map(function($company) {

        //     return [
        //         'id' => $company->id,
        //         'name' => $company->name,
        //         'email' => $company->email,
        //         'website' => $company->website,
        //         'logo' => $company->logo
        //     ];
        // });

        // return response()->json([
        //     'companies' => $companies,
        //     'next_page' => $paginated_companies->nextPageUrl(),
        //     'previous_page' => $paginated_companies->previousPageUrl(),
        // ], 200);

        return view('/companies', [
            'companies' => $companies
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:companies',
            'website' => 'required|URL|unique:companies',
            // 'logo' => 'required|image|mimes:jpg,jpeg,png'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $logo = Storage::disk('images')->put('', $request->logo);

        $data['logo'] = URL::asset("/img/".$logo);

        $company = Company::create($data);

        return redirect('companies');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('edit-company', [
            'company' => $company
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        if ($request->has('name')) {
            $company->name = $request->name;
        }

        if ($request->has('email') && $company->email != $request->email) {
            $company->email = $request->email;
        }

        if ($request->has('website') && $company->website != $request->website) {
            $company->website = $request->website;
        }

        if ($request->has('logo')) {

            $stored_logo = Storage::disk('images')->put('', $request->logo);

            $logo = URL::asset("/img/".$stored_logo);

            $company->logo = $logo;
        }

        if(!$company->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update',
                 422);
        }

        $company->updated_at = now();

        $company->save();

        $company->refresh();

        return redirect('companies');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect('companies');
    }
}
