 <footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Dev By <a href="#">Fokal-IT</a>
  </div>
  <div class="footer-right">
  </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="{{url('')}}/assets/modules/jquery.min.js"></script>
<script src="{{url('')}}/assets/modules/popper.js"></script>
<script src="{{url('')}}/assets/modules/tooltip.js"></script>
<script src="{{url('')}}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="{{url('')}}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="{{url('')}}/assets/modules/moment.min.js"></script>
<script src="{{url('')}}/assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="{{url('')}}/assets/modules/summernote/summernote-bs4.js"></script>
<script src="{{url('')}}/assets/modules/datatables/datatables.min.js"></script>
<script src="{{url('')}}/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('')}}/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="{{url('')}}/assets/modules/jquery-ui/jquery-ui.min.js"></script>

<!-- Page Specific JS File -->
<script src="{{url('')}}/assets/js/page/modules-datatables.js"></script>
<script src="{{url('')}}/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="{{url('')}}/assets/modules/chart.min.js"></script>
{{-- <script src="{{url('')}}/assets/js/page/features-post-create.js"></script> --}}
<script src="{{url('')}}/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="{{url('')}}/assets/js/page/index-0.js"></script>

<!-- Template JS File -->
<script src="{{url('')}}/assets/js/scripts.js"></script>
<script src="{{url('')}}/assets/js/custom.js"></script>
<!-- Validator -->
<script src="{{url('')}}/js/validator.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  function preview(selector, temporaryFile, width = 200)  {
    $(selector).empty();
    $(selector).append(`<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`);
  }
</script>
@stack('scripts')