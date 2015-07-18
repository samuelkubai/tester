
                                <div class="modal inmodal" id="createForum" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-bullhorn modal-icon"></i>
                                                <h4 class="modal-title">Create a Forum</h4>
                                                <small class="font-bold">Feel free to share or enquire on anything and everything.</small>
                                            </div>
                                            <form action="{{ url($group->username.'/forums/create') }}" id="createfolderform" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body">
                                                   <div class=" form-group">
                                                   <label>Forum Name:</label>
                                                        <input class="form-control" name="name" id="name" placeholder="Enter forum title" type="text"/>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="submit" id="createfolderbtn" class="btn btn-primary">Create Forum</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>