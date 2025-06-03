@extends('layouts.main')
@section('title', 'Edit Konten Tentang')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Edit Konten Tentang Kami</h2>

        <form action="{{ route('about.update', $about->id) }}" method="POST">
        @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="15"
                    class="w-full border rounded px-3 py-2">{{ old('deskripsi', $about->deskripsi) }}</textarea>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
{{-- Modal Preview (jika ingin pakai, copy dari create juga) --}}
<div id="previewModal" onclick="handleOutsideClick(event)"
    class="fixed inset-0 z-[9999] bg-black bg-opacity-70 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl max-h-[100vh] overflow-y-auto p-6 relative"
        onclick="event.stopPropagation()">
        <h3 class="text-xl font-bold mb-4">Preview Deskripsi</h3>
        <div id="previewContent" class="prose max-h-[60vh] overflow-y-auto border p-4 rounded"></div>
        <button onclick="closePreview()"
            class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl font-bold">&times;</button>
    </div>
</div>
@endsection

@push('script')
<!-- TinyMCE dari lokal -->
<script src="{{ asset('js/tinymce_7.7.2/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#deskripsi',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

    function showPreview() {
        const content = tinymce.get("deskripsi").getContent();
        document.getElementById("previewContent").innerHTML = content;
        document.getElementById("previewModal").classList.remove("hidden");
    }
    function closePreview() {
        document.getElementById("previewModal").classList.add("hidden");
    }
    function handleOutsideClick(event) {
        if (event.target.id === 'previewModal') {
            closePreview();
        }
    }
</script>
@endpush