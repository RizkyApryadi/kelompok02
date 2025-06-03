@extends('layouts.main')
@section('title', 'Tambah Berita')

@section('content')
<div class="container mx-auto py-12 px-6">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg overflow-hidden">

        <!-- Form mulai di sini -->
        <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Kotak abu-abu untuk upload gambar -->
            <div class="w-full h-48 sm:h-56 md:h-64 bg-gray-300 relative flex items-center justify-center">
                <label for="imageUpload" class="absolute inset-0 flex items-center justify-center cursor-pointer">
                    <img id="imagePreview" class="hidden w-full h-full object-cover" />
                    <span id="uploadText" class="text-gray-600 font-medium">Klik untuk unggah gambar</span>
                </label>
                <input type="file" id="imageUpload" name="photo" accept="image/*" class="hidden" required />
            </div>  

            <div class="p-4 sm:p-6">
                <!-- Teks Pembuka -->
                <div class="flex items-center mb-4">
                    <div class="h-5 w-1 bg-blue-600 mr-2"></div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">BERITA TERKINI</span>
                </div>

                <!-- Input Tanggal -->
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 text-sm font-medium mb-1">Tanggal</label>
                    <input type="date" id="date" name="date" class="w-full p-2 border border-gray-300 rounded-lg" required />
                </div>

                <!-- Input Judul Berita -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-medium mb-1">Judul Berita</label>
                    <input type="text" id="title" name="title" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Judul Berita" required />
                </div>

                <!-- Input Deskripsi Berita -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-medium mb-1">Deskripsi Berita</label>
                    <textarea id="description" name="description" class="w-full p-3 border border-gray-300 rounded-lg" rows="4" placeholder="Tulis konten berita di sini..." required></textarea>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 flex items-center text-sm">
                        Simpan Berita
                    </button>
                </div>
            </div>
        </form>
        <!-- Form berakhir di sini -->
    </div>
</div>

<!-- JavaScript untuk preview gambar -->
<script>
document.getElementById('imageUpload').addEventListener('change', function(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            let imagePreview = document.getElementById('imagePreview');
            let uploadText = document.getElementById('uploadText');
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('hidden');
            uploadText.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection
