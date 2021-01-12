<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<x-app-layout title="Companies">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Update Company
        </h2>

        <form method="POST" action="/companies/{{ $company->id }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                <input class="form-control" type="text" placeholder="any" value="{{ $company->name }}" name="name" id="name" aria-label="default input example">
            </div>
            <label for="website" class="form-label">Company Website</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">https://www.example.com</span>
              <input type="text" class="form-control" value="{{ $company->website }}" name="website" id="website" aria-describedby="basic-addon3">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Company Email</label>
                <input type="email" class="form-control" value="{{ $company->email }}" name="email" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input class="form-control" type="file" value="{{ $company->logo }}" name="logo" id="logo">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
