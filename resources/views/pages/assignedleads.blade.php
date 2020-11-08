@extends('layouts.app', ['activePage' => 'leads-management', 'title' => 'Leadbox Management System', 'navName' => 'Leads Management', 'activeButton' => 'laravel'])

@section('content')
    @php
    $unassignedTotal = $assignedTotal = $rejectedTotal = $reassignedTotal = 0;
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="col-12 mt-2">
                @include('alerts.success')
                @include('alerts.errors')
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card striped-tabled-with-hover">
                        <div class="card-header  text-center">
                            <h3 class="card-title ">Leads</h3>
                            <p class="card-category ">Here you can view or delete the leads.</p>
                        </div>
                        <div class="card-body">
                        @php
                        foreach ($leadMails as $leadMail){
                                    
                                    if($leadMail->agent_id == 0){
                                        $unassignedTotal++;
                                    } elseif($leadMail->rejected > 0){
                                        $rejectedTotal++;
                                    } elseif($leadMail->old_agent_id > 0){
                                        $reassignedTotal++;
                                    } else {
                                        $assignedTotal++;
                                    }
                        }
                        @endphp
                        <div class="p-4 text-center">
                            <label for="time-set">Run the report by dates: </label>
                            <form method='POST'>
                                @csrf
                                <input type="date" id="from-date" name="from-date" value="{{explode(' ', $dateFrom)[0]}}" > to <input type="date" id="to-date" name="to-date" value="{{explode(' ', $dateTo)[0]}}" >
                            <form>
                            <button type="submit" class="btn btn-primary">Submit</a>
                        </div>
                        <ul class="nav nav-tabs">
                        <li class="nav-item">
                        <button class="nav-link active" onclick="openReport(event, 'unassigned', this)">Unassigned ({{$unassignedTotal}})</button>
                        </li> 
                        <li class="nav-item">
                        <button class="nav-link" onclick="openReport(event, 'assigned', this)">Assigned ({{$assignedTotal}})</button>
                        </li>
                        <li class="nav-item">
                        <button class="nav-link" onclick="openReport(event, 'rejected', this)">Rejected ({{$rejectedTotal}})</button>
                        </li>
                        <li class="nav-item">
                        <button class="nav-link" onclick="openReport(event, 'reassigned', this)">Reassigned ({{$reassignedTotal}})</button>
                        </li>
                        </ul>
                            <div id="assigned" style="display:none" class="type" >
                                <table class="table table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Sender </th>
                                        <th style="width:200px">Subject Line </th>
                                        <th style="width:200px">Agent</th>
                                        <th>Time/date</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($leadMails as $leadMail)
                                        @if($leadMail->agent_id > 0)
                                        <tr>
                                            <td><span id="mail-from">{{$leadMail->id}}</span></td>
                                            <td><span id="mail-from">{{$leadMail->email_from}}</span></td>
                                            <td>{{$leadMail->subject}}</td>
                                            <td >{{optional(optional($leadMail->agent())->first())->name}}</td>
                                            
                                            <td><span id="mail-date">{{\Carbon\Carbon::parse($leadMail->received_date)->format('m/d/Y g:i A')}}</span> </td>
                                            
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <div class="modal fade " id="leadsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="leadsModalBody" style="border:solid darkgray 1px!important; padding:25px; min-height:400px">
        ...
        </div>
    </div>
    </div>

<script>
function openReport(e, report, caller) {
  var i;
  var x = document.getElementsByClassName("type");

  e.preventDefault();

  $('.nav-link').removeClass('active');
  $(this).addClass('active');

  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  document.getElementById(report).style.display = "block";
}
</script>
@endsection