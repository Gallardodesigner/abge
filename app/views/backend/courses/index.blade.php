@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
{{HTML::script("assetsadmin/js/jquery.jgrowl.js")}}
{{HTML::script("assetsadmin/js/jquery.alerts.js")}}
{{HTML::script("assetsadmin/js/jquery.dataTables.min.js")}}

<script type='text/javascript'>

     jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });
        if(jQuery('.confirmbutton').length > 0) {
          jQuery('.confirmbutton').on("click",function(e){
            e.preventDefault();
            var elem=jQuery(this);
            jConfirm('{{ Lang::get("messages.are_you_sure") }} '+elem.attr("data-action")+'  {{ Lang::get("messages.this_element") }}', 'Confirmation Dialog', function(r) {
                 // jAlert('Confirmed: ' + r, 'Confirmation Results');
                if(r==true){
                    window.location.assign("/dashboard/courses/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
                }
            });
        });
      }
        
    });
</script>
@stop

@section("title")
{{ Lang::get('titles.courses') }}
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Courses
@stop

@section("nameview")
    All Courses
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="courses/create" class="btn dropdown-toggle">Add New Course</a>
                        </div>
                        <h4 class="widgettitle">All Courses</h4>
                    </div>
                    <table id="dyntable" class="table table-bordered responsive">
                        <colgroup>
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="head0 nosort" style="width:15%"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" width="15%">Title</th>
                                <th class="head1"style="width:25%">Description</th>
                                <th class="head0" style="width:8%">Event</th>
                                <th class="head1" style="width:8%">Start at</th>
                                <th class="head0" style="width:8%">End at</th>
                                <th class="head1" style="width:10%">Participants</th>
                                <th class="head0" style="width:10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($courses))
                                @foreach($courses as $course)
                                    <tr class="gradeX">
                                      <td class="aligncenter"><span class="center">
                                        <input type="checkbox" />
                                      </span></td>
                                        <td>{{$course->title}}</td>
                                        <td>{{$course->description}}</td>
                                        <td>{{$course->event->title}}</td>
                                        <td class="center">{{date("d-m-Y", strtotime($course->start))}}</td>
                                        <td class="center">{{date("d-m-Y", strtotime($course->end))}}</td>
                                        <td class="center">
                                            {{Lang::get('display.inscriptions')}}: {{count($course->inscriptions)}}
                                            <?php $count = 0; ?>
                                            @foreach($course->inscriptions as $inscription)
                                                @if($inscription->paid)
                                                    <?php $count++ ?>
                                                @endif
                                            @endforeach
                                            {{Lang::get('display.inscriptions_paid')}}: {{$count}}
                                        </td>
                                        <td class="center">
                                             <a href="/dashboard/courses/{{$course->id}}/content/" class="btn btn-info alertwarning" style="color:#FFF !important;"><i class="iconfa-tasks" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.sections')}}</a>
                                             <a href="/dashboard/courses/{{$course->id}}/usertypes/" class="btn btn-success alertwarning" style="color:#FFF !important;"><i class="iconfa-user" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.usertypes')}}</a>
                                             <a href="/dashboard/courses/{{$course->id}}/inscriptions/" class="btn btn-success alertwarning" style="color:#FFF !important;"><i class="iconfa-star" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.inscriptions')}}</a>
                                             <a href="/dashboard/courses/update/{{$course->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.edit')}}</a>
                                   
                                            @if($course->status == 'publish')

                                                <a data-id="{{$course->id}}" data-action="draft" class="btn confirmbutton btn-primary alertdanger" style="color:#FFF !important;"><i class="iconfa-file" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.draft')}}</a>
                                            
                                            @else
                                            
                                                <a data-id="{{$course->id}}" data-action="publish" class="btn confirmbutton btn-success alertdanger" style="color:#FFF !important;"><i class="iconfa-ok" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.publish')}}</a>
                                                <a data-id="{{$course->id}}" data-action="trash" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.trash')}}</a>

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                
@stop