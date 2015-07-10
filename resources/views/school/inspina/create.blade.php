@extends('inspina.layouts.main')

@section('content')
    <div class="wrapper wrapper-content">
        <form action="{{ url('create/group') }}" method="post"  id="createschoolform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <input name="email" id="email" type="email"  class="form-control" placeholder="Group's Email" required = "required">
                    </div>
                    <div class="col-md-6">
                        <input name="username" id="username" type="text" class="form-control" placeholder="Unique Username" required = "required">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <input name="name" id="name" type="text" class="form-control" placeholder="Group Name" required = "required">
                    </div>
                    <div class="col-md-6">
                    <label for="school_affiliation" class="col-md-6">Group's University or College </label>
                        <select name="school_affiliation" id="school"  class="pull-right col-md-6">
                            <option value="" > Select Group's University or College </option>
                            <option value="Jomo Kenyatta University of Agriculture and Technology" selected> JKUAT </option>
                            <option value="Kenyatta University">Kenyatta University</option>
                            <option value="University of Nairobi"> University of Nairobi </option>
                            <option value="Moi University"> Moi University </option>
                            <option value="Other Institution"> Other Institution </option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="chat-message-form">
                            <div class="form-group">
                                <textarea class="form-control message-input" name="description" id="description" placeholder="Brief Description" required = "required"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                <label class="col-sm-2 control-label">Type of group:</label>
                    <div class="col-sm-10">
                        <label class="checkbox-inline">
                            <input type="radio" value="0" id="inlineCheckbox2" name="type" checked> Public
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="1" id="inlineCheckbox1" name="type" > Private
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{url('/')}}" class="btn btn-default">Close</a>
                <button type="button" id="createschoolbtn" class="btn btn-info">Create</button>
            </div>
        </form>
    </div>
@endsection

@section('validation')
$("#createschoolbtn").click(function()
                    {
                        if(!validateText("email"))
                            return false;
                        if(!validateText("username"))
                            return false;
                        if(!validateText("name"))
                            return false;
                        if(!validateText("school"))
                            return false;
                        if(!validateText("description"))
                            return false;
                        $('form#createschoolform').submit();

                    })
@endsection