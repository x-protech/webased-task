<x-app-layout title="Forms">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>
<div>

        <form action="/upload-image" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" />
            <input type="submit" value="upload" />
        </form>

</div>

<div>
    <img src="{{  URL::asset("/img/qvp2yQIDQ6cZRT3jk1vCyB3usjh65Kx0ZOy4aUHB.jpg")}}" alt="img" />
</div>

</x-app-layout>
