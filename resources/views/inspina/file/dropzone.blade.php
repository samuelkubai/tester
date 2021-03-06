@extends('inspina.layouts.main')

@section('content')

   <div class="row">
                    @include('inspina.partials.to_folder_nav')
                  <div class="col-lg-12">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5>Drag and drop files in here or <i>click to browse for files.</i></h5>

                      </div>
                      <div class="ibox-content">
                          <form id="my-awesome-dropzone" class="dropzone"  method="post" action="{{ url('/dropzone/upload', $folder->id) }}">
                              <!--<div class="dropzone-previews"></div>-->
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-upload"></i> Upload files</button>
                          </form>
                          <div>
                              <div class="m text-right"><small>DropzoneJS is an open source library that provides drag'n'drop file uploads with image previews: <a href="https://github.com/enyo/dropzone" target="_blank">https://github.com/enyo/dropzone</a></small> </div>
                          </div>
                      </div>
                  </div>
              </div>
              </div>


@endsection
@section('script')

    <script>
        $(document).ready(function(){
        var  allowedTypes =
                    '.txt, .pdf, .docx, .jpg, .png, .jpeg, .jpe, .ppt,.pptx,.pptm,.pot,.potx, .doc,  .zip, .tar, .rar, .7z, .iso,.xls, .xlsm, .xlsx, .xlsb, .xlt';
         Dropzone.options.myAwesomeDropzone = {

                paramName: "files[]",
                autoProcessQueue: false,
                maxFilesize: 1000000,
                addRemoveLinks: true,
                acceptedFiles: 'image/*,'+ allowedTypes,


                // Dropzone settings
                init: function() {

                    var submitButton = document.querySelector("button[type=submit]");
                    var myDropzone = this;

                    submitButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                    });

                    myDropzone.on("complete", function(file) {
                      myDropzone.removeFile(file);
                    });


                }

            }

       });
    </script>
@endsection
