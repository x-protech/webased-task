<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<x-app-layout title="Companies">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Update Employee
        </h2>

        <form method="POST" action="/employees/{{ $employee->id }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">First Name</label>
                <input class="form-control" type="text" placeholder="any" value="{{ $employee->first_name }}" name="name" id="name" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">Last Name</label>
                <input class="form-control" type="text" placeholder="any" value="{{ $employee->last_name }}" name="name" id="name" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                <input class="form-control" type="text" placeholder="any" value="{{ $employee->company->name }}" name="name" id="name" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">Phone Number</label>
                <input class="form-control" type="text" placeholder="any" value="{{ $employee->phone_number }}" name="name" id="name" aria-label="default input example">
            </div>
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" value="{{ $employee->email }}" name="email" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
