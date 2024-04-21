<script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
    });
</script>
<script>
    CKEDITOR.replace('introduction', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
    });
</script>
<script>
    CKEDITOR.replace('body', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
    });
</script>
