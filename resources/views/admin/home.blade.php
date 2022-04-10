<x-app-layout>
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
  <head>
      @include('admin.css')
  </head>
  <body>
   
      <!-- partial -->
         @include('admin.slidebar') 
        @include('admin.navbar')
        <!-- partial -->
       @include('admin.body')
          <!-- partial -->
        @include('admin.script')
  </body>
</html>