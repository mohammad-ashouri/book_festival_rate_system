users
<form action="{{ route('excel.importUsers') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" required>
    <button type="submit">آپلود فایل</button>
</form>
general informations
<form action="{{ route('excel.importGeneralInformations') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" required>
    <button type="submit">آپلود فایل</button>
</form>
posts
<form action="{{ route('excel.importPosts') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" required>
    <button type="submit">آپلود فایل</button>
</form>
@php
phpinfo();
 @endphp
