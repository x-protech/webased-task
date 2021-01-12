<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<x-app-layout title="Emplyees">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Add new Employee
        </h2>

        <form method="POST" action="/employees" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <input class="form-control" type="text" placeholder="Default input" name="first_name" id="first_name" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <input class="form-control" type="text" placeholder="Default input" name="last_name" id="last_name" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                <input class="form-control" type="text" placeholder="Default input" name="phone_number" id="phone_number" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                <input class="form-control" type="text" placeholder="Default input" name="name" id="name" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
