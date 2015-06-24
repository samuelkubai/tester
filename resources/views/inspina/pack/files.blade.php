@extends('inspina.layouts.user')

@section('content')
                <!-- Content starts here -->
                <div class="wrapper wrapper-content" style="padding-right: 0px; padding-top: 0px;">
                    <div class="row">
                   @include('inspina.partials.back_to_group_feed')
                    </div>
                    <br>
                    @include('inspina.partials.error')
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="file-manager">

                                        <h5>Sharers <i class="fa fa-share-square-o"></i> <small class="pull-right">Files</small></h5>
                                        <ul class="folder-list" style="padding: 0">
                                        @if($sharers->count() != 0)
                                        @foreach($sharers as $sharer)
                                            <li><a href="{{url('share/'.$group->username.'/files/'. $sharer->id) }}"><i class="fa fa-user"></i> {{ $sharer->fullName()}} <span class="badge badge-info pull-right">{{ $group->sharedFilesof($sharer)->count() }}</span></a></li>
                                        @endforeach
                                        @else
                                            <li><b> <span align="center">No Sub Folders for this folder.</span></b></li>
                                        @endif
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">


                        @if($documents->count() != 0)
                            @foreach($documents as $document)
                                <div class="file-box">
                                    <div class="file">
                                        <a href="{{ url($document->source) }}">
                                            <span class="corner"></span>

                                        @if($document->isImage())
                                            <div class="image">
                                                <img src="{{ asset($document->source)}}" alt="{{ $document->name }}" class="img-responsive"/>
                                            </div>
                                        @else
                                            <div class="icon">
                                                <i class="fa fa-file"></i>
                                            </div>
                                        @endif
                                            <div class="file-name">
                                                {{ $document->name }}

                                                <br/>
                                                <small>Shared On: {{ $document->created_at->diffForHumans() }}</small>
                                                <br>

                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endforeach

                            @else
                                <div class="middle-box text-center animated fadeInRightBig">
                                    <h3 class="font-bold">This is page content</h3>
                                        <div class="error-desc">
                                            You can create here any grid layout you want. And any variation layout you imagine:) Check out main dashboard and other site. It use many different layout.
                                            <br><a href="index.html" class="btn btn-primary m-t">Dashboard</a>
                                        </div>
                                </div>
                        @endif
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                <!-- Content ends Here! -->
@endsection

