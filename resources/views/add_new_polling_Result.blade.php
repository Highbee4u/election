@extends('welcome')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Add Result For New Polling unit
    </div>
    <div class="panel-body">
        <form class="form-group">
            <fieldset>
                <legend>Filter Result</legend>
                    <label for="" >State List</label>
                    <select name="stateList" id="stateList" class="form-control">
                        @foreach ($statelists as $list)
                            <option value="{{ $list->state_id }}">{{ $list->state_name }}</option>    
                        @endforeach
                    </select>
                    <br>
                    <label for="" >Local Government List</label>
                    <select name="lgaList" id="lgaList" class="form-control">
                    </select>
                <br>
            </fieldset>
          </form>

          <table class="table" id="resultTable">
            <caption id="caption">Election Result for All Polling Unit In: <span id="captionid"></span></caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Party</th>
                <th scope="col">Total Votes</th>
              </tr>
            </thead>
            <tbody>
               
              
              
            </tbody>
          </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#pollinglist').change(function(){
            var selval = this.value;
            let getUrl = "/IndividualPU/"+ selval;
            $.ajax({
                url: getUrl,
                type: 'GET',
                contentType: 'application/json',
                success: function (data) {
                    var counter = 0;
                    var rows = '';
                    if(data.status){
                        console.log(data.id);
                        $.each(data.pollingList, function(i, item){
                            $("#pollinglist").append("<option value='" + data.pollingList[i].polling_unit_id + "'>" + data.pollingList[i].polling_unit_id + "</option>");
                        });

                        $.each(data.scorelist, function (a, items){
                            rows += "<tr><td>" + ++counter + "</td><td>" + data.scorelist[a].party_abbreviation + "</td><td>" + data.scorelist[a].score + "</td></tr>";
                        });
                        $('#resultTable tbody').append(rows);
                        $('#captionid').text(data.id);
                    }else{
                        setTimeout(function(){
                            alert("No record found");
                        }, 1000);
                    }
                },
                error: function(xhr, status,error){
                    console.log(error)
                    setTimeout(function(){
                        window.location = "{{ route('IndividualPU') }}";
                    }, 5000);
                }
            }) 
        });
    });
</script>
@endsection