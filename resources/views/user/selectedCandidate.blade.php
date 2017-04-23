<select name="candidate[]" class="select2_multiple form-control"
        multiple="multiple">
    @foreach($candidates as $candidate)
        <option value="{{$candidate->id}}">{{$candidate->first_name." ".$candidate->last_name}}
            ({{$candidate->region}})
        </option>
    @endforeach
</select>