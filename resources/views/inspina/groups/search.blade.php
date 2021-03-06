@extends('inspina.layouts.main')

@section('content')
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('inspina.partials.to_home_set')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                    <h2>
                                        {{ $tagline }}
                                    </h2>

                                <div class="search-form">
                                    <form action="{{ url('/groups/all') }}" method="get">

                                        <div class="input-group">
                                            <input type="search" placeholder="Search by group name" name="value" class="form-control input-lg">
                                            <div class="input-group-btn">
                                                <button class="btn btn-lg btn-primary" type="submit">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              @foreach($groups as $group)
                                <div class="hr-line-dashed"></div>
                                <div class="search-result">
                                <h3>{{ $group->name }}</h3>
                                    <span class="search-link"><i class="fa fa-university"></i> {{ $group->school_affiliation }}</span>
                                    <p>
                                        {{ $group->description }}
                                         <br>

                                       <span> <b>Followers</b>: {{ $group->followers()->get()->count() }}</span>&nbsp;&nbsp;&nbsp;

                                       <span> <b>Notices</b>: {{ $group->notices()->get()->count() }}</span>

                                    <br>
                                    <p align="center">
                                    @if(!$group->isFollowedBy(\Auth::user()))
                                        @if($group->isPublic())
                                        <a href="{{ url($group->username . '/join/group') }}" class="btn btn-rounded btn-primary btn-outline">Join Group</a>
                                        @else
                                        <a href="{{ url($group->username . '/send/request') }}" class="btn btn-rounded btn-primary btn-outline">Request Admission</a>
                                        @endif
                                    @else
                                    @if(!$group->isOwner(\Auth::user()))
                                        <a href="{{ url($group->username . '/leave/group') }}" class="btn btn-rounded btn-danger btn-outline">Leave Group</a>
                                    @else
                                        <a href="{{ url($group->username) }}" class="btn btn-rounded btn-default btn-outline">Manage Group</a>
                                    @endif
                                    @endif
                                    </p>
                                </div>
                              @endforeach

                                <div class="hr-line-dashed"></div>
                                <div class="text-center">
                                    <?php echo $groups->render() ?>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
@endsection