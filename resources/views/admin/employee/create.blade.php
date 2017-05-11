@extends('admin.layouts.app')
@section('content')
{!! Breadcrumbs::render('create_employee') !!}
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered clearfix" style="position:relative; padding-bottom: 40px;">
            <div class="">
                <div class="caption">
                    <i class="icon-equalizer font-blue"></i>
                    <span class="caption-subject font-blue bold">{{ trans("employee.add_employee") }}</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            
            <div class="portlet-body form">
                {!! Form::open(['route' => 'admin.employee.store', 'class' => 'form-horizontal ajax', 'files' => true])!!}
                    @include('admin.employee._form')
                {!! Form::close() !!}  
                <div style="float: right; width: 50%; margin-top: -100px;" class="form-horizontal ajax">                
                <div class="form-group {{ $errors->has('documents') ? 'has-error' : ''}}">
                    {!! Form::label('documents', trans('employee.documents'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">                
                        <form id="fileupload" action="admin.employee.create" class="form-horizontal ajax" method="POST" enctype="multipart/form-data">

                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-7" style="width: 100%;">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <input type="hidden" name="emp_code" value="<?php echo $input['employee_code'];?>" id="emp_code">
                                        <input type="file" name="files[]" tabindex='33' multiple>
                                    </span>
                                    <button type="submit" class="btn btn-primary start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <span class="fileupload-process"></span>
                                </div>

                            </div>
                            <table role="presentation" style="width:100%;"><tbody class="files"></tbody></table>
                        </form>

                        {!! $errors->first('documents', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-6">
                        <script id="template-upload" type="text/x-tmpl">
                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-upload fade">

                                <td>
                                    <p class="name">{%=file.name%}</p>
                                    <strong class="error text-danger"></strong>
                                </td>
                                <td>
                                    <p class="size">Processing...</p>
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                                </td>
                                <td>
                                    {% if (!i && !o.options.autoUpload) { %}
                                        <div class="start" ></div>
                                    {% } %}
                                    {% if (!i) { %}
                                        <button class="btn btn-warning cancel">Cancel</button>
                                    {% } %}
                                </td>
                            </tr>
                        {% } %}
                        </script>
                        <!-- The template to display files available for download -->
                        <script id="template-download" type="text/x-tmpl">
                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-download fade">        
                                <td>
                                    <p class="name">
                                        {% if (file.url) { %}
                                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                        {% } else { %}
                                            <span>{%=file.name%}</span>
                                        {% } %}
                                    </p>
                                    {% if (file.error) { %}
                                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                                    {% } %}
                                </td>

                                <td>                                            
                                    {% if (file.deleteUrl) { %}
                                        <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}&emp_code=<?php echo $input['employee_code'];?>" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                            <i class="glyphicon glyphicon-trash"></i>                   
                                        </button>

                                    {% } else { %}
                                        <button class="btn btn-warning cancel">
                                            <i class="glyphicon glyphicon-ban-circle"></i>
                                        </button>
                                    {% } %}
                                </td>
                            </tr>
                        {% } %}
                        </script>        

                    </div>
                </div>
            </div> 
            </div> 
            
            
            
        </div>
    </div>
</div>
<style>    
    .contract_duration_cls{ display: none;}    
</style>
@endsection
