
                                <div class="modal inmodal" id="uploadModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-upload modal-icon"></i>
                                                <h4 class="modal-title">Upload New File</h4>
                                                <small class="font-bold">Only images and documents to be shared ( Maximum file size: 100mb ).</small>
                                            </div>
                                            <form action="{{ url('pack',$folder->id) }}" method="POST" id="uploadfileform" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body">
                                                   <div class="row form-group"><input type="file" name="file" id="file" placeholder="Select a file to upload" class="form-control col-sm-12"></div>
                                                   <div class="row form-group"><input type="text" name="name" placeholder="Rename File if you wish.." class="form-control col-sm-12"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="button" id="uploadfilebtn" class="btn btn-primary">Upload File</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>