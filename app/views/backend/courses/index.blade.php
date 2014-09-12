@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
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
        
    });
</script>
@stop

@section("title")
Courses
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
                            <col class="con0" style="align: center; width: 4%" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0">Rendering engine</th>
                                <th class="head1">Browser</th>
                                <th class="head0">Platform(s)</th>
                                <th class="head1">Engine version</th>
                                <th class="head0">CSS grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="gradeX">
                              <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td>Trident</td>
                                <td>Internet Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td class="center">4</td>
                                <td class="center">X</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                
@stop